<?php

class Telefone
{
    private $id;
    private $contato_id;
    private $telefone_comercial;
    private $telefone_residencial;
    private $telefone_celular;

    public function __construct($contato_id, $telefone_comercial, $telefone_residencial, $telefone_celular)
    {
        $this->contato_id = $contato_id;
        $this->telefone_comercial = $telefone_comercial;
        $this->telefone_residencial = $telefone_residencial;
        $this->telefone_celular = $telefone_celular;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getContatoId()
    {
        return $this->contato_id;
    }

    public function setContatoId($contato_id)
    {
        $this->contato_id = $contato_id;
    }

    public function getTelefone()
    {
        return $this->telefone_comercial;
    }

    public function setTelefone($telefone_comercial)
    {
        $this->telefone_comercial = $telefone_comercial;
    }

    public function getTelefoneResidencial()
    {
        return $this->telefone_residencial;
    }

    public function setTelefoneResidencial($telefone_residencial)
    {
        $this->telefone_residencial = $telefone_residencial;
    }

    public function getTelefoneCelular()
    {
        return $this->telefone_celular;
    }

    public function setTelefoneCelular($telefone_celular)
    {
        $this->telefone_celular = $telefone_celular;
    }
}

?>
