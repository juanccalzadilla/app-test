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
    <main style="margin-top: 90px;font-family: 'Poppins', sans-serif;">
        <div class="container">
            <!--Section: Minimal statistics cards-->
            <section>
                <div class="row">
                    <div class="col-xl-12 col-sm-12 col-12 mb-2 d-flex justify-content-between align-items-center flex-column flex-lg-row">
                        <h4>Bienvenido, Juan</h4>
                        <h4>Gestor: Atención al cliente </h4>
                    </div>
                </div>
                <hr class="hr hr-blurry">
                <div class="row">
                    <div class="col-md-6 my-3"> <!-- Cambiar tamaño del card al crear nuevo widget (si es necesario) -->
                        <div class="card p-4 card-brand rounded-brand d-flex justify-content-center" style="height: 20vh;">
                            <div class="row">
                                <!-- DYNAMIC CONTENT -->
                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                    <div class="d-flex bg-brand-light rounded-full justify-content-center align-items-center" style="width: 50px;height: 50px;">
                                        <i class="fas fa-download text-brand fs-icons-index"></i> <!-- Cambiar icono al crear nuevo widget -->
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex flex-column">
                                        <h4>Nueva documentación disponible</h4> <!-- Cambiar al crear nuevo widget -->
                                        <h6>Consulta los nuevos documentos que envía tu gestor.</h6> <!-- Cambiar al crear nuevo widget -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-3"> <!-- Cambiar tamaño del card al crear nuevo widget (si es necesario) -->
                        <div class="card p-4 card-brand rounded-brand d-flex justify-content-center" style="height: 20vh;">
                            <div class="row">
                                <!-- DYNAMIC CONTENT -->
                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                    <div class="d-flex bg-brand-light rounded-full justify-content-center align-items-center" style="width: 50px;height: 50px;">
                                        <i class="fas fa-file-upload text-brand fs-icons-index"></i> <!-- Cambiar icono al crear nuevo widget -->
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex flex-column">
                                        <h4>Mis documentos</h4> <!-- Cambiar al crear nuevo widget -->
                                        <h6>Subir documentos</h6> <!-- Cambiar al crear nuevo widget -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 my-3"> <!-- Cambiar tamaño del card al crear nuevo widget (si es necesario) -->
                        <div class="card p-4 card-brand rounded-brand d-flex" style="height: 20vh;">
                            <div class="d-flex align-items-center justify-content-between">
                                <!-- DYNAMIC CONTENT -->
                                <div class="col-md-9 ms-4">
                                    <div class="d-flex flex-column">
                                        <h4>Ventas</h4> <!-- Cambiar al crear nuevo widget -->
                                        <h6>Abril</h6> <!-- Cambiar al crear nuevo widget -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                            <div class="row ms-1 mt-3">
                                <div class="col-md-12">
                                    <h3>1.958,00€</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 my-3"> <!-- Cambiar tamaño del card al crear nuevo widget (si es necesario) -->
                        <div class="card p-4 card-brand rounded-brand d-flex" style="height: 20vh;">
                            <div class="d-flex align-items-center justify-content-between">
                                <!-- DYNAMIC CONTENT -->
                                <div class="col-md-9 ms-4">
                                    <div class="d-flex flex-column">
                                        <h4>Compras</h4> <!-- Cambiar al crear nuevo widget -->
                                        <h6>Abril</h6> <!-- Cambiar al crear nuevo widget -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                            <div class="row ms-1 mt-3">
                                <div class="col-md-12">
                                    <h3>957,00€</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 my-3"> <!-- Cambiar tamaño del card al crear nuevo widget (si es necesario) -->
                        <div class="card p-4 card-brand rounded-brand d-flex" style="height: 20vh;">
                            <div class="d-flex align-items-center justify-content-between">
                                <!-- DYNAMIC CONTENT -->
                                <div class="col-md-9 ms-4">
                                    <div class="d-flex flex-column">
                                        <h4>Solicitudes</h4> <!-- Cambiar al crear nuevo widget -->
                                        <h6>Comunícate con tu gestor, reliza consulta y peticiones.</h6> <!-- Cambiar al crear nuevo widget -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7 my-3"> <!-- Cambiar tamaño del card al crear nuevo widget (si es necesario) -->
                        <div class="card rounded-brand">
                            <div class="card-header py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="text-uppercase mb-2">Gráfico compras/ventas</h6>
                                        <p class="mb-0">
                                            <span class="h4 me-2">1 001</span>
                                            <span class="text-success"><i class="fas fa-arrow-up fa-sm"></i>
                                                <span style="font-size: 0.875rem; font-weight: 500"> 5,48%</span></span>
                                        </p>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-outline-primary">Detalles</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="chart-pages-and-queries"></div>
                            </div>
                            <div class="card-footer py-4">
                                <div class="row">
                                    <div class="col-md-6 mb-4 mb-md-0">
                                        <select class="select">
                                            <option value="1">Hoy</option>
                                            <option value="2">Ayer</option>
                                            <option value="3" selected>Últimos 7 días</option>
                                            <option value="4">Últimos 30 días</option>
                                            <option value="5">Últimos 90 días</option>
                                        </select>
                                        <label class="form-label select-label">Fecha</label>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-outline datepicker">
                                            <input type="text" class="form-control" id="exampleDatepicker1" value="Custom date" data-mdb-toggle="datepicker" />
                                            <label for="exampleDatepicker1" class="form-label">Date</label>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 my-3"> <!-- Cambiar tamaño del card al crear nuevo widget (si es necesario) -->
                        <div class="card p-4 card-brand rounded-brand d-flex">
                            <div class="d-flex align-items-center justify-content-between">
                                <!-- DYNAMIC CONTENT -->
                                <div class="col-md-9 ms-4">
                                    <div class="d-flex flex-column">
                                        <h4>Mis recibos</h4> <!-- Cambiar al crear nuevo widget -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-center align-items-center mt-2">
                                <div class="d-flex  justify-content-between w-50">
                                    <h5>ORD-1234 </h5> <!-- Cambiar al crear nuevo widget -->
                                    <h5 class="text-success">Pagado</h5> <!-- Cambiar al crear nuevo widget -->
                                </div>
                            </div>
                            <hr class="hr" />
                            <div class="d-flex flex-column justify-content-center align-items-center mt-2">
                                <div class="d-flex  justify-content-between w-50">
                                    <h5>ORD-4434 </h5> <!-- Cambiar al crear nuevo widget -->
                                    <h5 class="text-danger">Pendiente</h5> <!-- Cambiar al crear nuevo widget -->
                                </div>
                            </div>
                            <hr class="hr" />
                            <div class="d-flex flex-column justify-content-center align-items-center mt-2">
                                <div class="d-flex  justify-content-between w-50">
                                    <h5>ORD-1224 </h5> <!-- Cambiar al crear nuevo widget -->
                                    <h5 class="text-warning">Pago parcial</h5> <!-- Cambiar al crear nuevo widget -->
                                </div>
                            </div>
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

            // Grafico -----------------------------

            const optionsChartPagesAndQueries = {
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            stacked: false,
                        }, ],
                    },
                },
            };

            const dataChartPagesAndQueries = {
                type: 'line',
                data: {
                    labels: [
                        '02/05/2023',
                        '03/05/2023',
                        '12/05/2023',
                        '15/05/2023',
                        '22/05/2023',
                        '23/05/2023',
                        '28/05/2023',
                    ],
                    datasets: [{
                            label: 'Ventas',
                            data: [25, 49, 40, 21, 56, 75, 30],
                            backgroundColor: 'rgba(66, 133, 244, 0.0)',
                            borderColor: 'green',
                            pointBorderColor: 'green',
                            pointBackgroundColor: 'green',
                        },
                        {
                            label: 'Compras',
                            data: [58, 18, 30, 59, 46, 77, 90],
                            backgroundColor: 'rgba(66, 133, 244, 0.0)',
                            borderColor: 'red',
                            pointBorderColor: 'red',
                            pointBackgroundColor: 'red',
                        },
                    ],
                },
            };

            new mdb.Chart(
                document.getElementById('chart-pages-and-queries'),
                dataChartPagesAndQueries,
                optionsChartPagesAndQueries
            );
        });
    </script>

</body>

</html>