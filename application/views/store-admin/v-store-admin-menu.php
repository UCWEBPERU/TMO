<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">MENU</li>
            <li <?php echo ($menu == 1) ? 'class="active"' : ''; ?>><a href="store/<?php echo $this->session->id_empresa; ?>/admin/perfil-store"><i class="fa fa-building-o"></i><span>Empresa</span></a></li>
            <li <?php echo ($menu == 2) ? 'class="active"' : ''; ?>><a href="store/<?php echo $this->session->id_empresa; ?>/admin/products"><i class="fa fa-shopping-bag"></i><span>Productos</span></a></li>
            <li <?php echo ($menu == 3) ? 'class="active"' : ''; ?>><a href="store/<?php echo $this->session->id_empresa; ?>/admin/categorys"><i class="fa fa-tags"></i><span>Categorias</span></a></li>
            <li <?php echo ($menu == 4) ? 'class="active"' : ''; ?>><a href="store/<?php echo $this->session->id_empresa; ?>/admin/perfil-user"><i class="fa fa-user"></i><span>Perfil</span></a></li>
		</ul><!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>