<?php

require_once "./_BBDD_Connect.php";
require_once "./inc/start-ajax.php";

if (!isset($_SESSION['rol'])) {
  header("Location: /login.php");
  die();
}

?>
<!DOCTYPE html>
<html lang="es">
<?php require_once './inc/header.php'; ?>
<body>
  <!--Main Navigation-->
  <header>
    <?php require_once './inc/sidebar.php'; ?>
    <?php require_once './inc/navbar.php'; ?>
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main style="margin-top: 58px;font-family: 'Poppins', sans-serif;">
    <div class="container">
      <!--Section: Minimal statistics cards-->
      <section>
        <div class="row">
          <div class="col-xl-12 col-sm-12 col-12 mb-2 d-flex justify-content-between align-items-center flex-column flex-lg-row">
            <h4 clas>Nuevo proyecto</h4>
            </span>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-xl-6 col-sm-12 col-12 my-4">
            <div class="card">
              <a href="./cliente_estadoFicherosDisponibles.php">
                <div class="card-body" style="background-color:#ffffff;">
                  <div class="d-flex px-md-1" style="color: slategray;">
                    <div class="align-self-center text-brand">
                      <i class="fas fa-user fa-3x"></i>
                    </div>
                    <div style="margin-left:20px;">
                      <h4 class="text-brand">Alta persona</h4>
                      <p class="mb-0 text-brand">Alta nuevo usuario normal</p>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-xl-6 col-sm-12 col-12 my-4">
            <div class="card">
              <a href="./solicitudes_cliente.php">
                <div class="card-body" style="background-color:#ffffff;">
                  <div class="d-flex px-md-1" style="color: slategray;">
                    <div class="align-self-center text-brand">
                      <i class="fas fa-user fa-3x"></i>
                    </div>
                    <div style="margin-left:20px;">
                      <h4 class="text-brand">Alta administrador</h4>
                      <p class="mb-0 text-brand">Dar alta de administrador</p>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>

      </section>
      <!--Section: Minimal statistics cards-->

      <!-- Section : Tramites habituales -->
    </div>
  </main>

  <!-- Button trigger modal -->
  <!--Main layout-->

  <?php require_once './inc/scripts.php'; ?>
  <?php require_once('./inc/footer.php'); ?>


  <script>
    $(document).ready(function() {
      const sidenav = document.getElementById("sidenav-1");
      const sidenavInstance = mdb.Sidenav.getInstance(sidenav);

      let innerWidth = null;

      const setMode = (e) => {
        // Check necessary for Android devices
        if (window.innerWidth === innerWidth) {
          return;
        }

        innerWidth = window.innerWidth;

        if (window.innerWidth < 1400) {
          sidenavInstance.changeMode("over");
          sidenavInstance.hide();
        } else {
          sidenavInstance.changeMode("side");
          sidenavInstance.show();
        }
      };

      setMode();

      // Event listeners
      window.addEventListener("resize", setMode);
    });
  </script>

</body>

</html>