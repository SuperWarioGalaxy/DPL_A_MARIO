<!DOCTYPE html>
<html lang="es">
<head>
  <title>Insertar</title>
</head>
<body>
  <?php
  if (!$_POST) {
  ?>
    <div>
      <h1>Insertar un registro</h1>
      <br>
      <form method="POST" action="insertar.php">
        Nombre
        <br>
        <input type="text" name="name"><br>
        Email
        <br>
        <input type="text" name="email">
        <br>
        <input type="submit" value="Insertar">
      </form>
    </div>
  <?php
  } else {
    include "conexion.php";
    //$conexion = conexion();

    // Recuperamos los datos del formulario
    $name = $_POST["name"];
    $email = $_POST["email"];

    // Componemos la sentencia SQL
    $ssql = "insert into users (name, email) values ('$name','$email')";

    // Ejecutamos la sentencia y comprobamos si ha ido bien
    if($conn->query($ssql)) {
      echo "<p>Registro insertado con éxito</p>";
    } else {
      echo "<p>Hubo un error al ejecutar la sentencia de inserción: {$conn->error}</p>";
    }
    $conn->close();
  ?>
  <p><a href="index.php">Volver</a></p>
  <?php
  }
  ?>
</body>
</html>