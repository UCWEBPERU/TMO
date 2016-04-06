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
	
</head>
<body>
<div id="mainHeader">
	<div class="btn-Left">
		<!-- <img src="icon_arrow_back.png"> -->
	</div>
	<div class="title-header"><?php echo $modulo->data_empresa->organization; ?></div>
	<div id="btnChangeViewProduct" class="btn-right" data-current-view="row">
<!--		<img src="--><?php //echo PATH_RESOURCE_STORE; ?><!--img/icon_tableview.png">-->
	</div>
</div>
<!-- Swiper -->
<div id="swMainMenu" class="swiper-container">
	<div class="swiper-wrapper">
		<?php for ( $c = 0; $c < sizeof($modulo->data_categorias); $c++) { ?>
			<?php if ($modulo->data_categorias[$c]->id_categoria == $modulo->id_categoria_raiz) { ?>
				<div class="swiper-slide">
					<?php echo strtoupper($modulo->data_categorias[$c]->nombre_categoria); ?>
				</div>
			<?php } else { ?>
				<div class="swiper-slide">
					<?php echo strtoupper($modulo->data_categorias[$c]->nombre_categoria); ?>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
</div>
<!-- Swiper -->
<div id="swMainPanel" class="swiper-container">
	<div class="swiper-wrapper">
		<?php for ( $c = 0; $c < sizeof($modulo->data_categorias); $c++) { ?>
			<div class="swiper-slide" >
				<?php foreach ($modulo->data_sub_categorias as $sub_categoria) { ?>
					<?php if($modulo->data_categorias[$c]->id_categoria == $sub_categoria->id_categoria_superior ){?>
						<div class="item-list">
							<a href="<?php echo $sub_categoria->url_categoria; ?>">
								<div class="image-list">
									<img src="<?php echo $sub_categoria->url_archivo; ?>">
								</div>
								<div class="text-list">
									<?php echo strtoupper($sub_categoria->nombre_categoria); ?>
								</div>
								<div class="arrow-list">
									<img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_arrow.png">
								</div>
							</a>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>
<div id="menuApp">
	<div class="menu-item">
		<a class="active" href="<?php echo $modulo->base_url_store; ?>">
			<img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_active_products.png">
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
		<a href="<?php echo $modulo->base_url_store; ?>/cart">
			<img src="<?php echo PATH_RESOURCE_STORE; ?>img/icon_menu_inactive_cart.png">
			<div>CART</div>
		</a>
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
		longSwipes: false,
		onSlideChangeStart:  function(swiper) {
			$("#swMainPanel").scrollTo(0);
		}
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