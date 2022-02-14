<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));


$protocolo = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == "on") ? "https" : "http");
$id_url = $_SERVER['QUERY_STRING'];
$url = explode("=", $id_url);
$id_pesquisa = $url[1];
$conn = Connection::conectar();

// $id_pesquisa = 18;
if (!empty($id_pesquisa)) {

    $query_publicacao = "SELECT * FROM `redeTermos` WHERE `id`=:id";
    $result = $conn->prepare($query_publicacao);
    $result->bindParam(':id', $id_pesquisa);
    $result->execute();


    if (($result) and ($result->rowCount() != 0)) {

        while ($row_publicacao = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados['redeTermos'] = [
                'id' => $row_publicacao['id'],
                'nome' => $row_publicacao['nome'],
                'descricao' => $row_publicacao['descricao']
            ];
        }
    }

    $query_termo = "SELECT * FROM `rede_termos_termo` as A INNER JOIN `redeTermos` as B ON `b`.`id` = `a`.`id_rede` WHERE `a`.`id_rede` = :id";
    $result = $conn->prepare($query_termo);
    $result->bindParam(':id', $id_pesquisa);
    $result->execute();
    if (($result) and ($result->rowCount() != 0)) {
        while ($row_id = $result->fetch(PDO::FETCH_ASSOC)) {
            $id_termos[] = [
                'id_termo' => $row_id['id_termo']
            ];
        }
        for ($a = 0; $a != count($id_termos); $a++) {
            $id = $id_termos[$a]['id_termo'];

            $query_termo = "SELECT * FROM `termo` WHERE `id` =:id";
            $result = $conn->prepare($query_termo);
            $result->bindParam(':id', $id);
            $result->execute();

            while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados['termos'][$a] = [
                    'id' => $row_termo['id'],
                    'nome' => $row_termo['nome']
                ];
            }
        }
    }
    $retorna = ['erro' => false, 'dados' => $dados];
} else {
    $retorna = ['erro' => true, 'msg' => "Erro: Nenhum usuário encontrado!"];
}

echo json_encode($retorna);