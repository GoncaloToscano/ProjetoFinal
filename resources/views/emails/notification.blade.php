<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'Drive&Ride Notification' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff; /* Light blue background */
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border: 1px solid #dfe3e8;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #0078d4; /* Primary color of Drive&Ride */
        }
        .header h1 {
            margin: 0;
            color: #0078d4; /* Primary color */
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 20px 0;
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            padding-top: 20px;
            border-top: 2px solid #0078d4;
        }
        .footer p {
            margin: 0;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color: #fff;
            background-color: #0078d4; /* Button color */
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }
        .button:hover {
            background-color: #005fa3; /* Darker shade for hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $subject ?? 'Drive&Ride Notification' }}</h1>
        </div>
        <div class="content">
            <p>{{ $messageContent }}</p>
            <p>Obrigado por escolher <strong>Drive&Ride</strong> Estamos aqui para fazer a diferença!</p>
            <a href="{{ url('/') }}" class="button">Visita o nosso site!</a>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Drive&Ride. Todos os direitos reservados.</p>
            <p>Mantenha-se informado: <a href="{{ url('/') }}" style="color: #0078d4; text-decoration: none;">Facebook</a> | <a href="https://www.instagram.com/driveandride" style="color: #0078d4; text-decoration: none;">Instagram</a></p>
        </div>
    </div>
</body>
</html>
