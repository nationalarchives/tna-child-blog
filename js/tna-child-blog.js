/**
 * Blog
 */

$(document).ready(function () {
    $('.author-list').on('change', function () {
        $(this).submit();
    });

    $('.month-list').on('change', function () {
        var month = document.getElementById("month");
        window.location = month.value;
    });

    var dropdown = document.getElementById("cat");
    function onCatChange() {
        if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
            location.href = "/?cat="+dropdown.options[dropdown.selectedIndex].value;
        }
    }
    dropdown.onchange = onCatChange;
});