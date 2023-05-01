<?php

include "../model/config.php";
include "../model/utils.php";

$dbConn = connect($db);

switch($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    if (isset($_GET['id'])) {
      //Mostrar un post
      $sql = $dbConn->prepare("SELECT * FROM datos WHERE datos.id=:id");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
      exit();
    } else {
      //Mostrar lista de post
      $sql = $dbConn->prepare("SELECT * FROM datos");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode($sql->fetchAll());
      exit();
    }
    break;

  case 'POST':
    // Crear un nuevo post
    $input = $_POST;
    $sql = "INSERT INTO datos (`fecha`,`valor`) VALUES (':fecha, :valor')";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();
    if($postId) {
      $input['id'] = $postId;
      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
    }
    break;

  case 'DELETE':
    // Borrar
    $id = $_GET['id'];
    $statement = $dbConn->prepare("DELETE FROM datos where id=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
    break;

  case 'PUT':
    // Actualizar
    $input = $_GET;
    $postId = $input['id'];
    $fields = getParams($input);

    $sql = "UPDATE datos SET $fields WHERE id=:id";
    $statement = $dbConn->prepare($sql);
    $statement->bindValue(':id', $postId);
    bindAllValues($statement, $input);

    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
    break;

  default:
    header("HTTP/1.1 400 Bad Request");
    break;
}