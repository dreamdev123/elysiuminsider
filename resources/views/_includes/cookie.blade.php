<div class="cookie-section" data-content="cookie-section">
    <span class="cookie-section-desc flex-grow-1 text-center">
        In order to give you the best experience, we have to set our website to allow cookies.<br/>
        By continuing, you agree that you are happy for us to use these cookies.
        Read more details on the Terms of Use page in the footer menu.
    </span>
    <span class="cookie-section-agree d-flex cursor-pointer" data-content="cookie-agree">
        <span class="m-auto">
            I&nbsp;AGREE
        </span>
    </span>
</div>

<script type="text/javascript">
    const cookie = {
        init: function () {
            this.variables();
            this.addEventListeners();
        },
        variables: function () {
            this.cookieSection = $('[data-content="cookie-section"]');
            this.cookieAgreeButton = $('[data-content="cookie-agree"]');
        },
        addEventListeners: function () {
            this.cookieAgreeButton.on('click', function () {
                this.addCookie();
                this.cookieSection.slideUp(200);
                $('footer').removeClass('footer-cookie');
            }.bind(this));
        },
        addCookie: function () {
            $.cookie("cookies_agree", '1', { expires: 365 });
        }
    };

    $(document).ready(function() {
        cookie.init();
        if(!$.cookie("cookies_agree"))
            $('footer').addClass('footer-cookie');
    });
</script>