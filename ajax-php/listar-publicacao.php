<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

$conn = Connection::conectar();

$query_usuarios = "SELECT `id`,`titulo`,`categoria` FROM `publicacao` ORDER BY `id` DESC";
$result = $conn->prepare($query_usuarios);
$result->execute();
if (($result) and ($result->rowCount() != 0)) {
    while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {

        $retorna[] =[
            'id'=> $row_termo['id'],
            'titulo' => $row_termo['titulo'],
            'categoria' => $row_termo['categoria']
        ];
    }
}

echo json_encode($retorna);