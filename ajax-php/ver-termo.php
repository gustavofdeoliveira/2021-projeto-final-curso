<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));


$protocolo = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == "on") ? "https" : "http");
$id_url = $_SERVER['QUERY_STRING'];
$url = explode("=", $id_url);
$id_pesquisa = $url[1];
$conn = Connection::conectar();

// $id_pesquisa = 18;
if (!empty($id_pesquisa)) {

    $query_termo = "SELECT * FROM `termo` WHERE `id`=:id";
    $result = $conn->prepare($query_termo);
    $result->bindParam(':id', $id_pesquisa);
    $result->execute();


    if (($result) and ($result->rowCount() != 0)) {

        while ($row_publicacao = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados['termo'] = [
                'id' => $row_publicacao['id'],
                'nome' => $row_publicacao['nome'],
                'conceito' => $row_publicacao['conceito']
            ];
        }
    }

    $query_termo = "SELECT `id_publicacao` FROM `publicacao_termo_rede_termos` as A INNER JOIN `termo` as B ON `b`.`id` = `a`.`id_termo` WHERE `a`.`id_termo` = :id LIMIT 3";
    $result = $conn->prepare($query_termo);
    $result->bindParam(':id', $id_pesquisa);
    $result->execute();
    if (($result) and ($result->rowCount() != 0)) {
        while ($row_id = $result->fetch(PDO::FETCH_ASSOC)) {
            $id_publicacao[] = [
                'id_publicacao' => $row_id['id_publicacao']
            ];
        }

        for ($a = 0; $a != count($id_publicacao); $a++) {
            $id = $id_publicacao[$a]['id_publicacao'];

            $query_termo = "SELECT * FROM `publicacao` WHERE `id` =:id";
            $result = $conn->prepare($query_termo);
            $result->bindParam(':id', $id);
            $result->execute();

            while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados['semelhantes'][$a] = [
                    'id' => $row_termo['id'],
                    'titulo' => $row_termo['titulo'],
                    'imagem' => $row_termo['imagem']

                ];
            }
        }
    }
    $query_termo = "SELECT `id_rede` FROM `rede_termos_termo` as A INNER JOIN `redetermos` as B ON `b`.`id` = `a`.`id_rede` WHERE `a`.`id_termo` = :id LIMIT 3";
    $result = $conn->prepare($query_termo);
    $result->bindParam(':id', $id_pesquisa);
    $result->execute();
    if (($result) and ($result->rowCount() != 0)) {
        while ($row_id = $result->fetch(PDO::FETCH_ASSOC)) {
            $id_redes[] = [
                'id_rede' => $row_id['id_rede']
            ];
        }
        for ($a = 0; $a != count($id_redes); $a++) {
            $id = $id_redes[$a]['id_rede'];

            $query_rede = "SELECT * FROM `redetermos` WHERE `id` =:id";
            $result = $conn->prepare($query_rede);
            $result->bindParam(':id', $id);
            $result->execute();

            while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados['redeTermos'][$a] = [
                    'id' => $row_termo['id'],
                    'nome' => $row_termo['nome']
                ];
            }
        }
    }
    $query_termo = "SELECT `id_termo` FROM `rede_termos_termo` as A INNER JOIN `redetermos` as B ON `b`.`id` = `a`.`id_rede` WHERE `a`.`id_rede` = :id LIMIT 3;";
    $result = $conn->prepare($query_termo);
    $result->bindParam(':id', $id_pesquisa);
    $result->execute();

    if (($result) and ($result->rowCount() != 0)) {
        while ($row_id = $result->fetch(PDO::FETCH_ASSOC)) {
            $id_termos[] = [
                'id_termo' => $row_id['id_termo']
            ];
        }
        for ($a = 0; $a != count($id_id_termos); $a++) {
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
