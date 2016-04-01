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
        <div class="sign-in-form">
            <input type="email" id="txtEmail" name="txtEmail" placeholder="Email" data-parsley-required data-parsley-type="email" data-parsley-required-message="Enter your email." data-parsley-type-message="Email incorrect.">
            <p class="text-error"></p>
        </div>
        <div class="sign-in-form">
            <input type="password" id="txtPassword" name="txtPassword" placeholder="Password" data-parsley-required data-parsley-required-message="Enter your password.">
            <p class="text-error"></p>
        </div>
        <div class="sign-in-form">
            <button id="btnSignIn" type="submit">Sign In</button>
            <p class="register-error"></p>
        </div>
        
    </form>
    <br>
    <div class="logo-text">Join instantly (and for free)</div>
    <div class="sign-in-form">
        <a class="join-button" href="<?php echo $modulo->base_url_store; ?>/register" >Join Now</a>
    </div>
    


</div>
<div id="menuApp">
    <div id="changeStyleProduct" class="menu-item">
        <a class="active" href="<?php echo $modulo->base_url_store; ?>">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_products.png">
            <div>PRODUCTS</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/promotions">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_promotion.png">
            <div>PROMOTION</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/search">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_search.png">
            <div>SEARCH</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/account">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_account.png">
            <div>ACCOUNT</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/cart">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_cart.png">
            <div>CART</div>
        </a>
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<!-- Swiper JS -->
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/swiper.min.js"></script>
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>parsleyjs/parsley.min.js"></script>
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>fakeloader/fakeLoader.min.js"></script>


<!-- Initialize Swiper -->
<script>
    var selectorInputsForm = ["#txtEmail", "#txtPassword"];

    function validateInputsForm(selectorInputsForm){
        var countMessagesError = 0;
        var messageError = "";
        for (var i = 0; i < selectorInputsForm.length; i++) {
            if ($(selectorInputsForm[i]).parsley().isValid()) {
                $(selectorInputsForm[i]).parent().removeClass("has-error");
            } else {
                $(selectorInputsForm[i]).parent().addClass("has-error");
                messageError = ParsleyUI.getErrorsMessages($(selectorInputsForm[i]).parsley());
                $(selectorInputsForm[i]).parent().find("p").html(messageError);
                countMessagesError++;
            }
        }
        if (countMessagesError > 0) {
            return false;
        }
        return true;
    }

    $(document).ready(function(){
        $("#btnSignIn").on("click", function(event){
            event.preventDefault();

            if (validateInputsForm(selectorInputsForm)) {
                $(".fakeloader").fakeLoader({
                    bgColor     : "rgba(0,0,0,.85)",
                    spinner     : "spinner2"
                });

                var request = $.ajax({
                    url: "<?php echo $modulo->base_url_store."/ajax/signIn"; ?>",
                    method: "POST",
                    data: $("#frmSignIn").serialize(),
                    dataType: "json"
                });

                request.done(function( response ) {
                    if (response.status) {
                        $(location).attr("href", response.data.url_redirect);
                    } else {
                        $(".fakeloader").fakeLoaderClose();
                        $(".register-error").html(response.message);
                    }
                });

                request.fail(function( jqXHR, textStatus ) {
                    $(".fakeloader").fakeLoaderClose();
                    $(".register-error").html(textStatus);
                });
            }
        });
    });
</script>
</body>
</html>