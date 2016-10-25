var universal_filename;
var final_filename;
var last_final_filename;

function showImage(){
  var result = cropper.getCroppedCanvas();

  $//(".canvasholder").html(result);

  var dataURL = result.toDataURL("image/png");

  //$(".canvasholder canvas").attr("data-caman-hidpi", dataURL);

  //$(".that_guy").attr("src", dataURL);
  NProgress.start();

  $.ajax({
    type: 'POST',
    url: 'posters/workings.php',
    data: {
      pngimageData: dataURL,
      filename: 'test.png'
    },
  success: function(output) {
    universal_filename = output;
    final_filename = universal_filename; //for cases where the user never selected a filter then clicked download
    $(".that_guy").attr("src", "posters/" + output);
    setSelect();
    NProgress.done();
  }
  })

  /*var pages = [].slice.call(document.querySelectorAll('.canvasholder > .that_guy'));

  var effect = ["normal", "vintage", "lomo", "clarity", "sinCity"];

  //console.log(pages.length);

  for (var i = 0; i < pages.length; i++){
    Caman(pages[i], function () {
      // If such an effect exists, use it:
      //if(effect in this){
        alert("bass");
        this.sunrise();
        this.render();
      //}
    });
  }*/


}

var presets = [
  {name: 'none'},
  {name: 'aqua'},
  {name: 'bubbles'},
  {name: 'colorise'},
  {name: 'cool'},
  {name: 'fuzzy'},
  {name: 'gray'},
  {name: 'light'},
  {name: 'old'},
  {name: 'real old'},
  {name: 'really old'},
  {name: 'sepia'}
];

function setSelect(){

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
    //$("#webgl-filter-stage-1").val(0).change();

    if(!before){
      //alert("fuck");
      [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
        new SelectFx(el);
      });
      before = true;
    }
  };

  fillSelectBox('webgl-filter-stage-1', changeImage);
}

function changeImage(ev){
    NProgress.start();
    //alert("balls");
    var id = "webgl-filter-stage-1";
    var index = parseInt(document.getElementById(id).value);
  	var preset = presets[index];
  	if( preset.name == 'none' ) { final_filename = universal_filename; return; }

    $.ajax({
      type: 'POST',
      url: 'posters/workings.php',
      data: {
        filter: preset.name,
        filename: universal_filename
      },
    success: function(output) {
      final_filename = output;
      $(".that_guy").attr("src", "posters/" + output);
      //setSelect();
      NProgress.done();
    }
    })
}

function downloadImage(){
  NProgress.start();

  $.ajax({
    type: 'POST',
    url: 'posters/workings.php',
    data: {
      download: 'yes',
      filename: final_filename
    },
  success: function(output) {
    last_final_filename = output;
    $(".that_guy").attr("src", "posters/" + output);
    //setSelect();
    NProgress.done();
    //NProgress.start();
    $.fileDownload('posters/workings.php?download_x&filename=' + output,  {
    successCallback: function (url) {
        alert('You just got a file download dialog or ribbon for this URL :' + url);
    }})
        .done(function () {
          NProgress.done();
          //window.alert("Balls");
        })
        .fail(function () {
          NProgress.done();
          //window.alert("Balls");
        });
  }
  })
}

function downloadImageOld(){
  NProgress.start();

  $("#user_blob").css("display", "none");
  $("#user_blob").css("opacity", "0");
  $("#user_instruction").css("display", "none");
  $("#user_control").css("display", "none");

  cropper.destroy();

  var canvas = document.getElementById('image-filter-canvas');
  var ctx = canvas.getContext('2d');

  var img = new Image();
  img.src = "img/g.png";
  img.onload = function() {

    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

    var dt = canvas.toDataURL('image/png');
      /* Change MIME type to trick the browser to downlaod the file instead of displaying it */
    dt = dt.replace(/^data:image\/[^;]*/, 'data:application/octet-stream');

      /* In addition to <a>'s "download" attribute, you can define HTTP-style headers */
    dt = dt.replace(/^data:application\/octet-stream/, 'data:application/octet-stream;headers=Content-Disposition:attachment;filename=CJ_Display_picture.png');

    var link = document.getElementById("downloadJigga");
    link.href = dt;

    canvas.toBlobHD(function(blob) {
            saveAs(blob, "CJ_Display_picture.png");
            //NProgress.done();
    }, "image/png");

    //window.location.href = dt;
    //alert(dt);
  }

  //$(".download_link").click();
  //$("#downloadJigga").trigger('click');
  //$("#downloadJigga").click();

}

var cropper;


function showPreview(element) {
    NProgress.start();
    var input = element;
    var holder = document.getElementById("user_blob");
    //holder.innerHTML = "";
    var i;

    var w, h;
    var wrong = false;

    if (input.files) {

        for (i = 0; i < input.files.length; i++) {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(input.files[i]);
            oFReader.onload = function (oFREvent) {
                //var preview = document.createElement("div");
                //preview.className = "previewUploads";
                var image = new Image();
                image.src = oFREvent.target.result;
                image.onload = function () {
                    w = this.width;
                    h = this.height;
                    //t = input.files[i].type,                           // ext only: // file.type.split('/')[1],
                    //n = input.files[i].name,
                    //s = ~ ~(file.size / 1024) + 'KB';
                    holder.src = oFREvent.target.result;

                    NProgress.done();

                    if(cropper != null){
                      cropper.destroy();
                      cropper.reset();
                      //alert("Balls");
                    }
                    //$('.coverupload').addClass('imageadded');
                    //holder.style.backgroundImage = "url('" + oFREvent.target.result + "')";
                    var image = document.getElementById('user_blob');
                    cropper = new Cropper(image, {
                      aspectRatio: 4 / 4,
                      movable: false,
                      zoomable: false,
                      scalable: false,
                      rotatable: false,
                      crop: function(e) {
                        //console.log(e.detail.x);
                        //console.log(e.detail.y);
                        //console.log(e.detail.width);
                        //console.log(e.detail.height);

                        $("#user_instruction").css("display", "block");

                        $("#user_control").css("display", "block");
                      }
                    });

                    $("#user_blob").css("display", "block");
                    $("#user_blob").css("opacity", "1");
                };

                //holder.appendChild(preview);
            };
            /*if (wrong) {
               $('.tabheader .content').html("Wrong Image Dimensions");
                $('.dialogcontent').html("<div style='padding:15px'>Sorry but the image has to have a width of 284px and a height of 346px</div>");
                $('.md-modal').addClass('md-show');
            }*/

        }
    }



}
