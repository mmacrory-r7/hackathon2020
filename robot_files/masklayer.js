var MaskProperties = {
	offset: "offset",
	smoothing: "smoothing",
	feathering: "feathering"
}

function MaskLayer(size, mask, scribbleLayer, mattingLayer, layerId, data) {
	ScribbleLayer.apply(this, [size, layerId, data]);
	this.mask = mask;
	this.worker = null;
	this.scribbleLayer = scribbleLayer;
	this.scribbleLayer.layerChangedEvent.attach(scribbleChanged.bind(this));

	this.mattingLayer = mattingLayer;
	this.mattingLayer.layerChangedEvent.attach(scribbleChanged.bind(this));

	function scribbleChanged(){
		this.drawLayer();
	}
}

MaskLayer.prototype = Object.create(ScribbleLayer.prototype);
MaskLayer.prototype.constructor = MaskLayer;
MaskLayer.prototype.render = function (ctx) {
	return;
	/*
	if(this._canvas && this.isEnabled()) {
		ctx.strokeStyle="yellow";
		ctx.lineWidth = 2/ this.view.getScale();
		this.contours.forEach(function(contour){
			if(contour.length < 1)
				return;

			ctx.beginPath();
	
			ctx.moveTo( contour[0][0],
						contour[0][1]);
			
			for(var j =1;j<contour.length;j++) {
				ctx.lineTo( contour[j][0],
							contour[j][1]);
			}
			ctx.closePath();
			ctx.stroke();	
		}, this);
	}
	*/
}

MaskLayer.prototype.propertyChanged = function(id){
	switch(id)
	{
		case MaskProperties.feathering:
		case MaskProperties.offset:
		case MaskProperties.smoothing:
			this.drawLayer();
			break;
	}
}
/*
function calcContentRect(contours){
	var contentRect = new Rect();
	contours.forEach(function(contour){
		if(contour.points.length < 1)
			return;

		var rect = new Rect();
		rect.initFromPoints(contour.points);
		
		contentRect.unite(rect);
	});
	return contentRect;
}
*/
function imageDataToDataURL(imageData, width, height){
	var canvas = document.createElement("canvas");
	canvas.width = width;
	canvas.height = height;
	var ctx = canvas.getContext("2d");
	ctx.putImageData(imageData, 0, 0);
	return canvas.toDataURL("image/png");
}
/*
function applyTrimapMask(maskData, mattingData, img, width, height){
	var canvas = document.createElement("canvas");
	canvas.width = width;
	canvas.height = height;
	var ctx = canvas.getContext("2d");
	ctx.clearRect(0, 0, width, height);
	ctx.drawImage(img, 0, 0, width, height);
	var newMaskData = ctx.getImageData(0,0,width,height);

	for(var y=0;y<height; y++)
	{
		for(var x=0;x<width;x++)
		{
			var i = y*width*4 + x*4;
			if(mattingData.data[i + 0]){
				maskData.data[i+0] = newMaskData[i+0];
				maskData.data[i+1] = newMaskData[i+1];
				maskData.data[i+2] = newMaskData[i+2];
				maskData.data[i+3] = newMaskData[i+3];
			}
		}
	}
}
*/
MaskLayer.prototype.drawLayer = function(){
	this.beginWorkEvent.notify();
	var br = this._properties[MaskProperties.feathering];
	var offset = this._properties[MaskProperties.offset];
	
	var ctx = this._canvas.getContext("2d");
	ctx.clearRect(0, 0, this._canvas.width, this._canvas.height);
	ctx.drawImage(this.mask, 0, 0, this._canvas.width, this._canvas.height);
	
	var size = this.scribbleLayer.size();

	var sw = size.width;
	var sh = size.height;
	var scribbleData = null;
	var mattingData = null;
	if(this.scribbleLayer.contentRect.isEmpty() == false) 
		scribbleData = this.scribbleLayer._canvas.getContext("2d").getImageData(0,0,size.width,size.height);	

	if(this.mattingLayer.contentRect.isEmpty() == false)
		mattingData = this.mattingLayer._canvas.getContext("2d").getImageData(0,0,size.width,size.height);

	if(this.worker)
		this.worker.terminate();

	this.worker = new Worker('/js/maskworker.js');
	var worker = this.worker;
	this.worker.onmessage = (event) => {
		if (event.data.status === 'complete') {
			ctx.putImageData(event.data.imageData,0,0);
			this.contentRect = new Rect(event.data.contentRect);
			this.layerChangedEvent.notify();
			var self = this;
			if(event.data.trimapData){
				var trimap = imageDataToDataURL(event.data.trimapData, size.width, size.height);
				var trimapRect = new Rect(event.data.trimapRect);
				var data = "";
				data +='&trimap=' + encodeURIComponent(trimap);
				if(trimapRect.isEmpty()){
					this.endWorkEvent.notify();
					return;
				}
				makeRequest({
					method:'POST',
					url: getUrl() + "/matting",
					headers: {"Content-Type": "application/x-www-form-urlencoded"},
					body: data
				})
				.then((response) => {
					if(worker != this.worker)
						return;

					if(response){
						var img = new Image();

						img.onload = function(){
							ctx.clearRect(trimapRect.x, trimapRect.y, trimapRect.width, trimapRect.height);
							ctx.drawImage(img, trimapRect.x, trimapRect.y, trimapRect.width, trimapRect.height,trimapRect.x, trimapRect.y, trimapRect.width, trimapRect.height);
							self.layerChangedEvent.notify();
						}
		
						img.src = response;
					}
				})
				.catch( (err) => {
					showMessage("Error", "Load mask failed!");
				})
				.finally(()=>{
					self.endWorkEvent.notify();
				});
			}
			else {
				self.endWorkEvent.notify();
			}
		} else {
			// event.data.progress + "%";
		}
	}
	this.worker.postMessage({
		imageData: ctx.getImageData(0,0,sw,sh),
		scribbleData: scribbleData,
		mattingData: mattingData,
		width: sw,
		height: sh,
		feathering: br,
		offset: offset
	});

}