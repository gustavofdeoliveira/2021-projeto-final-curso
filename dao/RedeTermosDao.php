<?php
//Abre conecao com o banco
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

if (!empty($_SESSION["msg_error"]) && (time() - $_SESSION["tempo_msg_error"] > 20)) {
    unset($_SESSION["msg_error"]);
}
if (!empty($_SESSION["msg_sucess"]) && (time() - $_SESSION["tempo_msg_sucess"] > 20)) {
    unset($_SESSION["msg_sucess"]);
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
            $id_termos = explode(",", $modelo->getTermosIncluidos());
            $id_termos_repetidos = array_unique($id_termos);
            if(count($id_termos) <= 1){
                throw new \Exception('Erro ao cadastrar a Rede: Uma Rede precisa ter mais de 2 Termos, para ser cadastrada!');
            }
            if(count($id_termos_repetidos) != count($id_termos)){
                throw new \Exception('Erro ao cadastrar a Rede: Duplicata nos Termos selecionados!');
            }
            $sql = "INSERT INTO `redetermos`(`nome`,`descricao`,`dataInclusao`) 
               VALUES (  
                   '" . $modelo->getNome() . "', 
                   '" . $modelo->getDescricao() . "', 
                   CURRENT_DATE())";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $id = $this->conn->lastInsertId();
            
            for ($a = 0; $a != count($id_termos); $a++) {
                try {
                    $sql = "INSERT INTO `rede_termos_termo` (`id_rede`,`id_termo`) VALUES (?,?)";
                    $statement = $this->conn->prepare($sql);
                    $statement->bindParam(1, $id);
                    $statement->bindParam(2, $id_termos[$a]);
                    $statement->execute();
                } catch (Exception $e) {
                    print_r($e->getMessage());
                    exit();
                }
            }
            $_SESSION["msg_sucess"] = "Rede de termos cadastrado com sucesso!";
            $_SESSION["tempo_msg_sucess"] = time();
        }
    }
    function excluirRedeTermos(RedeTermosModel $modelo)
    {
        $sql = "UPDATE`publicacao_termo_rede_termos` SET `id_rede` = '0' 
                WHERE `id_rede` = :id";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue("id", $modelo->getId());
        $statement->execute();

        $sql = "DELETE `redetermos`, `rede_termos_termo` FROM `redetermos` 
                LEFT JOIN `rede_termos_termo` ON `rede_termos_termo`.`id_rede` = `redetermos`.`id` 
                WHERE `redetermos`.`id` = :id";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue("id", $modelo->getId());
        $statement->execute();
        $_SESSION["msg_sucess"] = "Rede de Termos " . $modelo->getId() . " excluído!";
        $_SESSION["tempo_msg_sucess"] = time();
    }
    function excluirTermo(RedeTermosModel $modelo)
    {
        $id_url = $_SERVER['HTTP_REFERER'];
        $url = explode("=", $id_url);
        $id_rede = $url[1];
        $sql = "DELETE FROM `rede_termos_termo` WHERE `id_rede`=$id_rede AND `id_termo` = :id";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue("id", $modelo->getId());
        $statement->execute();
        $_SESSION["msg_sucess"] = "Rede de Termos " . $modelo->getId() . " excluída!";
        $_SESSION["tempo_msg_sucess"] = time();
        return $id_rede;
    }
    function atualizarRedeTermos(RedeTermosModel $modelo)
    {
        $sql = "UPDATE `redetermos` SET `nome` = '" . $modelo->getNome() . "', 
                `descricao`='" . $modelo->getDescricao() . "'  WHERE `id`=:id";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':id', $modelo->getId());
        $statement->execute();
        $id = $modelo->getId();
        $id_termos = explode(",", $modelo->getTermosIncluidos());

        for ($a = 0; $a != count($id_termos); $a++) {
            $sql = "SELECT `id_rede`,`id_termo` FROM `rede_termos_termo` WHERE `id_rede`=$id AND `id_termo`=$id_termos[$a]";
            $statement = $this->conn->prepare($sql);
            $statement->execute();

            if (empty($statement->rowCount())) {
                $sql = "INSERT INTO `rede_termos_termo`(`id_rede`,`id_termo`) 
               VALUES  (?,?)";
                $statement = $this->conn->prepare($sql);
                $statement->bindParam(1, $id);
                $statement->bindParam(2, $id_termos[$a]);
                $statement->execute();
            }
        }
        $_SESSION["msg_sucess"] = "Rede de termos atualizada com sucesso!";
        $_SESSION["tempo_msg_sucess"] = time();
        return $id;
    }
    function listarRedeTermos()
    {
        $sql = "SELECT * FROM `redetermos` ORDER BY `id` DESC";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        if (($statement) and ($statement->rowCount() != 0)) {
            while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
                $redeTermos[] = $result;
            }
            return $redeTermos;
        }
    }
    function pesquisaRedeTermos($id_pesquisa)
    {
        $sql = "SELECT * FROM `redetermos` WHERE `id` =:id";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':id', $id_pesquisa);
        $statement->execute();
        if (($statement) and ($statement->rowCount() != 0)) {
            $rede[] = $statement->fetch(PDO::FETCH_ASSOC);
            return $rede;
        }
    }
}
