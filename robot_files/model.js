var LayerNames = {
	ImageLayer: "image",
	ScribbleLayer: "scribble",
	ForegroundLayer: "foreground",
	BackgroundLayer: "background",
	ShadowLayer: "shadow",
	MaskLayer: "mask",
	MattingLayer: "matting"
}

function getUrl(){
	var query = window.location.pathname.split('/');
	return "/" + query[1] + "/" + query[2];
}

function Model(){
	this.modelLoadedEvent = new Event(this);
	var layers = {};
	var size = null;
	this.undoStack = new UndoStack(this);
	this.fileName = "image.png";

	var imagePromise = loadImage(getUrl() + "/image");
	var maskPromise = loadImage(getUrl() + "/alpha");
	var dataPromise = makeRequest({ method:'GET', url: getUrl() + "/model" });

	Promise.all([imagePromise, maskPromise, dataPromise]).then((values) => {
		var image = values[0];
		var mask = values[1];
		var data = JSON.parse(values[2]);

		if(image.complete && mask.complete && data != null) {

			size = {width: image.width, height: image.height};
			this.fileName = data["fileName"] == null ? "image" : data["fileName"];
			var imageLayer = new ImageLayer(image, LayerNames.ImageLayer, data[LayerNames.ImageLayer]);
			var scribbleLayer = new ScribbleLayer(size, LayerNames.ScribbleLayer, data[LayerNames.ScribbleLayer]);
			var mattingLayer = new ScribbleLayer(size, LayerNames.MattingLayer, data[LayerNames.MattingLayer]);
			var maskLayer = new MaskLayer(size, mask, scribbleLayer, mattingLayer, LayerNames.MaskLayer, data[LayerNames.MaskLayer]);

			var foregroundLayer = new ForegroundLayer(imageLayer, maskLayer, LayerNames.ForegroundLayer, data[LayerNames.ForegroundLayer]);
			var backgroundLayer = new BackgroundLayer(imageLayer, maskLayer, LayerNames.BackgroundLayer, data[LayerNames.BackgroundLayer]);
			var shadowLayer = new ShadowLayer(maskLayer, LayerNames.ShadowLayer, data[LayerNames.ShadowLayer]);

			addLayer(imageLayer);
			addLayer(scribbleLayer);
			addLayer(mattingLayer);
			addLayer(maskLayer);
			
			addLayer(backgroundLayer);
			addLayer(shadowLayer);
			addLayer(foregroundLayer);

			this.modelLoadedEvent.notify();

			scribbleLayer.drawLayer();
		}
	})
	.catch( (error) => { 
		showMessage("Error", "Load Failed!"); 
	});

	this.imageSize = function() {
		return size;
	}

	function addLayer(layer){
		layers[layer.layerId()] = layer;
	}

	this.layer = function(name) {
		return layers[name];
	}
}