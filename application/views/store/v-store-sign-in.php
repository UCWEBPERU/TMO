<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TMO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <base href="<?php echo base_url();?>">
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>css/main.css" />
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>css/swiper.min.css" />
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_PLUGINS; ?>sweetalert/sweetalert.css">

</head>
<body>
<div id="mainHeader">
    <div class="btn-Left">
        <a href="<?php echo $modulo->previuos_url; ?>"><img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow_back.png"></a>
    </div>
    <div class="title-header">MEMBER SIGN IN</div>
    <div id="btnChangeViewProduct" class="btn-right" data-current-view="row">
        <!--img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_tableview.png"-->
    </div>
</div>
<div id="panelSignIn">
    <div class="logo">
        <img src="<?php echo $modulo->icono_empresa; ?>" alt="">
        
    </div>
    <div class="logo-text">WELCOME!</div>
    <div class="logo-text2">Enter your user account</div>
    <form id="frmSignIn" name="frmSignIn" method="post">
        <div class="sign-in-input">
            <input type="email" id="txtEmail" name="txtEmail" placeholder="Email" data-parsley-required data-parsley-type="email" data-parsley-required-message="Enter your email." data-parsley-type-message="Email incorrect.">
            <p class="text-error"></p>
        </div>
        <div class="sign-in-input">
            <input type="password" id="txtPassword" name="txtPassword" placeholder="Password" data-parsley-required data-parsley-required-message="Enter your password.">
            <p class="text-error"></p>
        </div>
        <div class="sign-in-input">
            <button id="btnSignIn" type="submit">Sign In</button>
            <p class="register-error"></p>
        </div>
        
    </form>
    <div class="logo-text">Join instantly (and for free)</div>
    <div class="sign-in-input">
        <button id="btnSignIn" type="submit">Join Now</button>
    </div>
    


</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<!-- Swiper JS -->
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/swiper.min.js"></script>


<!-- Initialize Swiper -->
<script>
    var swMainMenu = new Swiper('#swMainMenu', {
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 0,
        loop: true,
        slideToClickedSlide: true,
        onSlideChangeEnd: function(swiper){
            for (var c = 0; c < swiper.slides.length; c++) {
                $(swiper.slides[c]).css({"color": "#959595"});
            }
            $(swiper.slides[swiper.activeIndex]).css({"color": "#FFFFFF"});
        }
    });

    var swMainPanel = new Swiper('#swMainPanel', {
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 0,
        loop: true,
        longSwipes: false
    });

    swMainMenu.params.control = swMainPanel;
    swMainPanel.params.control = swMainMenu;

    $("#btnChangeViewProduct").on("click", function() {
        if ( $(this).attr("data-current-view") == "row" ) {
            $(".item-product-row").addClass("item-product-block");
            $(".item-product-row").removeClass("item-product-row");
            $(this).attr("data-current-view", "block");
            $(this).children("img").attr("src","<?php echo PATH_RESOURCE_STORE; ?>img/icon_lineview.png" );
        } else if ( $(this).attr("data-current-view") == "block" ) {
            $(".item-product-block").addClass("item-product-row");
            $(".item-product-block").removeClass("item-product-block");
            $(this).attr("data-current-view", "row");
            $(this).children("img").attr("src", "<?php echo PATH_RESOURCE_STORE; ?>img/icon_tableview.png");
        }

    });
</script>
</body>
</html>