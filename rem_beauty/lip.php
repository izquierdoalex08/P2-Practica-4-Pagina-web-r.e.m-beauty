<?php require_once "auth.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>r.e.m. beauty — Lip</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; color: #252536; background: #fff; }
        .promo { text-align: center; background: #edf2f8; padding: 10px; font-size: 13px; }
        header { position: sticky; top: 0; z-index: 5; background: #fff; border-bottom: 1px solid #eee; padding: 18px 4%; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
        .logo { font-size: 28px; font-weight: 800; letter-spacing: -2px; cursor: pointer; text-decoration: none; color: inherit; }
        .logo small { font-size: 14px; letter-spacing: 0; }
        .logo span { display: block; font-size: 11px; letter-spacing: 0; }
        nav { display: flex; gap: 22px; flex-wrap: wrap; }
        .nav-label { color: inherit; text-decoration: none; font-size: 14px; }
        .nav-label:hover { color: #7896bc; }
        button, .btn { border: 0; border-radius: 25px; background: #bfd0e4; padding: 12px 22px; cursor: pointer; color: #222; font-weight: 600; display: inline-block; text-decoration: none; }
        button:hover, .btn:hover { background: #a8bfd9; }
        section { padding: 35px 4%; }
        .section-title { display: flex; justify-content: space-between; align-items: flex-end; }
        .section-title h2 { font-weight: 500; text-transform: lowercase; font-size: 28px; margin: 0 0 18px; }
        .products { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 18px; }
        .product { min-width: 0; }
        .photo { position: relative; height: 245px; background: #e9e9eb; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .photo img { width: 100%; height: 100%; object-fit: contain; transition: opacity 0.3s ease; }
        .photo-desc { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(242, 245, 250, 0.95); color: #252536; padding: 18px; font-size: 12px; line-height: 1.5; display: flex; align-items: center; justify-content: center; text-align: center; opacity: 0; transition: opacity 0.3s ease; }
        .product:hover .photo img { opacity: 0.1; }
        .product:hover .photo-desc { opacity: 1; }
        .details { padding: 10px 2px; }
        .rating { font-size: 12px; color: #555; }
        .name { font-weight: 600; font-size: 14px; margin: 5px 0; }
        .price { font-size: 13px; }
        .product button { width: 100%; margin-top: 10px; font-size: 12px; }
        .user-bar { background: #f2f5fa; text-align: right; padding: 8px 4%; font-size: 12px; color: #536e94; }
        .user-bar a { margin-left: 12px; text-decoration: underline; }
        footer { text-align: center; background: #dce6f1; padding: 28px; font-size: 13px; margin-top: 40px; }
        @media(max-width:850px) { header { align-items: flex-start; flex-direction: column; } .products { grid-template-columns: repeat(2, minmax(0, 1fr)); } .photo { height: 210px; } }
        @media(max-width:460px) { nav { gap: 12px; font-size: 13px; } .products { gap: 10px; } .photo { height: 160px; } }
    </style>
</head>
<body>
    <div class="promo">✨ regalo especial en compras seleccionadas ✨</div>
    <header>
        <a class="logo" href="index.php">r.e.m.<small> beauty</small><span>inspirado en tu brillo</span></a>
        <nav>
            <a class="nav-label" href="new.php">new</a>
            <a class="nav-label" href="best.php">best sellers</a>
            <a class="nav-label" href="eyes.php">eyes</a>
            <a class="nav-label" href="lip.php">lip</a>
            <a class="nav-label" href="face.php">face</a>
            <a class="nav-label" href="cuenta.php">cuenta</a>

            <a href="?ver_carrito=1" class="cart-icon-btn" title="Ver carrito">
                <svg viewBox="0 0 24 24" width="20" height="20" stroke="#252536" stroke-width="1.8" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                <?php if (!empty($_SESSION["carrito"])): ?>
                    <span class="cart-dot"></span>
                <?php endif; ?>
            </a>
        </nav>
    </header>

    <?php if (!empty($_SESSION["usuario"])): ?>
        <div class="user-bar">Hola, <?php echo htmlspecialchars($_SESSION["usuario"], ENT_QUOTES, "UTF-8"); ?> · ¡qué gusto tenerte aquí! <a href="salir.php">Cerrar sesión</a></div>
    <?php endif; ?>

    <main>
        <section id="sec-lip">
            <div class="section-title">
                <h2>lip</h2>
                <span>✦ colección ✦</span>
            </div>
            <div class="products">
                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_lipmask.png?v=1790102322&width=433&height=506&crop=center" alt="satin slumber lip mask">
                        <div class="photo-desc">Una mascarilla labial sedosa y ligera con ácido láctico, tripéptido y manteca de karité que hidrata, suaviza y acondiciona los labios para una comodidad duradera, completa con un dije personalizado que se engancha al brillo.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>5.0</span></div>
                        <div class="name">satin slumber lip mask</div>
                        <div class="price">$26 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="satin slumber lip mask">
                            <input type="hidden" name="prod_precio" value="26.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_lipmask.png?v=1790102322&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_glossybalmset_488b29e6-eca2-4c98-b4f7-abe11703017e.png?v=1788908350&width=433&height=506&crop=center" alt="the gloss barre mini glossy balm set">
                        <div class="photo-desc">Brillo radiante e hidratación duradera. Un trío de bálsamos nutritivos de edición limitada con brillo, que incluye tres nuevos tonos festivos que brindan un color sutil, una sensación sedosa y unos labios más suaves y tersos.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.8</span></div>
                        <div class="name">the gloss barre mini glossy balm set</div>
                        <div class="price">$26 USD</div>
                       <form method="post">
                            <input type="hidden" name="prod_nombre" value="the gloss barre mini glossy balm set">
                            <input type="hidden" name="prod_precio" value="26.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_glossybalmset_488b29e6-eca2-4c98-b4f7-abe11703017e.png?v=1788908350&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_ruby_red_with_cap.png?v=1780691320&width=433&height=506&crop=center" alt="blur butter lip palm">
                        <div class="photo-desc">Un bálsamo labial nutritivo que se funde con suavidad y deja un acabado mate ligero y difuminado. Color cremoso y modulable que no reseca los labios.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.9</span></div>
                        <div class="name">blur butter lip palm</div>
                        <div class="price">$24 USD</div>
                       <form method="post">
                            <input type="hidden" name="prod_nombre" value="blur butter lip palm">
                            <input type="hidden" name="prod_precio" value="24.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_ruby_red_with_cap.png?v=1780691320&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_6d6c07d1-0723-4c55-a57b-d9c377ad73fc.png?v=1762197963&width=1222&height=1426&crop=center" alt="essential drip glossy balm">
                        <div class="photo-desc">Un tratamiento nutritivo para los labios que también funciona como un brillo labial con color de alto brillo.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.8</span></div>
                        <div class="name">essential drip glossy balm</div>
                        <div class="price">$20 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="essential drip glossy balm">
                            <input type="hidden" name="prod_precio" value="20.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_6d6c07d1-0723-4c55-a57b-d9c377ad73fc.png?v=1762197963&width=1222&height=1426&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_plumping-lip-gloss-on-your-collar-shimmer-rem-fembot.png?v=1762198052&width=433&height=506&crop=center" alt="on your collar plumping lip gloss">
                        <div class="photo-desc">Este brillo labial de alto brillo da volumen a los labios al instante, proporcionando una agradable sensación de calor que los deja hidratados, más suaves, lisos y visiblemente más voluminosos.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.7</span></div>
                        <div class="name">on your collar plumping lip gloss</div>
                        <div class="price">$22 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="on your collar plumping lip gloss">
                            <input type="hidden" name="prod_precio" value="22.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_plumping-lip-gloss-on-your-collar-shimmer-rem-fembot.png?v=1762198052&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_da39ef0a-78c2-476a-985d-f05e19f3c6c8.png?v=1755286904&width=433&height=506&crop=center" alt="practically permanent lip stain marker">
                        <div class="photo-desc">Un tinte de larga duración que proporciona comodidad durante todo el día y un color intenso sin resecar los labios. </div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.2</span></div>
                        <div class="name">practically permanent lip stain marker</div>
                        <div class="price">$17 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="practically permanent lip stain marker">
                            <input type="hidden" name="prod_precio" value="17.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_da39ef0a-78c2-476a-985d-f05e19f3c6c8.png?v=1755286904&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/lipoil_1.png?v=1758054766&width=433&height=506&crop=center" alt="r.e.m. beauty x Wicked: For Good So Popular ph Adaptive Lip Oil">
                        <div class="photo-desc">De vuelta por aclamación popular con un nuevo y seductor tono esmeralda, este aceite labial brillante con pH adaptable cambia a tu tono rosa personalizado y cautivador.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.8</span></div>
                        <div class="name">r.e.m. beauty x Wicked: For Good So Popular pH Adaptive Lip Oil</div>
                        <div class="price">$12.50 USD</div>
                       <form method="post">
                            <input type="hidden" name="prod_nombre" value="r.e.m. beauty x Wicked: For Good So Popular pH Adaptive Lip Oil">
                            <input type="hidden" name="prod_precio" value="12.50">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/lipoil_1.png?v=1758054766&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_8_e2b0304b-d06a-4d24-bb92-81dbdcf613e9.png?v=1778176452&width=433&height=506&crop=center" alt="dangerous woman lip mask">
                        <div class="photo-desc">Una mascarilla labial suave y sedosa que hidrata profundamente los labios con una textura suave y adictiva que querrás usar día y noche. Incluye un dije coleccionable inspirado en la icónica mascarilla de conejito de Ari.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.8</span></div>
                        <div class="name">dangerous woman lip mask</div>
                        <div class="price">$26 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="dangerous woman lip mask">
                            <input type="hidden" name="prod_precio" value="26.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_8_e2b0304b-d06a-4d24-bb92-81dbdcf613e9.png?v=1778176452&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_1_0b4f9716-388a-4cd0-a2b2-32ebfbcdbe74.png?v=1782343767&width=862&height=1006&crop=center" alt="utmost importance plumping lip gloss">
                        <div class="photo-desc">Un brillo labial transparente con efecto voluminizador para unos labios con apariencia más carnosa y un acabado brillante y no pegajoso.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.8</span></div>
                        <div class="name">utmost importance plumping lip gloss</div>
                        <div class="price">$17 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="utmost importance plumping lip gloss">
                            <input type="hidden" name="prod_precio" value="17.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_1_0b4f9716-388a-4cd0-a2b2-32ebfbcdbe74.png?v=1782343767&width=862&height=1006&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/REM_OnYourCollar_LipOil_PDP_Open_MintCondition_right.png?v=1706146317&width=1724&height=2012&crop=center" alt="essential drip lip oil">
                        <div class="photo-desc">Un aceite no pegajoso de última generación que hidrata profundamente los labios y les aporta un brillo nutritivo.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.8</span></div>
                        <div class="name">essential drip lip oil</div>
                        <div class="price">$20 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="essential drip lip oil">
                            <input type="hidden" name="prod_precio" value="20.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/REM_OnYourCollar_LipOil_PDP_Open_MintCondition_right.png?v=1706146317&width=1724&height=2012&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>
            </div>
        </section>
    </main>
    <?php include "cart_component.php"; ?>
    <footer>Izquierdo Gaytan Alexander 5°J · r.e.m. beauty by Ariana Grande</footer>
</body>
</html>