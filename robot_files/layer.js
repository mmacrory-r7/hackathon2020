var LayerProperties = {
	boundingRect: "boundingRect",
	opacity: "opacity",
	enabled: "enabled",
}

function Layer(size, layerId, data) {
	this._layerId = layerId;
	this.layerChangedEvent = new Event(this);
	this.beginWorkEvent = new Event(this);
	this.endWorkEvent = new Event(this);

	this._canvas = 0;
	this.view = 0;
	this.visible = true;
	this.tool = 0;
	this.contentRect = new Rect(); // must be updated at drawLayer
	this.propertyChangedEvent = new Event(this);

	this.createCanvas(size.width, size.height);

	this._properties = {};
	this._properties[LayerProperties.enabled] = true;
	this._properties[LayerProperties.opacity] = 100;
	this._properties = data;
	if(!this._properties[LayerProperties.boundingRect])
		this.setProperty(LayerProperties.boundingRect, this.defaultBoundingRect());
};

Layer.prototype.constructor = Layer;
Layer.prototype.render = function (context) {
	//context.fillStyle="#FF0000";
	//context.fillRect(this.boundingRect.x,this.boundingRect.y,this.boundingRect.width,this.boundingRect.height);
	if(this._canvas && this.isEnabled()) {
		var rect = this.boundingRect();
		context.drawImage(this._canvas, 0, 0, this._canvas.width, this._canvas.height,
			rect.x, rect.y, rect.width, rect.height);
	}
}

Layer.prototype.defaultBoundingRect = function(){
	return { x:0, y:0, width: this._canvas.width, height: this._canvas.height };
}

Layer.prototype.init = function(data){
	var keys = Object.keys(data);
	keys.forEach(function(id){
		this._properties[id] = data[id];
		this.propertyChangedEvent.notify(id);
		//this.setProperty(prop, data[prop]);
	},this);
	this.updateLayer();
}

Layer.prototype.load = function() {
	makeRequest({
		method:'GET',
		url: getUrl() + "/layer/" + this.layerId()
	})
	.then((response) => {
		this.init(JSON.parse(response));
	})
	.catch( (err) => {
  		console.error('error!', err.statusText);
	});
}

Layer.prototype.allProperties = function() {
	return this.clone(this._properties);
}

Layer.prototype.save = function() {
	makeRequest({
		method:'POST',
		url: getUrl() + "/layer/" + this.layerId(),
		headers: {"Content-Type": "application/json"},
		body: JSON.stringify(this._properties)
	})
	.then(function (response) {})
	.catch(function (err) {
		console.error('error!', err.statusText);
	});
}

Layer.prototype.size = function(){
	return { width: this._canvas.width, height: this._canvas.height };
}

Layer.prototype.createCanvas = function(width, height){
	this._canvas = document.createElement('canvas');
	this._canvas.width = width;
	this._canvas.height = height;
}

Layer.prototype.layerId = function(){
	return this._layerId;
}

Layer.prototype.property = function(id){
	return this.clone(this._properties[id]);
}

Layer.prototype.setProperty = function(id, value) {
	if(this._properties[id] == value)
		return;
	this._properties[id] = value;
	this.propertyChanged(id);
	this.propertyChangedEvent.notify(id);
	this.save();
}

Layer.prototype.clone = function(obj){
	if (null == obj || "object" != typeof obj) {
		return obj;
	}

	return JSON.parse(JSON.stringify(obj));
}

Layer.prototype.boundingRect = function() {
	return this.property(LayerProperties.boundingRect);
}

Layer.prototype.opacity = function() {
	return this.property(LayerProperties.opacity);
}

Layer.prototype.isEnabled = function(){
	return this.property(LayerProperties.enabled);
}

Layer.prototype.setOpacity = function(opacity) {
	this.setProperty(LayerProperties.opacity, opacity);
}

Layer.prototype.setTool = function(newTool) {
	this.tool = newTool;
	this.tool.setLayer(this);
	this.view.setCursor(newTool.cursor());
}

Layer.prototype.setView = function(newView) {
	this.view = newView;
}

Layer.prototype.propertyChanged = function(){

}

Layer.prototype.updateLayer = function(){
	this.drawLayer();
}

Layer.prototype.drawLayer = function(){

}
//-----------------------------------------------------
function LayerTool(){
	this._layer = 0;
}

LayerTool.prototype.setLayer = function(layer){
	this._layer = layer;
}

LayerTool.prototype.layer = function(){
	return this._layer;
}

LayerTool.prototype.cursor = function(){
	return "default";
}




