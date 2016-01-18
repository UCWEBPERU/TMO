<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">MENU</li>
            <li <?php echo ($menu == 1) ? 'class="active"' : ''; ?>><a href="admin/empresa"><i class="fa fa-building-o"></i> <span>Empresa</span></a></li>
            <li <?php echo ($menu == 2) ? 'class="active"' : ''; ?>><a href="admin/tipoempresa"><i class="fa fa-building-o"></i> <span>Tipo Empresa</span></a></li>
            <li <?php echo ($menu == 3) ? 'class="active"' : ''; ?>><a href="admin/usuario"><i class="fa fa-users"></i> <span>Usuarios</span></a></li>
            <li <?php echo ($menu == 4) ? 'class="active"' : ''; ?>><a href="admin/perfil"><i class="fa fa-user"></i> <span>Perfil</span></a></li>
		</ul><!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>