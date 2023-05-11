	<!-- Sidebar -->
	<?php
	if( $_SESSION['rol'] == 'Administrador' )
	{
		/*
		?>
		<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
		  <div class="position-sticky">
			<div class="list-group list-group-flush mx-3 mt-4">
			  <a href="index.php" class="list-group-item list-group-item-action py-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/index.php")?"active":""; ?>">
				<i class="fas fa-home fa-fw me-3"></i><span>Inicio</span></a>
			  <a href="administradores.php" class="list-group-item list-group-item-action py-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/administradores.php")?"active":""; ?>">
				<i class="fas fa-user-cog fa-fw me-3"></i><span>Administradores </span></a>
			  <a href="gestores.php" class="list-group-item list-group-item-action py-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/gestores.php")?"active":""; ?>">
				<i class="fas fa-user-tie fa-fw me-3"></i><span>Gestores </span></a>
			  <a href="personas.php" class="list-group-item list-group-item-action py-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/personas.php")?"active":""; ?>">
				<i class="fas fa-user fa-fw me-3"></i><span>Personas</span></a>
			  <a href="expedientes.php" class="list-group-item list-group-item-action py-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/expedientes.php" ||
																											   $_SERVER['PHP_SELF'] == "/expediente-plantillas.php" ||
																											   $_SERVER['PHP_SELF'] == "/expediente-plantilla-single.php" )?"active":""; ?>">
				<i class="fas fa-scroll fa-fw me-3"></i><span>Expedientes</span></a>
			  <a href="procedimientos.php" class="list-group-item list-group-item-action py-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/procedimientos.php")?"active":""; ?>">
				<i class="fas fa-list-ul fa-fw me-3"></i><span>Procedimientos</span></a>
			  <a href="plantillas.php" class="list-group-item list-group-item-action py-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/plantillas.php" ||
																											  $_SERVER['PHP_SELF'] == "/plantilla-single.php" )?"active":""; ?>">
				<i class="fas fa-edit fa-fw me-3"></i><span>Plantillas</span></a>
			  <a href="juzgados.php" class="list-group-item list-group-item-action py-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/juzgados.php")?"active":""; ?>">
				<i class="fas fa-gavel fa-fw me-3"></i><span>Juzgados</span></a>
			  <a href="documentos.php" class="list-group-item list-group-item-action py-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/documentos.php")?"active":""; ?>">
				<i class="fas fa-folder-open fa-fw me-3"></i><span>Gestor Documental</span></a>
			  <a href="registro.php" class="list-group-item list-group-item-action py-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/registro.php")?"active":""; ?>">
				<i class="fas fa-archive fa-fw me-3"></i><span>Registro</span></a>
			</div>
		  </div>
		</nav>
		<?php
		*/
	}
	else if( $_SESSION['rol'] == 'Persona' )
	{
		/*
		?>
		<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
		  <div class="position-sticky">
			<div class="list-group list-group-flush mx-3 mt-4">
			  <a href="index_persona.php" class="list-group-item list-group-item-action p-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/index_persona.php")?"active":""; ?>">
				<i class="fas fa-home fa-fw me-3"></i><span>Inicio</span></a>
			  <a href="cliente_perfil.php" class="list-group-item list-group-item-action p-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/cliente_perfil.php")?"active":""; ?>">
				<i class="fas fa-user fa-fw me-3"></i><span>Perfil</span></a>
			  <a href="expedientes.php" class="list-group-item list-group-item-action p-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/expedientes.php")?"active":""; ?>">
				<i class="fas fa-scroll fa-fw me-3"></i><span>Expedientes</span></a>
			  <a href="cliente_bajada.php" class="list-group-item list-group-item-action p-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/cliente_bajada.php")?"active":""; ?>">
				<i class="fas fa-download fa-fw me-3"></i><span>Mis Expedientes</span></a>
			  <a href="cliente_subida.php" class="list-group-item list-group-item-action p-2 ripple <?php echo ( $_SERVER['PHP_SELF'] == "/cliente_subida.php")?"active":""; ?>">
				<i class="fas fa-upload fa-fw me-3"></i><span>Mis Documentos</span></a>
			  <hr/>
			  <a target="_blank" href="https://misfacturas3w.com/login" class="list-group-item list-group-item-action py-2 ripple">
				<i class="fas fa-external-link-alt fa-fw me-3"></i><span>Acceso iFactura</span></a>
			</div>
		  </div>
		</nav>
		<?php
		*/
	}
	?>
	<!-- Sidebar -->