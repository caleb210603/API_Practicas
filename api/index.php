<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Web Page</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>

    <form class="form" action="post.php" method="POST">
      <h2 class="form-title">Bienvenido !!</h2>
      <p class="form-paragraph">Estamos contentos que estes aqui</p>

      <div class="form-container">
        <div class="form-group">
          <input type="text" name="title" class="form-input" placeholder="La Bestia" autocomplete="off" value="Las Estrellas y Yo">
          <label for="title" class="form-label">Title:</label>
          <span class="form-line"></span>
        </div>
        <div class="form-group">
          <input type="text" name="summary" class="form-input" placeholder="Libro en PDF" autocomplete="off" value="Libro sobre las estrellas">
          <label for="summary" class="form-label">Summary:</label>
          <span class="form-line"></span>
        </div>

        <div class="form-group">
          <select class="form-input" name="status">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
          </select>

          <label for="status" class="form-label">Status:</label>
          <span class="form-line"></span>
        </div>

        <div class="form-group">
          <input type="number" name="user_id" class="form-input" placeholder="Online" autocomplete="off" value="1" min="1">
          <label for="user" class="form-label">User ID:</label>
          <span class="form-line"></span>
        </div>

        <input type="submit" class="form-submit" value="Submit">

      </div>

    </form>

  </body>
</html>

<?php

header("HTTP/1.1 200");

?>
