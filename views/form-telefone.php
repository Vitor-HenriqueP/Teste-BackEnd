<?php
require_once '../controllers/ContatoController.php';
require_once '../controllers/TelefoneController.php';

$contatoController = new ContatoController();
$telefoneController = new TelefoneController();
$contatos = $contatoController->obterTodosContatos();
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
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
                    <select class="form-control" name="contato_id" id="contato_id" required onchange="carregarTelefones(this.value)">
                        <option value="">Selecione um contato</option>
                        <?php foreach ($contatos as $contato) : ?>
                            <option value="<?php echo $contato['id']; ?>"><?php echo $contato['nome_completo']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Telefone Comercial" name="telefone_comercial" id="telefone_comercial">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Telefone Residencial" name="telefone_residencial" id="telefone_residencial">
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Telefone Celular" name="telefone_celular" id="telefone_celular" required>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Salvar Telefone</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function carregarTelefones(contatoId) {
            if (contatoId) {
                $.ajax({
                    url: '../models/obter_telefones.php',
                    type: 'GET',
                    data: { contato_id: contatoId },
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            $('#telefone_comercial').val(data.telefone_comercial);
                            $('#telefone_residencial').val(data.telefone_residencial);
                            $('#telefone_celular').val(data.telefone_celular);
                        } else {
                            $('#telefone_comercial').val('');
                            $('#telefone_residencial').val('');
                            $('#telefone_celular').val('');
                        }
                        aplicarMascara();
                    }
                });
            } else {
                $('#telefone_comercial').val('');
                $('#telefone_residencial').val('');
                $('#telefone_celular').val('');
                aplicarMascara();
            }
        }

        function aplicarMascara() {
            $('#telefone_comercial').mask('(00) 0 0000-0000');
            $('#telefone_residencial').mask('(00) 0 0000-0000');
            $('#telefone_celular').mask('(00) 0 0000-0000');
        }

        $(document).ready(function () {
            aplicarMascara();
        });
    </script>
</body>

</html>
