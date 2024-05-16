<?php
require_once __DIR__ . '/../controllers/ContatoController.php';
$controller = new ContatoController();
$contatos = $controller->obterTodosContatos();
if (isset($_GET['successMessage'])) {
    echo '<div style="color: green;">' . $_GET['successMessage'] . '</div>';
}
if (isset($_GET['errorMessage'])) {
    echo '<div style="color: red;">' . $_GET['errorMessage'] . '</div>';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatos</title>
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
<h1>Contatos Cadastrados</h1>

<table>
    <tr>
        <th>Nome Completo</th>
        <th>CPF</th>
        <th>E-mail</th>
        <th>Data de Nascimento</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($contatos as $contato): ?>
        <tr>
            <td><?php echo $contato['nome_completo']; ?></td>
            <td><?php echo $contato['cpf']; ?></td>
            <td><?php echo $contato['email']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($contato['data_nascimento'])); ?></td>
            <td>
                <a href="editar_contato.php?id=<?php echo $contato['id']; ?>">Editar</a>
                <form action="../models/excluir_contato.php" method="post" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $contato['id']; ?>">
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>