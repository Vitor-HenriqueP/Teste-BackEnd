<?php
require_once __DIR__ . '/../controllers/ContatoController.php';
require_once __DIR__ . '/../controllers/EnderecoController.php';
require_once __DIR__ . '/../controllers/TelefoneController.php';

if (!isset($_GET['id'])) {
    header("Location: contatos.php?errorMessage=ID do contato não fornecido.");
    exit;
}
$contatoId = $_GET['id'];
$contatoController = new ContatoController();
$enderecoController = new EnderecoController();
$telefoneController = new TelefoneController();

try {
    $contato = $contatoController->obterContato($contatoId);
    if (!$contato) {
        throw new Exception("Contato não encontrado.");
    }
    $endereco = $enderecoController->obterEnderecoPorContato($contatoId);
    $telefones = $telefoneController->obterTelefonesPorContato($contatoId);
} catch (Exception $e) {
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
        <li>
            <?php echo $telefones['telefone_celular'] ? "Telefone Celular: " . $telefones['telefone_celular'] : "Nenhum telefone celular cadastrado"; ?>
        </li>
        <li>
            <?php echo $telefones['telefone_comercial'] ? "Telefone Comercial: " . $telefones['telefone_comercial'] : "Nenhum telefone comercial cadastrado"; ?>
        </li>
        <li>
            <?php echo $telefones['telefone_residencial'] ? "Telefone Residencial: " . $telefones['telefone_residencial'] : "Nenhum telefone residencial cadastrado"; ?>
        </li>
    </ul>
<?php else : ?>
    <p>Nenhum telefone cadastrado para este contato.</p>
<?php endif; ?>




</body>
</html>