$(function() {
    var currentUrl = window.location.href;
    $('#navbar').find('a[href="'+window.location.pathname+'"]').parent().addClass('active');
});
