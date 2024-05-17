<?php
require_once __DIR__ . '/../config/database.php';

class Endereco
{
    private $cep;
    private $endereco;
    private $numero_residencia;
    private $bairro;
    private $cidade;
    private $uf;

    public function __construct($cep, $endereco, $numero_residencia, $bairro, $cidade, $uf)
    {
        $this->cep = $cep;
        $this->endereco = $endereco;
        $this->numero_residencia = $numero_residencia;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->uf = $uf;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getNumeroResidencia()
    {
        return $this->numero_residencia;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function getUf()
    {
        return $this->uf;
    }

    public function salvarEndereco($contato_id)
    {
        try {
            $conn = Database::getConnection();

            $sql = "SELECT * FROM enderecos WHERE contato_id = :contato_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':contato_id', $contato_id);
            $stmt->execute();
            $enderecoExistente = $stmt->fetch();

            if ($enderecoExistente) {
                $sql = "UPDATE enderecos SET cep = :cep, endereco = :endereco, numero_residencia = :numero_residencia, bairro = :bairro, cidade = :cidade, uf = :uf WHERE contato_id = :contato_id";
            } else {
                $sql = "INSERT INTO enderecos (contato_id, cep, endereco, numero_residencia, bairro, cidade, uf) VALUES (:contato_id, :cep, :endereco, :numero_residencia, :bairro, :cidade, :uf)";
            }

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':contato_id', $contato_id);
            $stmt->bindParam(':cep', $this->cep);
            $stmt->bindParam(':endereco', $this->endereco);
            $stmt->bindParam(':numero_residencia', $this->numero_residencia);
            $stmt->bindParam(':bairro', $this->bairro);
            $stmt->bindParam(':cidade', $this->cidade);
            $stmt->bindParam(':uf', $this->uf);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao salvar endereço: " . $e->getMessage();
        }
    }
}
?>
