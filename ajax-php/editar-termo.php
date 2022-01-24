<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

$url = filter_input(INPUT_GET, "url", FILTER_SANITIZE_STRING);
parse_str($url, $id);

$conn = Connection::conectar();


if (!empty($id)) {

    $pesq_usuarios = "%" . $id . "%";

    $query_termos = "SELECT id, nome,tipo FROM termo WHERE id LIKE :id LIMIT 20";
    $result = $conn->prepare($query_termos);
    $result->bindParam(':id', $pesq_usuarios);
    $result->execute();
    
     if(($result) and ($result->rowCount() != 0)){
         while($row_termo = $result->fetch(PDO::FETCH_ASSOC)){
           $dados[] = [
                 'id' => $row_termo['id'],
                 'nome' => $row_termo['nome']
            ];
         }

         $retorna = ['erro' => false, 'dados' => $dados];
    }
    else{
         $retorna = ['erro' => true, 'msg' => "Erro: Nenhum usuário encontrado!"];
     }

} else {
    $retorna = ['erro' => true, 'msg' => "Erro: Nenhum usuário encontrado!"];
}

echo json_encode($retorna);
