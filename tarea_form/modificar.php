<!DOCTYPE html>
<html lang="es">

<head>
  <title>Actualizar registros de la base de datos</title>
</head>
<body>

<div>
  <h1>Actualizar un registro</h1>
  <br>
  <?php
    include "conexion.php";
    //$conn = conn();
    if(! $_POST) {
  ?>    
      <form method="POST" action="modificar.php">
        Nombre
        <br>
        <?php
          // creamos la sentencia SQL y la ejecutamos
          $ssql = "select id from users order by id";
          $result = $conn->query($ssql);
          
          //Generamos el campo select
          echo '<select name="id">';
          while ($row = $result->fetch_array()) {
            echo '<option>' . $row["id"] . '</option>';
          }
          echo '</select>';
        ?>
        <br>
        Nombre<br>
        <input type="text" name="name"><br>
        Email<br>
        <input type="text" name="email"><br>
        <input type="submit" value="Actualizar">
      </form>
  <?php
    } else {
      // Recibimos los datos del formulario
      $id = $_POST["id"];
      $name = $_POST["name"];
      $email = $_POST["email"];

      // Montamos la sentencia SQL
      $ssql = "update users set name='$name', email='$email' Where id='$id'";

      // Ejecutamos la sentencia de actualización
      if($conn->query($ssql)) {
        echo '<p>Usuario actualizado con éxito</p>';
      } else {
        echo '<p>Hubo un error al actualizar el usuario: ' . $conn->error . '</p>';
      }
    }
    $conn->close();
  ?>
  <p>
    <a href="modificar.php">Actualizar otro registro</a>
  </p>
  <p>
    <a href="index.php">Volver</a>
  </p>
</div>

</body>
</html>