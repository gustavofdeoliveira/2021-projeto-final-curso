<?php
session_start();
require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

if (!empty($_SESSION["msg_error"]) and (time() - $_SESSION["tempo_msg_error"] > 20)) {
    unset($_SESSION["msg_error"]);
}
if (!empty($_SESSION["msg_sucess"]) && (time() - $_SESSION["tempo_msg_sucess"] > 20)) {
    unset($_SESSION["msg_sucess"]);
}

class PublicacaoDao
{
    private $conn;
    function __construct()
    {
        $this->conn = Connection::conectar();
    }
    function inserirPublicacao(PublicacaoModel $modelo)
    {
        $sql = "SELECT * FROM `publicacao` WHERE `titulo`=:titulo";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':titulo', $modelo->getTitulo());
        $statement->execute();
        $texto_publicacao = base64_encode($modelo->getTexto());

        if (!empty($statement->rowCount())) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['titulo'] === $modelo->getTitulo()) {
                throw new \Exception('Publicação com o mesmo nome já cadastrada!');
            }
        } else if (empty($statement->rowCount())) {
            $sql = "INSERT INTO `publicacao` (`titulo`,`categoria`,`numeroVisualizacao`,`resumo`,`imagem`,`texto`,`dataInclusao`)
                 VALUES (  
                     '" . $modelo->getTitulo() . "', 
                     '" . $modelo->getCategoria() . "',
                     0,
                     '" . $modelo->getResumo() . "',
                     '" . $modelo->getImagem() . "',
                     '" . $texto_publicacao . "',
                     CURRENT_DATE())";

            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $id_publicacao = $this->conn->lastInsertId();
            $id_termos = explode(",", $modelo->getTermosId());
            $id_rede = $modelo->getRedeTermosId();
            for ($a = 0; $a != count($id_termos); $a++) {
                try {
                    $sql = "INSERT INTO `publicacao_termo_rede_termos` (`id_publicacao`,`id_rede`,`id_termo`) VALUES (?,?,?)";
                    $statement = $this->conn->prepare($sql);
                    $statement->bindParam(1, $id_publicacao);
                    $statement->bindParam(2, $id_rede);
                    $statement->bindParam(3, $id_termos[$a]);
                    $statement->execute();
                } catch (Exception $e) {
                    $_SESSION["msg_error"] = $e->getMessage();
                    $_SESSION["msg_tempo_error"] = time();
                    exit();
                }
            }
            $_SESSION["msg_tempo_sucess"] = time();
            $_SESSION["msg_sucess"] = "Publicação cadastrada com sucesso!";
            return $id_publicacao;
        }
    }

    function excluirPublicacao(PublicacaoModel $modelo)
    {
        $sql = "DELETE `publicacao`, `publicacao_termo_rede_termos` FROM `publicacao` 
        LEFT JOIN `publicacao_termo_rede_termos` ON `publicacao_termo_rede_termos`.`id_publicacao` = `publicacao`.`id` 
        WHERE `publicacao`.`id` = :id";

        $statement = $this->conn->prepare($sql);
        $statement->bindValue("id", $modelo->getId());
        $statement->execute();
        $_SESSION["msg_sucess"] = "Publicação " . $modelo->getId() . " excluído!";
        $_SESSION["tempo_msg_sucess"] = time();
    }
}
