<!DOCTYPE html>
<html lang="es">
<head>
  <title>Leer</title>
</head>
<body>
  <?php
  //conn con la base
  include 'conexion.php';

  // sentencia SQL
  $ssql = "select * from users";

  // Ejecutamos la sentencia SQL
  $result = $conn->query($ssql);
  ?>
  <div>
    <a href="insertar.php">Añadir un nuevo registro</a>
    <a href="borrar.php">Borrar un nuevo</a>
    <a href="modificar.php">Modificar un registro</a>
  </div>
  <table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Teléfono</th>
      <th>Fecha Creacion</th>
    </tr>
    <?php
      //Mostramos los registros
      while ($row = $result->fetch_array()) {
        echo '<tr><td>' . $row["id"] . '</td>';
        echo '<td>' . $row["name"] . '</td>';
        echo '<td>' . $row["email"] . '</td>';
        echo '<td>' . $row["created"] . '</td></tr>';
      }
      $result->free_result();
      $conn->close();
    ?>
  </table>
</body>
</html>