const $ = require('jquery');
$(document).ready(function () {
  $(".button-show").click(function () {
     var id = $(this).closest('div').attr('id');
     $("#" + id + ' .hidden-box').show();
     $("#" + id + " .button-show").hide();
     $("#" + id + " .button-hide").show();
     $("#" + id).parent().css( "background-color", "lightgrey");
   });

  $(".button-hide").click(function () {
    var id = $(this).closest('div').attr('id');
    $("#" + id + ' .hidden-box').hide();
    $("#" + id + " .button-show").show();
    $("#" + id + " .button-hide").hide();
    $("#" + id).parent().css( "background-color", "");
  });
});
