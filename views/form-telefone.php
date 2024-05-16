<?php
require_once '../controllers/ContatoController.php';
require_once '../controllers/TelefoneController.php';

$contatoController = new ContatoController();
$telefoneController = new TelefoneController();
$contatos = $contatoController->obterTodosContatos();

$contato_id = isset($_GET['contato_id']) ? $_GET['contato_id'] : null;
$telefone_comercial = '';
$telefone_residencial = '';
$telefone_celular = '';

if ($contato_id) {
    $telefone_comercial = $telefoneController->obterTelefonePorTipo($contato_id, 'comercial')['telefone'] ?? '';
    $telefone_residencial = $telefoneController->obterTelefonePorTipo($contato_id, 'residencial')['telefone'] ?? '';
    $telefone_celular = $telefoneController->obterTelefonePorTipo($contato_id, 'celular')['telefone'] ?? '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Telefone</title>
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
        <a href="form-telefone.php">Cadastrar telefone</a>
    </div>
    <div class="container">
        <form action="../models/cadastrar_telefone.php" method="POST">
            <div class="row form-group">
                <div class="col-sm-6">
                    <select class="form-control" name="contato_id" required onchange="this.form.submit()">
                        <option value="">Selecione um contato</option>
                        <?php foreach ($contatos as $contato) : ?>
                            <option value="<?php echo $contato['id']; ?>" <?php echo ($contato_id == $contato['id']) ? 'selected' : ''; ?>><?php echo $contato['nome_completo']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Telefone Comercial" name="telefone_comercial" value="<?php echo $telefone_comercial; ?>">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Telefone Residencial" name="telefone_residencial" value="<?php echo $telefone_residencial; ?>">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Telefone Celular" name="telefone_celular" value="<?php echo $telefone_celular; ?>" required>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Salvar Telefone</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
