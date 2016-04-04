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
<div id="panelSignIn">
    <form id="frmPaymentMethod" name="frmPaymentMethod" method="post">
        <input type="hidden" name="amountCart" value="<?php echo $modulo->amount_cart; ?>">
        <div>
            <input type="text" id="txtCreditCardNumber" name="txtCreditCardNumber" placeholder="Credit card number" maxlength="16" data-parsley-required data-parsley-type="number" data-parsley-minlength="16" data-parsley-maxlength="16" data-parsley-required-message="Enter your credit card number." data-parsley-minlength-message="Invalid credit card number." data-parsley-maxlength-message="Invalid credit card number." data-parsley-type-message="Credit card number is only numbers.">
            <p class="text-error"></p>
        </div>
        <div>
            <select id="cboExpirationMonth" name="cboExpirationMonth" data-parsley-required data-parsley-required-message="Enter expiration month.">
                <option selected="selected" value="">Expiration Month</option>
                <?php for ($c = 1; $c < 13; $c++) { ?>
                    <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                <?php } ?>
            </select>
            <p class="text-error"></p>
        </div>
        <div>
            <select id="cboExpirationYear" name="cboExpirationYear" data-parsley-required data-parsley-required-message="Enter expiration year.">
                <option selected="selected" value="">Expiration Year</option>
                <?php for ($c = intval(date('Y')); $c < intval(date('Y')) + 50; $c++) { ?>
                    <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                <?php } ?>
            </select>
            <p class="text-error"></p>
        </div>
        <div>
            <input id="txtCVC" name="txtCVC" placeholder="CVC" maxlength="3" data-parsley-required data-parsley-type="number" data-parsley-required-message="Enter cardholder's name." data-parsley-type-message="Cardholder's name is only numbers.">
            <p class="text-error"></p>
        </div>
        <button id="btnDone" type="submit">Done</button>
        <p class="register-error"></p>
    </form>
    
</div>
<div id="menuApp">
    <div id="changeStyleProduct" class="menu-item">
        <a href="<?php echo $modulo->base_url_store; ?>">
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
        <a class="active" href="<?php echo $modulo->base_url_store; ?>/cart">
            <img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_cart.png">
            <div>CART</div>
        </a>
    </div>
</div>

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
    $("#btnChangeViewProduct").on("click", function() {
        if ( $(this).attr("data-current-view") == "row" ) {
            $(".item-product-row").addClass("item-product-block");
            $(".item-product-row").removeClass("item-product-row");
            $(this).attr("data-current-view", "block");
            $(this).children("img").attr("src", "icon_lineview.png");
        } else if ( $(this).attr("data-current-view") == "block" ) {
            $(".item-product-block").addClass("item-product-row");
            $(".item-product-block").removeClass("item-product-block");
            $(this).attr("data-current-view", "row");
            $(this).children("img").attr("src", "icon_tableview.png");
        }

    });
    $("ul li a").hammer().bind("swipeleft", function(event){
        $("ul li a").each(function() {
            $(this).prevAll("span").removeClass("show");
            $(this).css({
                transform: "translateX(0)"
            }).blur();
        });
        $(this).prevAll("span").addClass("show");
        $(this).off("click").blur();
        $(this).css({
            transform: "translateX(-300px)"
        }).one("transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd", function () {
            $("ul li a").one("swiperight", function () {
                $(this).prevAll("span").removeClass("show");
                $(this).css({
                    transform: "translateX(0)"
                }).blur();
            });
        });
    });
    $("ul li, ul li a").hammer().bind("tap", function(event){
        $("ul li a").each(function() {
            $(this).prevAll("span").removeClass("show");
            $(this).css({
                transform: "translateX(0)"
            }).blur();
        });
    });
    $("ul li span.delete").on("click", function () {
        var listview = $(this).closest("ul");
        $(".ui-content").css({
            overflow: "hidden"
        });
        $(this).parent().css({
            display: "block"
        }).animate({
            opacity: 0
        }, {
            duration: 250,
            queue: false
        }).animate({
            height: 0
        }, 300, function () {
            $(this).remove();
            $(".ui-content").removeAttr("style");
        });
    });

    function deleteItem(item) {
        var formData = new FormData();
        formData.append("id_producto", item);
        var request = $.ajax({
            url: "<?php echo $modulo->base_url_store."/ajax/shopping/delete"; ?>",
            method: "POST",
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
        });
        request.done(function( response ) {
            if (response.status) {

                swal({
                        title: "Delete Item",
                        text: response.message,
                        type: "success",
                        showCancelButton: false,
                        confirmButtonText: "OK",
                        closeOnConfirm: true },
                    function(){
                        location.reload(); }
                );


            } else {
                swal("Delete Item", response.message, "danger");
            }
        });
        request.fail(function( jqXHR, textStatus ) {
            swal("Delete Item", textStatus, "danger");
        });
    }



</script>
</body>
</html>