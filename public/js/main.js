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
    
    dynamicActiveClass();
    
    //NEXT CODE
  
  
});

// DYNAMICALLY ADD ACTIVE CLASS TO MENU ITEM
function dynamicActiveClass() {
    
    var pathNameOfCurrentPage = window.location.pathname;
    $('a[href="' + pathNameOfCurrentPage + '"]').parent().addClass('active');
    
}