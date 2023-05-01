<?php

include "../model/config.php";
include "../model/utils.php";

$dbConn = connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $json = file_get_contents('php://input');
    $input = json_decode($json, true);
    
    // Verificar que los datos recibidos sean un array
    if (!is_array($input)) {
        header("HTTP/1.1 400 Bad Request");
        exit();
    }

    // Eliminar todos los registros existentes en la tabla "datos"
    $sql = "DELETE FROM datos";
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    
    // Insertar cada valor en la base de datos
    foreach ($input as $valor) {
        if (!isset($valor['fecha']) || !isset($valor['valor'])) {
        header("HTTP/1.1 400 Bad Request");
        exit();
        }
        $sql = "INSERT INTO datos (`fecha`,`valor`) VALUES (:fecha, :valor)";
        $statement = $dbConn->prepare($sql);
        $statement->bindParam(':fecha', $valor['fecha']);
        $statement->bindParam(':valor', $valor['valor']);
        $statement->execute();
        $postId = $dbConn->lastInsertId();
        if($postId) {
        $valor['id'] = $postId;
        }
    }
    
    header("HTTP/1.1 200 OK");
    echo json_encode($input);
    exit();
};
