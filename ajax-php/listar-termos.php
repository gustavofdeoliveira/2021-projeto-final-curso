<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

$conn = Connection::conectar();

$query_usuarios = "SELECT `id`,`tipoTermo`,`nome`,`conceito` FROM `termo` ORDER BY `id` DESC";
$result = $conn->prepare($query_usuarios);
$result->execute();
if (($result) and ($result->rowCount() != 0)) {
    while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {

        $retorna[] =[
            'id'=> $row_termo['id'],
            'tipo' => $row_termo['tipoTermo'],
            'nome' => $row_termo['nome'],
            'conceito' => $row_termo['conceito']
        ];
    }
}

echo json_encode($retorna);
