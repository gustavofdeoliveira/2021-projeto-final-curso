<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

$publicacao = filter_input(INPUT_GET, "publicacao", FILTER_SANITIZE_STRING);

$conn = Connection::conectar();


if (!empty($publicacao)) {

    $pesq_publicacao = "%" . $publicacao . "%";

    $sql = "SELECT * FROM publicacao WHERE titulo LIKE :titulo LIMIT 20";
    $result = $conn->prepare($sql);
    $result->bindParam(':titulo', $pesq_publicacao);
    $result->execute();
    
     if(($result) and ($result->rowCount() != 0)){
         while($row_publicacao = $result->fetch(PDO::FETCH_ASSOC)){
           $dados[] = [
                 'id' => $row_publicacao['id'],
                 'titulo' => $row_publicacao['titulo']
            ];
         }

         $retorna = ['erro' => false, 'dados' => $dados];
    }
    else{
         $retorna = ['erro' => true, 'msg' => "Erro: Nenhuma publicação encontrada!"];
     }

} else {
    $retorna = ['erro' => true, 'msg' => "Erro: Nenhuma publicação encontrada!"];
}

echo json_encode($retorna);
