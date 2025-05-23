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
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        h1 {
            color: #dc3545;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            background-color: #dc3545;
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
        <h1>Hola <?php echo $nombre; ?>,</h1>
        <p>Has solicitado restablecer tu contraseña. Haz clic en el botón de abajo para continuar:</p>
        <a class="btn" href="<?php echo $url; ?>">Restablecer Contraseña</a>
        <p>Si no hiciste esta solicitud, puedes ignorar este mensaje.</p>
        <div class="footer">
            &copy; <?php echo date('Y'); ?>La 57 Cap - Todos los derechos reservados
        </div>
    </div>
</body>
</html>
