<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

$rede = filter_input(INPUT_GET, "rede", FILTER_SANITIZE_STRING);

$conn = Connection::conectar();


if (!empty($rede)) {

    $pesq_rede = "%" . $rede . "%";

    $query_redeTermos = "SELECT id, nome FROM redetermos WHERE nome LIKE :nome LIMIT 20";
    $result = $conn->prepare($query_redeTermos);
    $result->bindParam(':nome', $pesq_rede);
    $result->execute();
    
     if(($result) and ($result->rowCount() != 0)){
         while($row_rede = $result->fetch(PDO::FETCH_ASSOC)){
           $dados[] = [
                 'id' => $row_rede['id'],
                 'nome' => $row_rede['nome']
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