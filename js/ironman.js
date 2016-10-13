$(function() {

		//var	maxWidth = 400,
		//maxHeight = 400,
		//photo = $('#photo'),
		//originalCanvas = null,
		var filters = $('#filters li a'),
		photo = $('.canvasholder'),
		this_photo = $("#that_guy"),
		filterContainer = $('#filterContainer');

	// Use the fileReader plugin to listen for
	// file drag and drop on the photo div:

	//photo.fileReaderJS({
  /*var opts = {
		on:{
			load: function(e, file){

				// An image has been dropped.

				var img = $('<img>').appendTo(photo),
					imgWidth, newWidth,
					imgHeight, newHeight,
					ratio;

				// Remove canvas elements left on the page
				// from previous image drag/drops.

				photo.find('canvas').remove();
				filters.removeClass('active');

				// When the image is loaded successfully,
				// we can find out its width/height:

				img.load(function() {

					imgWidth  = this.width;
					imgHeight = this.height;

					// Calculate the new image dimensions, so they fit
					// inside the maxWidth x maxHeight bounding box

					if (imgWidth >= maxWidth || imgHeight >= maxHeight) {

						// The image is too large,
						// resize it to fit a 500x500 square!

						if (imgWidth > imgHeight) {

							// Wide
							ratio = imgWidth / maxWidth;
							newWidth = maxWidth;
							newHeight = imgHeight / ratio;

						} else {

							// Tall or square
							ratio = imgHeight / maxHeight;
							newHeight = maxHeight;
							newWidth = imgWidth / ratio;

						}

					} else {
						newHeight = imgHeight;
						newWidth = imgWidth;
					}

					// Create the original canvas.

					originalCanvas = $('<canvas>');
					var originalContext = originalCanvas[0].getContext('2d');

					// Set the attributes for centering the canvas

					originalCanvas.attr({
						width: newWidth,
						height: newHeight
					}).css({
						marginTop: -newHeight/2,
						marginLeft: -newWidth/2
					});

					// Draw the dropped image to the canvas
					// with the new dimensions
					originalContext.drawImage(this, 0, 0, newWidth, newHeight);

          originalCanvas.toDataURL(this)
					// We don't need this any more
					img.remove();

          //photo.html(originalCanvas);

					filterContainer.fadeIn();

					// Trigger the default "normal" filter
					filters.first().click();
				});

				// Set the src of the img, which will
				// trigger the load event when done:

				img.attr('src', e.target.result);
			},

			beforestart: function(file){

				// Accept only images.
				// Returning false will reject the file.

				return /^image/.test(file.type);
			}
		}
	//});
};*/

	// Listen for clicks on the filters

	var pages = [].slice.call(document.querySelectorAll('.canvasholder > .that_guy'));

	console.log(pages.length);

	filters.click(function(e){

		var originalCanvas = $(".canvasholder canvas");

		e.preventDefault();

		var f = $(this);

		if(f.is('.active')){
			// Apply filters only once
			return false;
		}

		filters.removeClass('active');
		f.addClass('active');

		// Clone the canvas
		//var clone = originalCanvas.clone();
		var clone = this_photo.clone();

		// Clone the image stored in the canvas as well
		//clone[0].getContext('2d').drawImage(originalCanvas[0], 0, 0);
		// Add the clone to the page and trigger
		// the Caman library on it
		photo.html(clone);

		var effect = $.trim(f[0].id);

		console.log(effect);

		Caman(clone[0], function () {
			// If such an effect exists, use it:
			if(effect in this){
				//alert("bass");
				this[effect]();
				this.render();
			}
		});

	});

	// Use the mousewheel plugin to scroll
	// scroll the div more intuitively

	filterContainer.find('ul').on('mousewheel',function(e, delta){

		this.scrollLeft -= (delta * 50);
		e.preventDefault();

	});

  //FileReaderJS.setupInput(document.getElementById('upload_ninja'), opts);

});
