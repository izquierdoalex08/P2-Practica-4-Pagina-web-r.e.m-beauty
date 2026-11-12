<?php require_once "auth.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>r.e.m. beauty — New</title>
    <style>
        <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
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
        footer {
            text-align: center;
            background: #dce6f1;
            padding: 28px;
            font-size: 13px;
            font-family: 'Space Mono', monospace;
            letter-spacing: 1.5px;
        }
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
                <svg viewBox="0 0 24 24" width="18" height="18" stroke="#252536" stroke-width="1.8" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
        <section id="sec-new">
            <div class="section-title">
                <h2>new</h2>
                <span>✦ colección ✦</span>
            </div>
            <div class="products">
                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/holiday_bear_bundle_1.gif?v=1792520134&width=618&height=722&crop=center" alt="en pointe teddy bear bag charm + glossy balm bundle">
                        <div class="photo-desc">Un set de edición limitada que incluye un llavero con forma de osito de peluche de Rem Beauty y un bálsamo labial brillante del tono que elijas.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.8</span></div>
                        <div class="name">en pointe teddy bear bag charm + glossy balm bundle</div>
                        <div class="price">$55 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="en pointe teddy bear bag charm + glossy balm bundle">
                            <input type="hidden" name="prod_precio" value="55.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/holiday_bear_bundle_1.gif?v=1792520134&width=618&height=722&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>
                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/petal_kit_main_image.png?v=1791489716&width=433&height=506&crop=center" alt="petal kit">
                        <div class="photo-desc">Directamente de la colección actual de Ari. El kit de edición limitada Petal incluye la máscara de pestañas Treble Maker 3 en 1 de tamaño completo para unas pestañas impactantes, el colorete e iluminador Love Spell Mélange à Trois para un rubor malva romántico, un neceser negro con forma de pétalo y un llavero plateado con forma de pétalo. ¡Consigue los cuatro productos juntos antes de que se agoten!</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>5.0</span></div>
                        <div class="name">petal kit</div>
                        <div class="price">$80 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="petal kit">
                            <input type="hidden" name="prod_precio" value="80.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/petal_kit_main_image.png?v=1791489716&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_prima.png?v=1788907435&width=433&height=506&crop=center" alt="the prima palette">
                        <div class="photo-desc">Color intenso. Dimensión onírica. Esta paleta de sombras de ojos de edición limitada, ligera y de larga duración, está inspirada en la elegancia del ballet, con acabados mate aterciopelados y luminosos duocromos que invitan a una segunda mirada.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>5.0</span></div>
                        <div class="name">the prima palette</div>
                        <div class="price">$44 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="the prima palette">
                            <input type="hidden" name="prod_precio" value="44.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_prima.png?v=1788907435&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_glossybalmset_488b29e6-eca2-4c98-b4f7-abe11703017e.png?v=1788908350&width=433&height=506&crop=center" alt="glossy balm set">
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
                        <img src="https://rembeauty.com/cdn/shop/files/01_blushpalette_2341ea72-2ba9-442f-abe1-2f8470a60139.png?v=1790103471&width=433&height=506&crop=center" alt="blush palette">
                        <div class="photo-desc">Una paleta de colorete de edición limitada con tres tonos, acabados mate aterciopelados y luminosos que se difuminan sin esfuerzo para conseguir un color modulable, un brillo sutilmente definido y un acabado difuminado.
                        </div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>5.0</span></div>
                        <div class="name">ballet rosé blush palette</div>
                        <div class="price">$42 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="ballet rosé blush palette">
                            <input type="hidden" name="prod_precio" value="42.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_blushpalette_2341ea72-2ba9-442f-abe1-2f8470a60139.png?v=1790103471&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_frost_flutter.png?v=1790103584&width=433&height=506&crop=center" alt="frost & flutter eye makeup set">
                        <div class="photo-desc">Un dúo de maquillaje para ojos de edición limitada que incluye una sombra de ojos líquida brillante y de larga duración, y nuestra nueva máscara de pestañas 3 en 1 para un color multidimensional, un volumen intenso, un efecto lifting y mayor longitud.
                        </div>
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
                        <img src="https://rembeauty.com/cdn/shop/files/01_melange_cheeky.png?v=1790105972&width=433&height=506&crop=center" alt="mélange à trois blush & highlight stick">
                        <div class="photo-desc">Una edición limitada de nuestro stick que combina colorete e iluminador, con perlas jaspeadas que se difuminan sin esfuerzo para conseguir un color radiante, un brillo personalizable y un acabado suave e hidratado.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.7</span></div>
                        <div class="name">mélange à trois blush & highlight stick</div>
                        <div class="price">$29 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="mélange à trois blush & highlight stick">
                            <input type="hidden" name="prod_precio" value="29.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_melange_cheeky.png?v=1790105972&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_3cef6ace-e39d-4bd7-b007-ae61f8fa0ab4.png?v=1778177047&width=618&height=722&crop=center" alt="dangerous woman collector's set">
                        <div class="photo-desc">Celebra el décimo aniversario de Dangerous Woman con este paquete de edición limitada inspirado en la dualidad, un tema central del álbum: suavidad y fuerza, luz y audacia, y las múltiples facetas del ser que coexisten. Este exclusivo set incluye dos bálsamos labiales brillantes, una mascarilla nutritiva para labios y la paleta de sombras de ojos Sweet Dreams, cada uno diseñado para usarse solo o combinado para lograr un sinfín de expresiones.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.5</span></div>
                        <div class="name">dangerous woman collector's set</div>
                        <div class="price">$86.40 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="dangerous woman collector's set">
                            <input type="hidden" name="prod_precio" value="86.40">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_3cef6ace-e39d-4bd7-b007-ae61f8fa0ab4.png?v=1778177047&width=618&height=722&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>
            </div>
        </section>
    </main>
    <?php include "cart_component.php"; ?>
    <footer>Izquierdo Gaytan Alexander 5°J · r.e.m. beauty: the everyday artistry brand</footer>
</body>
</html>
