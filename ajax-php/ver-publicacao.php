<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));


$protocolo = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == "on") ? "https" : "http");
$id_url = $_SERVER['QUERY_STRING'];
$url = explode("=", $id_url);
$id_pesquisa = $url[1];
$conn = Connection::conectar();

// $id_pesquisa = 18;
if (!empty($id_pesquisa)) {
    $query_publicacao = "SELECT * FROM `publicacao` WHERE `id`=:id";
    $result = $conn->prepare($query_publicacao);
    $result->bindParam(':id', $id_pesquisa);
    $result->execute();

    if (($result) and ($result->rowCount() != 0)) {
        while ($row_publicacao = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados['publicacao'] = [
                'id' => $row_publicacao['id'],
                'titulo' => $row_publicacao['titulo'],
                'categoria' => $row_publicacao['categoria'],
                'numeroVisualizacao' => $row_publicacao['numeroVisualizacao'],
                'resumo' => $row_publicacao['resumo'],
                'imagem' => $row_publicacao['imagem'],
                'texto' => base64_decode($row_publicacao['texto']),
                'dataInclusao' => $row_publicacao['dataInclusao']
            ];
        }
    }

    $query_termo = "SELECT `a`.`id`,`a`.`id_publicacao`, `a`.`id_rede`, `a`.`id_termo` FROM `publicacao_termo_rede_termos` as A INNER JOIN `publicacao` as B ON `b`.`id` = `a`.`id_publicacao` WHERE `a`.`id_publicacao` = :id";
    $result = $conn->prepare($query_termo);
    $result->bindParam(':id', $id_pesquisa);
    $result->execute();
    if (($result) and ($result->rowCount() != 0)) {
        while ($row_id = $result->fetch(PDO::FETCH_ASSOC)) {
            $id_termos[] = [
                'id_termo' => $row_id['id_termo'],
                'id_rede' => $row_id['id_rede'],
            ];
        }
        $id_rede = $id_termos[1]['id_rede'];
        $query_termo = "SELECT * FROM `redetermos` WHERE `id` =:id";
        $result = $conn->prepare($query_termo);
        $result->bindParam(':id', $id_rede);
        $result->execute();

        $row =  $result->fetch(PDO::FETCH_ASSOC);
        $dados['redeTermos'][0] = [
            'id' => $row['id'],
            'nome' => $row['nome'],
            'descricao' => $row['descricao'],
            'dataInclusao' => $row['dataInclusao'],
        ];
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

    $query_rede = "SELECT DISTINCT `id_publicacao` FROM `publicacao_termo_rede_termos` 
    WHERE `id_rede` =:id  AND `id_publicacao` !=:id_ignorado LIMIT 3";
    $result = $conn->prepare($query_rede);
    $result->bindParam(':id', $id_rede);
    $result->bindParam(':id_ignorado', $id_pesquisa);
    $result->execute();

    if (($result) and ($result->rowCount() != 0)) {
        while ($row_publicacao = $result->fetch(PDO::FETCH_ASSOC)) {
            $id_publicacao[] = [
                'id_publicacao' => $row_publicacao['id_publicacao']
            ];
        }
        for ($a = 0; $a != count($id_publicacao); $a++) {
            $query_publicacao = "SELECT `id`,`titulo`,`imagem` FROM `publicacao` WHERE `id` = :id LIMIT 3";
            $result = $conn->prepare($query_publicacao);
            $id = $id_publicacao[$a]['id_publicacao'];
            $result->bindParam(':id', $id);
            $result->execute();
            while ($row_publicacao = $result->fetch(PDO::FETCH_ASSOC)) {
                $dados['semelhantes'][$a] = [
                    'id' => $row_publicacao['id'],
                    'titulo' => $row_publicacao['titulo'],
                    'imagem' => $row_publicacao['imagem']
                ];
            }
        }
    }
    $retorna = ['erro' => false, 'dados' => $dados];
} else {
    $retorna = ['erro' => true, 'msg' => "Erro: Nenhum usuário encontrado!"];
}

echo json_encode($retorna);
