<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] ."/admin/Controller/PerfilAdminController.php";
    $perfilAdminController = new PerfilAdminController($mysqli);
    $userData = $perfilAdminController->getPerfil($_SESSION["dniUser"]);
?>

<link rel="stylesheet" href="../assets/css/styleperfil.css">

<!-- Titulo pagina -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Perfil</h1>
</div>

<hr class="mt-0 mb-4">
<!-- AQUI ESTA EL PERFIL -->
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->

    <!-- <hr class="mt-0 mb-4"> -->
    <div class="">
        <div class="col-xl-20">
            <!-- Account details card-->
            <div class="card mb-4">
                <!-- <div class="card-header">Detalles del perfil</div> -->
                <div class="card-body">
                    <form id="perfilForm" method="post" action="./Controller/PerfilAdminController.php">
                        <input type="hidden" name="action" value="actualizar">
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (nombres)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Nombres</label>
                                <input class="form-control bord" id="inputFirstName" name="name" type="text" value="<?php echo htmlspecialchars($userData['nameAdmin']); ?>" required>
                            </div>
                            <!-- Form Group (apellidos)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Apellidos</label>
                                <input class="form-control bord" id="inputLastName" name="lastname" type="text" value="<?php echo htmlspecialchars($userData['apelliAdmin']); ?>" required>
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (usuario)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputUser">Usuario</label>
                                <input class="form-control bord" id="inputUser" type="text" value="<?php echo htmlspecialchars($userData['dniAdmin']); ?>" style="cursor: not-allowed;" readonly>
                            </div>
                            <!-- Form Group (contraseña)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Cambiar Contraseña</label>
                                <input class="form-control bord" id="inputLocation" name="password" type="password">
                            </div>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (DNI)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputDNI">DNI</label>
                                <input class="form-control bord" id="inputDNI" type="text" name="dni" value="<?php echo htmlspecialchars($userData['dniAdmin']); ?>" style="cursor: not-allowed;" readonly>
                            </div>
                            <!-- Form Group (cargo)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputCargo">Cargo</label>
                                <input class="form-control" id="inputCargo" type="text" name="rol" value="<?php echo htmlspecialchars($userData['rolAdmin']); ?>" style="cursor: not-allowed;" readonly>
                            </div>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (telefono)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Telefono</label>
                                <input class="form-control bord" id="inputPhone" type="text" name="phone" value="<?php echo htmlspecialchars($userData['celAdmin']); ?>" required>
                            </div>
                            <!-- Form Group (gender)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Genero</label>
                                <input class="form-control bord" id="inputBirthday" type="text" name="gender" value="<?php echo htmlspecialchars($userData['sexAdmin']); ?>" style="cursor: not-allowed;" readonly>
                            </div>

                        </div>
                        <!-- Update button-->
                        <div class="hola arreglar">
                            <button class="btn btn-primary" type="submit">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>