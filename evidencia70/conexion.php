<?php
// esta sera la conexion, pero no establecere desde aqui, conexion.php

$servername = "localhost";
$username = "root"; 
$password = "1064117731"; 
$dbname = "ev67"; 

// aqui creo la  conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// verifico
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// desde aqui establesco los utf
$conn->set_charset("utf8");
?>
