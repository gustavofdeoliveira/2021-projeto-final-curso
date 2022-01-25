<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));


$protocolo = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == "on") ? "https" : "http");
$id_url = $_SERVER['QUERY_STRING'];
$url = explode("=", $id_url);
$id_pesquisa = $url[1];
$conn = Connection::conectar();

// $id_pesquisa = 18;
if (!empty($id_pesquisa)) {

    $query_termo = "SELECT `id`,`nome`,`descricao`,`dataInclusao` FROM redetermos WHERE `id`=:id";
    $result = $conn->prepare($query_termo);
    $result->bindParam(':id', $id_pesquisa);
    $result->execute();


    if (($result) and ($result->rowCount() != 0)) {

        while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = [
                'id' => $row_termo['id'],
                'nome' => $row_termo['nome'],
                'descricao' => $row_termo['descricao'],
                'dataInclusao' => $row_termo['dataInclusao']
            ];
        }

        
    } 

    $query_termo = "SELECT `a`.`id`, `a`.`id_rede`, `a`.`id_termo` FROM `rede_termos_termo` as A INNER JOIN `redetermos` as B ON `b`.`id` = `a`.`id_rede` WHERE `a`.`id_rede` = :id";
    $result = $conn->prepare($query_termo);
    $result->bindParam(':id', $id_pesquisa);
    $result->execute();
    if (($result) and ($result->rowCount() != 0)) {
        while ($row_id = $result->fetch(PDO::FETCH_ASSOC)) {
            $id_termos[] = [
                'id_termo' => $row_id['id_termo']
            ];
        }
    }

    for ($a = 0; $a != count($id_termos); $a++) {
        $id = $id_termos[$a]['id_termo'];

        $query_termo = "SELECT * FROM `termo` WHERE `id` =:id";
        $result = $conn->prepare($query_termo);
        $result->bindParam(':id', $id);
        $result->execute();

        while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[1]['termos'][$a] = [
                'id' => $row_termo['id'],
                'nome' => $row_termo['nome']
            ];
        }
    }
    $retorna = ['erro' => false, 'dados' => $dados];
} else {
    $retorna = ['erro' => true, 'msg' => "Erro: Nenhum usuário encontrado!"];
}

echo json_encode($retorna);
