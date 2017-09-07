
function inIframe() {
    try {
        return window.self !== window.top;
    } catch (e) {
        return true;
    }
}

$( document ).ready(function() {







    if(inIframe()){
        $('body').addClass('iframe')
        $('.id-idp-button').click(function(event) {

            event.preventDefault();
            var strWindowFeatures = "menubar=no,location=no,resizable=no,scrollbars=no,status=yes,width=500,height=450";

            var URL = $(this).attr("href");
            SocialLoginWindow = window.open(URL, 'SocialLoginWindow', strWindowFeatures);


        });
    }
});