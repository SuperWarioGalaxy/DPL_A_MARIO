Iniciando los servicios de XAMP, accedo al phpMyAdmin, en este creare una nueva BD llamada "pruebas" dentro creare una tabla llamada "users" en la cual definire 4 campos:
<br>
ID(sera de valor INT y autoincremental con una longitud de 11),<br>
nombre(un VARCHAR de longitud 200),<br>
email(un VARCHAR de longitud 200),<br>
created(con DATETIME y ocn valor predeterminado de "current_timestamp"),<br>

Con esto tendre creada la BD y tabla de manera muy comoda por la interfaz de phpMyAdmin para hacer pruebas con los siguientes archivos que creare: conexion.php y insertar.php

Dentro de"conexion.php" en el cual escribire un sencillo codigo para conectarme a la BD
con el siguiente contenido:

"<?php"  <br>
"$conn= mysqli_connect(direccion del server,usaurio,contraseña,BD);  "  <br>
"echo "< pre> ";  "  <br>
"print_r($conn); "  <br>

Gracias a este codigo podre visualizar un objeto mysqli en el navegador que repesenta la conexion que e realizado con la (BD)Base de Datos, en los datos que se muestran se pueden contemplar varios datos realcionados cone sta conexion como: <br>
  -informacion del cliente <br>
  -informacion del host <br>
  -version del servidor <br>
  -el protocolo <br>
  -y varias cosas mas <br>

En "insertar.php" utilizarae un "include('conexion.php')" para poder reutilizar el fichero anterior para volver a conectarme y escribire un nuevo codigo para insertar en la BD:

"$insert = "insert into users(name, email) values('pedro','pedro@dominio.es')";" En esta linea creo la sentencia con la que insertare los datos y tambien le paso esos mismos datos.
"$return = mysqli_query($conn,$insert);" con esto realizo la insercion en la BD.
"print_r($return);" veo el reultado de la insercion
"mysqli_close($conn);" y cierro la conexion.

Una vez realizada la insercion podre comprobar que efectivamente se creo un nuevo usuario en la tabla "users" con los datos que le pase, asi como que se le a asignado automaticamente un id y fecha de creacion.
