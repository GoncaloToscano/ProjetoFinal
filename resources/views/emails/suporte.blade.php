<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido de Suporte</title>
    <style>
        /* Estilos gerais */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
            color: #555;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .email-header h2 {
            font-size: 24px;
            margin: 0;
        }

        .email-body {
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.6;
        }

        .email-body p {
            margin-bottom: 10px;
        }

        .email-body strong {
            color: #333;
        }

        .email-footer {
            margin-top: 30px;
            padding: 10px;
            background-color: #f7f7f7;
            text-align: center;
            font-size: 14px;
            color: #777;
            border-radius: 8px;
        }

        .email-footer p {
            margin: 0;
        }

        /* Adicionando um botão para responder ou ver mais */
        .cta-button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .cta-button:hover {
            background-color: #0056b3;
        }

        /* Responsividade */
        @media screen and (max-width: 600px) {
            .email-container {
                padding: 15px;
            }
            .email-header h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
<br><br>
    <div class="email-container">
        <div class="email-header">
            <h2>Pedido de Suporte</h2>
        </div>
        <div class="email-body">
            <p><strong>Nome:</strong> {{ $nome }}</p>
            <p><strong>E-mail:</strong> {{ $email }}</p>
            <p><strong>Telefone:</strong> {{ $telefone }}</p>
            <p><strong>Mensagem:</strong></p>
            <p>{{ $mensagem }}</p>
        </div>
        <div class="email-footer">
            <p>Este é um e-mail automatizado. Por favor, não responda a este e-mail diretamente.</p>
            <a href="mailto:{{ $email }}" class="cta-button">Responder ao Pedido</a>
        </div>
    </div>
    <br>
</body>
</html>
