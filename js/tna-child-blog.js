/**
 * Blog
 */

$(document).ready(function () {
    var dropdown = document.getElementById("author");
    function onAuChange() {
        if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
            location.href = "?author="+dropdown.options[dropdown.selectedIndex].value;
        }
    }
    dropdown.onchange = onAuChange;
});