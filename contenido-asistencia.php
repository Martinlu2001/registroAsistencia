<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] ."/Controller/RegistrarAsistenciaController.php";
    $userDatatableData = readDatatable();
    $lawyerData = readLawyerData();
    $lawyers = [];
    while ($lawyer = $lawyerData->fetch_object()) {
        $lawyers[] = $lawyer;
    }
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
                            <!-- Form Row -->
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
                                    <label class="small mb-1" for="inputTimeAttendance">Hora asistencia</label>
                                    <input class="form-control" name="timeAttendance" id="timeAttendance"
                                        type="time" required>
                                </div>
                                <!-- Form Group (abogado)-->
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputSex">Abogado</label>
                                    <select id="lawyer" class="form-control" name="lawyer" required>
                                        <option selected hidden>Elija...</option>
                                        <?php 
                                            foreach ($lawyers as $lawyer) {
                                                echo '<option value="'.$lawyer->dniAbogado.'">'.$lawyer->nameAbogado.' '.$lawyer->apelliAbogado.'</option>';
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
                        <th>Hora asistencia</th>
                        <th>DNI</th>
                        <th>Nombres</th>
                        <th>Genero</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Fecha asistencia</th>
                        <th>Hora asistencia</th>
                        <th>DNI</th>
                        <th>Nombres</th>
                        <th>Genero</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $modales = '';
                        while ($datos = $userDatatableData->fetch_object()) {
                            echo '
                            <tr>
                                <td>' . $datos->fechaAsistencia. '</td>
                                <td>' . $datos->horaAsistencia. '</td>
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
                                        data-toggle="modal" data-target="#userAttendanceUpdate_'.$datos->dniCliente .'"><i
                                            class="fa fa-plus" aria-hidden="true"
                                            style=" cursor:pointer"></i>
                                    </button>

                                    <button value="ok" class="btn btn-secondary" type="button"
                                        data-toggle="modal" data-target="#userTableView_'.$datos->dniCliente .'"><i
                                            class="fa fa-eye" aria-hidden="true"
                                            style=" cursor:pointer"></i>
                                    </button>
                                </td>
                            </tr>';
                            // Modal para ver los datos del cliente
                            $modales .='
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
                                            <form id="updateUser_'.$datos->dniCliente.'" method="post" action="./Controller/RegistrarAsistenciaController.php">
                                                <input type="hidden" name="action" value="updateDataUser">
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
                                                            type="text" value="'.$datos->nameCliente.'">
                                                    </div>
                                                </div>

                                                <!-- Form Row -->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (Lastname)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1"
                                                            for="inputApellidos">Apellidos</label>
                                                        <input class="form-control" name="lastname" id="lastname"
                                                            type="text" value="'.$datos->apelliCliente.'">
                                                    </div>
                                                    <!-- Form Group (phone)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputPhone">Telefono</label>
                                                        <input class="form-control" name="phone" id="phone"
                                                            type="text" value="'.$datos->celCliente.'">
                                                    </div>
                                                </div>

                                                <!-- Form Row -->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (fecha nacimiento)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1"
                                                            for="inputDateBirth">Fecha nacimiento</label>
                                                        <input class="form-control" name="dateBirth" id="dateBirth"
                                                            type="date" value="'.$datos->datebirthCliente.'">
                                                    </div>
                                                    <!-- Form Group (edad)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="inputEdad">Edad</label>
                                                        <input class="form-control" name="age" id="age"
                                                            type="text" value="'.$datos->ageCliente.'">
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
                                                        <select id="gender" class="form-control" name="gender">
                                                            <option selected hidden value="'.$datos->sexCliente.'">'.$datos->sexCliente.'</option>
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
                                                    <button type="submit" value="ok" class="btn btn-primary">
                                                        Actualizar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            //Modal para actualizar las asistencias del cliente
                            $modales .='
                            <div class="modal" id="userAttendanceUpdate_'.$datos->dniCliente.'" tabindex="-1" aria-labelledby="dataDispSecLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <!-- header modal -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="dataUpdateLabel">Actualizar asistencia de '.$datos->dniCliente.'</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <!-- body ventana modal-->
                                        <div class="modal-body">
                                            <form id="updateAttendanceUser_'.$datos->dniCliente.'" method="post" action="./Controller/RegistrarAsistenciaController.php">
                                                <input type="hidden" name="action" value="updateAttendance">
                                                <input type="hidden" name="current_user" id="current_user" value="'.$_SESSION["dniUser"].'">
                                                <input type="hidden" name="dni" id="dni" value="'.$datos->dniCliente.'"> 
                                                <input type="hidden" name="name" id="name" value="'.$datos->nameCliente.'">  
                                                <input type="hidden" name="lastname" id="lastname" value="'.$datos->apelliCliente.'">         

                                                <!-- Form Row -->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (fecha asistencia)-->
                                                    <div class="col-md-4">
                                                        <label class="small mb-1"
                                                            for="inputDateUpdateAttendance">Fecha asistencia</label>
                                                        <input class="form-control" name="dateUpdateAttendance" id="dateUpdateAttendance"
                                                            type="date" value="'.$datos->fechaAsistencia.'" required>
                                                    </div>
                                                    <!-- Form Group (hora asistencia)-->
                                                    <div class="col-md-4">
                                                        <label class="small mb-1" for="inputTimeUpdateAttendance">Hora asistencia</label>
                                                        <input class="form-control" name="timeUpdateAttendance" id="timeUpdateAttendance"
                                                            type="time" value="'.$datos->horaAsistencia.'" required>
                                                    </div>
                                                    <!-- Form Group (rol)-->
                                                    <div class="col-md-4">
                                                        <label class="small mb-1" for="inputLawyerUpdateAttendance">Abogado</label>
                                                        <select id="lawyerUpdateAttendance" class="form-control" name="lawyerUpdateAttendance" required>
                                                            <option selected hidden value="'.$datos->Abogado_dniAbogado.'">'.$datos->nameAbogado.' '.$datos->apelliAbogado.'</option>';
                                                            foreach ($lawyers as $lawyer) {
                                                                $modales .= '<option value="'.$lawyer->dniAbogado.'">'.$lawyer->nameAbogado.' '.$lawyer->apelliAbogado.'</option>';
                                                            }
                                                        $modales .= '
                                                        </select>
                                                    </div>
                                                </div>
                                
                                                <!-- footer modal -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar
                                                    </button>
                                                    <button type="submit" value="ok" class="btn btn-primary">
                                                        Actualizar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            //Modal para ver la tabla de asistencias del cliente
                            $modales .='
                            <div class="modal" id="userTableView_'. $datos->dniCliente.'" tabindex="-1" aria-labelledby="dataDispSecLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <!-- header modal -->
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="dataUpdateLabel">Tabla de asistencias de '.$datos->dniCliente.'</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <!-- body ventana modal-->
                                        <div class="modal-body">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha asistencia</th>
                                                        <th>Hora asistencia</th>
                                                        <th>Abogado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                                    $userAttendanceData = readUserAttendanceData($datos->dniCliente, $datos->nameCliente, $datos->apelliCliente);
                                                    $list = [];
                                                    while ($attendance = $userAttendanceData->fetch_object()) {
                                                        $list[] = $attendance;
                                                    }
                                                    foreach ($list as $attendance) {
                                                        $modales .='
                                                        <tr>
                                                            <td>' . $attendance->fechaAsistencia. '</td>
                                                            <td>' . $attendance->horaAsistencia . '</td>
                                                            <td>' . $attendance->nameAbogado .  ' ' .$attendance->apelliAbogado.'</td>
                                                        </tr>';
                                                    }
                                                $modales .='
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar
                                            </button>
                                        </div>
                                    </div>  
                                </div>
                            </div>';
                        }
                    ?>
                </tbody>
            </table>
            <?php echo $modales;?>
        </div>
    </div>
</div>