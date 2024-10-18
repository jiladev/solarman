<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo orçamento gerado</title>
    <link rel="stylesheet" href="https://github.com/jiladev/solarman/blob/main/solarman-backend/public/css/style.css">

</head>

<body>
    <div class="container">
        <header class="header">
            <div class="img-header">
                <img src="https://raw.githubusercontent.com/jiladev/solarman/refs/heads/main/solarman-backend/public/img/logo-horiz-solarman-1.png?token=GHSAT0AAAAAACYMDKKAYFMLT3H3W2MVRQ7SZYRW3IQ" alt="Logo Solarman">
            </div>
            <h1> Tem <span>cliente novo</span> chegando aí!</h1>
            <hr class="line-orange">
            <p class="info">
                Um cliente acabou de preencher o formulário na <span>Área do cliente</span>
                lá do site da Cooperativa. Corre aqui ver os dados desse cliente.
            </p>
            <p class="little-letters">Todos os dados foram enviados conforme consentimento do cliente.</p>
        </header>
        <div class="body-email">
            <h4>Nome do cliente</h4>
            <p>{{ $client->name }}</p>
            <h4>Celular do cliente</h4>
            <p>{{ $client->phone }}</p>
            <h4>Valor da fatura</h4>
            <p>R${{ $clientEstimate->fatura_copel }}</p>
            <h4>Valor final informado</h4>
            <p>R${{ $clientEstimate->final_value_discount }}</p>
        </div>
    </div>

    <footer class="footer">
        <img src="https://raw.githubusercontent.com/jiladev/solarman/refs/heads/main/solarman-backend/public/img/logo-horiz-solarman-branca-1.png?token=GHSAT0AAAAAACYMDKKA3PET4GSL3URNNG5UZYRW3WA" alt="Logo footer">
    </footer>

</body>

</html>