<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">MENU</li>
			<li <?php echo ($menu == 1) ? 'class="active"' : ''; ?>><a href="<?php echo $modulo->url_main_panel; ?>/company-profile"><i class="fa fa-building-o"></i><span>Company</span></a></li>
			<li <?php echo ($menu == 2) ? 'class="active"' : ''; ?>><a href="<?php echo $modulo->url_main_panel; ?>/store"><i class="fa fa-building-o"></i><span>Store</span></a> </li>
			<li <?php echo ($menu == 3) ? 'class="active"' : ''; ?>><a href="<?php echo $modulo->url_main_panel; ?>/product"><i class="fa fa-shopping-bag"></i><span>Products</span></a></li>
			<li <?php echo ($menu == 4) ? 'class="active"' : ''; ?>><a href="<?php echo $modulo->url_main_panel; ?>/promotion"><i class="fa fa-shopping-bag"></i><span>Promotions</span></a></li>
			<li <?php echo ($menu == 5) ? 'class="active"' : ''; ?>><a href="<?php echo $modulo->url_main_panel; ?>/category"><i class="fa fa-tags"></i><span>Categories</span></a></li>
			<li <?php echo ($menu == 6) ? 'class="active"' : ''; ?>><a href="<?php echo $modulo->url_main_panel; ?>/user"><i class="fa fa-user"></i><span>Users</span></a></li>
		</ul><!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>