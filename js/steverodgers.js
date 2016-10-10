function showImage(){
  //var img = document.createElement("img");
  //$("#photo").append(img);
}

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
                    //$('.coverupload').addClass('imageadded');
                    //holder.style.backgroundImage = "url('" + oFREvent.target.result + "')";
                    NProgress.done();
                };

                $("#user_blob").css("display", "block");
                $("#user_blob").css("opacity", "1");

                var image = document.getElementById('user_blob');
                var cropper = new Cropper(image, {
                  aspectRatio: 4 / 4,
                  crop: function(e) {
                    console.log(e.detail.x);
                    console.log(e.detail.y);
                    console.log(e.detail.width);
                    console.log(e.detail.height);
                  }
                });


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
