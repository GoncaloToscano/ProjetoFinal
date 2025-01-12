<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Agendamento de Test Drive</title>
</head>
<body>
    <h1>Test Drive Agendado</h1>
    <p><strong>Nome:</strong> {{ $testDrive->name }}</p>
    <p><strong>Carro:</strong> {{ $testDrive->car->brand }} {{ $testDrive->car->name }}</p>
    <p><strong>Data Preferencial:</strong> {{ $testDrive->preferred_date }}</p>
    <p><strong>Hora Preferencial:</strong> {{ $testDrive->preferred_time }}</p>
    <p><strong>E-mail:</strong> {{ $testDrive->email }}</p>
    <p><strong>Telefone:</strong> {{ $testDrive->phone }}</p>
    <p><strong>Observações:</strong> {{ $testDrive->observations }}</p>
</body>
</html>
