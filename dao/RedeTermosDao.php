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
            $sql = "INSERT INTO `redetermos`(`nome`,`descricao`,`dataInclusao`) 
               VALUES (  
                   '" . $modelo->getNome() . "', 
                   '" . $modelo->getDescricao() . "', 
                   CURRENT_DATE())";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $id = $this->conn->lastInsertId();
            $id_termos = explode(",", $modelo->getTermosIncluidos());
            for ($a = 0; $a != count($id_termos); $a++) {
                try {
                    $sql = "INSERT INTO `rede_termos_termo` (`id_rede`,`id_termo`) VALUES (?,?)";
                    $statement = $this->conn->prepare($sql);
                    $statement->bindParam(1, $id);
                    $statement->bindParam(2, $id_termos[$a]);
                    $statement->execute();

                    $_SESSION["msg_tempo"] = time();
                } catch (Exception $e) {
                    print_r($e->getMessage());
                    exit();
                }
            }
            return $_SESSION["msg_sucess"] = "Rede de termos cadastrado com sucesso!";
        }
    }
}
