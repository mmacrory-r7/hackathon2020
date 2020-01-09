var BackgroundProperties = {
	padding: "padding",
	fitToResult: "fitToResult",
	aspectRatio: "aspectRatio",
	color: "color",
	image: "image",
	original: "original",
	transparent: "transparent",
	mode: "mode",
	inpaint: "inpaint",
}

function BackgroundLayer(imageLayer, maskLayer, layerId, data) {
	Layer.apply(this, [imageLayer.size(), layerId, data]);

	this.imageLayer = imageLayer;
	this.maskLayer = maskLayer;
	this.image = 0;

	this.maskLayer.layerChangedEvent.attach(maskChanged.bind(this));

	function maskChanged() {
		this.drawLayer();
	}
}

BackgroundLayer.prototype = Object.create(Layer.prototype);
BackgroundLayer.prototype.constructor = BackgroundLayer;

BackgroundLayer.prototype.defaultBoundingRect = function(){
	if(this.maskLayer)
		return this.maskLayer.defaultBoundingRect();
	else
		return Layer.prototype.defaultBoundingRect.call(this);
}
BackgroundLayer.prototype.propertyChanged = function(id){
	Layer.prototype.propertyChanged(id);
	switch(id)
	{
		case BackgroundProperties.mode:
		case BackgroundProperties.color:
		case BackgroundProperties.original:
			this._properties[BackgroundProperties.image] = "";
			this.drawLayer();
			break;
		case BackgroundProperties.aspectRatio:
			break;
		case BackgroundProperties.fitToResult:
			break;
		case BackgroundProperties.padding:
			break;
		case  BackgroundProperties.image:
			if(this._properties[BackgroundProperties.image]) {
				this.image = new Image();
				this.image.onload = (function(){ this.drawLayer(); }).bind(this);
				this.image.src = this._properties[BackgroundProperties.image];
			} else {
				this.image = 0;
				this.drawLayer();
			}
			break;
	}
}

BackgroundLayer.prototype.save = function(){
	this._properties[BackgroundProperties.image] = ""; // do not save background image to server
	Layer.prototype.save.call(this);
}

BackgroundLayer.prototype.drawLayer = function(){
	this.beginWorkEvent.notify();

	var ctx = this._canvas.getContext("2d");
	var size = this.imageLayer.size();
	this._canvas.width = size.width;
	this._canvas.height = size.height;
	
	ctx.clearRect(0, 0, this._canvas.width,this._canvas.height);

	switch(this._properties[BackgroundProperties.mode])
	{
	case BackgroundProperties.transparent:
		break;

	case BackgroundProperties.color:
		ctx.fillStyle = this._properties[BackgroundProperties.color];
		ctx.fillRect(0,0,this._canvas.width,this._canvas.height);
		break;

	case BackgroundProperties.image:
		if(this.image && this.image.complete){
			this._canvas.width = this.image.width;
			this._canvas.height = this.image.height;

				/*
			var rect = this.boundingRect();
			ctx.drawImage(this.image, 0, 0, this.image.width, this.image.height,
				rect.x, rect.y, rect.width, rect.height);
				*/
			ctx.drawImage(this.image, 0, 0);
		}
		break;

	case BackgroundProperties.original:
		ctx.drawImage(this.imageLayer._canvas, 0, 0);
		break;
	}

	this.layerChangedEvent.notify();
	this.endWorkEvent.notify();
}