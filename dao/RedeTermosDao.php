<?php
//Abre conecao com o banco
session_start();
require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

if (!empty($_SESSION['msg_error']) && (time() - $_SESSION['msg_tempo'] > 10)) {
    unset($_SESSION['msg_error']);
} else if (!empty($_SESSION['msg_sucess']) && (time() - $_SESSION['msg_tempo'] > 10)) {
    unset($_SESSION['msg_sucess']);
}

class RedeTermosDao
{
    private $conn;
    function __construct()
    {
        $this->conn = Connection::conectar();
    }
    function inserirRedeTermos(RedeTermosModel $modelo)
    {
        $sql = "SELECT * FROM `redetermos` WHERE `nome`=:nome";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':nome', $modelo->getNome());
        $statement->execute();

        if (!empty($statement->rowCount())) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['nome'] === $modelo->getNome()) {
                throw new \Exception('Rede de termos já cadastrado');
            }
        } else if (empty($statement->rowCount())) {
            $sql = "INSERT INTO `redetermos`(`nome`,`descricao`,`termosIncluidos`,`dataInclusao`) 
              VALUES (  
                  '" . $modelo->getNome() . "', 
                  '" . $modelo->getDescricao() . "', 
                  '" . $modelo->getTermosIncluidos() . "', 
                  CURRENT_DATE())";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $_SESSION["msg_tempo"] = time();
            return $_SESSION["msg_sucess"] = "Rede de termos cadastrado com sucesso!";
        }
    }
}
