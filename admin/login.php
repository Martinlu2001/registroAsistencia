<?php
    session_start();
    $error = isset($_SESSION["error"]) ? $_SESSION["error"] : "";
    unset($_SESSION["error"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"  crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <img src="../images/prcesamiento.png" alt="image" width="58px" height="59px">
                                    <!-- <h3 class="text-center font-weight-light my-4">[nombre de la empresa or image]</h3> -->
                                    <h3 class="text-center font-weight-light my-4">Iniciar sesión</h3>
                                </div>
                                <div class="card-body">
                                    <form method='POST' action="./Controller/LoginAdminController.php">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="usuario" type="text" required />
                                            <label for="inputEmail">Usuario*</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="password" type="password" required />
                                            <label for="inputPassword">Contraseña*</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                                            <button type=submit class="btn btn-primary">Ingresar</button>
                                        </div>                                      
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="js/scripts.js"></script>
</body>

</html>