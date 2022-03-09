<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

$termo = filter_input(INPUT_GET, "termo", FILTER_SANITIZE_STRING);

$conn = Connection::conectar();


if (!empty($termo)) {

    $pesq_usuarios = "%" . $termo . "%";

    $query_termos = "SELECT * FROM publicacao WHERE titulo LIKE :titulo LIMIT 20";
    $result = $conn->prepare($query_termos);
    $result->bindParam(':titulo', $pesq_usuarios);
    $result->execute();
    
     if(($result) and ($result->rowCount() != 0)){
         while($row_termo = $result->fetch(PDO::FETCH_ASSOC)){
           $dados[] = [
                 'id' => $row_termo['id'],
                 'titulo' => $row_termo['titulo']
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
