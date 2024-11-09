<?php

$dbname = "bd_crud";
$host = "localhost";
$usuario = "root";
$senha = "";

$conexao = new Usuario($dbname, $host, $usuario, $senha);

class Usuario
{
    private $conexao;

    public function __construct($dbname, $host, $usuario, $senha)
    {
        $this->conexao = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $usuario, $senha);
    }

    public function addUsuario($nome, $tel, $email)
    {

        $sql = $this->conexao->prepare("INSERT INTO usuario (nome, telefone, email) VALUE (:n, :t, :e)");
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":t", $tel);
        $sql->bindValue(":e", $email);
        $sql->execute();
    }
    // Função para listar todos os usuários
    public function listarUsuarios()
    {
        $usuarios = array(); //Declarando um array
        $sql = $this->conexao->query("SELECT * FROM usuario"); //
        $usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $usuarios; //retornar o vetor com todos usuarios
    }

    //Buscar um usuario especifico
    public function buscarUsuario($id)
    {
        $usuario = array();
        $sql = $this->conexao->query("SELECT * FROM usuario WHERE id = '$id'");
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

    //Apagar usuario
    public function apagarUsuario($id)
    {
        $sql = $this->conexao->query("DELETE FROM usuario WHERE id = '$id'");
    }
}
