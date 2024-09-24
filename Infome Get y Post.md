GET y POST
Mario Pérez Marrero

CON EL GET:
Creo los archivo “get_post.php” y “index.php”, en index va el html donde pondré un formulario de prueba y 
un botón para enviar, a todo esto le pondremos valores y le indicaremos el método al formulario que sera GET.

Con esto se puede hacer el get en el “get_post.php” de la siguiente manera:
print_r ($_GET)
print_r ($_GET['usuario'])

CON EL POST:
Modificando el archivo index.php y get_post.php para que se adapten al método post, que es mas seguro que el get
evitando que se muestre informacion de mas en el enlace y un envio de infomacion local mas seguro.

Modificando para que sea el metodo POST en el formulario del index.php y modificando el codigo del get_post.php
podremos conseguir que sea por POST:
print_r ($_POST)
print_r ($_POST['usuario'])








