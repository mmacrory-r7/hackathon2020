var ShadowProperties = {
	color: "color",
	blurRadius: "blurRadius",
}

function ShadowLayer(maskLayer, layerId, data) {
	Layer.apply(this, [maskLayer.size(), layerId, data]);

	this.maskLayer = maskLayer;
	this.maskLayer.layerChangedEvent.attach(maskChanged.bind(this));
	
	function maskChanged(){
		this.drawLayer();
	}
}

function hexToRgb(hex) {
	var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
	return result ? {
		r: parseInt(result[1], 16),
		g: parseInt(result[2], 16),
		b: parseInt(result[3], 16)
	} : null;
}

ShadowLayer.prototype = Object.create(Layer.prototype);
ShadowLayer.prototype.constructor = ShadowLayer;
ShadowLayer.prototype.defaultBoundingRect = function(){
	var rect = Layer.prototype.defaultBoundingRect.call(this);
	rect.x+=10;
	rect.y+=10;
	return rect;
}
ShadowLayer.prototype.propertyChanged = function(id){
	switch(id)
	{
		case ShadowProperties.color:
		case ShadowProperties.blurRadius:
			this.drawLayer();
			break;
		case LayerProperties.opacity:
		case LayerProperties.enabled:
			this.view.update();
			break;

	}
}
ShadowLayer.prototype.drawLayer = function(){
	if(this.maskLayer.contentRect.isEmpty() /* || this.isEnabled() == false*/)
		return;

	this.beginWorkEvent.notify();
	var br = this._properties[ShadowProperties.blurRadius];
	var shadowColor = this._properties[ShadowProperties.color];
	var size = this.maskLayer.size();
	
	var sw = size.width + 2*br;
	var sh = size.height + 2*br;

	if(this._canvas.width != sw || this._canvas.height != sh){
		this.createCanvas(sw, sh);
	}

	var ctx = this._canvas.getContext("2d");
	ctx.clearRect(0, 0, this._canvas.width, this._canvas.height);
	ctx.drawImage(this.maskLayer._canvas, br, br);

	var worker = new Worker('/js/shadowworker.js');
	worker.postMessage({
		imageData: ctx.getImageData(0,0,sw,sh), 
		color: hexToRgb(shadowColor),
		width: sw,
		height: sh,
		radius: br
	});

	worker.onmessage = (event) => {
		if (event.data.status === 'complete') {
			ctx.putImageData(event.data.imagedata,0,0);
			this.layerChangedEvent.notify();
			this.endWorkEvent.notify();
		} else {
			// event.data.progress + "%";
		}
	}
}