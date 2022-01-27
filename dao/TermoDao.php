<?php
//Abre conecao com o banco
session_start();
require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

if (!empty($_SESSION['msg_error']) && (time() - $_SESSION['tempo_msg_error'] > 20)) {
    unset($_SESSION['msg_error']);
}
if (!empty($_SESSION['msg_sucess']) && (time() - $_SESSION['tempo_msg_sucess'] > 20)) {
    unset($_SESSION['msg_sucess']);
}
class TermoDao
{
    private $conn;
    function __construct()
    {
        $this->conn = Connection::conectar();
    }
    function inserirTermo(TermoModel $modelo)
    {
        $sql = "SELECT * FROM `termo` WHERE `nome`=:nome";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':nome', $modelo->getNome());
        $statement->execute();
        //Se achar o usuario
        if (!empty($statement->rowCount())) {
            //Guarda em um array os dados retornado do banco

            $result = $statement->fetch(PDO::FETCH_ASSOC);
            //Se a senha estiver correta
            if ($result['nome'] === $modelo->getNome()) {
                throw new \Exception('Termo já cadastrado');
            }
        }
        if (empty($statement->rowCount())) {
            $sql = "INSERT INTO `termo`(`tipoTermo`,`nome`,`nomeVariavel`,`conceito`,`dataInclusao`) 
             VALUES ( 
                 '" . $modelo->getTipoTermo() . "', 
                 '" . $modelo->getNome() . "', 
                 '" . $modelo->getNomeVariavel() . "', 
                 '" . $modelo->getConceito() . "', 
                 CURRENT_DATE())";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $_SESSION["tempo_msg_sucess"] = time();
            return $_SESSION["msg_sucess"] = "Termo cadastrado com sucesso!";
        }
    }

    function deletarTermo(TermoModel $modelo)
    {
        $sql = "DELETE `termo`, `rede_termos_termo` FROM `termo`
                LEFT JOIN `rede_termos_termo` ON `termo`.`id` = `rede_termos_termo`.`id_termo`
                WHERE `termo`.`id` = :id";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue("id", $modelo->getId());
        $statement->execute();
        $_SESSION["msg_sucess"] = "Termo " . $modelo->getId() . " excluído!";
        $_SESSION["tempo_msg_sucess"] = time();
    }

    function atualizarTermo(TermoModel $modelo)
    {

        $sql = "UPDATE `termo` SET 
        `tipoTermo` = '" . $modelo->getTipoTermo() . "',
        `nome` = '" . $modelo->getNome() . "',
        `nomeVariavel` ='" . $modelo->getNomeVariavel() . "',
        `conceito` ='" . $modelo->getConceito() . "' WHERE `id`=:id";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue("id", $modelo->getId());
        $statement->execute();
        $_SESSION["tempo_msg"] = time();
        return $_SESSION["msg_sucess"] = "Termo atualizado com sucesso!";
    }
}
