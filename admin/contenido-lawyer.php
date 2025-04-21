<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] ."/admin/Controller/AbogadoController.php";
    $userDatatableData = readDatatableAbogado();
?>

<link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Titulo pagina inicio -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Lista de abogados</h1>
</div>
<hr class="mt-0 mb-4">

<!-- DATATABLE -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button value="ok" class="btn btn-primary btn-rounded"
            style="float: right; margin-left: 10px;" type="button" data-toggle="modal"
            data-target="#createLawyer" aria-hidden="true">
            <i class="fa fa-plus"aria-hidden="true"></i>
        </button>
        <a class="btn btn-rounded"
            style="float: right; margin-left: 10px;background-color: rgb(29, 185, 81);">
            <i class="fa fa-file-excel" style="color:white"></i>
        </a>

        <!-- MODAL AGREGAR -->
        <div class="modal" id="createLawyer" tabindex="-1" aria-labelledby="dataDispSecLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">

                <!-- content modal -->
                <div class="modal-content">

                    <!-- header modal -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="dataUpdateLabel">Agregar abogado</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <!-- body ventana modal-->
                    <div class="modal-body">
                        <form id="addLawyer" method="post" action="./Controller/AbogadoController.php">
                            <input type="hidden" name="action" value="create">                          
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

                            <!-- Form Row -->
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
                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (rol)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputRol">Rol</label>
                                    <select id="rol" class="form-control" name="rol" required>
                                        <option selected hidden>Elija...</option>
                                        <option value="Abogado">Abogado</option>
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

                            <!-- footer modal -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Cerrar
                                </button>
                                <button type="submit" value="ok" name="createDisp"
                                    class="btn btn-primary">Agregar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content datatable -->
    <div class="card-body">
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
                            echo '
                            <tr>
                                <td>' . $datos->dniAbogado . '</td>
                                <td>' . $datos->nameAbogado .  ' ' .$datos->apelliAbogado.'</td>
                                <td>' . $datos->rolAbogado . '</td>
                                <td>' . $datos->celAbogado . '</td>
                                <td>' . $datos->sexAbogado . '</td>
                                <td> 
                                    <button value="ok" class="btn btn-success" type="button"
                                        data-toggle="modal" data-target="#dataLawyerView_'.$datos->dniAbogado .'"><i
                                            class="fa fa-eye" aria-hidden="true"
                                            style=" cursor:pointer"></i>
                                    </button>
                                   
                                    <button class="btn btn-danger" onclick="confirmDelete('.$datos->dniAbogado.')" id="buttondelete"><i
                                            class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>';
                            // Modal para ver los datos del vigilante
                            echo'
                            <div class="modal" id="dataLawyerView_'. $datos->dniAbogado.'" tabindex="-1" aria-labelledby="dataDispSecLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <!-- header modal -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="dataUpdateLabel">Informacion de '.$datos->dniAbogado.'</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <!-- body ventana modal-->
                                        <div class="modal-body">
                                            <form id="viewLawyer" method="">
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (DNI)-->
                                                    <div class="col-md-6 ">
                                                        <label class="small mb-1" for="inputDNI">
                                                            DNI</label>
                                                        <input class="form-control" name="dni" id="dni"
                                                            type="text" value="'.$datos->dniAbogado.'" readonly>
                                                    </div>
                                                    <!-- Form Group (Nombre)-->
                                                    <div class="col-md-6 ">
                                                        <label class="small mb-1" for="inputName">Nombres</label>
                                                        <input class="form-control" name="name" id="name"
                                                            type="text" value="'.$datos->nameAbogado.'" readonly>
                                                    </div>
                                                </div>

                                                <!-- Form Row -->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Lastname)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1"
                                                            for="inputApellidos">Apellidos</label>
                                                        <input class="form-control" name="lastname" id="lastname"
                                                            type="text" value="'.$datos->apelliAbogado.'" readonly>
                                                    </div>
                                                    <!-- Form Group (phone)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputPhone">Telefono</label>
                                                        <input class="form-control" name="phone" id="phone"
                                                            type="text" value="'.$datos->celAbogado.'" readonly>
                                                    </div>
                                                </div>
                                                <!-- Form Row -->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (rol)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputRol">Rol</label>
                                                        <input type="text" class="form-control" name="rol" id="rol"
                                                            value="'.$datos->rolAbogado.'" readonly>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputSex">Genero</label>
                                                        <input type="text" class="form-control" name="gender" id="gender"
                                                            value="'.$datos->sexAbogado.'" readonly>
                                                    </div>
                                                </div>
                                                <!-- footer modal -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>