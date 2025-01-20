<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Agendamento de Serviço</title>
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
            <h1>Confirmação de Agendamento</h1>
            <p>O seu serviço foi agendado com sucesso!</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <p>Olá, {{ $serviceDetails['user_name'] }}!</p>
            <p>Estamos felizes em informar que seu serviço foi agendado com sucesso. Aqui estão os detalhes do seu agendamento:</p>

            <ul class="details-list">
                <li><strong>Modelo do Carro:</strong> {{ $serviceDetails['car_model'] }}</li>
                <li><strong>Concessionária:</strong> {{ $serviceDetails['dealership'] }}</li>
                <li><strong>Data de Entrega do Veículo:</strong> {{ $serviceDetails['delivery_date'] }}</li>
                @if (!empty($serviceDetails['pickup_date']))
                    <li><strong>Data de Recolha do Veículo Estimada:</strong> {{ $serviceDetails['pickup_date'] }}</li>
                @endif
                <li><strong>Serviço Agendado:</strong> {{ $serviceDetails['service'] }}</li>
            </ul>

            <p>Se tiver alguma dúvida ou precisar de mais informações, a nossa equipa está à disposição. Não hesite em contatar.</p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>Atenciosamente,</p>
            <p><strong>Equipa de Atendimento</strong><br>Drive&Ride</p>
            <p><a href="mailto:support@seusite.com">driveride@gmail.com</a></p>
        </div>
    </div>
</body>
</html>
