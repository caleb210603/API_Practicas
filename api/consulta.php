<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Web Page</title>
    <link rel="stylesheet" href="css/consulta.css">
  </head>
  <body>

    <form class="form" action="consulta.php" method="GET">
      <h2 class="form-title">Bienvenido !!</h2>
      <p class="form-paragraph">Ingresa el ID para consultar el valor</p>

      <div class="form-container">
        <div class="form-group">
          <input type="number" name="id" class="form-input" min=1 placeholder="1" autocomplete="off">
          <label for="id" class="form-label">ID:</label>
          <span class="form-line"></span>
        </div>
        <input type="submit" class="form-submit" value="Consultar">

        <?php
        include "config.php";
        include "utils.php";

        $dbConn = connect($db);

        ?>

        <?php 
        
        if (isset($_GET['id'])){

            if ($_GET['id'] == "") {
                echo "<p>Hey bro!!, Tienes que ingresar un ID</p>";
                exit();
            } else {
                $id_required = $_GET['id'];
                foreach($dbConn->query("SELECT * FROM books WHERE id = '" . $id_required . "'") as $row){ ?>
                
            

                <div class="container">
                    <h4>Title:</h4> 
                    <p><?php echo $row["title"]?></p>
                </div>

                <div class="container">
                    <h4>Summary:</h4> 
                    <p><?php echo $row["summary"]?></p>
                </div>

                <div class="container">
                    <h4>Status:</h4> 
                    <p><?php echo $row["status"]?></p>
                </div>
            
                <?php
                }

            } ?>

        <?php     
        } else {
            foreach($dbConn->query("SELECT * FROM books") as $row){ ?>

                <div class="container">
                    <h4>ID:</h4> 
                    <p><?php echo $row["id"]?></p>
                </div>
                
                <div class="container">
                    <h4>Title:</h4> 
                    <p><?php echo $row["title"]?></p>
                </div>
                
                <hr class="line">
        <?php 
            }
        }
        ?>

      </div>

    </form>

  </body>
</html>