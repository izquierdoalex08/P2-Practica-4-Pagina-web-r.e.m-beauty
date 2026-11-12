<?php require_once "auth.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>r.e.m. beauty — Cuenta</title>
    <style>
        * {
            box-sizing: border-box;
        }

        /* FLEXBOX EN EL BODY PARA EMPUJAR EL FOOTER HASTA ABAJO */
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #252536;
            background: #fff;
            display: flex;
            flex-direction: column;
        }

        /* EL MAIN CRECE PARA OCUPAR EL ESPACIO SOBRANTE */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .promo {
            text-align: center;
            background: #edf2f8;
            padding: 10px;
            font-size: 13px;
        }

        header {
            position: sticky;
            top: 0;
            z-index: 5;
            background: #fff;
            border-bottom: 1px solid #eee;
            padding: 18px 4%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .logo {
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -2px;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .logo small {
            font-size: 14px;
            letter-spacing: 0;
        }

        .logo span {
            display: block;
            font-size: 11px;
            letter-spacing: 0;
        }

        nav {
            display: flex;
            gap: 22px;
            flex-wrap: wrap;
        }

        .nav-label {
            color: inherit;
            text-decoration: none;
            font-size: 14px;
        }

        .nav-label:hover {
            color: #7896bc;
        }

        button, .btn {
            border: 0;
            border-radius: 25px;
            background: #bfd0e4;
            padding: 12px 22px;
            cursor: pointer;
            color: #222;
            font-weight: 600;
            display: inline-block;
            text-decoration: none;
        }

        button:hover, .btn:hover {
            background: #a8bfd9;
        }

        section {
            width: 100%;
            padding: 0 4%;
        }

        /* Formularios de la cuenta */
        .forms-container {
            background: #f2f5fa;
            max-width: 520px;
            margin: 0 auto;
            border-radius: 14px;
            padding: 28px;
        }

        .formbox {
            background: #fff;
            padding: 24px;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .formbox h2 {
            margin-top: 0;
            font-weight: 500;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        label {
            display: block;
            font-size: 13px;
            margin: 12px 0 5px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d5d8e0;
            border-radius: 8px;
        }

        .formbox button {
            margin-top: 18px;
            width: 100%;
        }

        .msg {
            font-size: 14px;
            min-height: 20px;
            margin-top: 12px;
            color: #385d82;
            font-weight: 600;
        }
        
        .auth-switch {
            display: none;
        }

        #switch-login:checked ~ #box-login {
            display: block;
        }
        #switch-login:checked ~ #box-registro {
            display: none;
        }

        #switch-registro:checked ~ #box-login {
            display: none;
        }
        #switch-registro:checked ~ #box-registro {
            display: block;
        }

        .toggle-auth {
            text-align: center;
            margin-top: 18px;
            font-size: 13px;
        }

        .toggle-auth label {
            display: inline;
            color: #385d82;
            text-decoration: underline;
            cursor: pointer;
            font-weight: 600;
        }

        .user-bar {
            background: #f2f5fa;
            text-align: right;
            padding: 8px 4%;
            font-size: 12px;
            color: #536e94;
        }

        .user-bar a {
            margin-left: 12px;
            text-decoration: underline;
        }

        footer {
            text-align: center;
            background: #dce6f1;
            padding: 28px;
            font-size: 13px;
            width: 100%;
        }

        @media(max-width:850px) {
            header {
                align-items: flex-start;
                flex-direction: column;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:460px) {
            nav {
                gap: 12px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

    <div class="promo">✨ regalo especial en compras seleccionadas ✨</div>

    <header>
        <a class="logo" href="index.php">
            r.e.m.<small> beauty</small>
            <span>inspirado en tu brillo</span>
        </a>
        <nav>
            <a class="nav-label" href="new.php">new</a>
            <a class="nav-label" href="best.php">best sellers</a>
            <a class="nav-label" href="eyes.php">eyes</a>
            <a class="nav-label" href="lip.php">lip</a>
            <a class="nav-label" href="face.php">face</a>
            <a class="nav-label" href="cuenta.php">cuenta</a>
        </nav>
    </header>

    <?php if (!empty($_SESSION["usuario"])): ?>
        <div class="user-bar">
            Hola, <?php echo htmlspecialchars($_SESSION["usuario"], ENT_QUOTES, "UTF-8"); ?> · ¡qué gusto tenerte aquí! 
            <a href="salir.php">Cerrar sesión</a>
        </div>
    <?php endif; ?>

    <main>
        <section id="sec-cuenta">
            <div class="forms-container">
                <input type="radio" name="auth_switch" id="switch-login" class="auth-switch" <?php echo empty($mensajeRegistro) ? 'checked' : ''; ?>>
                <input type="radio" name="auth_switch" id="switch-registro" class="auth-switch" <?php echo !empty($mensajeRegistro) ? 'checked' : ''; ?>>

                <div class="formbox" id="box-login">
                    <h2>Iniciar sesión</h2>
                    <form method="post" action="cuenta.php">
                        <label for="correo_login">Correo electrónico</label>
                        <input id="correo_login" name="correo_login" type="email" required>

                        <label for="contrasena_login">Contraseña</label>
                        <input id="contrasena_login" name="contrasena_login" type="password" required>

                        <button type="submit" name="iniciar">INICIAR SESIÓN</button>
                    </form>

                    <p class="msg"><?php echo isset($mensajeLogin) ? htmlspecialchars($mensajeLogin, ENT_QUOTES, "UTF-8") : ''; ?></p>

                    <div class="toggle-auth">
                        ¿No tienes una cuenta? <label for="switch-registro">Regístrate aquí</label>
                    </div>
                </div>

                <!-- Formulario Registro -->
                <div class="formbox" id="box-registro">
                    <h2>Crear cuenta</h2>
                    <form method="post" action="cuenta.php">
                        <div class="form-row">
                            <div>
                                <label for="nombre">Nombre(s)</label>
                                <input id="nombre" name="nombre" required maxlength="50">
                            </div>
                            <div>
                                <label for="apellidos">Apellidos</label>
                                <input id="apellidos" name="apellidos" required maxlength="80">
                            </div>
                        </div>

                        <label for="correo">Correo electrónico</label>
                        <input id="correo" name="correo" type="email" required maxlength="150">

                        <div class="form-row">
                            <div>
                                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" required>
                            </div>
                            <div>
                                <label for="telefono">Teléfono (opcional)</label>
                                <input id="telefono" name="telefono" type="tel" maxlength="20">
                            </div>
                        </div>

                        <label for="contrasena">Contraseña (mínimo 8 caracteres)</label>
                        <input id="contrasena" name="contrasena" type="password" required minlength="8">

                        <button type="submit" name="registrar">REGISTRARME</button>
                    </form>

                    <p class="msg"><?php echo isset($mensajeRegistro) ? htmlspecialchars($mensajeRegistro, ENT_QUOTES, "UTF-8") : ''; ?></p>

                    <div class="toggle-auth">
                        ¿Ya tienes una cuenta? <label for="switch-login">Inicia sesión</label>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        Izquierdo Gaytan Alexander 5°J · r.e.m. beauty by Ariana Grande
    </footer>

</body>
</html>
