<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] ."/Controller/RegistrarAsistenciaController.php";
    $userDatatableData = readDatatable();
    $lawyerData = readLawyerData();
?>

<!-- Titulo pagina inicio -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Registrar asistencia</h1>
</div>
<hr class="mt-0 mb-4">

<!-- DATATABLE -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button value="ok" class="btn btn-primary btn-rounded"
            style="float: right; margin-left: 10px;" type="button" data-toggle="modal"
            data-target="#createUser" aria-hidden="true">
            <i class="fa fa-plus"aria-hidden="true"></i>
            Nuevo cliente
        </button>
        <a class="btn btn-rounded"
            style="float: right; margin-left: 10px;background-color: rgb(29, 185, 81);">
            <i class="fa fa-file-excel" style="color:white"></i>
        </a>

        <!-- MODAL AGREGAR -->
        <div class="modal" id="createUser" tabindex="-1" aria-labelledby="dataDispSecLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">

                <!-- content modal -->
                <div class="modal-content">

                    <!-- header modal -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="dataUpdateLabel">Registrar nuevo cliente</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <!-- body ventana modal-->
                    <div class="modal-body">
                        <form id="addUser" method="post" action="./Controller/RegistrarAsistenciaController.php">
                            <input type="hidden" name="action" value="create">
                            <input type="hidden" name="current_user" id="current_user" value="<?php echo $_SESSION["dniUser"]?>">                          
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
                                <!-- Form Group (fecha nacimiento)-->
                                <div class="col-md-3">
                                    <label class="small mb-1"
                                        for="inputDateBirth">Fecha nacimiento</label>
                                    <input class="form-control" name="dateBirth" id="dateBirth"
                                        type="date" required>
                                </div>
                                <!-- Form Group (edad)-->
                                <div class="col-md-3">
                                    <label class="small mb-1" for="inputEdad">Edad</label>
                                    <input class="form-control" name="age" id="age"
                                        type="text" required>
                                </div>
                                <!-- </div> -->

                                <!-- Form Row -->
                                <!-- <div class="row gx-3 mb-3"> -->
                                <!-- Form Group (rol)-->
                                <div class="col-md-3">
                                    <label class="small mb-1" for="inputRol">Rol</label>
                                    <select id="rol" class="form-control" name="rol" required>
                                        <option selected hidden>Elija...</option>
                                        <option value="Cliente">Cliente</option>
                                    </select>
                                </div>
                                <!-- Form Group (genero)-->
                                <div class="col-md-3">
                                    <label class="small mb-1" for="inputSex">Genero</label>
                                    <select id="gender" class="form-control" name="gender" required>
                                        <option selected hidden>Elija...</option>
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (fecha asistencia)-->
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputDateAttendance">Fecha asistencia</label>
                                    <input class="form-control" name="dateAttendance" id="dateAttendance"
                                        type="date" required>
                                </div>
                                <!-- Form Group (hora asistencia)-->
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputhourAttendance">Hora asistencia</label>
                                    <input class="form-control" name="hourAttendance" id="hourAttendance"
                                        type="time" required>
                                </div>
                                <!-- Form Group (abogado)-->
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputSex">Abogado</label>
                                    <select id="lawyer" class="form-control" name="lawyer" required>
                                        <option selected hidden>Elija...</option>
                                        <?php 
                                            while ($datos = $lawyerData->fetch_object()) {
                                                echo '<option value="'.$datos->dniAbogado.'">'.$datos->nameAbogado.' '.$datos->apelliAbogado.'</option>';
                                            }
                                        ?>
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
                        <th>Fecha asistencia</th>
                        <th>DNI</th>
                        <th>Nombres</th>
                        <th>Genero</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Fecha asistencia</th>
                        <th>DNI</th>
                        <th>Nombres</th>
                        <th>Genero</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
                        while ($datos = $userDatatableData->fetch_object()) {
                            echo '
                            <tr>
                                <td>' . $datos->dniCliente . '</td>
                                <td>' . $datos->dniCliente . '</td>
                                <td>' . $datos->nameCliente .  ' ' .$datos->apelliCliente.'</td>
                                <td>' . $datos->sexCliente . '</td>
                                <td> 
                                    <button value="ok" class="btn btn-success" type="button"
                                        data-toggle="modal" data-target="#dataUserUpdate_'.$datos->dniCliente .'"><i
                                            class="fa fa-edit" aria-hidden="true"
                                            style=" cursor:pointer"></i>
                                    </button>

                                    <button value="ok" class="btn btn-info" type="button"
                                        data-toggle="modal" data-target="#userDateUpdate_'.$datos->dniCliente .'"><i
                                            class="fa fa-plus" aria-hidden="true"
                                            style=" cursor:pointer"></i>
                                    </button>
                                </td>
                            </tr>';
                            // Modal para ver los datos del cliente
                            echo'
                            <div class="modal" id="dataUserUpdate_'. $datos->dniCliente.'" tabindex="-1" aria-labelledby="dataDispSecLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <!-- header modal -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="dataUpdateLabel">Informacion de '.$datos->dniCliente.'</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <!-- body ventana modal-->
                                        <div class="modal-body">
                                            <form id="updateUser" method="post" action="./Controller/RegistrarAsistenciaController.php">
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (DNI)-->
                                                    <div class="col-md-6 ">
                                                        <label class="small mb-1" for="inputDNI">
                                                            DNI</label>
                                                        <input class="form-control" name="dni" id="dni"
                                                            type="text" value="'.$datos->dniCliente.'" readonly>
                                                    </div>
                                                    <!-- Form Group (Nombre)-->
                                                    <div class="col-md-6 ">
                                                        <label class="small mb-1" for="inputName">Nombres</label>
                                                        <input class="form-control" name="name" id="name"
                                                            type="text" value="'.$datos->nameCliente.'" readonly>
                                                    </div>
                                                </div>

                                                <!-- Form Row -->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Lastname)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1"
                                                            for="inputApellidos">Apellidos</label>
                                                        <input class="form-control" name="lastname" id="lastname"
                                                            type="text" value="'.$datos->apelliCliente.'" readonly>
                                                    </div>
                                                    <!-- Form Group (phone)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputPhone">Telefono</label>
                                                        <input class="form-control" name="phone" id="phone"
                                                            type="text" value="'.$datos->celCliente.'" readonly>
                                                    </div>
                                                </div>

                                                <!-- Form Row -->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (fecha nacimiento)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1"
                                                            for="inputDateBirth">Fecha nacimiento</label>
                                                        <input class="form-control" name="dateBirth" id="dateBirth"
                                                            type="date" value="'.$datos->datebirthCliente.'" readonly>
                                                    </div>
                                                    <!-- Form Group (edad)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputEdad">Edad</label>
                                                        <input class="form-control" name="age" id="age"
                                                            type="text" value="'.$datos->ageCliente.'" readonly>
                                                    </div>
                                                </div>

                                                <!-- Form Row -->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (rol)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputRol">Rol</label>
                                                        <input type="text" class="form-control" name="rol" id="rol"
                                                            value="'.$datos->rolCliente.'" readonly>
                                                    </div>
                                                    <!-- Form Group (genero)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputSex">Genero</label>
                                                        <input type="text" class="form-control" name="gender" id="gender"
                                                            value="'.$datos->sexCliente.'" readonly>
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