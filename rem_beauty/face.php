<?php require_once "auth.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>r.e.m. beauty — Face</title>
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
        <section id="sec-face">
            <div class="section-title">
                <h2>face</h2>
                <span>✦ colección ✦</span>
            </div>
            <div class="products">
                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_blushpalette_2341ea72-2ba9-442f-abe1-2f8470a60139.png?v=1790103471&width=433&height=506&crop=center" alt="ballet rosé blush palette">
                        <div class="photo-desc">Una paleta de colorete de edición limitada con tres tonos, acabados mate aterciopelados y luminosos que se difuminan sin esfuerzo para conseguir un color modulable, un brillo sutilmente definido y un acabado difuminado.</div>
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
                        <img src="https://rembeauty.com/cdn/shop/files/01_melange_cheeky.png?v=1790105972&width=433&height=506&crop=center" alt="mélange á trois blush & highlight stick">
                        <div class="photo-desc">Una edición limitada de nuestro stick que combina colorete e iluminador, con perlas jaspeadas que se difuminan sin esfuerzo para conseguir un color radiante, un brillo personalizable y un acabado suave e hidratado.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.7</span></div>
                        <div class="name">mélange à trois blush & highlight stick </div>
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
                        <img src="https://rembeauty.com/cdn/shop/files/01_collection_05ac52e7-4151-4ce3-ad29-f540236fdc3b.png?v=1790193756&width=433&height=506&crop=center" alt="en pointe full colection bundle">
                        <div class="photo-desc">El paquete incluye: la paleta de sombras de ojos prima, el set de mini bálsamos brillantes Gloss Barre, Mascarilla labial Satin Slumber, Sombra de ojos Sweet Dreams, camiseta sin mangas de terciopelo estrellado y zapatillas Starlit, paleta de coloretes Ballet Rosé, mélange à trois rubor & iluminador en barra en primera posición y descarado, Set de maquillaje para ojos Frost & Flutter.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>5.0</span></div>
                        <div class="name">en pointe full colection bundle</div>
                        <div class="price">$245.70 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="en pointe full colection bundle">
                            <input type="hidden" name="prod_precio" value="245.70">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_collection_05ac52e7-4151-4ce3-ad29-f540236fdc3b.png?v=1790193756&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_52.png?v=1761085060&width=433&height=506&crop=center" alt="r.e.m. beauty x Wicked: For Good couldn´t be lovelier blush set">
                        <div class="photo-desc">Un trío de coloretes inspirados en las características flores de cerezo de Glinda en Wicked: For Good, con acabados mate, brillantes y melange para un look suave y floral en tonos rosas claros y cálidos. Ahorra al comprar las dos paletas de colorete con aroma a flor de cerezo y la brocha para colorete con aroma a flor de cerezo.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.7</span></div>
                        <div class="name">r.e.m. beauty x Wicked: For Good couldn't be lovelier blush set</div>
                        <div class="price">$56 USD</div>
                       <form method="post">
                            <input type="hidden" name="prod_nombre" value="r.e.m. beauty x Wicked: For Good couldn't be lovelier blush set">
                            <input type="hidden" name="prod_precio" value="56.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_52.png?v=1761085060&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_highlighter-serum-dreamglow-rem-quartz.png?v=1764353465&width=433&height=506&crop=center" alt="dreamglow highlight serum">
                        <div class="photo-desc">Un elixir de belleza hidratante y ligero que proporciona un velo luminoso para el rostro o el escote. Puede usarse solo o mezclado con tus productos de maquillaje favoritos. </div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.8</span></div>
                        <div class="name">dreamglow highlight serum</div>
                        <div class="price">$29 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="dreamglow highlight serum">
                            <input type="hidden" name="prod_precio" value="29.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_highlighter-serum-dreamglow-rem-quartz.png?v=1764353465&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/08_eyeshadow-powder-pressed-pigment-shimmer-sweet-dreams-singlet-rem-fembot-open.png?v=1750188830&width=862&height=1006&crop=center" alt="eclipse glow stick">
                        <div class="photo-desc">Un iluminador en barra multiusos que se puede aplicar en mejillas, ojos o labios y que aporta un brillo cristalino con un efecto iridiscente duocromo de estilo fembot.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.8</span></div>
                        <div class="name">eclipse glow stick</div>
                        <div class="price">$22 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="eclipse glow stick">
                            <input type="hidden" name="prod_precio" value="22.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/08_eyeshadow-powder-pressed-pigment-shimmer-sweet-dreams-singlet-rem-fembot-open.png?v=1750188830&width=862&height=1006&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_22_f8a8fc1d-601f-4f0b-b692-447bc942819f.png?v=1737584277&width=433&height=506&crop=center" alt="eclipse blush & lip stick">
                        <div class="photo-desc">Un lápiz 2 en 1 que proporciona un color cremoso y confortable con un acabado naturalmente luminoso y de larga duración.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.7</span></div>
                        <div class="name">eclipse blush & lip stick</div>
                        <div class="price">$26 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="eclipse blush & lip stick">
                            <input type="hidden" name="prod_precio" value="26.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_22_f8a8fc1d-601f-4f0b-b692-447bc942819f.png?v=1737584277&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/Rapid_Highlighter_PDP_Open_missmercury_6138bd63-c4e6-43bd-9f5f-3e6fe579ba8b.png?v=1691473933&width=433&height=506&crop=center" alt="interstellar highlighter topper">
                        <div class="photo-desc">Un polvo sedoso ultraligero que proporciona un brillo multidimensional fascinante con una sola pasada.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.9</span></div>
                        <div class="name">interstellar highlighter topper</div>
                        <div class="price">$28 USD</div>
                       <form method="post">
                            <input type="hidden" name="prod_nombre" value="interstellar highlighter topper">
                            <input type="hidden" name="prod_precio" value="28.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/Rapid_Highlighter_PDP_Open_missmercury_6138bd63-c4e6-43bd-9f5f-3e6fe579ba8b.png?v=1691473933&width=433&height=506&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/01_37.png?v=1740777053&width=1724&height=2012&crop=center" alt="hypernova satin matte bronzer">
                        <div class="photo-desc">Unos polvos bronceadores compactos que combinan una hidratación ligera con pigmentos mate que difuminan las imperfecciones de la piel para lograr un brillo radiante durante la hora dorada.</div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.9</span></div>
                        <div class="name">hypernova satin matte bronzer</div>
                        <div class="price">$30 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="hypernova satin matte bronzer">
                            <input type="hidden" name="prod_precio" value="30.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/01_37.png?v=1740777053&width=1724&height=2012&crop=center">
                            <button type="submit" name="agregar_carrito">AÑADIR AL CARRITO</button>
                        </form>
                    </div>
                </article>

                <article class="product">
                    <div class="photo">
                        <img src="https://rembeauty.com/cdn/shop/files/0062_REM_Foundation_PDP_FoundationBrush.png?v=1762197943&width=433&height=506&crop=center" alt="foundation brush">
                        <div class="photo-desc">Una brocha de base ultrasuave diseñada a medida para una cobertura perfecta y un acabado difuminador. </div>
                    </div>
                    <div class="details">
                        <div class="rating">★★★★★ <span>4.8</span></div>
                        <div class="name">foundation brush</div>
                        <div class="price">$25 USD</div>
                        <form method="post">
                            <input type="hidden" name="prod_nombre" value="foundation brush">
                            <input type="hidden" name="prod_precio" value="25.00">
                            <input type="hidden" name="prod_imagen" value="https://rembeauty.com/cdn/shop/files/0062_REM_Foundation_PDP_FoundationBrush.png?v=1762197943&width=433&height=506&crop=center">
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