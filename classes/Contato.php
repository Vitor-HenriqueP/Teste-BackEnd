<?php


class Contato {
    private $nomeCompleto;
    private $cpf;
    private $email;
    private $dataNascimento;

    public function __construct($nomeCompleto, $cpf, $email, $dataNascimento) {
        $this->nomeCompleto = $nomeCompleto;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->dataNascimento = $dataNascimento;
    }

    public function getNomeCompleto() {
        return $this->nomeCompleto;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function setNomeCompleto($nomeCompleto) {
        $this->nomeCompleto = $nomeCompleto;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }
}
?>
