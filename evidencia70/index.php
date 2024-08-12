<?php
$servername = "localhost";
$username = "root";
$password = "1064117731";
$dbname = "ev67";

// aqui para crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// se verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// star de sesion
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usua_usua = $_POST['usua_usua'];
    $cont_usua = $_POST['cont_usua'];

    // verificamos usuario
    $sql = "SELECT id_usua, cont_usua FROM usuarios WHERE usua_usua = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usua_usua);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usua, $hashed_password);
        $stmt->fetch();

        if (password_verify($cont_usua, $hashed_password)) {
            // aqui se inicia la sesión
            $_SESSION['id_usua'] = $id_usua;
            $_SESSION['usua_usua'] = $usua_usua;
            echo "Logueo exitoso";
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index jaguashop</title>
    <link rel="stylesheet" type="text/css" href="css/ev67.css">
</head>
<body>
    <div class="center-content">
        <h1>Jaguashop</h1>
        <h2>¡Bienvenid@ a nuestra tienda online!</h2>
    </div>

    <div class="center-content">
        <img src="img/imglogo.jpeg" alt="logo jagua shop" width="200" height="205">
        <form action="index.php" method="POST">
            <input type="text" id="usua_usua" name="usua_usua" placeholder="NOMBRE DE USUARIO" required><br><br>
            <input type="password" id="cont_usua" name="cont_usua" placeholder="CONTRASEÑA" required><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
