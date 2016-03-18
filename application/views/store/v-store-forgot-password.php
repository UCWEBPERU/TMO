<!DOCTYPE HTML>
<html>
<head>
    <title>TMO</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Path -->
    <base href="<?php echo base_url();?>">
    <!--[if lte IE 8]><script src="<?php echo PATH_RESOURCE_STORE; ?>js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/ie8.css" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/ie9.css" /><![endif]-->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>css/fakeLoader.css">
    <script src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script>
</head>
<body>

<div>
    <!-- Header -->
    <header>
        <div id="title">
            <a href="<?php echo $modulo->previuos_url; ?>" >< Back</a>
            <h2>Forgot password</h2>
        </div>
    </header>

    <!-- Content -->
    <content>

        <div class="col-xs-12" >
            <div class="row" id="contenedordetail">
                <div>
                    <div class="col-xs-12 sign">
                        <h3>Ingrese los siguientes datos para recuperar su contraseña</h3>
                        <form id="frmSignIn" name="frmSignIn" method="post">
                            <div>
                                <input type="email" id="txtEmail" name="txtEmail" placeholder="Email" data-parsley-required data-parsley-type="email" data-parsley-required-message="Enter your email." data-parsley-type-message="Email incorrect.">
                                <p class="text-error"></p>
                            </div>
                            <div>
                                <input type="password" id="txtLastPassword" name="txtLastPassword" placeholder="Last Password" data-parsley-required data-parsley-required-message="Enter your last password.">
                                <p class="text-error"></p>
                            </div>
                            <div>
                                <input type="password" id="txtNewPassword" name="txtNewPassword" placeholder="Last Password" data-parsley-required data-parsley-required-message="Enter your new password.">
                                <p class="text-error"></p>
                            </div>
                            <div>
                                <input type="password" id="txtConfirmPassword" name="txtConfirmPassword" placeholder="Confirm Password"  data-parsley-required data-parsley-equalto="#txtNewPassword" data-parsley-required-message="Confirm password." data-parsley-equalto-message="Passwords do not match.">
                                <p class="text-error"></p>
                            </div>
                            <div class="g-recaptcha" data-sitekey="6LdeIxsTAAAAACS6_lRzeXCfr-PRFSQ9_RBDqWSn"></div>
                            <button id="btnSend" type="submit">Send</button>
                            <p class="register-error"></p>
                        </form>
                    </div>
                    <div class="col-xs-12 detail" style="height: 200px;"></div>
                </div>
            </div>

        </div>

    </content>
    <footer>
        <div id="footer">
            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/homes.png" class="images" alt="" /></a>
                <h2><a href="<?php echo $modulo->base_url_store; ?>" onclick="">Home</a></h2>
            </div>
            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>/search"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/tool.png" class="images" alt="" /></a>
                <h1><a href="<?php echo $modulo->base_url_store; ?>/search" onclick="">Find</a></h1>
            </div>
            <div class="boximage">
                <a href="cart.html"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/cart.png" class="images" alt="" /></a>
                <h1><a href="#" onclick="">Cart</a></h1>
            </div>
            <div class="boximage">
                <a href="<?php echo $modulo->base_url_store; ?>/account"><img src="<?php echo PATH_RESOURCE_STORE; ?>images/setting.png" class="images" alt="" /></a>
                <h1><a href="<?php echo $modulo->base_url_store; ?>/account" onclick="">Account</a></h1>
            </div>
        </div>
    </footer>
    <div class="fakeloader"></div>
    <!-- Scripts -->
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/skel.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/skel-viewport.min.js"></script>
    <!--<script src="--><?php //echo PATH_RESOURCE_STORE; ?><!--js/util.js"></script>-->
    <!--[if lte IE 8]><script src="<?php echo PATH_RESOURCE_STORE; ?>js/ie/respond.min.js"></script><![endif]-->
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.scrolly.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.placeholder.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/main.js"></script>
    <script src="<?php echo PATH_RESOURCE_STORE; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_PLUGINS; ?>parsleyjs/parsley.min.js"></script>
    <script src="<?php echo PATH_RESOURCE_PLUGINS; ?>fakeloader/fakeLoader.min.js"></script>

    <script type="text/javascript">

        var selectorInputsForm = ["#txtEmail", "#txtLastPassword", "#txtNewPassword", "#txtConfirmPassword"];

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
            $("#btnSend").on("click", function(event){
                event.preventDefault();

                if (validateInputsForm(selectorInputsForm)) {
                    if (grecaptcha.getResponse()) {
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
                            $(".fakeloader").fakeLoaderClose();
                            if (response.status) {
                                $(location).attr("href", response.data.url_redirect);
                            } else {
                                $(".register-error").html(response.message);
                            }
                        });

                        request.fail(function( jqXHR, textStatus ) {
                            $(".fakeloader").fakeLoaderClose();
                            $(".register-error").html(textStatus);
                        });
                    } else {
                        $(".register-error").html("No realizo la prueba de seguridad.");
                    }
                }
            });
        });
    </script>
</body>
</html>