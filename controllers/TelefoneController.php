<?php
require_once __DIR__ . '/../classes/Telefone.php';

class TelefoneController
{
    private $conn;

    public function __construct()
    {
        $host = 'localhost';  
        $db = 'testebackend';
        $user = 'root';       
        $pass = '';           

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function salvarTelefone($contato_id, $telefone_comercial, $telefone_residencial, $telefone_celular)
    {
        $this->salvarOuAtualizarTelefone($contato_id, $telefone_comercial, 'comercial');
        $this->salvarOuAtualizarTelefone($contato_id, $telefone_residencial, 'residencial');
        $this->salvarOuAtualizarTelefone($contato_id, $telefone_celular, 'celular');
    }

    private function salvarOuAtualizarTelefone($contato_id, $telefone, $tipo)
    {
        if (empty($telefone)) {
            return;
        }

        $telefoneExistente = $this->obterTelefonePorTipo($contato_id, $tipo);
        if ($telefoneExistente) {
            $this->atualizarTelefone($contato_id, $telefone, $tipo);
        } else {
            $this->inserirTelefone($contato_id, $telefone, $tipo);
        }
    }

    private function inserirTelefone($contato_id, $telefone, $tipo)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO telefone (contato_id, telefone, tipo) VALUES (:contato_id, :telefone, :tipo)");
            $stmt->bindParam(':contato_id', $contato_id);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erro ao salvar telefone: " . $e->getMessage());
        }
    }

    private function atualizarTelefone($contato_id, $telefone, $tipo)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE telefone SET telefone = :telefone WHERE contato_id = :contato_id AND tipo = :tipo");
            $stmt->bindParam(':contato_id', $contato_id);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar telefone: " . $e->getMessage());
        }
    }

    public function obterTelefonePorTipo($contato_id, $tipo)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM telefone WHERE contato_id = :contato_id AND tipo = :tipo");
            $stmt->bindParam(':contato_id', $contato_id);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erro ao obter telefone: " . $e->getMessage());
        }
    }
}
?>
