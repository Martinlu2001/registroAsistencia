<?php
    session_start();
    //si esta iniciado la sesion
    if (!isset($_SESSION["rolUser"]) || $_SESSION["rolUser"] !== "admin") {
        header("Location: ../login.php");
        exit();
    }
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
?>

<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] ."/admin/Controller/PersonalSeguridadController.php";
    $userDatatableData = readDatatableVigilante();
    //$userData = readVigilante();
?>

<?php
    include './template/header.php';
?>

<link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Titulo pagina inicio -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Datos de personal de seguridad</h1>
</div>
<hr class="mt-0 mb-4">

<!-- AQUI EMPIEZA DATATABLE -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button value="ok" class="btn btn-primary btn-rounded"
            style="float: right; margin-left: 10px;" type="button" data-toggle="modal"
            data-target="#dataDispSec" aria-hidden="true">
            <i class="fa fa-plus"aria-hidden="true"></i>
        </button>
        <a class="btn btn-rounded"
            style="float: right; margin-left: 10px;background-color: rgb(29, 185, 81);">
            <i class="fa fa-file-excel" style="color:white"></i>
        </a>

        <!-- MODAL AGREGAR -->
        <div class="modal" id="dataDispSec" tabindex="-1" aria-labelledby="dataDispSecLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dataUpdateLabel">Agregar personal de seguridad</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <!-- aqui va lo principal de la ventana modal-->

                    <div class="modal-body">

                        <!-- <div class="card-body"> -->

                        <form id="addSecurity" method="post" enctype="multipart/form-data" action="./Controller/PersonalSeguridadController.php">
                            <input type="hidden" name="action" value="create"> <!-- Acción para actualizar -->
                            <div class="row gx-3 mb-3">
                                <!-- <div class="row gx-3 mb-3"> -->
                                <!-- Form Group (image)-->
                                <div class="col-md-6" id="uploadImageDisp">
                                    <img class="img-account-profile" id="imagesDisp"
                                        src="../assets/images/User_icon.png" alt="usericon" width="200"
                                        height="200">
                                    <input type="file" name="image" id="image"
                                        accept=".jpg, .jpeg, .png" value="">
                                </div>
                                <script type="text/javascript">
                                    document.getElementById("image").onchange = function() {
                                        document.getElementById("imagesDisp").src = URL.createObjectURL(image.files[0]);
                                    }
                                </script>

                                <!-- row gx-3 mb-3 col-md-6 align-items-center -->
                                <div class="col-md-6 ">
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (DNI)-->
                                        <div class="col-md-6 ">
                                            <label class="small mb-1" for="inputDNI">
                                                DNI</label>
                                            <input class="form-control" name="dni" id="dni"
                                                type="text" required>
                                        </div>
                                        <!-- Form Group (Nombre)-->
                                        <div class="col-md-6 ">
                                            <label class="small mb-1" for="inputName">Nombres</label>
                                            <input class="form-control" name="name" id="name"
                                                type="text" required>
                                        </div>
                                    </div>

                                    <!-- Form Row        -->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (Lastname)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1"
                                                for="inputApellidos">Apellidos</label>
                                            <input class="form-control" name="lastname" id="lastname"
                                                type="text" required>
                                        </div>
                                        <!-- Form Group (phone)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputPhone">Telefono</label>
                                            <input class="form-control" name="phone" id="phone"
                                                type="text" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (rol)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputRol">Rol</label>
                                    <select id="rol" class="form-control" name="rol" required>
                                        <option selected hidden>Elija...</option>
                                        <option value="Vigilante">Vigilante</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputSex">Genero</label>
                                    <select id="gender" class="form-control" name="gender" required>
                                        <option selected hidden>Elija...</option>
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                            </div>

                            <style>
                                .data {
                                    display: none;
                                }

                                .data1 {
                                    display: none;
                                }

                                .location {
                                    display: none;
                                }
                            </style>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Cerrar</button>
                                <button type="submit" value="ok" name="createDisp"
                                    class="btn btn-primary">Agregar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- datatable -->
    <div class="card-body" id="datatable-container">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombres</th>
                        <th>Rol</th>
                        <th>Celular</th>
                        <th>Genero</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>DNI</th>
                        <th>Nombres</th>
                        <th>Rol</th>
                        <th>Celular</th>
                        <th>Genero</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
                        while ($datos = $userDatatableData->fetch_object()) {
                            // Mostrar información en la tabla
                            echo '
                            <tr>
                                <td>' . $datos->dniVigilante . '</td>
                                <td>' . $datos->nameVigilante .  ' ' .$datos->apelliVigilante.'</td>
                                <td>' . $datos->rolVigilante . '</td>
                                <td>' . $datos->celVigilante . '</td>
                                <td>' . $datos->sexVigilante . '</td>
                                <td> <button value="ok" class="btn btn-success" type="button"
                                        data-toggle="modal" data-target="#dataDeviceView"><i
                                            class="fa fa-eye" aria-hidden="true"
                                            style=" cursor:pointer"></i></button>
                                    <button value="ok" class="btn btn-primary" type="button"
                                        data-toggle="modal" data-target="#dataDeviceEdit"><i
                                            class="fa fa-edit" aria-hidden="true"
                                            style=" cursor:pointer"></i></button>
                                    <button class="btn btn-danger" onclick="dele()" id="buttondelete"><i
                                            class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>';
                        }
                    ?>

                    
                    <!-- <tr>
                        <td>
                            <button value="ok" class="btn btn-success" type="button"
                                data-toggle="modal" data-target="#dataDeviceView"><i
                                    class="fa fa-eye" aria-hidden="true"
                                    style=" cursor:pointer"></i></button>
                            <button value="ok" class="btn btn-primary" type="button"
                                data-toggle="modal" data-target="#dataDeviceEdit"><i
                                    class="fa fa-edit" aria-hidden="true"
                                    style=" cursor:pointer"></i></button>
                            <button class="btn btn-danger" onclick="dele()" id="buttondelete"><i
                                    class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    include './template/footer.php';
?>