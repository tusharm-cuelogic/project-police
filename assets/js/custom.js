$(document).ready(function() {
    loginLayout();
    $(window).resize(function() {
        loginLayout();
    });
});

function loginLayout() {
    var windowH = $(window).height();
    var headerH = $('.navbar-fixed-top').height();
    var footerH = $('footer').height();
    var loginWrapH = $('.login-wrap').height();
    var bodyH = windowH - headerH - footerH;
    $('.login-wrap').css('top', bodyH / 2);
    $('.login-wrap').css('margin-top', loginWrapH / 2);
}
