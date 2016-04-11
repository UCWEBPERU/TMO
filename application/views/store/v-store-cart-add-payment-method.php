<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TMO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <base href="<?php echo base_url();?>">
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>css/main.css" />
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_PLUGINS; ?>sweetalert/sweetalert.css">
    <!-- Fake Loader -->
    <link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>css/fakeLoader.css">
</head>
<body>
<div id="mainHeader">
    <div class="btn-Left">
        <a href="<?php echo $modulo->previuos_url; ?>">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow_back.png">
        </a>
    </div>
    <div class="title-header">SET PAYMENT METHOD</div>
    <div class="btn-right"></div>
</div>
<div id="panelPayment">
    <form id="frmPaymentMethod" name="frmPaymentMethod" method="post">
        <input type="hidden" name="amountCart" value="<?php echo $modulo->amount_cart; ?>">
        <div class="sign-in-form">
            <input  type="text" id="txtCreditCardNumber" name="txtCreditCardNumber" placeholder="Credit card number" maxlength="16" data-parsley-required data-parsley-type="number" data-parsley-minlength="16" data-parsley-maxlength="16" data-parsley-required-message="Enter your credit card number." data-parsley-minlength-message="Invalid credit card number." data-parsley-maxlength-message="Invalid credit card number." data-parsley-type-message="Credit card number is only numbers.">
            <p class="text-error"></p>
        </div>

        <div class="sign-in-form">
            <select id="cboExpirationMonth" name="cboExpirationMonth" data-parsley-required data-parsley-required-message="Enter expiration month.">
                <option selected="selected" value="">Expiration Month</option>
                <?php for ($c = 1; $c < 13; $c++) { ?>
                    <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                <?php } ?>
            </select>
            <p class="text-error"></p>
        </div>
        <div class="sign-in-form">
            <select id="cboExpirationYear" name="cboExpirationYear" data-parsley-required data-parsley-required-message="Enter expiration year.">
                <option selected="selected" value="">Expiration Year</option>
                <?php for ($c = intval(date('Y')); $c < intval(date('Y')) + 50; $c++) { ?>
                    <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                <?php } ?>
            </select>
            <p class="text-error"></p>
        </div>
        <div class="sign-in-form">
            <input id="txtCVC" name="txtCVC" placeholder="CVC" maxlength="3" data-parsley-required data-parsley-type="number" data-parsley-required-message="Enter cardholder's name." data-parsley-type-message="Cardholder's name is only numbers.">
            <p class="text-error"></p>
        </div>
        <div class="sign-in-form">
            <button id="btnDone" type="submit">Done</button>
            <p class="register-error"></p>
        </div>
    </form>
    
</div>
<div id="menuApp">
    <div id="changeStyleProduct" class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_inactive_products.png">
            <div>PRODUCTS</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/promotions">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_inactive_promotion.png">
            <div>PROMOTION</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/search">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_inactive_search.png">
            <div>SEARCH</div>
        </a>
    </div>
    <div class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>/account">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_inactive_account.png">
            <div>ACCOUNT</div>
        </a>
    </div>
    <div class="menu-item">
        <a class="active" href="<?php echo $modulo->base_url_store; ?>/cart">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_active_cart.png">
            <div>CART</div>
        </a>
    </div>
</div>
<div class="fakeloader"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/hammer.min.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>js/jquery.hammer.js"></script>
<!-- Sweet Alert -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>sweetalert/sweetalert.min.js"></script>
<!-- Fake Loader -->
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>parsleyjs/parsley.min.js"></script>
<script src="<?php echo PATH_RESOURCE_PLUGINS; ?>fakeloader/fakeLoader.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var selectorInputsForm = ["#txtCreditCardNumber", "#cboExpirationMonth", "#cboExpirationYear", "#txtCVC"];

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
        $("#btnDone").on("click", function(event){
            event.preventDefault();

            if (validateInputsForm(selectorInputsForm)) {
                $(".fakeloader").fakeLoader({
                    bgColor     : "rgba(0,0,0,.85)",
                    spinner     : "spinner2"
                });
                var request = $.ajax({
                    url: "<?php echo $modulo->base_url_store."/ajax/checkout"; ?>",
                    method: "POST",
                    data: $("#frmPaymentMethod").serialize(),
                    dataType: "json"
                });

                request.done(function( response ) {
                    $(".fakeloader").fakeLoaderClose();
                    if (response.status) {
//                        swal("Checkout", response.message, "success");
                        swal({
                            title: "Checkout",
                            text: response.message,
                            type: "success",
                            confirmButtonText: "Accept",
                            closeOnConfirm: false
                        }, function(){
                            $(location).attr("href", "<?php echo $modulo->base_url_store; ?>");
                        });

                    } else {
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