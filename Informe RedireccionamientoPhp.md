redirecciones.php:
tendra un html sencillo en el que pondremos un enlace de la siguiente manera hacia la pagina2.php
<a href="pagina2.php?name=alex">Redireccion</a>

Con esto, cuando habramos el archivo redirecciones.php en el navegador de manera local gracias al XAMP
se podra clickar en la palabra "Redireccion" que aparecera y nos llevara a la pagina2.php.

En esta pagina podremos hacer un "echo "pagina 2"" para demostrar que efectivamente nos encontramos en esta
mas un "print_r($_GET)" que nos mostrara la infomracion que le hemos pasado desde la pagina anterior 
"redirecciones.php", que es el nombre alex. Luego incluiremos una linea nueva que nos dirigira a la pagina3.php:
"header("location: pagina3.php?name=". $_GET['name'])"

En la pagina3.php escribiremos un "echo "pagina 3 <br>"" para indicar donde nos encontramo y un "print_r($_GET)"
para mostrar la informacion que hemos redirecionado por los 3 archivos php. Con esto cuando accedamos al enlace inicial 
de "redirecciones.php" saltaremos de esta a la pagina 3 directamente la cual nos mostrara lo siguiente:

pagina 3
Array ([name] => alex)
