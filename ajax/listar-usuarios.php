<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

$conn = Connection::conectar();

$query_usuarios = "SELECT `idUsuario`,`nomeCompleto`,`nivelAcesso`,`dataInclusao` FROM `usuario` ORDER BY `idUsuario` ASC";
$result = $conn->prepare($query_usuarios);
$result->execute();
if (($result) and ($result->rowCount() != 0)) {
    while ($row_termo = $result->fetch(PDO::FETCH_ASSOC)) {

        $retorna[] =[
            'id'=> $row_termo['idUsuario'],
            'nome' => $row_termo['nomeCompleto'],
            'nivel' => $row_termo['nivelAcesso'],
            'dataInclusao' => $row_termo['dataInclusao']
        ];
    }
}

echo json_encode($retorna);
