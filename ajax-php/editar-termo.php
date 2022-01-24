<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));


$protocolo = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == "on") ? "https" : "http");
$id_url = $_SERVER['QUERY_STRING'];
$url = explode("=", $id_url);
$id_pesquisa = $url[1];
$conn = Connection::conectar();


if (!empty($id_pesquisa)) {

    $pesq_id = "%" . $id_pesquisa . "%";

    $query_termo = "SELECT `id`,`nome`,`tipoTermo`,`nomeVariavel`, `conceito` FROM termo WHERE id LIKE :id LIMIT 5";
    $result = $conn->prepare($query_termo);
    $result->bindParam(':id', $pesq_id);
    $result->execute();

    if (($result) and ($result->rowCount() != 0)) {
        while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {
            $dados[] = [
                'id' => $row_termo['id'],
                'nome' => $row_termo['nome'],
                'tipo' => $row_termo['tipoTermo'],
                'nome' => $row_termo['nome'],
                'nomeVariavel' => $row_termo['nomeVariavel'],
                'conceito' => $row_termo['conceito']
            ];
        }

        $retorna = ['erro' => false, 'dados' => $dados];
    } else {
        $retorna = ['erro' => true, 'msg' => "Erro: Nenhum usuário encontrado!"];
    }
} else {
    $retorna = ['erro' => true, 'msg' => "Erro: Nenhum usuário encontrado!"];
}

echo json_encode($retorna);
