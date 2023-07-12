<?php
include "config.php";
include "utils.php";

$dbConn =  connect($db);


if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id']))
    {
      //Mostrar un post
      $sql = $dbConn->prepare("SELECT * FROM books where id=:id");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
      exit();
	  }
    else {
      //Mostrar lista de post
      $sql = $dbConn->prepare("SELECT * FROM books");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
	}
}

// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;

    $sql = "INSERT INTO books
          (title, status, summary, user_id)
          VALUES
          (:title, :status, :summary, :user_id)";

    $statement = $dbConn->prepare($sql);

    bindAllValues($statement, $input);

    $statement->execute();

    $postId = $dbConn->lastInsertId();

    if($postId)
    {
      $input['id'] = $postId;
      header('Location: http://localhost/master-php/api/consulta.php');
      echo json_encode($input);
      exit();
	 }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$id = $_GET['id'];
  $statement = $dbConn->prepare("DELETE FROM books where id=:id");
  $statement->bindValue(':id', $id);
  $statement->execute();
	header("HTTP/1.1 200 OK");
	exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

  $input = $_GET;
  $postId = $input['id'];

  // Obtener los datos del cuerpo de la solicitud en formato JSON
  $content = file_get_contents('php://input');
  parse_str($content, $array);

  // Obtener los valores para actualizar
  $title = $array['title'];
  $status = $array['status'];
  $summary = $array['summary'];
  $user_id = $array['user_id'];

  // Construir la consulta SQL de actualización
  $sql = "UPDATE books SET title = :title, status = :status, summary = :summary, user_id = :user_id WHERE id = :id";

  // Preparar la consulta SQL
  $statement = $dbConn->prepare($sql);

  // Vincular los valores
  $statement->bindParam(':id', $postId);
  $statement->bindParam(':title', $title);
  $statement->bindParam(':status', $status);
  $statement->bindParam(':summary', $summary);
  $statement->bindParam(':user_id', $user_id);

  // Ejecutar la consulta SQL
  $statement->execute();

  // Enviar respuesta exitosa
  header("HTTP/1.1 200 OK");
  exit();
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>
