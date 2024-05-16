<?php
session_start();
require_once __DIR__ . '/../controllers/ContatoController.php';

if (!isset($_GET['id'])) {
    die("ID do contato não fornecido.");
}

$controller = new ContatoController();
$contato = $controller->obterContato($_GET['id']);

if ($contato) {
    $nomeCompleto = $contato->getNomeCompleto();
    $cpf = $contato->getCpf();
    $email = $contato->getEmail();
    $dataNascimento = $contato->getDataNascimento();
} else {
    die("Contato não encontrado.");
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Concluído</title>
    <style>
        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>

<body>
<div class="navbar">
    <a href="contatos.php">Contatos cadastrados</a>
    <a href="form.php">Cadastrar novo contato</a>
    <a href="#">Cadastrar endereço</a>
</div>
    <h1>Contato cadastrado com sucesso!</h1>
    <p><strong>Nome Completo:</strong> <?= htmlspecialchars($nomeCompleto) ?></p>
    <p><strong>CPF:</strong> <?= htmlspecialchars($cpf) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
    <p><strong>Data de Nascimento:</strong> <?= date('d/m/Y', strtotime($dataNascimento)) ?></p> <!-- Converte a data para o formato DD/MM/AAAA -->
</body>

</html>