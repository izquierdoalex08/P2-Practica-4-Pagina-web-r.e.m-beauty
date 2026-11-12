<?php require_once "auth.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>r.e.m. beauty — Eyes</title>
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
        <a class="logo" href="index.php">r.e.m.<small> beauty</small><span>by ariana grande</span></a>
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
        <section id="sec-eyes">
            <div class="section-title">
                <h2>eyes</h2>
                <span>✦ colección ✦</span>
            </div>
            <div class="products">
                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_prima.png?v=1788907435&width=866&height=1012&crop=center" alt="the prima palette">
                        <div class="photo-desc">Color intenso. Dimensión onírica. Esta paleta de sombras de ojos de edición limitada, ligera y de larga duración, está inspirada en la elegancia del ballet, con acabados mate aterciopelados y luminosos duocromos que invitan a una segunda mirada.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>5.0</span></div>
                        <div class="name">the prima palette</div>
                        <div class="price">$44 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="the prima palette">
                            <input type="hidden" name="prod_precio" value="44.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_prima.png?v=1788907435&width=866&height=1012&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_frost_flutter.png?v=1790103584&width=433&height=506&crop=center" alt="frost & flutter eye makeup set">
                        <div class="photo-desc">Un dúo de maquillaje para ojos de edición limitada que incluye una sombra de ojos líquida brillante y de larga duración, y nuestra nueva máscara de pestañas 3 en 1 para un color multidimensional, un volumen intenso, un efecto lifting y mayor longitud.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>5.0</span></div>
                        <div class="name">frost & flutter eye makeup set</div>
                        <div class="price">$29 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="frost & flutter eye makeup set">
                            <input type="hidden" name="prod_precio" value="29.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_frost_flutter.png?v=1790103584&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_singlet_velvetetoile.png?v=1788908275&width=433&height=506&crop=center" alt="sweet dreams eyeshadow singlet">
                        <div class="photo-desc">Una sombra de ojos individual de edición limitada, de textura sedosa y con un luminoso acabado duocromo que ofrece una pigmentación intensa, una fácil difuminación y un brillo multidimensional.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.9</span></div>
                        <div class="name">sweet dreams eyeshadow singlet</div>
                        <div class="price">$24 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="sweet dreams eyeshadow singlet">
                            <input type="hidden" name="prod_precio" value="24.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_singlet_velvetetoile.png?v=1788908275&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_treblemaker.png?v=1785964767&width=866&height=1012&crop=center" alt="treble maker 3-in-1 mascara">
                        <div class="photo-desc">Doble volumen. Elevación y longitud instantáneas. Una máscara de pestañas ligera y de larga duración que proporciona pestañas con un aspecto más voluminoso y definido, a la vez que ayuda a conseguir unas pestañas más fuertes y densas con el paso del tiempo.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.5</span></div>
                        <div class="name">treble maker 3-in-1 mascara</div>
                        <div class="price">$24 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="treble maker 3-in-1 mascara">
                            <input type="hidden" name="prod_precio" value="24.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_treblemaker.png?v=1785964767&width=866&height=1012&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_liquid-eyeshadow-shimmer-waterproof-starlet-rem-fembot.png?v=1776719015&width=866&height=1012&crop=center" alt="starlet lustrous liquid eyeshadow">
                        <div class="photo-desc">Una sola pasada. Un look de ojos completo. En segundos. Color ligero, de larga duración y con una pigmentación intensa.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.5</span></div>
                        <div class="name">starlet lustrous liquid eyeshadow</div>
                        <div class="price">$22 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="starlet lustrous liquid eyeshadow">
                            <input type="hidden" name="prod_precio" value="22.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_liquid-eyeshadow-shimmer-waterproof-starlet-rem-fembot.png?v=1776719015&width=866&height=1012&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_fembot_fatale.png?v=1789660614&width=433&height=506&crop=center" alt="sweet dreams eyeshadow quad">
                        <div class="photo-desc">Paletas de sombras de ojos cuádruples de alta intensidad y larga duración, diseñadas para el maquillaje diario. Cada tono, libre de talco, ofrece una pigmentación intensa, una difuminación perfecta y un sinfín de posibilidades de expresión con cada aplicación.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.9</span></div>
                        <div class="name">sweet dreams eyeshadow quad</div>
                        <div class="price">$30 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="sweet dreams eyeshadow quad">
                            <input type="hidden" name="prod_precio" value="30.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_fembot_fatale.png?v=1789660614&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_be6cbb58-8c33-4e52-a557-1f97dd47d297.png?v=1789504049&width=433&height=506&crop=center" alt="flourshing lengthening mascara">
                        <div class="photo-desc">Una innovación ingrávida que sujeta y alarga las pestañas para una definición total sin caídas.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.6</span></div>
                        <div class="name">flourshing lengthening mascara</div>
                        <div class="price">$26 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="flourshing lengthening mascara">
                            <input type="hidden" name="prod_precio" value="26.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_be6cbb58-8c33-4e52-a557-1f97dd47d297.png?v=1789504049&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/products/REM_Ch2_DreamLashes_PDP_Closed_DayDreamin_right.png?v=1762197923&width=433&height=506&crop=center" alt="dream lashes">
                        <div class="photo-desc">Un juego de pestañas postizas de imitación de visón de alta calidad con un efecto 3D realista.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.5</span></div>
                        <div class="name">dream lashes</div>
                        <div class="price">$16 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="dream lashes">
                            <input type="hidden" name="prod_precio" value="16.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/products/REM_Ch2_DreamLashes_PDP_Closed_DayDreamin_right.png?v=1762197923&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_33.png?v=1762197910&width=618&height=722&crop=center" alt="at the borderline eyeliner marker">
                        <div class="photo-desc">Un delineador de ojos de larga duración, de color intenso y atrevido, inspirado en el característico delineado de ojos de gato de Ari, que crea efectos de alto impacto, desde lo sutil hasta lo gráfico.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.8</span></div>
                        <div class="name">at the borderline eyeliner marker</div>
                        <div class="price">$21 USD</div>
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
                        <img src="https://rembeauty.com/cdn/shop/files/ozianforestpalette.png?v=1758047886&width=862&height=1006&crop=center" alt="r.e.m. beauty x Wicked: For Good Ozian Forest Eyeshadow Palette">
                        <div class="photo-desc">Adéntrate en el bosque de Ozia: 12 tonos de sombras de ojos de larga duración y alto impacto, con pigmentos puros que proporcionan un color intenso y vibrante con una sola pincelada.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.8</span></div>
                        <div class="name">r.e.m. beauty x Wicked: For Good Ozian Forest Eyeshadow Palette</div>
                        <div class="price">$30 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="satin slumber lip mask">
                            <input type="hidden" name="prod_precio" value="26.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_lipmask.png?v=1790102322&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>
            </div>
        </section>
    </main>

    <footer>Izquierdo Gaytan Alexander 5°J · r.e.m. beauty: the everyday artistry brand</footer>
    <?php include "cart_component.php"; ?>
</body>
</html>
