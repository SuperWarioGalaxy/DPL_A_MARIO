Iniciando los servicios de XAMP, accedo al phpMyAdmin, en este creare una nueva BD llamada "pruebas"
dentro de pruebas creare una tabla llamada "users" en la cual definire 4 campos:
<br>
ID(sera de valor INT y autoincremental con una longitud de 11),<br>
nombre(un VARCHAR de longitud 200),<br>
email(un VARCHAR de longitud 200),<br>
created(con DATETIME y ocn valor predeterminado de "current_timestamp"),<br>

Con esto tendre creada la BD y tabla para hacer pruebas con los siguientes archivos que creare:

creo un archivo "conexion.php" en el cual escribire un sencillo codigo para conectarme a la BD
con el siguiente contenido:


"<?php"  <br>
"$conn= mysqli_connect(direccion del server,usaurio,contraseña,BD);  "  <br>
"echo "< pre> ";  "  <br>
"print_r($conn); "  <br>




creo el archivo "insertar.php"
