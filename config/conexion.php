<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "registroAsistencia";
    $mysqli = new mysqli($host, $user, $password , $database );

    /*$passhash = password_hash('70370747', PASSWORD_DEFAULT);
    $sql1 = "INSERT INTO admin(dniAdmin, passwordAdmin, nameAdmin, apelliAdmin, celAdmin, sexAdmin) VALUES ('70370747', '$passhash', 'fabricio', 'luna', '973457436', 'm')";
    $result = mysqli_query($mysqli,$sql1);*/

    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }
?>