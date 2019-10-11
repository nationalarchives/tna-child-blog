/**
 * Blog
 */

$('.category-list').on('change', function () {
    $(this).submit();
})

$('.author-list').on('change', function () {
    $(this).submit();
})

$('.month-list').on('change', function () {
    var month = document.getElementById("month");
    window.location = month.value;
})
