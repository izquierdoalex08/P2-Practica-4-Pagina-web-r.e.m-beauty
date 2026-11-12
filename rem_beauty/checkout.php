<?php
require_once "auth.php";

$carrito = $_SESSION["carrito"] ?? [];
if (empty($carrito) && $_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

// Calcular Totales
$subtotal = 0;
$total_items = 0;
foreach ($carrito as $item) {
    $subtotal += ($item["precio"] * $item["cantidad"]);
    $total_items += $item["cantidad"];
}

// Validación de Recompensas ($70 Regalo, $150 Envío)
$aplica_regalo = ($subtotal >= 70);
$envio = ($subtotal >= 150 || $subtotal == 0) ? 0 : 10.00;
$total = $subtotal + $envio;

$mensaje_exito = false;

// PROCESAR LA COMPRA AL ENVIAR FORMULARIO
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["realizar_pedido"])) {
    $email = trim($_POST["email"] ?? "");
    $nombre = trim($_POST["nombre"] ?? "") . " " . trim($_POST["apellido"] ?? "");
    $direccion = trim($_POST["direccion"] ?? "") . " " . trim($_POST["apartamento"] ?? "");
    $ciudad = trim($_POST["ciudad"] ?? "");
    $estado = trim($_POST["estado"] ?? "");
    $codigo_postal = trim($_POST["codigo_postal"] ?? "");
    $pais = trim($_POST["pais"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");
    
    // Capturar regalo seleccionado (si aplica)
    $regalo_seleccionado = $_POST["regalo_elegido"] ?? "";
    if ($aplica_regalo && !empty($regalo_seleccionado)) {
        $carrito[] = [
            "nombre" => "REGALO: " . $regalo_seleccionado,
            "precio" => 0.00,
            "imagen" => "",
            "cantidad" => 1
        ];
    }
    
    // Convertir lista de productos a JSON para almacenar
    $productos_json = json_encode($carrito, JSON_UNESCAPED_UNICODE);

    // Insertar pedido en la base de datos si existe conexión ($conexion definida en auth.php)
    if (isset($conexion)) {
        $stmt = $conexion->prepare("INSERT INTO pedidos (nombre_cliente, email, direccion, ciudad, estado, codigo_postal, pais, telefono, total, productos_json) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $email, $direccion, $ciudad, $estado, $codigo_postal, $pais, $telefono, $total, $productos_json]);
    }

    // Vaciar el carrito y marcar éxito
    $_SESSION["carrito"] = [];
    $mensaje_exito = true;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>r.e.m. beauty — Finalizar Compra</title>
    <style>
        * { box-sizing: border-box; }
        body { 
            margin: 0; 
            font-family: Arial, sans-serif; 
            color: #252536; 
            background: #fff;
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes modalSlideUp {
            from { opacity: 0; transform: translateY(20px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .checkout-header { text-align: center; padding: 25px 0; border-bottom: 1px solid #eee; }
        .checkout-header .logo { font-size: 26px; font-weight: 800; letter-spacing: -1.5px; text-decoration: none; color: inherit; display: inline-block; }

        /* GRID PRINCIPAL AMPLIADO A 3 COLUMNAS */
        .checkout-container { 
            display: grid; 
            grid-template-columns: minmax(0, 1.2fr) minmax(280px, 0.9fr) minmax(260px, 0.8fr); 
            gap: 28px; 
            max-width: 1280px; 
            margin: 0 auto; 
            padding: 0 24px; 
            min-height: 80vh; 
        }
        
        .main-content { padding: 40px 0; }
        .sidebar-content { 
            padding: 30px 22px; 
            background: #f7f8fb; 
            border-radius: 12px; 
            margin: 35px 0; 
            height: fit-content;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        /* COLUMNA DE REGALOS (DERECHA) */
        .gifts-sidebar {
            padding: 30px 18px;
            margin: 35px 0;
            height: fit-content;
            background: #fff;
            border: 1px solid #e8ecf2;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        h2 { font-size: 18px; font-weight: 600; margin: 25px 0 15px; color: #252536; }
        h2:first-child { margin-top: 0; }
        .form-group { margin-bottom: 12px; min-width: 0; }
        .form-row { display: flex; gap: 12px; }
        .form-row .form-group { flex: 1; }

        input[type="text"], input[type="email"], input[type="tel"] {
            width: 100%; min-width: 0; padding: 13px 14px; border: 1px solid #d5d8e0; border-radius: 7px;
            font-size: 13px; color: #333; outline: none; transition: border .2s, box-shadow .2s; background: #fff;
        }
        input:focus { border-color: #8da7c6; box-shadow: 0 0 0 3px rgba(191,208,228,.25); }

        .checkbox-label { font-size: 12px; color: #555; display: flex; align-items: center; gap: 8px; margin-top: 8px; cursor: pointer; }
        
        .payment-box { 
            border: 1px solid #d5d8e0; 
            border-radius: 10px; 
            background: #fff; 
            overflow: hidden; 
            margin-top: 15px; 
            box-shadow: 0 5px 18px rgba(40,50,70,.04);
        }
        .payment-header { padding: 16px; background: #f2f5fa; border-bottom: 1px solid #d5d8e0; font-weight: 600; font-size: 14px; display: flex; justify-content: space-between; align-items: center; gap: 10px; }
        .card-types { font-size: 11px; color: #6d7f99; font-weight: 500; }
        .payment-body { padding: 18px; }

        .btn-submit { 
            width: 100%; 
            background: #bfd0e4; 
            color: #222; 
            border: none; 
            padding: 16px; 
            border-radius: 25px; 
            font-weight: 700; 
            font-size: 13px; 
            letter-spacing: .5px; 
            cursor: pointer; 
            margin-top: 25px; 
            transition: background .2s, transform .2s; 
        }
        .btn-submit:hover { background: #a8bfd9; transform: translateY(-1px); }

        /* RESUMEN DE COMPRA */
        .summary-heading { font-size: 17px; font-weight: 600; margin: 0 0 22px; text-align: center; }
        .summary-item { display: flex; align-items: center; justify-content: center; gap: 12px; margin: 0 auto 15px; max-width: 390px; padding-bottom: 15px; border-bottom: 1px solid #e5e8ef; }
        .summary-img-wrap { position: relative; flex: 0 0 60px; width: 60px; height: 60px; background: #e9edf3; border-radius: 8px; }
        .summary-img-wrap img { width: 100%; height: 100%; object-fit: contain; border-radius: 8px; }
        .summary-badge { position: absolute; top: -5px; right: -5px; background: #7189a8; color: #fff; font-size: 10px; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; }
        .summary-details { flex: 1; text-align: left; }
        .summary-title { font-size: 12px; font-weight: 600; margin: 0 0 3px; }
        .summary-price { font-size: 12px; font-weight: 600; white-space: nowrap; }
        .summary-totals { margin: 18px auto 0; border-top: 1px solid #e1e5ec; padding-top: 14px; }
        .summary-row { display: flex; justify-content: space-between; gap: 12px; font-size: 13px; margin-bottom: 10px; color: #555; }
        .summary-total { display: flex; justify-content: space-between; gap: 12px; font-size: 16px; font-weight: 700; color: #252536; border-top: 1px solid #d8dee8; padding-top: 14px; margin-top: 14px; }

        /* ESTILOS DE TARJETAS DE REGALO */
        .gift-title { font-size: 15px; font-weight: 600; margin: 0 0 6px; text-align: center; color: #252536; }
        .gift-subtitle { font-size: 11px; color: #666; text-align: center; margin: 0 0 16px; display: block; }
        .gift-grid { display: flex; flex-direction: column; gap: 10px; }
        
        .gift-card-option {
            position: relative;
            cursor: pointer;
            display: block;
        }

        .gift-card-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .gift-card-content {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border: 1.5px solid #e1e5ec;
            border-radius: 8px;
            background: #fff;
            transition: all 0.2s ease;
        }

        .gift-card-content img {
            width: 42px;
            height: 42px;
            object-fit: contain;
            background: #f4f6fa;
            border-radius: 6px;
            flex-shrink: 0;
        }

        .gift-card-info {
            flex: 1;
        }

        .gift-card-info span {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: #252536;
            line-height: 1.2;
        }

        .gift-card-info small {
            font-size: 10px;
            color: #385d82;
            font-weight: bold;
        }

        /* Efecto al seleccionar */
        .gift-card-option input[type="radio"]:checked + .gift-card-content {
            border-color: #7896bc;
            background: #f2f6fa;
            box-shadow: 0 2px 8px rgba(120, 150, 188, 0.2);
        }

        .gift-card-option:hover .gift-card-content {
            border-color: #a8bfd9;
        }

        .gift-locked-box {
            background: #f8f9fa;
            border: 1px dashed #ccc;
            padding: 15px 12px;
            border-radius: 8px;
            text-align: center;
            font-size: 11px;
            color: #777;
            line-height: 1.4;
        }

        .success-overlay { position: fixed; inset: 0; width: 100%; height: 100%; background: rgba(35,43,58,.55); display: flex; align-items: center; justify-content: center; z-index: 1000; padding: 20px; backdrop-filter: blur(3px); }
        .success-modal { background: #fff; padding: 42px 35px; border-radius: 16px; text-align: center; max-width: 450px; width: 100%; box-shadow: 0 14px 40px rgba(0,0,0,.2); animation: modalSlideUp 0.35s ease-out; }
        .success-mark { width: 52px; height: 52px; border: 2px solid #9bb5d6; background: #f2f6fa; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; color: #43638a; font-size: 26px; font-weight: bold; }
        .success-modal h3 { font-size: 23px; font-weight: 600; margin: 0 0 10px; color: #252536; }
        .success-modal p { font-size: 14px; color: #666; line-height: 1.6; margin-bottom: 25px; }
        .btn-success { background: #bfd0e4; color: #222; text-decoration: none; padding: 14px 32px; border-radius: 25px; font-weight: 700; font-size: 12px; letter-spacing: .4px; display: inline-block; }

        @media(max-width: 980px) {
            .checkout-container { grid-template-columns: 1fr; gap: 0; padding: 0 20px; }
            .main-content { padding: 30px 0 10px; }
            .sidebar-content, .gifts-sidebar { margin: 15px 0; padding: 22px 18px; }
        }
    </style>
</head>
<body>

    <header class="checkout-header">
        <a class="logo" href="index.php">r.e.m.<small style="font-size: 13px;"> beauty</small></a>
    </header>

    <?php if ($mensaje_exito): ?>
        <div class="success-overlay">
            <div class="success-modal">
                <div class="success-mark">✓</div>
                <h3>¡Gracias por tu compra!</h3>
                <p>Tu pedido se registró correctamente. Gracias por elegir r.e.m. beauty. La información de tu compra estará disponible en tu cuenta.</p>
                <a href="index.php" class="btn-success">VOLVER A LA TIENDA</a>
            </div>
        </div>
    <?php endif; ?>

    <form method="post" autocomplete="off">
        <div class="checkout-container">
            <!-- FORMULARIO DE PAGO Y DATOS -->
            <main class="main-content">
                <!-- Contacto -->
                <h2>Contacto</h2>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Correo electrónico" required>
                </div>
                <label class="checkbox-label">
                    <input type="checkbox" checked> Enviarme noticias y ofertas por correo electrónico
                </label>

                <!-- Entrega -->
                <h2>Entrega</h2>
                <div class="form-group">
                    <input type="text" name="pais" placeholder="País / Región" value="México" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="apellido" placeholder="Apellidos" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="direccion" placeholder="Dirección (calle y número)" required>
                </div>
                <div class="form-group">
                    <input type="text" name="apartamento" placeholder="Casa, apartamento, suite, etc. (opcional)">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <input type="text" name="ciudad" placeholder="Ciudad" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="estado" placeholder="Estado" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="codigo_postal" placeholder="Código postal" required>
                    </div>
                </div>
                <div class="form-group">
                    <input type="tel" name="telefono" placeholder="Teléfono (opcional)">
                </div>

                <!-- Método de Pago -->
                <h2>Pago</h2>
                
                <div class="payment-box">
                    <div class="payment-header">
                        <span>Tarjeta de débito/crédito</span>
                        <span class="card-types">VISA&nbsp;&nbsp; MASTERCARD&nbsp;&nbsp; AMEX</span>
                    </div>
                    <div class="payment-body">
                        <div class="form-group">
                            <input type="text" id="num_tarjeta" placeholder="Número de tarjeta (XXXX XXXX XXXX XXXX)" required maxlength="19" autocomplete="off" inputmode="numeric">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <input type="text" id="fecha_expiracion" placeholder="Fecha de vencimiento (MM/AA)" required maxlength="5" inputmode="numeric" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Código de seguridad (CVV)" required maxlength="4" inputmode="numeric" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Nombre en la tarjeta" required autocomplete="off">
                        </div>
                    </div>
                </div>

                <button type="submit" name="realizar_pedido" class="btn-submit">PAGAR AHORA</button>
            </main>

            <!-- RESUMEN DE COMPRA -->
            <aside class="sidebar-content">
                <h2 class="summary-heading">Resumen de tu compra</h2>
                <?php foreach ($carrito as $item): ?>
                    <div class="summary-item">
                        <div class="summary-img-wrap">
                            <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="">
                            <span class="summary-badge"><?php echo $item['cantidad']; ?></span>
                        </div>
                        <div class="summary-details">
                            <div class="summary-title"><?php echo htmlspecialchars($item['nombre']); ?></div>
                        </div>
                        <div class="summary-price">$<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></div>
                    </div>
                <?php endforeach; ?>

                <div class="summary-totals">
                    <div class="summary-row">
                        <span>Subtotal · <?php echo $total_items; ?> productos</span>
                        <span>$<?php echo number_format($subtotal, 2); ?> USD</span>
                    </div>
                    <div class="summary-row">
                        <span>Envío</span>
                        <span><?php echo $envio == 0 ? "Gratis" : "$" . number_format($envio, 2) . " USD"; ?></span>
                    </div>
                    <div class="summary-total">
                        <span>Total</span>
                        <span>USD $<?php echo number_format($total, 2); ?></span>
                    </div>
                </div>
            </aside>
            <aside class="gifts-sidebar">
                <h3 class="gift-title">Elige tu Regalo</h3>
                
                <?php if ($aplica_regalo): ?>
                    <span class="gift-subtitle">¡Alcanzaste los $70 USD! Selecciona 1 opción:</span>
                    <div class="gift-grid">
                        <!-- OPCIÓN 1 -->
                        <label class="gift-card-option">
                            <input type="radio" name="regalo_elegido" value="essential drip mini lip oil" checked>
                            <div class="gift-card-content">
                                <img src="https://rembeauty.com/cdn/shop/files/mini_lip_oil_01.png?v=1762197975&width=611&height=713&crop=center" alt="Gift 1">
                                <div class="gift-card-info">
                                    <span>essential drip mini lip oil</span>
                                    <small>GRATIS</small>
                                </div>
                            </div>
                        </label>

                        <!-- OPCIÓN 2 -->
                        <label class="gift-card-option">
                            <input type="radio" name="regalo_elegido" value="mini treble maker 3-in-1 mascara">
                            <div class="gift-card-content">
                                <img src="https://rembeauty.com/cdn/shop/files/01_treblemaker_1.png?v=1786388212&width=611&height=713&crop=center" alt="Gift 2">
                                <div class="gift-card-info">
                                    <span>mini treble maker 3-in-1 mascara</span>
                                    <small>GRATIS</small>
                                </div>
                            </div>
                        </label>

                        <!-- OPCIÓN 3 -->
                        <label class="gift-card-option">
                            <input type="radio" name="regalo_elegido" value="mist thing mini calming face mist">
                            <div class="gift-card-content">
                                <img src="https://rembeauty.com/cdn/shop/files/REM_MistThing_MiniCalmingFaceMist_PDP_Closed.png?v=1762197975&width=611&height=713&crop=center" alt="Gift 3">
                                <div class="gift-card-info">
                                    <span>mist thing mini calming face mist</span>
                                    <small>GRATIS</small>
                                </div>
                            </div>
                        </label>

                        <!-- OPCIÓN 4 -->
                        <label class="gift-card-option">
                            <input type="radio" name="regalo_elegido" value="full night's sleep cooling blurring undereye balm">
                            <div class="gift-card-content">
                                <img src="https://rembeauty.com/cdn/shop/products/REM_Ch2_UnderEyeBlur_PDP_Closed_right.png?v=1762197920&width=611&height=713&crop=center" alt="Gift 4">
                                <div class="gift-card-info">
                                    <span>full night's sleep cooling blurring undereye balm</span>
                                    <small>GRATIS</small>
                                </div>
                            </div>
                        </label>
                    </div>
                <?php else: ?>
                    <div class="gift-locked-box">
                        <strong>Regalo bloqueado</strong><br><br>
                        Agrega $<?php echo number_format(70 - $subtotal, 2); ?> USD más a tu carrito para desbloquear la selección de regalos.
                    </div>
                <?php endif; ?>
            </aside>
        </div>
    </form>

<script>
// Formateo dinámico del número de tarjeta
const tarjetaInput = document.getElementById("num_tarjeta");
if (tarjetaInput) {
    tarjetaInput.addEventListener("input", function () {
        let val = this.value.replace(/\D/g, "").slice(0, 16);
        this.value = val.replace(/(.{4})/g, "$1 ").trim();
    });
}

// Formateo de fecha de vencimiento (MM/AA)
const vencimientoInput = document.getElementById("fecha_expiracion");
if (vencimientoInput) {
    vencimientoInput.addEventListener("input", function () {
        let val = this.value.replace(/\D/g, "").slice(0, 4);
        if (val.length > 2) {
            val = val.slice(0, 2) + "/" + val.slice(2);
        }
        this.value = val;
    });
}
</script>
</body>
</html>