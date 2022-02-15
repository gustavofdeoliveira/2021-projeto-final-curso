<?php

require_once(realpath(dirname(__FILE__) . "/../database/Connection.php"));

$conn = Connection::conectar();



echo json_encode($retorna);