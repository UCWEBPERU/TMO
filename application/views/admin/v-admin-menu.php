<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">MENU</li>
            <li <?php echo ($menu == 1) ? 'class="active"' : ''; ?>><a href="admin/empresa"><i class="fa fa-building-o"></i> <span>Company</span></a></li>
            <li <?php echo ($menu == 2) ? 'class="active"' : ''; ?>><a href="admin/tipo-empresa"><i class="fa fa-building-o"></i> <span>Business type</span></a></li>
            <li <?php echo ($menu == 3) ? 'class="active"' : ''; ?>><a href="admin/paquetes-tmo"><i class="fa fa-list-alt"></i> <span>Paquetes TMO</span></a></li>
            <li <?php echo ($menu == 4) ? 'class="active"' : ''; ?>><a href="admin/usuario-store"><i class="fa fa-users"></i> <span>User</span></a></li>
            <li <?php echo ($menu == 5) ? 'class="active"' : ''; ?>><a href="admin/perfil"><i class="fa fa-user"></i> <span>Profile</span></a></li>
		</ul><!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>