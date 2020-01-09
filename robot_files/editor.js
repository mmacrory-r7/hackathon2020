function Editor(model, leftCanvas, rightCanvas) {
	var self = this;
	this.model = model;
	this.btns = [];
	this.markerSlider = document.getElementById("markerSize");
	this.markerSlider.oninput = function() { window.editor.setLineWidth(this.value); }
	this.inputs = [];

	model.undoStack.indexChangedEvent.attach(undoIndexChanged.bind(this));

	var leftView = new LayersView(leftCanvas, model.imageSize());
	leftView.zoomChangedEvent.attach(zoomChanged.bind(this));
	leftView.offsetChangedEvent.attach(offsetChanged.bind(this));
	leftView.addLayer(model.layer(LayerNames.ImageLayer));
	leftView.addLayer(model.layer(LayerNames.ScribbleLayer));
	leftView.addLayer(model.layer(LayerNames.MattingLayer));
	leftView.addLayer(model.layer(LayerNames.MaskLayer));
	leftView.setActiveLayer(model.layer(LayerNames.ScribbleLayer));

	var rightView = new LayersView(rightCanvas, model.imageSize());
	rightView.zoomChangedEvent.attach(zoomChanged.bind(this));
	rightView.offsetChangedEvent.attach(offsetChanged.bind(this));
	rightView.addLayer(model.layer(LayerNames.BackgroundLayer));
	rightView.addLayer(model.layer(LayerNames.ShadowLayer));
	rightView.addLayer(model.layer(LayerNames.ForegroundLayer));
	rightView.setActiveLayer(model.layer(LayerNames.ForegroundLayer));

	var propChanged = propertyChanged.bind(this);
	model.layer(LayerNames.MaskLayer).propertyChangedEvent.attach(propChanged);
	model.layer(LayerNames.ShadowLayer).propertyChangedEvent.attach(propChanged);
	model.layer(LayerNames.ForegroundLayer).propertyChangedEvent.attach(propChanged);
	model.layer(LayerNames.BackgroundLayer).propertyChangedEvent.attach(propChanged);

	var beginWork = beginProcessing.bind(this);
	var endWork = endProcessing.bind(this);

	model.layer(LayerNames.MaskLayer).beginWorkEvent.attach(beginWork);
	model.layer(LayerNames.MaskLayer).endWorkEvent.attach(endWork);
	model.layer(LayerNames.ForegroundLayer).beginWorkEvent.attach(beginWork);
	model.layer(LayerNames.ForegroundLayer).endWorkEvent.attach(endWork);
	model.layer(LayerNames.BackgroundLayer).beginWorkEvent.attach(beginWork);
	model.layer(LayerNames.BackgroundLayer).endWorkEvent.attach(endWork);
	model.layer(LayerNames.ShadowLayer).beginWorkEvent.attach(beginWork);
	model.layer(LayerNames.ShadowLayer).endWorkEvent.attach(endWork);
	//propChanged(model.layer(LayerNames.BackgroundLayer),BackgroundProperties.mode);

	var rectTracker = new RectTracker(this.model.undoStack)

	var markerTool = new ScribbleMarker(this.model.undoStack);
	model.layer(LayerNames.ScribbleLayer).setTool(markerTool);

	
	initButtons();
	undoIndexChanged();
	leftView.zoomToFit();
	propertyChanged(model.layer(LayerNames.BackgroundLayer), BackgroundProperties.mode);
	
	var fg = model.layer(LayerNames.ForegroundLayer);
	fg.setTool(rectTracker);
	rectTracker.setRect(fg.boundingRect());

	function getInput(layer,prop) {
		if(prop) {
			var res = this.inputs.filter('[data-layer='+layer+']');
			return res.filter('[data-property='+prop+']');
		} else {
			if(layer)return this.inputs.filter('[data-layer='+layer+']');
			else return this.inputs;
		}
	}

	function getAct(name,arg) {
		if(arg) {
			var res = this.btns.filter('[data-act='+name+']');
			return res.filter('[data-arg='+arg+']');
		} else {
			if(name)return this.btns.filter('[data-act='+name+']');
			else return this.btns;
		}
	}

	function undoIndexChanged() {
		enableButton('undo',self.model.undoStack.canUndo());
		enableButton('redo',self.model.undoStack.canRedo());
	}

	function propertyChanged(sender, prop){
		var val = sender.property(prop);
		var inp = getInput(sender.layerId(), prop);
		
		if(inp.is(':checkbox'))
			inp.prop('checked', val);
		else
			inp.val(val);

		if(prop == BackgroundProperties.mode){
			var bgColorGroup = $('#bgColor').parents('.form-group');
			var bgImageGroup = $('#bgImage').parents('.form-group');
			bgColorGroup.hide();
			bgImageGroup.hide();
			var val = sender.property(prop);
			switch(val)
			{
				case "color":
				bgColorGroup.show();
				break;
				case "image":
				bgImageGroup.show();
				break;
			}
		}
	}

	function enableButton(name, enabled){
		var btn = getAct(name);
		if(enabled){
			btn.removeClass('disabled');
		} else {
			btn.addClass('disabled');
		}
	}

	var MAX_WIDTH = 1920;
	var MAX_HEIGHT = 1920;
	function resizeImage(img)
	{
		return new Promise((resolve, reject) => {
			EXIF.getData(img, function() {
				var orientation = EXIF.getTag(this, "Orientation");
	
				var width = img.width;
				var height = img.height;
	
				if (width > height) {
					if (width > MAX_WIDTH) {
					  height *= MAX_WIDTH / width;
					  width = MAX_WIDTH;
					}
				} else {
					if (height > MAX_HEIGHT) {
					  width *= MAX_HEIGHT / height;
					  height = MAX_HEIGHT;
					}
				}
	
				var canvas = document.createElement('canvas');
				// set proper canvas dimensions before transform & export
				if (4 < orientation && orientation < 9) {
					canvas.width = height;
					canvas.height = width;
				} else {
					canvas.width = width;
					canvas.height = height;
				}
	
				var ctx = canvas.getContext("2d");
				// transform context before drawing image
				switch (orientation) {
					case 2: ctx.transform(-1, 0, 0, 1, width, 0); break;
					case 3: ctx.transform(-1, 0, 0, -1, width, height); break;
					case 4: ctx.transform(1, 0, 0, -1, 0, height); break;
					case 5: ctx.transform(0, 1, 1, 0, 0, 0); break;
					case 6: ctx.transform(0, 1, -1, 0, height, 0); break;
					case 7: ctx.transform(0, -1, -1, 0, height, width); break;
					case 8: ctx.transform(0, -1, 1, 0, 0, width); break;
					default: break;
				}
				ctx.drawImage(img, 0, 0, width, height);
				resolve({ dataurl: canvas.toDataURL("image/png"), width: width, height: height});
			});
		});
	}

	function readFile(file){
		return new Promise((resolve, reject) => {
		  var fr = new FileReader();  
		  fr.onload = (()=> {resolve(fr.result)});
		  fr.onerror = (() => { reject(); });
		  fr.readAsDataURL(file);
		});
	}

	function setBgImage(dataurl, width, height){
		var imgSize = model.imageSize();
		var maxDim = Math.max(imgSize.width,imgSize.height);
		var aspectRatio = width/height;
		var rect = new Rect();
		if(aspectRatio>1.0) // horizontal image
		{
			rect.height = maxDim;
			rect.width = Math.round(maxDim*aspectRatio+0.5);
		}
		else // vertical image
		{
			rect.width = maxDim;
			rect.height = Math.round(maxDim/aspectRatio);
		}

		rect.moveCenter({x:imgSize.width/2, y:imgSize.height/2});

		var bg = model.layer(LayerNames.BackgroundLayer);
		var cmd = new GroupUndoCommand();
		cmd.push(
			new ChangeLayerPropertyCommand(	LayerNames.BackgroundLayer,
											LayerProperties.boundingRect,
											bg.property(LayerProperties.boundingRect),
											rect)
			);
		
																	
		cmd.push(
			new ChangeLayerPropertyCommand(	LayerNames.BackgroundLayer,
											BackgroundProperties.image,
											bg.property(BackgroundProperties.image),
											dataurl)
				);

		self.model.undoStack.push(cmd);
	}

	function handleBgImage(e){
		readFile(e.target.files[0])
		.then((result)=>{
			loadImage(result)
			.then((image)=>{
				resizeImage(image)
				.then((result)=>{
					setBgImage(result.dataurl, result.width, result.height);
				});		
			});
		})
		.catch( (error) => { 
			showMessage("Error", "Set Background Image Failed!"); 
		});
	}

	function initButtons() {
		var bgImageLoader = document.getElementById('bgImageLoader');
		bgImageLoader.addEventListener('change', handleBgImage, false);

		this.btns=$('[data-act]');
	
		this.btns.click(
			function(event){
				var act = $(this).data('act');
				if(!self[act])return;
				var arg = $(this).data('arg');
				self[act](arg);
		});
/*
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			var target = $(e.target).attr("href") // activated tab
			self.selectResultLayer(target);
		  });
		  */

		  this.inputs=$('[data-layer]');

		  this.inputs.each(function() {
			var layer = $(this).data('layer');
			var property = $(this).data('property');
			var value = self.model.layer(layer).property(property);
			
			if($(this).is(':checkbox'))
				$(this).prop('checked', value);
			else
				$(this).val(value);
		  });

		  this.inputs.change(
			function(event){
				var layer = $(this).data('layer');
				if(!self.model.layer(layer))
					return;
				var property = $(this).data('property');

				var value = $(this).val();

				if($(this).is(':checkbox'))
					value = $(this).is(':checked');

				var oldVal = self.model.layer(layer).property(property);
				self.model.undoStack.push(new ChangeLayerPropertyCommand(layer,property,oldVal,value));
		});

	}

	function beginProcessing(layer){
		var name = layer.layerId();
		if(name == LayerNames.MaskLayer)
			name = LayerNames.ForegroundLayer;

		getAct("selectResultLayer",name).find('img').attr("src", "/images/editor/processing.svg");
		getAct("download").find('img').attr("src", "/images/editor/processing.svg");
	}

	function endProcessing(layer) {
		var name = layer.layerId();
		if(name == LayerNames.MaskLayer)
			name = LayerNames.ForegroundLayer;
		getAct("selectResultLayer",name).find('img').attr("src", "/images/editor/"+name+".svg");
		getAct("download").find('img').attr("src", "/images/editor/save.svg");
	}
	
	function zoomChanged(view) {
		leftView.syncWithView(view);
		rightView.syncWithView(view);

		updateZoom();
	}

	function offsetChanged(view){
		leftView.syncWithView(view);
		rightView.syncWithView(view);
	}

	function updateZoom() {
		var zoomOut = getAct('zoomOut');
		var zoomIn = getAct('zoomIn');
		
		if(leftView.getScale() <= MIN_ZOOM_FACTOR){
			zoomOut.addClass('disabled');
		} else {
			zoomOut.removeClass('disabled');
		}
		
		if(leftView.getScale() >= MAX_ZOOM_FACTOR){
			zoomIn.addClass('disabled');
		} else {
			zoomIn.removeClass('disabled');
		}
	}

	this.fitToContainer = function(){
		leftView.resizeCanvas();
		rightView.resizeCanvas();
		self.zoomToFit();
	}

	this.clear = function(){
		var group = new GroupUndoCommand();
		group.push(new ScribbleClearCommand(this.model.layer(LayerNames.ScribbleLayer)));
		group.push(new ScribbleClearCommand(this.model.layer(LayerNames.MattingLayer)));
		model.undoStack.push(group);
	}

	this.resetForeground = function(){
		this.resetLayer(LayerNames.MaskLayer);
		this.resetLayer(LayerNames.ForegroundLayer);
	}

	this.downloadLowRes = function(){
		var canvas = this.createResult(true);
		canvas.toBlob(function(blob) {
			saveAs(blob, model.fileName+".png");
		});
	}

	this.createResult = function(lowRes)
	{
		var imgLayerSize = model.layer(LayerNames.BackgroundLayer).size();
		var bg = model.layer(LayerNames.BackgroundLayer);
		var fg = model.layer(LayerNames.ForegroundLayer);
		var shadow = model.layer(LayerNames.ShadowLayer);
		var rect = bg.boundingRect();

		var canvas = document.createElement('canvas');
		canvas.width = rect.width;
		canvas.height = rect.height;
		var scale = Math.min(600/imgLayerSize.width, 600/imgLayerSize.height);
		if(lowRes){
			canvas.width = canvas.width*scale;
			canvas.height = canvas.height*scale;
		}
		
		var ctx = canvas.getContext("2d");
		if(lowRes){
			ctx.scale(scale,scale);
		}
		ctx.translate(-rect.x, -rect.y);
		
		bg.render(ctx);
		ctx.globalAlpha = shadow.opacity()/100.0;
		shadow.render(ctx);
		ctx.globalAlpha = 1;
		fg.render(ctx);
		return canvas;
	}

	this.downloadBlob = function(){
		var canvas = this.createResult(false);
		canvas.toBlob(function(blob) {
			saveAs(blob, model.fileName+".png");
		});
	}

	this.download = function() {
		var imgLayerSize = model.layer(LayerNames.BackgroundLayer).size();
		if(imgLayerSize.width * imgLayerSize.height <= 500*500)
			return this.downloadBlob();

		makeRequest({
			method:'GET', 
			url: getUrl() + "/download",
		})
		.then( (response) => {
			this.downloadBlob();
		})
		.catch( (err) => {
			$('#downloadModal').modal('show');
		});
	}
	
	this.zoomIn = function() {
		leftView.zoomIn();
	}
	
	this.zoomOut = function() {
		leftView.zoomOut();
	}

	this.zoomToOrig = function() {
		leftView.zoomToOrig();
	}

	this.zoomToFit = function() {
		leftView.zoomToFit();
	}
	
	this.undo = function() {
		this.model.undoStack.undo();
	}

	this.redo = function() {
		this.model.undoStack.redo();
	}

	this.fitRect = function(){
		var maskLayer = this.model.layer(LayerNames.MaskLayer);
		var bgLayer = this.model.layer(LayerNames.BackgroundLayer);
		var rect = new Rect;
		rect.unite(maskLayer.contentRect);
		var padding = bgLayer.property(BackgroundProperties.padding);
		if(padding > 0)
		{
			var dx = rect.width/100*padding;
			var dy = rect.height/100*padding;
			var dm = Math.min(dx,dy);
			rect.adjust(-dm, -dm, dm, dm);
		}
		return rect;
	}

	this.fitToResult = function(){
		var rect = this.fitRect();
		var bgLayer = this.model.layer(LayerNames.BackgroundLayer);
		var cmd = new GroupUndoCommand();
		cmd.push(
			new ChangeLayerPropertyCommand(	LayerNames.BackgroundLayer,
											LayerProperties.boundingRect,
											bgLayer.property(LayerProperties.boundingRect),
											rect)
			);
		
																	
		cmd.push(
			new ChangeLayerPropertyCommand(	LayerNames.BackgroundLayer,
											BackgroundProperties.fitToResult,
											bgLayer.property(BackgroundProperties.fitToResult),
											true)
				);

		self.model.undoStack.push(cmd);
	}

	this.selectResultLayer = function(layerId){
		var layer = model.layer(layerId);
		rightView.setActiveLayer(layer);
		layer.setTool(rectTracker);
		rectTracker.setRect(layer.boundingRect());
	}

	this.resetLayer = function(layerId) {
		makeRequest({
			method:'GET', 
			url: getUrl() + "/layer/" + layerId + "/factory-defaults",
		})
		.then( (response) => {
			var response = JSON.parse(response);
			if(response) {
				var layer = model.layer(layerId);
				response[LayerProperties.boundingRect] = layer.defaultBoundingRect();
				var cmd = new ChangeLayerPropertiesCommand(layerId, layer.allProperties(), response)
				model.undoStack.push(cmd);
			}
		})
		.catch( (err) => {
			console.error('error!', err.statusText);
		});
	}

	this.restoreFactoryDefaults = function(layerId){
	}
	
	this.saveDefaults = function(layerId) {
	}

	this.setLineWidth = function (lineWidth) {
		markerTool.setLineWidth(lineWidth);
	};

	this.setType = function(type){
		if(type == "move"){
			leftView.setMoveMode(true);
			return;
		} else {
			leftView.setMoveMode(false);
		}
		markerTool.setColor(type);

		switch(type){
		case "foreground":
		case "background":
		case "erase":
			leftView.setActiveLayer(model.layer(LayerNames.ScribbleLayer));
			break;
		case "matting":
		case "erase-matting":
			leftView.setActiveLayer(model.layer(LayerNames.MattingLayer));
			break;
		}

		leftView.activeLayer().setTool(markerTool);
	}
}

 