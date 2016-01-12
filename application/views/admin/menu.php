<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">MENU</li>
			<li class="treeview <?php echo ($menu == 1) ? 'active' : '';?>">
				<a href="admin/empresa"><i class="fa fa-car"></i> <span>Empresa</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li <?php echo ($submenu == 1) ? 'class="active"' : '';?>><a href="admin/empresa/crear"><i class="fa fa-circle-o"></i>Crear Empresa</a></li>
				</ul>
			</li>
            <li <?php echo ($menu == 2) ? 'class="active"' : ''; ?>><a href="admin/tipo-empresa"><i class="fa fa-user"></i> <span>Tipo Empresa</span></a></li>
            <li class="treeview <?php echo ($menu == 3) ? 'active' : '';?>">
				<a href="admin/usuario"><i class="fa fa-car"></i> <span>Usuario</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li <?php echo ($submenu == 1) ? 'class="active"' : '';?>><a href="admin/usuario/crear"><i class="fa fa-circle-o"></i>Crear Usuario</a></li>
				</ul>
			</li>
            <li <?php echo ($menu == 4) ? 'class="active"' : ''; ?>><a href="admin/perfil"><i class="fa fa-user"></i> <span>Perfil</span></a></li>
		</ul><!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>