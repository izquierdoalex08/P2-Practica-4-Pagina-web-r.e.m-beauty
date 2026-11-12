<?php
session_start();
require_once "conexion.php";
$mensajeRegistro = "";
$mensajeLogin = "";

// REGISTRO DE USUARIOS
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["registrar"])) {
    $nombre = trim($_POST["nombre"] ?? "");
    $apellidos = trim($_POST["apellidos"] ?? "");
    $correo = strtolower(trim($_POST["correo"] ?? ""));
    $fecha = $_POST["fecha_nacimiento"] ?? "";
    $telefono = trim($_POST["telefono"] ?? "");
    $contrasena = $_POST["contrasena"] ?? "";

    if ($nombre === "" || $apellidos === "" || !filter_var($correo, FILTER_VALIDATE_EMAIL) || !$fecha || strlen($contrasena) < 8) {
        $mensajeRegistro = "Revisa los campos obligatorios. La contraseña debe tener al menos 8 caracteres.";
    } else {
        $q = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $q->execute([$correo]);
        if ($q->fetch()) {
            $mensajeRegistro = "Este correo ya está registrado. Inicia sesión.";
        } else {
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $q = $conexion->prepare("INSERT INTO usuarios (nombre, apellidos, correo, fecha_nacimiento, telefono, contrasena) VALUES (?, ?, ?, ?, ?, ?)");
            $q->execute([$nombre, $apellidos, $correo, $fecha, $telefono, $hash]);
            $mensajeRegistro = "¡Registro exitoso! Ya puedes iniciar sesión.";
        }
    }
}

// INICIO DE SESIÓN
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["iniciar"])) {
    $correo = strtolower(trim($_POST["correo_login"] ?? ""));
    $contrasena = $_POST["contrasena_login"] ?? "";

    $q = $conexion->prepare("SELECT nombre, apellidos, contrasena FROM usuarios WHERE correo = ? LIMIT 1");
    $q->execute([$correo]); 
    $usuario = $q->fetch();

    if ($usuario && password_verify($contrasena, $usuario["contrasena"])) {
        $_SESSION["usuario"] = $usuario["nombre"] . " " . $usuario["apellidos"];
        // CAMBIO AQUÍ: Redirige a index.php en lugar de inicio.php
        header("Location: index.php"); 
        exit;
    } else {
        $mensajeLogin = "Correo o contraseña incorrectos.";
    }
}

// CERRAR SESIÓN (Opción por parámetro GET)
if (isset($_GET["salir"])) { 
    session_destroy(); 
    // CAMBIO AQUÍ: Redirige a index.php en lugar de inicio.php
    header("Location: index.php"); 
    exit; 
}

if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["agregar_carrito"])) {
    $nombre = $_POST["prod_nombre"] ?? "";
    $precio = floatval($_POST["prod_precio"] ?? 0);
    $imagen = $_POST["prod_imagen"] ?? "";

    if (!empty($nombre)) {
        $encontrado = false;
        foreach ($_SESSION["carrito"] as &$item) {
            if ($item["nombre"] === $nombre) {
                $item["cantidad"]++;
                $encontrado = true;
                break;
            }
        }
        if (!$encontrado) {
            $_SESSION["carrito"][] = [
                "nombre" => $nombre,
                "precio" => $precio,
                "imagen" => $imagen,
                "cantidad" => 1
            ];
        }
    }
    // Redirigir a la misma página manteniendo el carrito abierto
    $url = strtok($_SERVER["REQUEST_URI"], '?');
    header("Location: " . $url . "?ver_carrito=1");
    exit;
}

// Modificar cantidad o eliminar producto
if (isset($_GET["accion_carrito"])) {
    $index = intval($_GET["id_item"] ?? -1);
    $accion = $_GET["accion_carrito"];

    if (isset($_SESSION["carrito"][$index])) {
        if ($accion === "sumar") {
            $_SESSION["carrito"][$index]["cantidad"]++;
        } elseif ($accion === "restar") {
            $_SESSION["carrito"][$index]["cantidad"]--;
            if ($_SESSION["carrito"][$index]["cantidad"] <= 0) {
                array_splice($_SESSION["carrito"], $index, 1);
            }
        } elseif ($accion === "eliminar") {
            array_splice($_SESSION["carrito"], $index, 1);
        }
    }
    $url = strtok($_SERVER["REQUEST_URI"], '?');
    header("Location: " . $url . "?ver_carrito=1");
    exit;
}
?>