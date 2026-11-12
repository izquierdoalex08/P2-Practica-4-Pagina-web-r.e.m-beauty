<?php
$carrito = $_SESSION["carrito"] ?? [];
$total_items = 0;
$subtotal = 0;

foreach ($carrito as $item) {
    $total_items += $item["cantidad"];
    $subtotal += ($item["precio"] * $item["cantidad"]);
}

$abrir_carrito = isset($_GET["ver_carrito"]) && $_GET["ver_carrito"] == 1;
$url_actual = strtok($_SERVER["REQUEST_URI"], '?');

$meta_regalo = 70;
$meta_envio = 150;

$tiene_regalo = $subtotal >= $meta_regalo;
$tiene_envio = $subtotal >= $meta_envio;

if ($tiene_envio) {
    $mensaje_top = "¡felicidades! ¡tienes envío gratis!";
    $porcentaje_barra = 100;
} elseif ($tiene_regalo) {
    $falta_envio = $meta_envio - $subtotal;
    $mensaje_top = "agrega $" . number_format($falta_envio, 2) . " USD más para calificar para envío gratis";
    $porcentaje_barra = 50 + (($subtotal - $meta_regalo) / ($meta_envio - $meta_regalo)) * 50;
} else {
    $falta_regalo = $meta_regalo - $subtotal;
    $mensaje_top = "agrega $" . number_format($falta_regalo, 2) . " USD más para calificar para un regalo gratis";
    $porcentaje_barra = ($subtotal / $meta_regalo) * 50;
}
?>

<style>
    .cart-icon-btn {
        position: relative;
        background: #bfd0e4;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        text-decoration: none;
        color: #252536;
        margin-left: 6px;
        vertical-align: middle;
        margin-top: -6px;
        margin-bottom: -6px;
        <?php if ($abrir_carrito): ?>
            animation: popAnim 0.4s ease;
        <?php endif; ?>
    }
    .cart-icon-btn:hover { background: #a8bfd9; }
    .cart-dot {
        position: absolute;
        top: 2px;
        right: 2px;
        background: #385d82;
        width: 9px;
        height: 9px;
        border-radius: 50%;
        border: 2px solid #fff;
    }

    @keyframes popAnim {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .cart-overlay {
        display: <?php echo $abrir_carrito ? 'block' : 'none'; ?>;
        position: fixed;
        top: 0; left: 0; width: 100vw; height: 100vh;
        background: rgba(0, 0, 0, 0.4);
        z-index: 998;
    }

    .cart-drawer {
        position: fixed;
        top: 0; right: 0;
        width: 100%; max-width: 400px; height: 100vh;
        background: #fff;
        z-index: 999;
        box-shadow: -4px 0 20px rgba(0,0,0,0.15);
        display: <?php echo $abrir_carrito ? 'flex' : 'none'; ?>;
        flex-direction: column;
        font-family: Arial, sans-serif;
    }

    .cart-header {
        padding: 20px 24px 15px;
        display: flex; align-items: center; justify-content: space-between;
        border-bottom: 1px solid #eee;
    }
    .cart-header h2 { margin: 0; font-size: 20px; font-weight: 500; }
    .cart-header small { font-size: 13px; color: #666; font-weight: normal; }
    .close-cart { text-decoration: none; font-size: 24px; color: #666; font-weight: bold; line-height: 1; }

    .cart-promo-banner {
        padding: 15px 24px; background: #fff; font-size: 13px; text-align: left; border-bottom: 1px solid #eee;
    }
    .cart-promo-title {
        font-size: 13px; font-weight: 600; color: #252536; margin-bottom: 10px; display: block;
    }
    .promo-progress-container {
        position: relative; width: 100%; height: 4px; background: #e5e5e5; border-radius: 2px; margin: 12px 0 16px;
    }
    .promo-progress-fill {
        height: 100%; background: #252536; border-radius: 2px; transition: width 0.3s ease;
    }
    .promo-pin {
        position: absolute; top: -3px; left: 50%; width: 2px; height: 10px; background: #999; transform: translateX(-50%);
    }

    .promo-labels { display: flex; justify-content: space-around; font-size: 12px; color: #555; align-items: center; }
    .promo-step { display: inline-flex; align-items: center; gap: 5px; }
    .check-circle {
        width: 18px; height: 18px; border-radius: 50%; background: #d0def0; color: #252536;
        font-size: 11px; display: inline-flex; align-items: center; justify-content: center; font-weight: bold;
    }
    .check-circle.completed { background: #b0c8e4; }

    .gift-unlock-box { background: #f2f5fa; padding: 14px; border-radius: 6px; margin-top: 14px; text-align: left; }
    .gift-unlock-box h4 { margin: 0 0 3px; font-size: 13px; font-weight: 700; color: #252536; }
    .gift-unlock-box p { margin: 0; font-size: 12px; color: #666; }

    .cart-body { flex: 1; overflow-y: auto; padding: 20px 24px; }
    .cart-item { display: flex; gap: 15px; margin-bottom: 18px; padding-bottom: 18px; border-bottom: 1px solid #f0f0f0; }
    .cart-item-img { width: 75px; height: 75px; background: #f4f4f6; object-fit: contain; border-radius: 6px; }
    .cart-item-info { flex: 1; }
    .cart-item-title { font-size: 13px; font-weight: 600; margin: 0 0 4px; }
    .cart-item-price { font-size: 13px; font-weight: 600; float: right; }

    .cart-item-controls { display: flex; align-items: center; justify-content: space-between; margin-top: 10px; }
    .qty-picker { display: flex; align-items: center; border: 1px solid #d5d8e0; border-radius: 20px; padding: 2px 8px; }
    .qty-picker a { text-decoration: none; color: #252536; font-weight: bold; padding: 2px 6px; font-size: 13px; }
    .qty-picker span { font-size: 12px; font-weight: 600; min-width: 18px; text-align: center; }
    .btn-remove { color: #777; font-size: 11px; text-decoration: underline; }

    .team-note { background: #f2f5fa; padding: 12px; border-radius: 8px; font-size: 11px; color: #555; line-height: 1.4; margin-top: 10px; }
    .team-note strong { color: #252536; display: block; margin-bottom: 3px; }

    .cart-footer { padding: 20px 24px; border-top: 1px solid #eee; background: #fff; }
    .subtotal-row { display: flex; justify-content: space-between; font-size: 15px; font-weight: 600; margin-bottom: 4px; }
    .tax-shipping-note { font-size: 11px; color: #777; margin-bottom: 12px; }
    .btn-checkout {
        display: block; width: 100%; background: #bfd0e4; color: #222; text-align: center;
        text-decoration: none; border-radius: 25px; padding: 12px 0; font-weight: 700; font-size: 13px;
    }
    .btn-checkout:hover { background: #a8bfd9; }
</style>

<a href="<?php echo $url_actual; ?>" class="cart-overlay"></a>

<aside class="cart-drawer">
    <div class="cart-header">
        <h2>carrito <small>(<?php echo $total_items; ?> <?php echo $total_items == 1 ? 'producto' : 'productos'; ?>)</small></h2>
        <a href="<?php echo $url_actual; ?>" class="close-cart">&times;</a>
    </div>

    <?php if (!empty($carrito)): ?>
        <div class="cart-promo-banner">
            <span class="cart-promo-title"><?php echo $mensaje_top; ?></span>
            
            <div class="promo-progress-container">
                <div class="promo-progress-fill" style="width: <?php echo min(100, max(0, $porcentaje_barra)); ?>%;"></div>
                <div class="promo-pin"></div>
            </div>

            <div class="promo-labels">
                <span class="promo-step">
                    regalo gratis 
                    <span class="check-circle <?php echo $tiene_regalo ? 'completed' : ''; ?>">✓</span>
                </span>
                <span class="promo-step">
                    envío gratis 
                    <span class="check-circle <?php echo $tiene_envio ? 'completed' : ''; ?>">
                        <?php echo $tiene_envio ? '✓' : '🚚'; ?>
                    </span>
                </span>
            </div>

            <?php if ($tiene_regalo): ?>
                <div class="gift-unlock-box">
                    <h4>desbloquea tu regalo</h4>
                    <p>selecciona tu regalo al finalizar la compra</p>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="cart-body">
        <?php if (empty($carrito)): ?>
            <p style="text-align: center; color: #777; margin-top: 40px; font-size: 14px;">Tu carrito está vacío.</p>
        <?php else: ?>
            <?php foreach ($carrito as $i => $item): ?>
                <div class="cart-item">
                    <img class="cart-item-img" src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="">
                    <div class="cart-item-info">
                        <span class="cart-item-price">$<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></span>
                        <h4 class="cart-item-title"><?php echo htmlspecialchars($item['nombre']); ?></h4>
                        <div class="cart-item-controls">
                            <div class="qty-picker">
                                <a href="?accion_carrito=restar&id_item=<?php echo $i; ?>">-</a>
                                <span><?php echo $item['cantidad']; ?></span>
                                <a href="?accion_carrito=sumar&id_item=<?php echo $i; ?>">+</a>
                            </div>
                            <a href="?accion_carrito=eliminar&id_item=<?php echo $i; ?>" class="btn-remove">eliminar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="team-note">
                <strong>una nota del equipo r.e.m.</strong>
                nuestros productos facilitan la expresión de tu creatividad—multitarea, híbridos con infusión para el cuidado de la piel y fórmulas hipersensoriales que combinan el arte y el juego diario. vegano y libre de crueldad, siempre.
            </div>
        <?php endif; ?>
    </div>

    <div class="cart-footer">
        <div class="subtotal-row">
            <span>subtotal</span>
            <span>$<?php echo number_format($subtotal, 2); ?> USD</span>
        </div>
        <div class="tax-shipping-note">impuestos y envío calculados al finalizar la compra</div>
        <a href="checkout.php" class="btn-checkout">CHECKOUT</a>
    </div>
</aside>