<?php
//session_start();
//si esta iniciado la sesion
/*if(!isset($_SESSION['idUsuario'])){
        header("Location: login.php");
    }*/
?>

<?php
    include 'template/header.php';
?>
                    <link rel="stylesheet" href="./assets/css/styleperfil.css">
                    <!-- <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'></script> -->

                    <!-- Titulo pagina -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Perfil</h1>
                    </div>

                    <hr class="mt-0 mb-4">
                    <!-- AQUI ESTA EL PERFIL -->
                    <div class="container-xl px-4 mt-4">
                        <!-- Account page navigation-->

                        <!-- <hr class="mt-0 mb-4"> -->
                        <div class="row">
                            <div class="col-xl-4">
                                <!-- Profile picture card-->
                                <div class="card mb-4 mb-xl-0">
                                    <div class="card-header">Foto de perfil</div>
                                    <div class="card-body text-center">
                                        <!-- Profile picture image-->
                                        <img class="image-perfil borde-suave mb-2" alt="Foto de perfil" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                        <!-- Profile picture upload button-->
                                        <input type="file" alt="Foto de perfil" accept=".png,.jpeg,.jpg,.webp">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <!-- Account details card-->
                                <div class="card mb-4">
                                    <div class="card-header">Detalles del perfil</div>
                                    <div class="card-body">
                                        <form id="perfilForm">
                                            <!-- Form Group (username)-->
                                            <!-- <div class="mb-3">
                                                                    <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                                                    <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="username">
                                                                </div> -->
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (nombres)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputFirstName">Nombres</label>
                                                    <input class="form-control bord" id="inputFirstName" type="text" required>
                                                </div>
                                                <!-- Form Group (apellidos)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputLastName">Apellidos</label>
                                                    <input class="form-control bord" id="inputLastName" type="text" value="Luna" required>
                                                </div>
                                            </div>
                                            <!-- Form Row        -->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (usuario)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputUser">Usuario</label>
                                                    <input class="form-control bord" id="inputUser" type="text" value="70370747" required>
                                                </div>
                                                <!-- Form Group (contraseña)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputLocation">Contraseña</label>
                                                    <input class="form-control bord" id="inputLocation" type="password" value="123" required>
                                                </div>
                                            </div>
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (DNI)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputDNI">DNI</label>
                                                    <input class="form-control bord" id="inputDNI" type="text" value="70370747" required>
                                                </div>
                                                <!-- Form Group (cargo)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputCargo">Cargo</label>
                                                    <input class="form-control" id="inputCargo" type="text" style="cursor: not-allowed;" value="Administrador" readonly>
                                                </div>

                                                <!-- <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                                                    <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="name@example.com"> -->
                                            </div>
                                            <!-- Form Row-->
                                            <div class="row gx-3 mb-3">
                                                <!-- Form Group (telefono)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputPhone">Telefono</label>
                                                    <input class="form-control bord" id="inputPhone" type="text" value="973457436">
                                                </div>
                                                <!-- Form Group (correo)-->
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputBirthday">Correo</label>
                                                    <input class="form-control bord" id="inputBirthday" type="email" value="a@hotmail.com">
                                                </div>

                                            </div>
                                            <!-- Save changes button-->
                                            <!-- <button class="btn1 btn-primary" type="button">Save changes</button> -->
                                            <div class="hola arreglar">
                                                <button class="btn btn-primary" type="submit">Actualizar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- <div class="card-body text-center">
                                                            <button class="btn1 btn-primary" type="button">Save changes</button>
                                                        </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
<?php
    include 'template/footer.php';
?>