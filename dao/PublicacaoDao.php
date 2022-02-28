<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
                    $_SESSION["tempo_msg_sucess"] = time();
                    exit();
                }
            }
            $_SESSION["tempo_msg_sucess"] = time();
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

    function listarPublicacao()
    {
        $sql = "SELECT * FROM `publicacao` ORDER BY `id` DESC";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        if (($statement) and ($statement->rowCount() != 0)) {
            while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
                $publicacoes[] = $result;
            }
            return $publicacoes;
        }
    }

    function pesquisaPublicacao(PublicacaoModel $modelo)
    {
        $id_pesquisa = $modelo->getId();
        $sql = "SELECT * FROM `publicacao` WHERE `id`=:id OR `titulo`=:id";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':id', $id_pesquisa);
        $statement->execute();
        if (($statement) and ($statement->rowCount() != 0)) {
            $publicacao[] = $statement->fetch(PDO::FETCH_ASSOC);
        }
        $sql = "SELECT * FROM `publicacao_termo_rede_termos` as A 
                    INNER JOIN `publicacao` as B ON `b`.`id` = `a`.`id_publicacao` 
                    WHERE `a`.`id_publicacao` =:id";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':id', $id_pesquisa);
        $statement->execute();
        if (($statement) and ($statement->rowCount() != 0)) {
            while ($resultado = $statement->fetch(PDO::FETCH_ASSOC)) {
                $termos[] = $resultado['id_termo'];
                $rede[] = $resultado['id_rede'];
            }
            $_SESSION['id_termos'] = $termos;
            $_SESSION['id_rede'] = $rede[0];
            return $publicacao;
        }
    }
    function atualizarPublicacao(PublicacaoModel $modelo)
    {
        $sql = "DELETE FROM `publicacao_termo_rede_termos` WHERE `id_publicacao`=:id";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':id', $modelo->getId());
        $statement->execute();
        $termos =  $modelo->getTermosId();
        $id_termos = explode(",", $termos);
        $numeroTermos = count($id_termos) - 1;
        $id_publicacao = $modelo->getId();
        $id_rede = $modelo->getRedeTermosId();
        for ($a = 0; $a != $numeroTermos; $a++) {
            try {
                $sql = "INSERT INTO `publicacao_termo_rede_termos` (`id_publicacao`,`id_rede`,`id_termo`) VALUES (?,?,?)";
                $statement = $this->conn->prepare($sql);
                $statement->bindParam(1, $id_publicacao);
                $statement->bindParam(2, $id_rede);
                $statement->bindParam(3, $id_termos[$a]);
                $statement->execute();
            } catch (Exception $e) {
                $_SESSION["msg_error"] = $e->getMessage();
                print_r($_SESSION["msg_error"]);
                $_SESSION["tempo_msg_sucess"] = time();
                exit();
            }
        }
        if (!empty($modelo->getImagem())) {
            $texto  = base64_encode($modelo->getTexto());
            $sql = "UPDATE `publicacao` SET 
            `titulo` = '" . $modelo->getTitulo() . "',
            `categoria` = '" . $modelo->getCategoria() . "',
            `resumo` = '" . $modelo->getResumo() . "',
            `imagem` = '" . $modelo->getImagem() . "',
            `texto` = '" . $texto . "' WHERE `id`=:id";
        } else {
            $texto  = base64_encode($modelo->getTexto());
            $sql = "UPDATE `publicacao` SET 
            `titulo` = '" . $modelo->getTitulo() . "', 
            `categoria` = '" . $modelo->getCategoria() . "',
            `resumo` = '" . $modelo->getResumo() . "',
            `texto` = '" . $texto . "' WHERE `id`=:id";
        }
        $statement = $this->conn->prepare($sql);
        $statement->bindValue(':id', $id_publicacao);
        $statement->execute();
        $_SESSION["tempo_msg_sucess"] = time();
        $_SESSION["msg_sucess"] = "Publicação editada com sucesso!";
        return $id_publicacao;
    }
}
