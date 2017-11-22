/**
 * Smooth Scrolling for all internal links
 *
 * And remove #hash from link
 *
 * @require: jQuery
 */
$('a[href^="#"]').on('click',function (e) {
    e.preventDefault();

    var target = this.hash;
    var $target = $(target);

    if (this.hash == )

    $('html, body').stop().animate({
        'scrollTop': $target.offset().top
    }, 900, 'swing');
});