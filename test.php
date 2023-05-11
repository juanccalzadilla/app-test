<!DOCTYPE html>
<html lang="es">
	<?php require_once('./inc/header.php'); ?>
	
	<body>
		<!-- Main navigation -->
		<main>
			<!-- Intro -->
			<section class="view">
				<div class="row" style="margin-right: 0;">
					<div class="col-md-6 col-logo" style="background-color: #002e5d; height: 100vh;">
						<div class="text-center mb-4 p-5 d-flex align-items-center h-100 justify-content-center">
							<img src="img/logo-login.png" alt="" class="logo-login">
						</div>
					</div>
					<div class="col-md-6 col-form">
						<div class="d-flex flex-column justify-content-center align-items-center h-100">
							<div class="row row-form">
								
								<div class="col-xl-12 col-md-12">
								  <div class="rounded shadow-5-strong p-3" style="text-align: center; background-color:#002e5d;">
									
									<img src="./img/logo-login-sm.png" height="80px"/>
									<br/>
									<span class="subTextoLogo text-light">Acceso a la oficina virtual</span>
									
								  </div>
								  <form id="formularioLogin" class="bg-white rounded shadow-5-strong"
										style="padding-bottom: 1rem;
											   padding-top: 3rem;
											   padding-left: 3rem;
											   padding-right: 3rem;">
									<!-- Email input -->
									<div class="form-outline mb-4">
									  <input type="text" id="formLogin" class="form-control" />
									  <label class="form-label" for="formLogin">Usuario</label>
									</div>
									
									<!-- Password input -->
									<div class="form-outline mb-4">
									  <input type="password" id="formPass" class="form-control" />
									  <label class="form-label" for="formPass">Contraseña</label>
									</div>
									
									<!-- Submit button -->
									<button id="btnAcceder" type="button" onclick="Login();" class="btn btn-brand btn-block mb-1">Acceder</button>
									
									 <!-- column grid layout for inline styling -->
									<div class="row mb-4">
									  <div class="col text-center">
										<!-- Simple link -->
										<a href="#" class="link-login" data-mdb-toggle="modal" data-mdb-target="#restablecerModal">¿Olvidó su usuario o contraseña?</a>
									  </div>
									</div>
									
									<p id="resLogin" style="text-align:center;"></p>
									
									<div class="row" style="text-align:center; margin-top: 1.5rem;">
									  <div class="col-sm-6">
										<p>
										  <a href="http://www.gonzalbes.com/" class="link-login_footer">www.gonzalbes.com</a>
										</p>
									  </div>
									  <div class="col-sm-6">
										<p>
										  <a href="mailto:soporte@gonzalbes.com" class="link-login_footer">soporte@gonzalbes.com</a>
										</p>
									  </div>
									</div>
									
									<!-- <div class="row" style="text-align:center;">
									  <div class="col-sm-12">
										<p>
										  <a href="tel:91 635 17 38" class="link-login_footer">91 635 17 38</a>
										</p>
									  </div>
									</div> -->
									
									<div class="row" style="text-align:center;">
									  <div class="col-sm-6">
										<p>
										  <a target="_blank" href="privacidad.html" class="link-login_footer">Política de Privacidad</a>
										</p>
									  </div>
									  <div class="col-sm-6">
										<p>
										  <a target="_blank" href="aviso.html" class="link-login_footer">Aviso</a>
										</p>
									  </div>
									</div>
									
									
								  </form>
								</div>
								</div>
							 </div>
							
						</div>
					</div>
					</div>
				</div>
			</section>
		
</main>
		<!-- Main navigation -->
		
		<!-- Modal Restablecer Contraseña -->
  <div
    class="modal fade"
    id="restablecerModal"
    tabindex="-1"
    aria-labelledby="restablecerModal"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
		<form id="formularioRecov">
          <div class="modal-header">
            <h5 class="modal-title" id="restablecerModal">Restablecer Contraseña</h5>
            <button
              type="button"
              class="btn-close"
              data-mdb-dismiss="modal"
              aria-label="Close"></button>
          </div>
          <div class="modal-body">
		    <p>Introduzca su dirección de correo y le enviaremos un e-mail con un enlace para restablecer su contraseña</p>
		    <div class="form-outline mb-4">
		      <input type="email" id="mailRecov" name="mailRecov" class="form-control" />
		      <label class="form-label" for="mailRecov"> Dirección de E-Mail</label>
		    </div>
		    <p id="resRecov" style="text-align:center;"></p>
		  </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-brand_outline" data-mdb-dismiss="modal">Cerrar</button>
            <button id="btnEnviarRecov" type="button" onclick="Restablecer();" class="btn btn-brand">Enviar</button>
          </div>
		</form>
      </div>
    </div>
  </div>
  
  <?php require_once('./inc/scripts.php'); ?>
		
	<script>
	var loading = false;
	function Login()
	{
		if( !loading )
		{
			loading = true;
			$('#btnAcceder').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Procesando...</span></div>');
			
			$.ajax({
				url: "./ajax/ajax_login.php",
				data: {
					"login": $('#formLogin').val(),
					"pass": $('#formPass').val()
				},
				cache: false,
				type: "POST",
				success: function(response)
				{
					console.log(response);
					var res = JSON.parse(response);
					
					if( res['result'] == 'Ok' )
					{
						$('#resLogin').html('<br/>' + res['textResult']);
						setTimeout(function(){ window.location.replace( res['goTo'] ); }, 800);
						$('#btnAcceder').html('Acceder')
					}
					else
					{
						loading = false;
						$('#resLogin').html('<br/>' + res['textResult']);
						$('#btnAcceder').html('Acceder');
					}
				},
				error: function(xhr)
				{
					console.log(xhr);
					loading = false;
					$('#btnAcceder').html('Acceder');
				}
			});
		}
	}
	
	var loadingRecov = false;
	function Restablecer()
	{
		if( !loadingRecov )
		{
			loadingRecov = true;
			$('#btnEnviarRecov').html('<div class="spinner-border spinner-border-sm text-light" role="status"><span class="visually-hidden">Procesando...</span></div>');
			
			$.ajax({
				url: "./ajax/ajax_restablecer.php",
				data: {
					"accion": 'EnvioMail',
					"mail": $('#mailRecov').val()
				},
				cache: false,
				type: "POST",
				success: function(response)
				{
					console.log(response);
					var res = JSON.parse(response);
					
					if( res['result'] == 'Ok' )
					{
						$('#resRecov').html('<br/>' + res['textResult']);
						$('#btnEnviarRecov').html('Enviado');
						$('#btnEnviarRecov').attr('disabled',true);
					}
					else
					{
						loadingRecov = false;
						$('#resRecov').html('<br/>' + res['textResult']);
						$('#btnEnviarRecov').html('Enviar');
					}
				},
				error: function(xhr)
				{
					console.log(xhr);
					loadingRecov = false;
					$('#btnEnviarRecov').html('Enviar');
				}
			});
		}
	}
	
	$(function() {
		$('#formularioLogin').each(function() {
			$(this).find('input').keypress(function(e) {
				// Enter pressed?
				if(e.which == 10 || e.which == 13) {
					Login();
				}
			});
			$(this).find('input[type=submit]').hide();
		});
		
		$('#formularioRecov').each(function() {
			$(this).find('input').keypress(function(e) {
				// Enter pressed?
				if(e.which == 10 || e.which == 13) {
					Restablecer();
				}
			});

			$(this).find('input[type=submit]').hide();
		});
	});
	
  </script>
  
</body>
</html>
