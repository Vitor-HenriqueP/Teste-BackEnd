<?php
require_once __DIR__ . '/../controllers/ContatoController.php';
require_once __DIR__ . '/../controllers/EnderecoController.php';
require_once __DIR__ . '/../controllers/TelefoneController.php';

// Verifica se o ID do contato foi fornecido
if (!isset($_GET['id'])) {
    header("Location: contatos.php?errorMessage=ID do contato não fornecido.");
    exit;
}

// Obtém o ID do contato da consulta GET
$contatoId = $_GET['id'];

// Inicializa os controladores
$contatoController = new ContatoController();
$enderecoController = new EnderecoController();
$telefoneController = new TelefoneController();

try {
    // Obtém as informações do contato pelo ID
    $contato = $contatoController->obterContato($contatoId);
    
    // Verifica se o contato foi encontrado
    if (!$contato) {
        throw new Exception("Contato não encontrado.");
    }

    // Obtém o endereço associado ao contato
    $endereco = $enderecoController->obterEnderecoPorContato($contatoId);
    
    // Obtém os telefones associados ao contato
    $telefones = $telefoneController->obterTelefonesPorContato($contatoId);
} catch (Exception $e) {
    // Redireciona de volta à página de contatos com mensagem de erro
    header("Location: contatos.php?errorMessage=" . urlencode($e->getMessage()));
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Contato</title>
</head>
<body>
<h1>Detalhes do Contato</h1>

<h2>Informações do Contato</h2>
<p><strong>Nome Completo:</strong> <?php echo $contato->getNomeCompleto(); ?></p>
<p><strong>CPF:</strong> <?php echo $contato->getCPF(); ?></p>
<p><strong>Email:</strong> <?php echo $contato->getEmail(); ?></p>
<p><strong>Data de Nascimento:</strong> <?php echo date('d/m/Y', strtotime($contato->getDataNascimento())); ?></p>

<h2>Endereço</h2>
<?php if ($endereco) : ?>
    <p><strong>CEP:</strong> <?php echo $endereco->getCEP(); ?></p>
    <p><strong>Endereço:</strong> <?php echo $endereco->getEndereco(); ?></p>
    <p><strong>Número Residencial:</strong> <?php echo $endereco->getNumeroResidencia(); ?></p>
    <p><strong>Bairro:</strong> <?php echo $endereco->getBairro(); ?></p>
    <p><strong>Cidade:</strong> <?php echo $endereco->getCidade(); ?></p>
    <p><strong>UF:</strong> <?php echo $endereco->getUF(); ?></p>
<?php else : ?>
    <p>Nenhum endereço cadastrado para este contato.</p>
<?php endif; ?>

<h2>Telefones</h2>
<?php if (!empty($telefones)) : ?>
    <ul>
        <?php foreach ($telefones as $telefone) : ?>
            <li><?php echo $telefone->getNumero(); ?></li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Nenhum telefone cadastrado para este contato.</p>
<?php endif; ?>

</body>
</html>
