<?php
session_start();
$errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : null;
unset($_SESSION['errorMessage']);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Contato</title>
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
    <a href="form-endereco.php">Cadastrar endereço</a>
</div>
    <h1>Cadastro de Contato</h1>
    <?php if ($errorMessage) : ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <form id="contactForm" action="../index.php" method="POST">
        <label for="nomeCompleto">Nome Completo:</label><br>
        <input type="text" id="nomeCompleto" name="nomeCompleto" required><br><br>

        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="dataNascimento">Data de Nascimento:</label><br>
        <input type="date" id="dataNascimento" name="dataNascimento" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>

</html>