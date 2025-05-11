
<html>

<head>
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f5f7fa;
        color: #333;
        padding: 40px;
    }

    .container {
        max-width: 600px;
        margin: auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #007bff;
    }

    p {
        font-size: 16px;
        line-height: 1.6;
    }

    .btn {
        display: inline-block;
        background-color: #007bff;
        color: #ffffff;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 6px;
        margin-top: 20px;
        font-weight: bold;
    }

    .footer {
        margin-top: 40px;
        font-size: 14px;
        color: #999;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>¡Bienvenida, <?php echo $nombre; ?>!</h1>
        <p>Gracias por crear tu cuenta en <strong>La 57 Cap</strong>. Para confirmarla, haz clic en el siguiente botón:
        </p>
        <a class="btn" href="<?php echo $url; ?>">Confirmar Cuenta</a>
        <p>Si no solicitaste esta cuenta, puedes ignorar este mensaje.</p>
        <div class="footer">
            &copy; <?php echo date('Y'); ?> La 57 Cap - Todos los derechos reservados
        </div>
    </div>
</body>

</html>