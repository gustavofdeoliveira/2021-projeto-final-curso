<?php
//Abre conecao com o banco
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
            $sql = "INSERT INTO `termo`(`tipoTermo`,`nome`,`conceito`,`dataInclusao`) 
             VALUES ( 
                 '" . $modelo->getTipoTermo() . "', 
                 '" . $modelo->getNome() . "', 
                 '" . $modelo->getConceito() . "', 
                 CURRENT_DATE())";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $_SESSION["tempo_msg_sucess"] = time();
            $_SESSION["msg_sucess"] = "Termo cadastrado com sucesso!";
            $id_termo = $this->conn->lastInsertId();
            return $id_termo;
        }
    }

    function excluirTermo(TermoModel $modelo)
    {
        $id_termo = $modelo->getId();
        $sql = "DELETE FROM `usuarios_termos_salvos`  WHERE  `id_termo` = :id_termo";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':id_termo', $id_termo);
        $statement->execute();

        $sql = "DELETE `termo`, `rede_termos_termo` FROM `termo`
                LEFT JOIN `rede_termos_termo` ON `termo`.`id` = `rede_termos_termo`.`id_termo`
                WHERE `termo`.`id` = :id_termo";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue("id_termo", $modelo->getId());
        $statement->execute();
        $_SESSION["msg_sucess"] = "Termo " . $modelo->getId() . " excluído!";
        $_SESSION["tempo_msg_sucess"] = time();
    }

    function atualizarTermo(TermoModel $modelo)
    {

        $sql = "UPDATE `termo` SET 
        `tipoTermo` = '" . $modelo->getTipoTermo() . "',
        `nome` = '" . $modelo->getNome() . "',
        `conceito` ='" . $modelo->getConceito() . "' WHERE `id`=:id";
        $statement = $this->conn->prepare($sql);
        $statement->bindValue("id", $modelo->getId());
        $statement->execute();
        $_SESSION["tempo_msg_sucess"] = time();
        $_SESSION["msg_sucess"] = "Termo atualizado com sucesso!";
        $id_termo = $modelo->getId();
        return $id_termo;
    }

    function listarTermo()
    {
        $sql = "SELECT * FROM `termo` ORDER BY `id` DESC";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        if (($statement) and ($statement->rowCount() != 0)) {
            while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
                $termos[] = $result;
            }
            return $termos;
        }
    }
    function ordenarTermo($letraPesquisa)
    {
        try {
            $sql = "SELECT * FROM `termo` WHERE `nome` LIKE '$letraPesquisa%'";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            if (($statement) and ($statement->rowCount() != 0)) {
                while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $termos[] = $result;
                }
                return $termos;
            } else {
                throw new \Exception('Dados não encontrado!');
            }
        } catch (\Exception $e) {
            $_SESSION["msg_error"] = $e->getMessage();
            $_SESSION["tempo_msg_error"] = time();
            print_r($_SESSION["msg_error"]);
            header("Location:../view/Biblioteca.php");
        }
    }
    function salvarTermo(TermoModel $modelo)
    {
        $id_usuario = $_SESSION['usuarioAutenticado']['idUsuario'];
        $id_termo = $modelo->getId();
        $sql = "INSERT INTO `usuarios_termos_salvos` (`id_usuario`,`id_termo`,`dataInclusao`) 
        VALUES (?,?, CURRENT_DATE())";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(1, $id_usuario);
        $statement->bindParam(2, $id_termo);
        $statement->execute();
        $_SESSION["tempo_msg_sucess"] = time();
        $_SESSION["msg_sucess"] = "Termo favoritada com sucesso!";
        return $id_termo;
    }
    function removerTermo(TermoModel $modelo)
    {
        $id_usuario = $_SESSION['usuarioAutenticado']['idUsuario'];
        $id_termo = $modelo->getId();
        $sql = "DELETE FROM `usuarios_termos_salvos`  WHERE `id_usuario` = :id_usuario AND `id_termo` = :id_termo";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':id_usuario', $id_usuario);
        $statement->bindParam(':id_termo', $id_termo);
        $statement->execute();
        $_SESSION["tempo_msg_sucess"] = time();
        $_SESSION["msg_sucess"] = "Termo desfavoritada com sucesso!";
        return $id_termo;
    }
    function verTermo(TermoModel $modelo)
    {
        $id_termo = $modelo->getId();
        $sql = "SELECT * FROM `termo` WHERE `id`= :id_termo";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':id_termo', $id_termo);
        $statement->execute();
        if (($statement) and ($statement->rowCount() != 0)) {
            while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
                $termo[] = $result;
            }
            return $termo;
        }
    }
    function pesquisaTermo($id_termo)
    {
        $sql = "SELECT * FROM `termo` WHERE `id`= :id_termo";
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':id_termo', $id_termo);
        $statement->execute();
        if (($statement) and ($statement->rowCount() != 0)) {
            while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
                $termo[] = $result;
            }
            return $termo;
        }
    }
    function listagemTermosSalvos()
    {
        $id_usuario = $_SESSION['usuarioAutenticado']['idUsuario'];
        $sql = "SELECT * FROM `usuarios_termos_salvos` WHERE `id_usuario`= $id_usuario ORDER BY `dataInclusao` DESC";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        if (($statement) and ($statement->rowCount() != 0)) {
            while ($resultado = $statement->fetch(PDO::FETCH_ASSOC)) {
                $termos_salvos[] = $resultado;
            }
            for ($a = 0; $a != count($termos_salvos); $a++) {
                $id_termo = $termos_salvos[$a]['id_termo'];
                $sql = "SELECT * FROM `termo` WHERE `id`='$id_termo' ORDER BY `dataInclusao` DESC";
                $statement = $this->conn->prepare($sql);
                $statement->execute();
                if (($statement) and ($statement->rowCount() != 0)) {
                    while ($resultado = $statement->fetch(PDO::FETCH_ASSOC)) {
                        $termos[$a] = $resultado;
                    }
                }
            }
            return $termos;
        } else {
            return null;
        }
    }
}
