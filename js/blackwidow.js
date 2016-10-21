function showSocial(){
		if (!document.getElementById("backholder")) {
						//alert("dr");
						var backholder = document.createElement("div");
						backholder.id = "backholder";
						document.body.appendChild(backholder);
						var dialog = document.createElement("div");
						dialog.id = "dialogbox";
						document.body.appendChild(dialog);
						var header = document.createElement("div");
						header.id = "dialogheader";
						//dialog.appendChild(header);
						var closebutton = document.createElement("div");
						$(closebutton).addClass("headerclosebutton");
						closebutton.innerHTML = "<i class='fa fa-remove'></i>"
						header.appendChild(closebutton);
						var body_ = document.createElement("div");
						body_.id = "dialogbody";
						dialog.appendChild(body_);
						$("#dialogbody").html("<a href='https://twitter.com/intent/tweet?text=Get%20your%20own%20Camp%20Joseph%202016%20Avatar&url=http://campjoseph.herokuapp.com&via=officialydi' data-size='large'><i class='fa fa-3x fa-twitter-square'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://www.facebook.com/sharer/sharer.php?u=http://campjoseph.herokuapp.com/&title=Get%20your%20own%20Camp%20Joseph%202016%20Avatar' target='_blank' data-href='http://campjoseph.herokuapp.com/' data-layout='button_count'><i class='fa fa-3x fa-facebook-square'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://pinterest.com/pin/create/bookmarklet/?media=http://campjoseph.herokuapp.com/img/social_media-min.jpg&url=http://campjoseph.herokuapp.org/&is_video=false&description=Get%20your%20own%20Camp%20Joseph%202016%20Avatar' target='_blank'><i class='fa fa-3x fa-pinterest-square'></i></a><br/><br/><a href='javascript:void(0)' class='flat_button_green_white_outline closebutton'>Close</a>");
						//$("#backholder").click(function () { $("#backholder").fadeOut(); $("#dialogbox").fadeOut(); });
						$(".closebutton").click(function () { $("#backholder").fadeOut(); $("#dialogbox").fadeOut(); });
				} else {
						//var backholder = document.getElementById("backholder");
						$("#dialogbody").html("<a href='https://twitter.com/intent/tweet?text=Get%20your%20own%20Camp%20Joseph%202016%20Avatar&url=http://campjoseph.herokuapp.com&via=officialydi' data-size='large'><i class='fa fa-3x fa-twitter-square'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://www.facebook.com/sharer/sharer.php?u=http://campjoseph.herokuapp.com/&title=Get%20your%20own%20Camp%20Joseph%202016%20Avatar' target='_blank' data-href='http://campjoseph.herokuapp.com/' data-layout='button_count'><i class='fa fa-3x fa-facebook-square'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://pinterest.com/pin/create/bookmarklet/?media=http://campjoseph.herokuapp.com/img/social_media-min.jpg&url=http://campjoseph.herokuapp.org/&is_video=false&description=Get%20your%20own%20Camp%20Joseph%202016%20Avatar' target='_blank'><i class='fa fa-3x fa-pinterest-square'></i></a><br/><br/><a href='javascript:void(0)' class='flat_button_green_white_outline closebutton'>Close</a>");
						//var body = document.getElementById("dialogbody");
						//$(body).html("");
						$("#backholder").fadeIn();
						$("#dialogbox").fadeIn(function () { //make the dialog start to load after it has fully shown
								$(".closebutton").click(function () { $("#backholder").fadeOut(); $("#dialogbox").fadeOut(); });
						});

				}
}
