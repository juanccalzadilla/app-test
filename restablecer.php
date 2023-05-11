<!DOCTYPE html>
<html lang="es">

<?php require_once('./inc/header.php'); ?>

<?php

// if( isset($_GET['mail']) && isset($_GET['tokenReset']) )
// {
//   $resetMail = $_GET['mail'];
//   $resetTipo = $_GET['tipo'];
//   $resetToken = $_GET['tokenReset'];
// }
// else
// {
//   $resetMail = '';
//   $reestToken = '';
// }

?>

<body>
  <!--Main Navigation-->
  <header>
    <style>
      #intro {
        background-image: url(./img/login_background.jpg);
        height: 100vh;
      }
	  
      /* Height for devices larger than 576px */
      @media (min-width: 992px) {
        #intro {
          padding-top:100px;
        }
      }
	  
      .navbar .nav-link {
        color: #fff !important;
      }
	  
	  .container{
		padding-bottom: 80px;
	  }
	  
	  .subTextoLogo{
		color: white;
		font-weight: 500;
		font-size: 24px;
	  }
    </style>
	
    <!-- Background image -->
    <div id="intro" class="bg-image">
      <div class="mask d-flex align-items-center bg-danger h-100">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
              <form id="formularioRestablecer" class="bg-white rounded "
					style="padding-bottom: 1rem;
						   padding-top: 3rem;
						   padding-left: 3rem;
						   padding-right: 3rem;">
						   
				<h4 style="text-align:center;padding-bottom: 20px;" >Restablecer contraseña</h4>
				
                <!-- Mail -->
                <div class="form-outline mb-4">
                  <input type="email" id="formMail" class="form-control" disabled value="<?php echo $resetMail; ?>" />
                  <label class="form-label" for="formMail">E-Mail</label>
                </div>
				
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="newPass" class="form-control" />
                  <label class="form-label" for="newPass">Nueva Contraseña</label>
                </div>
				
                <!-- Submit button -->
                <button id="btnEnviarRecov" type="button" onclick="Restablecer();" class="btn btn-primary btn-block">Restablecer</button>
				
				<p id="resRecov" style="text-align:center;"></p>
				
              </form>
            </div>
          </div>
		  
        </div>
      </div>
    </div>
    <!-- Background image -->
  </header>
  <!--Main Navigation-->
  
  <?php require_once('./inc/scripts.php'); ?>
  
  <script>
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
					"accion": 'Restablecer',
					"mail": '<?php echo $resetMail; ?>',
					"token": '<?php echo $resetToken; ?>',
					"tipo": '<?php echo $resetTipo; ?>',
					"pass": $('#newPass').val()
				},
				cache: false,
				type: "POST",
				success: function(response)
				{
					console.log(response);
					try { var res = JSON.parse(response); }
					catch( exception )
					{
						console.log( exception );
						res = {'result':'Ko','textResult':'Ha habido un error. Por favor, inténtelo de nuevo más tarde.'};
					}
					
					if( res['result'] == 'Ok' )
					{
						$('#btnEnviarRecov').html('Restablecer');
						$('#btnEnviarRecov').attr('disabled',true);
						$('#resRecov').html('<br/>' + res['textResult']);
						setTimeout(function(){ window.location.replace( './login.php' ); }, 800);
					}
					else
					{
						loadingRecov = false;
						$('#resRecov').html('<br/>' + res['textResult']);
						$('#btnEnviarRecov').html('Restablecer');
					}
				},
				error: function(xhr)
				{
					console.log(xhr);
					loadingRecov = false;
					$('#btnEnviarRecov').html('Restablecer');
				}
			});
		}
	}
	
	$(function() {
		$('#formularioRestablecer').each(function() {
			$(this).find('input').keypress(function(e) {
				// Enter pressed?
				if(e.which == 10 || e.which == 13) {
					Restablecer();
				}
			});
		});
	});
	
  </script>
  
</body>
</html>