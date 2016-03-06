$(document).ready(function() {
    loginLayout();
    gitRepoCheck();
    headerAlert();
    $(window).resize(function() {
        loginLayout();
    });
    $(".commit-table .toggle-details").each(function() {
        $(this).click(function(){
            $(this).find('.details').slideToggle('fast');
        });
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
function gitRepoCheck(){
    $('#private').click(function() {
        if($(this).is(':checked')){
            $('.private-checked').fadeIn();
        }
    });
    $('#public').click(function() {
        if($(this).is(':checked')){
            $('.private-checked').fadeOut();
        }
    });
}
function headerAlert(){
    $(".header-message-wrap").animate({top:"50px"},500).delay(4000).animate({top:"20px"},500);
}
