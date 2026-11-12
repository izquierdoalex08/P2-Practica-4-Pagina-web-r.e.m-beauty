<?php //Izquierdo Gaytan Alexander 5°J
// Nombre o dirección del servidor donde está la base de datos 
$host = "localhost";

// Nombre exacto de la base de datos a la que nos vamos a conectar
$db   = "rem_beauty";

// Nombre de usuario por defecto en XAMPP para entrar a MySQL
$user = "root";

// Contraseña del usuario en XAMPP (por defecto viene vacía "")
$pass = "";

// Tipo de codificación de texto para que acepte acentos, eñes y emojismujeres sin errores
$charset = "utf8mb4";

// Configuración de opciones especiales para la conexión PDO
$options = [
    // Si ocurre un error, nos avisa lanzando una excepción detallada
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    
    // Devuelve las filas de la base de datos en formato de arreglo fácil de usar en PHP
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    
    // Desactiva la emulación para hacer las consultas a la base de datos más seguras contra ataques
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Bloque "try" para intentar realizar la conexión con los datos de arriba
try {
    // Intenta conectar usando PDO pasando la ruta del servidor, usuario, contraseña y opciones
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);

// Bloque "catch" por si algo falla (por ejemplo, si MySQL en XAMPP está apagado)
} catch (PDOException $e) {
    // Detiene la ejecución de la página y muestra el mensaje de error correspondiente
    die("Error de conexión: " . $e->getMessage());
}
?>