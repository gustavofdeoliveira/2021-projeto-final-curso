<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

$conn = Connection::conectar();

$query_usuarios = "SELECT `id`,`nome`,`descricao`, `dataInclusao` FROM `redetermos` ORDER BY `id` DESC";
$result = $conn->prepare($query_usuarios);
$result->execute();
if (($result) and ($result->rowCount() != 0)) {
    while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {

        $retorna[] =[
            'id'=> $row_termo['id'],
            'nome' => $row_termo['nome'],
            'descricao' => $row_termo['descricao'],
            'dataInclusao' => $row_termo['dataInclusao']
        ];
    }
}

echo json_encode($retorna);