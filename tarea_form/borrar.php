<!DOCTYPE html>
<html lang="es">

<head>
  <title>Borrar registros de la base de datos</title>
</head>
<body>

<div>
  <h1>Borrar un registro</h1>
  <br>
  <?php
    include "conexion.php";
    //$conn = conn();
    if(! $_POST) {
  ?>
      <form method="POST" action="borrar.php">
        id<br>
        <?php
          //Creamos la sentencia SQL y la ejecutamos
          $ssql="select id from users order by id";
          $result = $conn->query($ssql);
        
          echo '<select name="id">';
          //Mostramos los registros en forma de menú desplegable
          while ($row = $result->fetch_array()) {
            echo '<option>'.$row["id"];
          }
          $result->free_result();
        ?>
        </select>
        <br>
        <input TYPE="submit" value="Borrar">
      </form>
  <?php
    } else {
      // Recibimos los datos del formulario
      $id = $_POST["id"];

      //Creamos la sentencia SQL
      $ssql = "delete from users where id='$id'";

      // Ejecutamos la sentencia de borrado
      if($conn->query($ssql)) {
        echo '<p>usuario borrado con éxito</p>';
      } else {
        echo '<p>Hubo un error al borrar el usuario: ' . $conn->error . '</p>';
      }
    }
    $conn->close();
  ?>
  <p>
    <a href="borrar.php">Borrar otro registro</a>
  </p>
  <p>
    <a href="index.php">Volver</a>
  </p>
</div>

</body>
</html>