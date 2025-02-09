<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato sobre o Carro</title>
    <style>
        /* Resets e estilos básicos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #007BFF;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
        }
        .email-header h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .email-body {
            margin-top: 20px;
        }
        .email-body p {
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
        }
        .details-list {
            margin-top: 20px;
            padding-left: 20px;
        }
        .details-list li {
            font-size: 16px;
            color: #555555;
            margin-bottom: 8px;
        }
        .details-list strong {
            color: #007BFF;
        }
        .email-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #777777;
        }
        .email-footer a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>Contato sobre o Carro</h1>
            <p>Detalhes do contato recebido</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p>Olá, Equipe de Atendimento!</p>
            <p>Você recebeu uma nova mensagem de contato sobre o carro. Aqui estão os detalhes:</p>

            <ul class="details-list">
                <li><strong>Marca do Carro:</strong> {{ $data['car_brand'] }}</li>
                <li><strong>Modelo do Carro:</strong> {{ $data['car_name'] }}</li>
                <li><strong>Nome do Cliente:</strong> {{ $data['name'] }}</li>
                <li><strong>Email do Cliente:</strong> {{ $data['email'] }}</li>
                <li><strong>Mensagem:</strong> {{ $data['message'] }}</li>
            </ul>

            <p>Por favor, entre em contato com o cliente o mais breve possível.</p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>Atenciosamente,</p>
            <p><strong>Equipe de Atendimento</strong><br>Drive&Ride</p>
        </div>
    </div>
</body>
</html>
