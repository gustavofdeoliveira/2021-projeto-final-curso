<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

$protocolo = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == "on") ? "https" : "http");
$id_url = $_SERVER['QUERY_STRING'];
$url = explode("=", $id_url);
$id_pesquisa = $url[1];
$conn = Connection::conectar();

if (!empty($id_pesquisa)) {



    if (($result) and ($result->rowCount() != 0)) {

        while ($row_publicacao = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = [
                'id' => $row_publicacao['id'],
                'titulo' => $row_publicacao['titulo'],
                'categoria' => $row_publicacao['categoria'],
                'resumo' => $row_publicacao['resumo'],
                'imagem' => $row_publicacao['imagem'],
                'texto' => base64_decode($row_publicacao['texto'])
            ];
        }
    }

    $query_termo = "SELECT `a`.`id_rede` FROM `publicacao_termo_rede_termos` as A 
                    INNER JOIN `publicacao` as B ON `b`.`id` = `a`.`id_publicacao` 
                    WHERE `a`.`id_publicacao` =:id";
    $result = $conn->prepare($query_termo);
    $result->bindParam(':id', $id_pesquisa);
    $result->execute();

    if (($result) and ($result->rowCount() != 0)) {
        while ($row_id = $result->fetch(PDO::FETCH_ASSOC)) {
            $id_rede[] = [
                'id_rede' => $row_id['id_rede']
            ];
        }
    }
    $query_termo = "SELECT * FROM `redetermos` WHERE `id` =:id";
    $result = $conn->prepare($query_termo);
    $result->bindParam(':id', $id_pesquisa);
    $result->execute();
    if (($result) and ($result->rowCount() != 0)) {
        $row_rede = $result->fetch(PDO::FETCH_ASSOC);
        $dados['redeTermos'] = $row_rede;
    }
    $retorna = ['erro' => false, 'dados' => $dados];
} else {
    $retorna = ['erro' => true, 'msg' => "Erro: Nenhum usuário encontrado!"];
}

echo json_encode($retorna);
