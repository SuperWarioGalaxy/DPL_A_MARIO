Informe: Instalación y Configuración Básica de Nginx

Este informe describe los pasos básicos para instalar y configurar Nginx en un sistema basado en Linux, utilizando comandos en la terminal.
1. Actualización de paquetes

Para asegurarse de que todos los paquetes del sistema estén actualizados, se ejecuta el siguiente comando:

sudo apt update

Este comando actualiza la lista de paquetes disponibles desde los repositorios de Ubuntu, asegurando que la versión más reciente de cada software esté disponible para su instalación.
2. Instalación de Nginx

A continuación, instalamos Nginx, que es un servidor web y proxy inverso popular. Para ello, ejecutamos el siguiente comando:

apt install nginx

Este comando instala el paquete Nginx en el sistema. Durante el proceso de instalación, se descargan y configuran todos los archivos necesarios.
3. Verificación del estado de Nginx

Una vez instalado, podemos verificar el estado de Nginx utilizando el siguiente comando:

systemctl status nginx

Este comando muestra si el servicio de Nginx está en ejecución, junto con detalles sobre su estado, como el tiempo de actividad y si hay errores o advertencias.
4. Verificación de la configuración de Nginx

Para asegurarse de que la configuración de Nginx no tenga errores, se puede ejecutar el siguiente comando:

nginx -t

Este comando realiza una prueba de la configuración de Nginx. Si hay algún error de sintaxis o configuración, lo mostrará en la terminal.
5. Navegación por el directorio de configuración de Nginx

Los archivos de configuración de Nginx suelen encontrarse en el directorio /etc/nginx. Podemos navegar a este directorio para examinar la configuración:

cd /etc/nginx

Una vez en este directorio, podemos listar los archivos y carpetas con el comando:

ls

Esto nos dará una visión general de los archivos de configuración disponibles, como los archivos principales de configuración de Nginx y las configuraciones de sitios.
6. Explorar sitios disponibles y habilitados

Dentro del directorio /etc/nginx, hay dos subdirectorios importantes relacionados con la configuración de sitios:

    sites-available: contiene la configuración de los sitios disponibles.
    sites-enabled: contiene los enlaces simbólicos a los sitios habilitados para Nginx.

Primero, exploramos el directorio sites-available:

cd sites-available
ls

Esto muestra los archivos de configuración para los sitios que están disponibles pero no necesariamente habilitados.

Luego, exploramos el directorio sites-enabled:

cd ../sites-enabled
ls -l

Aquí, podemos ver los enlaces simbólicos de los sitios habilitados. Si un archivo está vinculado aquí, significa que el sitio está activado en Nginx.
7. Ver el archivo de configuración predeterminado

En la mayoría de las instalaciones de Nginx, hay un archivo de configuración predeterminado para el sitio web. Podemos visualizar este archivo con el siguiente comando:

cat default

Este archivo define la configuración predeterminada de Nginx para el servidor web, como el puerto de escucha y la ubicación de los archivos de sitio web.
8. Navegar al directorio de contenido web

Nginx generalmente coloca los archivos de contenido web en el directorio /var/www/html. Podemos navegar a este directorio para ver los archivos de la página predeterminada de Nginx:

cd /var/www/html
ls -l

Aquí se encuentra el archivo index.nginx-debian.html, que es la página de bienvenida predeterminada de Nginx en Debian y sus derivados.
9. Reiniciar Nginx

Después de realizar cambios en la configuración o en los archivos del sitio, es necesario reiniciar Nginx para que los cambios surtan efecto. Para hacerlo, usamos el siguiente comando:

systemctl restart nginx

Este comando reinicia el servicio de Nginx y aplica los cambios realizados.
10. Eliminar la página predeterminada de Nginx

Para eliminar la página predeterminada de Nginx, primero debemos eliminar el archivo index.nginx-debian.html. Para hacerlo, usamos el comando:

rm index.nginx-debian.html

Este comando elimina el archivo HTML que Nginx sirve por defecto en la instalación inicial.
11. Crear una nueva página web

Ahora, vamos a crear un archivo index.html personalizado para servir nuestra propia página web. Utilizamos el editor de texto nano para crear y editar este archivo:

nano index.html

En este archivo, podemos agregar contenido HTML, como un simple mensaje de bienvenida:

<!DOCTYPE html>
<html>
<head>
    <title>Mi Página Web</title>
</head>
<body>
    <h1>Bienvenido a mi página web!</h1>
</body>
</html>

Una vez que hayamos terminado de editar el archivo, guardamos los cambios y salimos de nano.
12. Reiniciar Nginx para aplicar los cambios

Después de crear el archivo index.html, necesitamos reiniciar Nginx nuevamente para aplicar los cambios:

systemctl restart nginx

Esto permite que Nginx sirva la nueva página web.
13. Verificación final del estado de Nginx

Finalmente, podemos verificar que Nginx esté en funcionamiento y sirviendo nuestra nueva página web mediante el siguiente comando:

systemctl status nginx

Este comando muestra el estado actual del servicio de Nginx, confirmando que está activo y ejecutándose correctamente.

Con estos pasos, hemos cubierto el proceso de instalación, configuración básica y personalización de Nginx en un servidor Ubuntu.
