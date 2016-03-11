<!DOCTYPE HTML>
<!--
	Miniport by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
	<title>TMO</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- Path -->
	<base href="<?php echo base_url();?>">
	<!--[if lte IE 8]><script src="<?php echo PATH_RESOURCE_STORE; ?>/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/main.css" />

	<script type="text/javascript" src="<?php echo PATH_RESOURCE_STORE; ?>/js/jssor.slider.min.js"></script>
	<!--[if lte IE 8]><link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/ie8.css" /><![endif]-->
	<!--[if lte IE 9]><link rel="stylesheet" href="<?php echo PATH_RESOURCE_STORE; ?>/css/ie9.css" /><![endif]-->
</head>
<body>
<script>
	jssor_1_slider_init = function() {

		var jssor_1_options = {
			//$AutoPlay: true,
			$Idle: 0,
			//$AutoPlaySteps: 4,
			$SlideDuration: 1600,
			$SlideEasing: $Jease$.$Linear,
			$PauseOnHover: 4,
			$SlideWidth: 300,
			$Cols: 7

		};

		var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

		//responsive code begin
		//you can remove responsive code if you don't want the slider scales while window resizing
		function ScaleSlider() {
			var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
			if (refSize) {
				refSize = Math.min(refSize, 809);
				jssor_1_slider.$ScaleWidth(refSize);
			}
			else {
				window.setTimeout(ScaleSlider, 30);
			}
		}
		ScaleSlider();
		$Jssor$.$AddEvent(window, "load", ScaleSlider);
		$Jssor$.$AddEvent(window, "resize", ScaleSlider);
		$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
		//responsive code end
	};
</script>

<header>
<!--	<div id="title">-->
<!--		<h2>Fashion Store</h2>-->
<!--	</div>-->
	<!-- Slider -->
	<div id="jssor_1" style="position: relative; left: 0px; width: 980px; height: 100px; ">
		<!-- Loading Screen -->
		<div data-u="slides" id="slide" >
			<?php for ( $c = 0; $c < sizeof($modulo->data_categorias); $c++) { ?>
				<?php if ($c == 0) { ?>
					<div style="background:#FFF;">
						<a href="#" style="color:#000;"><p><?php echo strtoupper($modulo->data_categorias[$c]->nombre_categoria); ?></p></a>
					</div>
				<?php } else { ?>
					<div>
						<a href="#"><p><?php echo strtoupper($modulo->data_categorias[$c]->nombre_categoria); ?></p></a>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</header>

<!-- Content -->
<content>

	<div class="col-xs-12">

		<?php foreach ($modulo->sub_categorias as $sub_categoria) { ?>
			<div class="row">
				<div>
					<div class="col-xs-5 list" >
						<a href="categories.html" ><img src="<?php echo $sub_categoria->url_archivo; ?>" id="images" alt=""  /></a>
					</div>
					<div class="col-xs-7 list" >
						<a href="categories.html" ><h2><?php echo strtoupper($sub_categoria->nombre_categoria); ?></h2></a>
					</div>
				</div>
			</div>
		<?php } ?>

		<section id="toplist">
			<h2>Productos</h2>
		</section>

		<div class="row">
			<div>
				<div class="col-xs-6 products" >
					<a href="detail.html" ><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/pic00.png" class="images" alt="" /></a>

					<h2><a href="detail.html" >Versace Woven scarf, Turquoise</a></h2>
					<h3><a href="detail.html" >$340</a></h3><h4><strike>$425</strike></h4>

				</div>
				<div class="col-xs-6 products">
					<a href="detail.html" ><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/pic00.png" class="images" alt="" /></a>
					<h2><a href="detail.html" >Versace Woven scarf, Turquoise</a></h2>
					<h3><a href="detail.html" >$340</a></h3><h4><strike>$425</strike></h4>
				</div>
			</div>
		</div>
		<div class="row">
			<div>

				<div class="col-xs-6 products" >
					<a href="detail.html" ><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/pic00.png" class="images" alt="" /></a>

					<h2><a href="detail.html" >Versace Woven scarf, Turquoise</a></h2>
					<h3><a href="detail.html" >$340</a></h3><h4><strike>$425</strike></h4>

				</div>
				<div class="col-xs-6 products">
					<a href="detail.html" ><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/pic00.png" class="images" alt="" /></a>
					<h2><a href="detail.html" >Versace Woven scarf, Turquoise</a></h2>
					<h3><a href="detail.html" >$340</a></h3><h4><strike>$425</strike></h4>
				</div>
			</div>
		</div>
		<div class="row">
			<div>

				<div class="col-xs-6 products" >
					<a href="detail.html" ><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/pic00.png" class="images" alt="" /></a>

					<h2><a href="detail.html" >Versace Woven scarf, Turquoise</a></h2>
					<h3><a href="detail.html" >$340</a></h3><h4><strike>$425</strike></h4>

				</div>
				<div class="col-xs-6 products">
					<a href="detail.html" ><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/pic00.png" class="images" alt="" /></a>
					<h2><a href="detail.html" >Versace Woven scarf, Turquoise</a></h2>
					<h3><a href="detail.html" >$340</a></h3><h4><strike>$425</strike></h4>
				</div>
				<div class="col-xs-12 products" style="height: 60px;"></div>

			</div>
		</div>

		<div class="row" style="height: 50px;"></div>

	</div>

</content>
<footer>
	<div id="footer">
		<div class="boximage">
			<a href="v-store-home.php"><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/homes.png" class="images" alt="" /></a>
			<h2><a href="#" onclick="">Home</a></h2>
		</div>
		<div class="boximage">
			<a href="find.html"><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/tool.png" class="images" alt="" /></a>
			<h1><a href="#" onclick="">Find</a></h1>
		</div>
		<div class="boximage">
			<a href="cart.html"><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/cart.png" class="images" alt="" /></a>
			<h1><a href="#" onclick="">Cart</a></h1>
		</div>
		<div class="boximage">
			<a href="account.html"><img src="<?php echo PATH_RESOURCE_STORE; ?>/images/setting.png" class="images" alt="" /></a>
			<h1><a href="#" onclick="">Account</a></h1>
		</div>


	</div>

</footer>


<script>
	jssor_1_slider_init();
</script>



<!-- Scripts -->
<script src="<?php echo PATH_RESOURCE_STORE; ?>/js/jquery.min.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>/js/skel.min.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>/js/skel-viewport.min.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>/js/util.js"></script>
<!--[if lte IE 8]><script src="<?php echo PATH_RESOURCE_STORE; ?>/js/ie/respond.min.js"></script><![endif]-->
<script src="<?php echo PATH_RESOURCE_STORE; ?>/js/main.js"></script>
<script src="<?php echo PATH_RESOURCE_STORE; ?>/js/bootstrap.min.js"></script>

</body>
</html>