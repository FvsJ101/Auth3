/**
 * Created by User on 25/09/2016.
 */

//TEST JQUERY
/*window.onload = function() {
    if (window.jQuery) {
        // jQuery is loaded
        alert("Yeah!");
    }
};*/

$(function () {
    
    // DYNAMICALLY ADD ACTIVE CLASS TO MENU ITEM
    var pathNameOfCurrentPage = window.location.pathname;
    $('a[href="' + pathNameOfCurrentPage + '"]').parent().addClass('active');
    
    //NEXT CODE
  
  
});