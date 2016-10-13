//$(function(){

$(document).ready = function(){

var presets = [
	{name: 'none'},
	{name: 'negative'},
	{name: 'brightness', args:[1.5]},
	{name: 'saturation', args:[1.5]},
	{name: 'contrast', args:[1.5]},
	{name: 'hue', args:[180]},
	{name: 'desaturate'},
	{name: 'desaturateLuminance'},
	{name: 'brownie'},
	{name: 'sepia'},
	{name: 'vintagePinhole'},
	{name: 'kodachrome'},
	{name: 'technicolor'},
	{name: 'detectEdges'},
	{name: 'sharpen'},
	{name: 'emboss'},
	{name: 'blur', args:[7]}
];

var fillSelectBox = function( id, onchange ) {
	var select = document.getElementById(id);
	select.onchange = onchange;

	for( var i = 0; i < presets.length; i++ ) {
		var name = presets[i].name;
		var opt = document.createElement('option');
		opt.value = i;
		opt.innerHTML = name;
		select.appendChild(opt);
	}
};

var addFilterFromSelectBox = function( filter, id ) {
	var index = parseInt(document.getElementById(id).value);
	var preset = presets[index];
	if( preset.name == 'none' ) { return; }

	filter.addFilter( preset.name, preset.args );
};

// Get the 2d context from the canvas and load an image
var canvas = document.getElementById('image-filter-canvas');
var ctx = canvas.getContext('2d');
ctx.textAlign = 'center';
ctx.fillStyle = '#000';
ctx.fillRect(0,0, canvas.width, canvas.height);
ctx.fillStyle = '#fff';
ctx.fillText("Loading...", canvas.width/2, canvas.height/2);

// Create the filter
try {
	var filter = new WebGLImageFilter();
}
catch( err ) {
	ctx.fillStyle = '#000';
	ctx.fillRect(0,0, canvas.width, canvas.height);
	ctx.fillStyle = '#fff';
	ctx.fillText("This browser doesn't support WebGL", canvas.width/2, canvas.height/2);
	return;
}

var img = new Image();
var realImg = document.getElementById("that_guy");
//img.src = '/files/webgl-image-filter/sergey-brin.jpg';
img.src = realImg.src;
img.onload = function() {
	canvas.width = img.width;
	canvas.height = img.height;

  $(realImg).hide();
  $("#image-filter-canvas").show();

	// When a select box changes its value, run the filter again
	var onchange = function( ev ) {
    alert("balls");
		filter.reset();
		addFilterFromSelectBox(filter, 'webgl-filter-stage-1');
		//addFilterFromSelectBox(filter, 'webgl-filter-stage-2');
		//addFilterFromSelectBox(filter, 'webgl-filter-stage-3');

		var filteredImage = filter.apply(img);

		// Draw the filtered image into our 2D Canvas
		ctx.drawImage(filteredImage,0,0);
	};

	// Fill the Select Box and attach the onchange listener
	fillSelectBox('webgl-filter-stage-1', onchange);
	//fillSelectBox('webgl-filter-stage-2', onchange);
	//fillSelectBox('webgl-filter-stage-3', onchange);

	document.getElementById('webgl-filter-stage-1').selectedIndex = 8;
	document.getElementById('webgl-filter-stage-1').onchange();
};

}

//});
