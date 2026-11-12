-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2026 a las 18:52:46
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rem_beauty`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `nombre_cliente` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `direccion` text NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `codigo_postal` varchar(20) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `productos_json` text NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `nombre_cliente`, `email`, `direccion`, `ciudad`, `estado`, `codigo_postal`, `pais`, `telefono`, `total`, `productos_json`, `fecha`) VALUES
(1, 'Alexander Izquierdo', 'alex@gmail.com', 'Calle Sunshine #12 Casa', 'Juarez', 'Chihuahua', '12345', 'México', '6561112222', '167.40', '[{"nombre":"en pointe teddy bear bag charm + glossy balm bundle","precio":55,"imagen":"https:\\/\\/rembeauty.com\\/cdn\\/shop\\/files\\/holiday_bear_bundle_1.gif?v=1792520134&width=618&height=722&crop=center","cantidad":1},{"nombre":"dangerous woman collector''s set","precio":86.4,"imagen":"https:\\/\\/rembeauty.com\\/cdn\\/shop\\/files\\/01_3cef6ace-e39d-4bd7-b007-ae61f8fa0ab4.png?v=1778177047&width=618&height=722&crop=center","cantidad":1},{"nombre":"the gloss barre mini glossy balm set","precio":26,"imagen":"https:\\/\\/rembeauty.com\\/cdn\\/shop\\/files\\/01_glossybalmset_488b29e6-eca2-4c98-b4f7-abe11703017e.png?v=1788908350&width=433&height=506&crop=center","cantidad":1}]', '2026-11-10 12:44:36'),
(2, 'Indra Martinez', 'indra@gmail.com', 'Av. Honeymoon #314 Casa', 'Juárez', 'Chihuahua', '32325', 'México', '6561112233', '150.00', '[{"nombre":"the prima palette","precio":44,"imagen":"https:\\/\\/rembeauty.com\\/cdn\\/shop\\/files\\/01_prima.png?v=1788907435&width=866&height=1012&crop=center","cantidad":1},{"nombre":"petal kit","precio":80,"imagen":"https:\\/\\/rembeauty.com\\/cdn\\/shop\\/files\\/petal_kit_main_image.png?v=1791489716&width=866&height=1012&crop=center","cantidad":1},{"nombre":"the gloss barre mini glossy balm set","precio":26,"imagen":"https:\\/\\/rembeauty.com\\/cdn\\/shop\\/files\\/01_glossybalmset_488b29e6-eca2-4c98-b4f7-abe11703017e.png?v=1788908350&width=433&height=506&crop=center","cantidad":1},{"nombre":"REGALO: full night''s sleep cooling blurring undereye balm","precio":0,"imagen":"","cantidad":1}]', '2026-11-12 11:41:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `descripcion` text NOT NULL,
  `calificacion` decimal(2,1) NOT NULL DEFAULT '5.0',
  `categoria` varchar(100) NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `descripcion`, `calificacion`, `categoria`, `imagen`) VALUES
(1, 'the prima palette', '44.00', 'Color intenso.', '5.0', 'new, best, eyes', 'https://rembeauty.com/cdn/shop/files/01_prima.png?v=1788907435&width=866&height=1012&crop=center'),
(2, 'frost & flutter eye makeup set', '29.00', 'Un dúo de maquillaje para ojos de edición limitada que incluye una sombra de ojos líquida brillante y de larga duración, y nuestra nueva máscara de pestañas 3 en 1 para un color multidimensional, un volumen intenso, un efecto lifting y mayor longitud.', '5.0', 'new, eyes', 'https://rembeauty.com/cdn/shop/files/01_frost_flutter.png?v=1790103584&width=433&height=506&crop=center'),
(3, 'sweet dreams eyeshadow singlet', '24.00', 'Una sombra de ojos individual de edición limitada, de textura sedosa y con un luminoso acabado duocromo que ofrece una pigmentación intensa, una fácil difuminación y un brillo multidimensional.', '4.9', 'new, eyes', 'https://rembeauty.com/cdn/shop/files/01_singlet_velvetetoile.png?v=1788908275&width=433&height=506&crop=center'),
(4, 'treble maker 3-in-1 mascara', '24.00', 'Doble volumen.', '4.5', 'best, eyes', 'https://rembeauty.com/cdn/shop/files/01_treblemaker.png?v=1785964767&width=866&height=1012&crop=center'),
(5, 'starlet lustrous liquid eyeshadow', '22.00', 'Una sola pasada.', '4.5', 'best, eyes', 'https://rembeauty.com/cdn/shop/files/01_liquid-eyeshadow-shimmer-waterproof-starlet-rem-fembot.png?v=1776719015&width=866&height=1012&crop=center'),
(6, 'sweet dreams eyeshadow quad', '30.00', 'Paletas de sombras de ojos cuádruples de alta intensidad y larga duración, diseñadas para el maquillaje diario.', '4.9', 'eyes', 'https://rembeauty.com/cdn/shop/files/01_fembot_fatale.png?v=1789660614&width=433&height=506&crop=center'),
(7, 'flourshing lengthening mascara', '26.00', 'Una innovación ingrávida que sujeta y alarga las pestañas para una definición total sin caídas.', '4.6', 'eyes', 'https://rembeauty.com/cdn/shop/files/01_be6cbb58-8c33-4e52-a557-1f97dd47d297.png?v=1789504049&width=433&height=506&crop=center'),
(8, 'dream lashes', '16.00', 'Un juego de pestañas postizas de imitación de visón de alta calidad con un efecto 3D realista.', '4.5', 'eyes', 'https://rembeauty.com/cdn/shop/products/REM_Ch2_DreamLashes_PDP_Closed_DayDreamin_right.png?v=1762197923&width=433&height=506&crop=center'),
(9, 'at the borderline eyeliner marker', '21.00', 'Un delineador de ojos de larga duración, de color intenso y atrevido, inspirado en el característico delineado de ojos de gato de Ari, que crea efectos de alto impacto, desde lo sutil hasta lo gráfico.', '4.8', 'eyes', 'https://rembeauty.com/cdn/shop/files/01_33.png?v=1762197910&width=618&height=722&crop=center'),
(10, 'r.e.m. beauty x Wicked: For Good Ozian Forest Eyeshadow Palette', '30.00', 'Adéntrate en el bosque de Ozia: 12 tonos de sombras de ojos de larga duración y alto impacto, con pigmentos puros que proporcionan un color intenso y vibrante con una sola pincelada.', '4.8', 'eyes', 'https://rembeauty.com/cdn/shop/files/ozianforestpalette.png?v=1758047886&width=862&height=1006&crop=center'),
(11, 'ballet rosé blush palette', '42.00', 'Una paleta de colorete de edición limitada con tres tonos, acabados mate aterciopelados y luminosos que se difuminan sin esfuerzo para conseguir un color modulable, un brillo sutilmente definido y un acabado difuminado.', '5.0', 'new, face', 'https://rembeauty.com/cdn/shop/files/01_blushpalette_2341ea72-2ba9-442f-abe1-2f8470a60139.png?v=1790103471&width=433&height=506&crop=center'),
(12, 'mélange à trois blush & highlight stick', '29.00', 'Una edición limitada de nuestro stick que combina colorete e iluminador, con perlas jaspeadas que se difuminan sin esfuerzo para conseguir un color radiante, un brillo personalizable y un acabado suave e hidratado.', '4.7', 'new, face', 'https://rembeauty.com/cdn/shop/files/01_melange_cheeky.png?v=1790105972&width=433&height=506&crop=center'),
(13, 'en pointe full colection bundle', '245.70', 'El paquete incluye: la paleta de sombras de ojos prima, el set de mini bálsamos brillantes Gloss Barre, Mascarilla labial Satin Slumber, Sombra de ojos Sweet Dreams, camiseta sin mangas de terciopelo estrellado y zapatillas Starlit, paleta de coloretes Ballet Rosé, mélange à trois rubor & iluminador en barra en primera posición y descarado, Set de maquillaje para ojos Frost & Flutter.', '5.0', 'face', 'https://rembeauty.com/cdn/shop/files/01_collection_05ac52e7-4151-4ce3-ad29-f540236fdc3b.png?v=1790193756&width=433&height=506&crop=center'),
(14, 'r.e.m. beauty x Wicked: For Good couldn''t be lovelier blush set', '56.00', 'Un trío de coloretes inspirados en las características flores de cerezo de Glinda en Wicked: For Good, con acabados mate, brillantes y melange para un look suave y floral en tonos rosas claros y cálidos.', '4.7', 'face', 'https://rembeauty.com/cdn/shop/files/01_52.png?v=1761085060&width=433&height=506&crop=center'),
(15, 'dreamglow highlight serum', '29.00', 'Un elixir de belleza hidratante y ligero que proporciona un velo luminoso para el rostro o el escote.', '4.8', 'face', 'https://rembeauty.com/cdn/shop/files/01_highlighter-serum-dreamglow-rem-quartz.png?v=1764353465&width=433&height=506&crop=center'),
(16, 'eclipse glow stick', '22.00', 'Un iluminador en barra multiusos que se puede aplicar en mejillas, ojos o labios y que aporta un brillo cristalino con un efecto iridiscente duocromo de estilo fembot.', '4.8', 'face', 'https://rembeauty.com/cdn/shop/files/08_eyeshadow-powder-pressed-pigment-shimmer-sweet-dreams-singlet-rem-fembot-open.png?v=1750188830&width=862&height=1006&crop=center'),
(17, 'eclipse blush & lip stick', '26.00', 'Un lápiz 2 en 1 que proporciona un color cremoso y confortable con un acabado naturalmente luminoso y de larga duración.', '4.7', 'best, face', 'https://rembeauty.com/cdn/shop/files/01_22_f8a8fc1d-601f-4f0b-b692-447bc942819f.png?v=1737584277&width=433&height=506&crop=center'),
(18, 'interstellar highlighter topper', '28.00', 'Un polvo sedoso ultraligero que proporciona un brillo multidimensional fascinante con una sola pasada.', '4.9', 'face', 'https://rembeauty.com/cdn/shop/files/Rapid_Highlighter_PDP_Open_missmercury_6138bd63-c4e6-43bd-9f5f-3e6fe579ba8b.png?v=1691473933&width=433&height=506&crop=center'),
(19, 'hypernova satin matte bronzer', '30.00', 'Unos polvos bronceadores compactos que combinan una hidratación ligera con pigmentos mate que difuminan las imperfecciones de la piel para lograr un brillo radiante durante la hora dorada.', '4.9', 'face', 'https://rembeauty.com/cdn/shop/files/01_37.png?v=1740777053&width=1724&height=2012&crop=center'),
(20, 'foundation brush', '25.00', 'Una brocha de base ultrasuave diseñada a medida para una cobertura perfecta y un acabado difuminador.', '4.8', 'face', 'https://rembeauty.com/cdn/shop/files/0062_REM_Foundation_PDP_FoundationBrush.png?v=1762197943&width=433&height=506&crop=center'),
(21, 'satin slumber lip mask', '26.00', 'Una mascarilla labial sedosa y ligera con ácido láctico, tripéptido y manteca de karité que hidrata, suaviza y acondiciona los labios para una comodidad duradera, completa con un dije personalizado que se engancha al brillo.', '5.0', 'new, best, lip', 'https://rembeauty.com/cdn/shop/files/01_lipmask.png?v=1790102322&width=433&height=506&crop=center'),
(22, 'the gloss barre mini glossy balm set', '26.00', 'Brillo radiante e hidratación duradera.', '4.8', 'new, best, lip', 'https://rembeauty.com/cdn/shop/files/01_glossybalmset_488b29e6-eca2-4c98-b4f7-abe11703017e.png?v=1788908350&width=433&height=506&crop=center'),
(23, 'petal kit', '80.00', 'Directamente de la colección actual de Ari.', '5.0', 'new, best', 'https://rembeauty.com/cdn/shop/files/petal_kit_main_image.png?v=1791489716&width=433&height=506&crop=center'),
(24, 'greatest hits', '75.00', 'Descubre nuestros productos estrella , un ritual sencillo para un rostro completo , desde el primer brillo hasta el toque final .', '4.8', 'best', 'https://rembeauty.com/cdn/shop/files/Bundle_2_GreatestHits_01.png?v=1773687398&width=433&height=506&crop=center'),
(25, 'blur butter lip palm', '24.00', 'Un bálsamo labial nutritivo que se funde con suavidad y deja un acabado mate ligero y difuminado.', '4.9', 'best, lip', 'https://rembeauty.com/cdn/shop/files/01_ruby_red_with_cap.png?v=1780691320&width=433&height=506&crop=center'),
(26, 'essential drip glossy balm', '20.00', 'Un tratamiento nutritivo para los labios que también funciona como un brillo labial con color de alto brillo.', '4.8', 'best, lip', 'https://rembeauty.com/cdn/shop/files/01_6d6c07d1-0723-4c55-a57b-d9c377ad73fc.png?v=1762197963&width=433&height=506&crop=center'),
(27, 'on your collar plumping lip gloss', '22.00', 'Este brillo labial de alto brillo da volumen a los labios al instante, proporcionando una agradable sensación de calor que los deja hidratados, más suaves, lisos y visiblemente más voluminosos.', '4.7', 'lip', 'https://rembeauty.com/cdn/shop/files/01_plumping-lip-gloss-on-your-collar-shimmer-rem-fembot.png?v=1762198052&width=433&height=506&crop=center'),
(28, 'practically permanent lip stain marker', '17.00', 'Un tinte de larga duración que proporciona comodidad durante todo el día y un color intenso sin resecar los labios.', '4.2', 'lip', 'https://rembeauty.com/cdn/shop/files/01_da39ef0a-78c2-476a-985d-f05e19f3c6c8.png?v=1755286904&width=433&height=506&crop=center'),
(29, 'r.e.m. beauty x Wicked: For Good So Popular pH Adaptive Lip Oil', '12.50', 'De vuelta por aclamación popular con un nuevo y seductor tono esmeralda, este aceite labial brillante con pH adaptable cambia a tu tono rosa personalizado y cautivador.', '4.8', 'lip', 'https://rembeauty.com/cdn/shop/files/lipoil_1.png?v=1758054766&width=433&height=506&crop=center'),
(30, 'dangerous woman lip mask', '26.00', 'Una mascarilla labial suave y sedosa que hidrata profundamente los labios con una textura suave y adictiva que querrás usar día y noche.', '4.8', 'lip', 'https://rembeauty.com/cdn/shop/files/01_8_e2b0304b-d06a-4d24-bb92-81dbdcf613e9.png?v=1778176452&width=433&height=506&crop=center'),
(31, 'utmost importance plumping lip gloss', '17.00', 'Un brillo labial transparente con efecto voluminizador para unos labios con apariencia más carnosa y un acabado brillante y no pegajoso.', '4.8', 'lip', 'https://rembeauty.com/cdn/shop/files/01_1_0b4f9716-388a-4cd0-a2b2-32ebfbcdbe74.png?v=1782343767&width=862&height=1006&crop=center'),
(32, 'essential drip lip oil', '20.00', 'Un aceite no pegajoso de última generación que hidrata profundamente los labios y les aporta un brillo nutritivo.', '4.8', 'lip', 'https://rembeauty.com/cdn/shop/files/REM_OnYourCollar_LipOil_PDP_Open_MintCondition_right.png?v=1706146317&width=1724&height=2012&crop=center'),
(33, 'en pointe teddy bear bag charm + glossy balm bundle', '55.00', 'Un set de edición limitada que incluye un llavero con forma de osito de peluche de Rem Beauty y un bálsamo labial brillante del tono que elijas.', '4.8', 'new', 'https://rembeauty.com/cdn/shop/files/holiday_bear_bundle_1.gif?v=1792520134&width=618&height=722&crop=center'),
(34, 'dangerous woman collector''s set', '86.40', 'Celebra el décimo aniversario de Dangerous Woman con este paquete de edición limitada inspirado en la dualidad, un tema central del álbum: suavidad y fuerza, luz y audacia, y las múltiples facetas del ser que coexisten.', '4.5', 'new', 'https://rembeauty.com/cdn/shop/files/01_3cef6ace-e39d-4bd7-b007-ae61f8fa0ab4.png?v=1778177047&width=618&height=722&crop=center');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `correo`, `fecha_nacimiento`, `telefono`, `contrasena`, `creado_en`) VALUES
(1, 'Alexander', 'Izquierdo', 'alex@gmail.com', '2009-09-27', '6561112222', '$2y$10$3WIRQGdJAOnfA6LLVFPuqeAT8tl5Y8ROT2AXrtyO43LeFfj04DOUW', '2026-10-28 02:19:57'),
(2, 'Indra', 'Martinez', 'indra@gmail.com', '2009-09-03', '6561112233', '$2y$10$fchmRtIMnyQMKv/UiwO2geUMhcNiFB6L0XjW4E7pXZaYkinpkKgzi', '2026-10-29 04:24:55'),
(3, 'Mia', 'Arzapala', 'mia@gmail.com', '2009-11-06', '6562223333', '$2y$10$0w.WkItZ.I2c9JDGHbS6yOi63bZl8YLOdhSTO.0ckyiN2qnxQe5sC', '2026-10-29 04:29:08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
