<?php
$servidor="192.168.0.13";
$usuario="x";//usaurio o root con lo que vamos a acceder a la bd isc->privilegios->crear usuario
$pass="hola";
$db= "biblioteca";

$conexion = mysqli_connect($servidor, $usuario, $pass, $db);

if (!$conexion) {
    echo "Error: No se pudo conectar a MySQL." .PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() .PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() .PHP_EOL;
    exit;
}

echo "Éxito: Se realizó una conexión apropiada a MySQL. Ahora la base de datos esta lista para usarse" . PHP_EOL;
echo "Información del host: " . mysqli_get_host_info($conexion) . PHP_EOL;
?>