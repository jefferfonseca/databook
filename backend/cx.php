<?php
// localhost
$host = 'localhost';
$dbname = 'databook';
$username = 'root';
$password = '';

// remote
// $host = 'localhost';
// $dbname = 'ingjefer_databook';
// $username = 'ingjefer_mari';
// $password = 'P.5dxU:S7|{;';


try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
