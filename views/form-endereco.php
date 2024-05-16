<?php
require_once '../controllers/ContatoController.php';
$contatoController = new ContatoController();
$contatos = $contatoController->obterTodosContatos();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <div class="container">
        <form action="../models/cadastrar_endereco.php" method="POST">

            <div class="row form-group">
                <div class="col-sm-6">
                    <select class="form-control" name="contato_id" required>
                        <option value="">Selecione um contato</option>
                        <?php foreach ($contatos as $contato) : ?>
                            <?php if (!$contato['endereco']) : ?>
                                <option value="<?php echo $contato['id']; ?>"><?php echo $contato['nome_completo']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="CEP" onblur="getDadosEnderecoPorCEP(this.value)" name="cep" required>
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Rua" name="endereco" id="endereco" required>
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="Número" name="numero_residencia" required>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Bairro" name="bairro" id="bairro" required>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Cidade" name="cidade" id="cidade" required>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="uf" id="uf">
                        <option value="">Selecione um estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Salvar Endereço</button>
                </div>
            </div>
        </form>
    </div>
</body>

<script>
    function getDadosEnderecoPorCEP(cep) {
        let url = 'https://viacep.com.br/ws/' + cep + '/json/';

        let xmlHttp = new XMLHttpRequest();
        xmlHttp.open('GET', url);

        xmlHttp.onreadystatechange = () => {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                let dadosJSONText = xmlHttp.responseText;
                let dados = JSON.parse(dadosJSONText);
                document.getElementById('endereco').value = dados.logradouro;
                document.getElementById('bairro').value = dados.bairro;
                document.getElementById('cidade').value = dados.localidade;
                document.getElementById('uf').value = dados.uf;
            }
        }

        xmlHttp.send()

    }
</script>

</html>