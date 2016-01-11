<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">MENU</li>
			<!-- Optionally, you can add icons to the links -->
			<li <?php echo ($menu == 1) ? 'class="active"' : ''; ?>><a href="admin/cliente"><i class="fa fa-user"></i> <span>Cliente</span></a></li>
			<!--<li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>-->
			<li class="treeview <?php echo ($menu == 2) ? 'active' : '';?>">
				<a href="#"><i class="fa fa-car"></i> <span>Vehiculo</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li <?php echo ($submenu == 1) ? 'class="active"' : '';?>><a href="admin/vehiculo/tipo-equipo"><i class="fa fa-circle-o"></i>Tipo Equipo</a></li>
					<li <?php echo ($submenu == 2) ? 'class="active"' : '';?>><a href="admin/vehiculo/marca"><i class="fa fa-circle-o"></i>Marca</a></li>
					<li <?php echo ($submenu == 3) ? 'class="active"' : '';?>><a href="admin/vehiculo/modelo"><i class="fa fa-circle-o"></i>Modelo</a></li>
				</ul>
			</li>
			<li class="treeview <?php echo ($menu == 3) ? 'active' : '';?>">
				<a href="#"><i class="fa fa-dot-circle-o"></i> <span>Neumatico</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li <?php echo ($submenu == 1) ? 'class="active"' : '';?>><a href="admin/neumatico/marca"><i class="fa fa-circle-o"></i>Marca</a></li>
					<li <?php echo ($submenu == 2) ? 'class="active"' : '';?>><a href="admin/neumatico/modelo"><i class="fa fa-circle-o"></i>Modelo</a></li>
					<li <?php echo ($submenu == 3) ? 'class="active"' : '';?>><a href="admin/neumatico/medida"><i class="fa fa-circle-o"></i>Medida</a></li>
				</ul>
			</li>
            <li <?php echo ($menu == 4) ? 'class="active"' : ''; ?>><a href="admin/user-application"><i class="fa fa-user"></i> <span>Usuario (Aplicacion)</span></a></li>
		</ul><!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>