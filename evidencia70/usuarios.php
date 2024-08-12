<?php
$servername = "localhost";
$username = "root";
$password = "1064117731";
$dbname = "ev67";

// Creo conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificamos la  conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usua_usua = $_POST['usua_usua'];
    $cont_usua = password_hash($_POST['cont_usua'], PASSWORD_BCRYPT);
    $corr_usua = $_POST['corr_usua'];
    $nomb_usua = $_POST['nomb_usua'];
    $apel_usua = $_POST['apel_usua'];
    $dire_usua = $_POST['dire_usua'];
    $tele_usua = $_POST['tele_usua'];

    // Inserto datos
    $sql = "INSERT INTO usuarios (usua_usua, cont_usua, corr_usua, nomb_usua, apel_usua, dire_usua, tele_usua) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $usua_usua, $cont_usua, $corr_usua, $nomb_usua, $apel_usua, $dire_usua, $tele_usua);

    if ($stmt->execute()) {
        echo "Usuario creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>usuarios jaguashop</title>
    <link rel="stylesheet" type="text/css" href="css/ev67.css">
</head>
<body>

    <nav> <a href="login.php"> <button>Back</button></a> </nav>

    <div class="center-content">
        <h1>Jaguashop</h1>
        <img src="img/imglogo.jpeg" alt="logo jagua shop" width="200" height="220">
        <h2>Registrate y haz parte de nuestros usuarios.</h2>
        <h4>registro de nuevo usuario</h4>
    </div>

    <div class="center-content">
        <form action="usuarios.php" method="POST">
            <input type="text" id="usua_usua" name="usua_usua" placeholder="NOMBRE DE USUARIO" required><br><br>
            <input type="password" id="cont_usua" name="cont_usua" placeholder="CONTRASEÑA" required><br><br>
            <input type="email" id="corr_usua" name="corr_usua" placeholder="CORREO ELECTRONICO" required><br><br>
            <input type="text" id="nomb_usua" name="nomb_usua" placeholder="NOMBRE" required><br><br>
            <input type="text" id="apel_usua" name="apel_usua" placeholder="APELLIDOS" required><br><br>
            <input type="text" id="dire_usua" name="dire_usua" placeholder="DIRECCIÓN" required><br><br>
            <input type="text" id="tele_usua" name="tele_usua" placeholder="TELÉFONO" required><br><br>
            <input type="submit" value="ENVIAR">
        </form>
    </div>
</body>
</html>
