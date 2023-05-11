<!DOCTYPE html>
<html lang="es">
<?php require_once('./inc/header.php'); ?>

<body>
	<!-- Main navigation -->
	<main class="d-flex bg-danger justify-content-center align-items-center" style="height: 100vh;">
		<div class="row">
			<div class="col-md-12">
				<div class="card p-4 m-4">

					<div class="rounded p-3" style="text-align: center;">

						<!-- <img src="./img/logo-login-sm.png" height="80px" /> -->
						<h4>Bienvenido - nuevo proyecto etnyka</h4>
					</div>

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
					<button id="btnAcceder" type="button" onclick="Login();" class="btn btn-danger btn-block mb-1">Acceder</button>

					<?php
					if ($_SERVER['HTTP_HOST'] == 'pruebas.localhost') {
					?>
						<button type="button" onclick="window.location.href='_loginAdmin.php?tipo=Admin';" class="btn btn-primary mt-4">- ACCESO DEVELOPERS -</button>
						<br /><br />
					<?php
					}
					?>

					<p class="text-center" id="resLogin"></p>
					<div class="row my-4">
						<div class="col text-center">
							<!-- Simple link -->
							<a href="#" class="link-login" data-mdb-toggle="modal" data-mdb-target="#restablecerModal">¿Olvidó su usuario o contraseña?</a>
						</div>
					</div>
				</div>
			</div>
		</div>


	</main>
	<!-- Main navigation -->

	<!-- Modal Restablecer Contraseña -->
	<div class="modal fade" id="restablecerModal" tabindex="-1" aria-labelledby="restablecerModal" aria-hidden="true">
		<div class="modal-dialog  modal-dialog-centered">
			<div class="modal-content">
				<form id="formularioRecov">
					<div class="modal-header">
						<h5 class="modal-title" id="restablecerModal">Restablecer Contraseña</h5>
						<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
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
						<button type="button" class="btn btn-danger" data-mdb-dismiss="modal">Cerrar</button>
						<button id="btnEnviarRecov" type="button" onclick="Restablecer();" class="btn btn-primary">Enviar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php require_once('./inc/scripts.php'); ?>

	<script>
		var loading = false;

		function Login() {
			if (!loading) {
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
					success: function(response) {
						console.log(response);
						var res = JSON.parse(response);

						if (res['result'] == 'Ok') {
							$('#resLogin').html('<br/>' + res['textResult']);
							setTimeout(function() {
								window.location.replace(res['goTo']);
							}, 800);
							$('#btnAcceder').html('Acceder')
						} else {
							loading = false;
							$('#resLogin').html('<br/>' + res['textResult']);
							$('#btnAcceder').html('Acceder');
						}
					},
					error: function(xhr) {
						console.log(xhr);
						loading = false;
						$('#btnAcceder').html('Acceder');
					}
				});
			}
		}

		var loadingRecov = false;

		function Restablecer() {
			if (!loadingRecov) {
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
					success: function(response) {
						console.log(response);
						var res = JSON.parse(response);

						if (res['result'] == 'Ok') {
							$('#resRecov').html('<br/>' + res['textResult']);
							$('#btnEnviarRecov').html('Enviado');
							$('#btnEnviarRecov').attr('disabled', true);
						} else {
							loadingRecov = false;
							$('#resRecov').html('<br/>' + res['textResult']);
							$('#btnEnviarRecov').html('Enviar');
						}
					},
					error: function(xhr) {
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
					if (e.which == 10 || e.which == 13) {
						Login();
					}
				});
				$(this).find('input[type=submit]').hide();
			});

			$('#formularioRecov').each(function() {
				$(this).find('input').keypress(function(e) {
					// Enter pressed?
					if (e.which == 10 || e.which == 13) {
						Restablecer();
					}
				});

				$(this).find('input[type=submit]').hide();
			});
		});
	</script>

</body>

</html>