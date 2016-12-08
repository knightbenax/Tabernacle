function submit(){
  var result = validate();
  name();

  if (result == true){


    $(".new_state").hide();
    $(".loader").show();

    $.post( "ajax.php", function( data ) {
      //$(".result" ).html( data );
      $(".loader").hide();
      $(".success").show();
    });
  }
}

function name(){
    // checks only inputs with type "text" inside div id-calc
    // e.g #haveprice-calc or #dontknow-calc
    var count = 0;
    var div = $(".new_state");
    $(div).find("input[type = 'text']").each(function() {
      $(this).attr("name", "text" + count);
      count++;
    });
}

function validate(){
    // checks only inputs with type "text" inside div id-calc
    // e.g #haveprice-calc or #dontknow-calc
    var value = 0;
    var div = $(".new_state");
    $(div).find("input[type = 'text']").each(function() {
        if(this.value == "") {
            alert("You must fill in all items on the form. Come on.");
            value = 1;
            return false;
        }
    });

    if (value == 0) {
      return true;
    } else {
      return false;
    }
    //return true;
}
