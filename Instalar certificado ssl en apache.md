Informe: Instalación de Certificado SSL en Apache

Este informe describe los pasos para instalar y configurar un certificado SSL en un servidor web Apache en un sistema basado en Linux, usando Let's Encrypt como ejemplo de una Autoridad de Certificación gratuita.
Prerrequisitos

    Tener Apache instalado y en funcionamiento.
    Tener un dominio válido apuntando al servidor.
    Tener privilegios de superusuario (root) o acceso mediante sudo.

1. Actualizar los paquetes del sistema

Es recomendable actualizar los paquetes del sistema antes de comenzar. Ejecutamos el siguiente comando:

sudo apt update && sudo apt upgrade -y

Esto actualizará todos los paquetes a sus versiones más recientes.
2. Instalar Certbot y el complemento de Apache

Certbot es una herramienta de Let's Encrypt para obtener certificados SSL gratuitos. Para instalar Certbot y el complemento de Apache, ejecutamos el siguiente comando:

sudo apt install certbot python3-certbot-apache -y

    certbot: Es la herramienta principal para solicitar y renovar certificados SSL.
    python3-certbot-apache: Es el complemento para Apache que configura automáticamente SSL y actualiza la configuración de Apache.

3. Obtener el certificado SSL

Con Certbot instalado, podemos obtener un certificado SSL para nuestro dominio. Para ello, ejecutamos:

sudo certbot --apache

Certbot automáticamente detectará la configuración de Apache, y nos guiará a través del proceso de instalación del certificado SSL. Durante el proceso, se nos pedirá:

    Ingresar la dirección de correo electrónico para recibir notificaciones sobre el certificado.
    Aceptar los términos del servicio de Let's Encrypt.
    Confirmar si deseamos redirigir todo el tráfico HTTP a HTTPS (es recomendable elegir esta opción para asegurar todo el tráfico).

4. Verificar la instalación del certificado SSL

Una vez completado el proceso de instalación, Certbot nos mostrará un mensaje indicando que el certificado SSL se ha instalado correctamente. Podemos verificar que el certificado está instalado correctamente visitando nuestro sitio web en https://:

https://tu-dominio.com

Si la instalación fue exitosa, deberíamos ver un candado verde en la barra de direcciones del navegador, indicando que la conexión está asegurada mediante SSL.
5. Configuración automática de renovación

Los certificados SSL de Let's Encrypt tienen una validez de 90 días, por lo que es importante renovar el certificado periódicamente. Afortunadamente, Certbot configura automáticamente una tarea en cron para renovar el certificado antes de que expire.

Para verificar si la renovación automática está configurada correctamente, podemos ejecutar el siguiente comando:

sudo systemctl list-timers

Este comando nos mostrará los temporizadores activos, y deberíamos ver uno relacionado con Certbot que se ejecute regularmente para renovar los certificados.
6. Verificación de la renovación del certificado

Podemos verificar la renovación de los certificados SSL de Let's Encrypt ejecutando:

sudo certbot renew --dry-run

Este comando realiza una prueba de renovación sin aplicar cambios, asegurando que la renovación automática funcionará correctamente.
7. Configuración manual de SSL en Apache

En algunos casos, puede ser necesario configurar manualmente el archivo de configuración de Apache para habilitar SSL. Aquí están los pasos básicos:

    Habilitar los módulos SSL de Apache:

    Ejecutamos el siguiente comando para habilitar los módulos SSL en Apache si no están habilitados:

sudo a2enmod ssl
sudo a2enmod headers

Configurar el archivo de sitio SSL:

Si Certbot no lo hizo automáticamente, debemos crear o editar el archivo de configuración del sitio SSL. Generalmente, se encuentra en /etc/apache2/sites-available/. Creamos o editamos un archivo de configuración SSL:

sudo nano /etc/apache2/sites-available/tu-dominio-ssl.conf

Dentro de este archivo, configuramos los parámetros del SSL, como el archivo del certificado y la clave privada:

<VirtualHost *:443>
    ServerAdmin webmaster@tu-dominio.com
    ServerName tu-dominio.com
    DocumentRoot /var/www/html

    SSLEngine on
    SSLCertificateFile /etc/letsencrypt/live/tu-dominio.com/fullchain.pem
    SSLCertificateKeyFile /etc/letsencrypt/live/tu-dominio.com/privkey.pem
    SSLCertificateChainFile /etc/letsencrypt/live/tu-dominio.com/chain.pem

    <Directory /var/www/html>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

Activar el sitio SSL y reiniciar Apache:

Una vez que hayamos configurado el archivo SSL, activamos el sitio SSL y reiniciamos Apache para aplicar los cambios:

    sudo a2ensite tu-dominio-ssl.conf
    sudo systemctl restart apache2

8. Verificación del Certificado SSL

Para verificar que el certificado SSL esté correctamente instalado y funcionando, podemos usar herramientas en línea como SSL Labs para realizar una prueba completa del sitio y comprobar que no haya problemas con el certificado.
9. Deshabilitar HTTP y forzar HTTPS (Opcional)

Si deseas forzar que todo el tráfico se redirija a HTTPS, puedes agregar una configuración adicional en el archivo de configuración de Apache. Para ello, creamos o editamos el archivo de configuración para el sitio HTTP (generalmente en /etc/apache2/sites-available/000-default.conf) y agregamos una redirección a HTTPS:

<VirtualHost *:80>
    ServerAdmin webmaster@tu-dominio.com
    ServerName tu-dominio.com
    Redirect permanent / https://tu-dominio.com/
</VirtualHost>

Luego, reiniciamos Apache para aplicar la redirección:

sudo systemctl restart apache2

10. Comprobación final

Con todo configurado, debemos asegurarnos de que el sitio web ahora está accesible de manera segura a través de HTTPS, y que el navegador muestra el candado verde en la barra de direcciones, indicando que la conexión está encriptada.
Conclusión

Con estos pasos, hemos instalado y configurado un certificado SSL en un servidor Apache utilizando Certbot y Let's Encrypt. Esto garantiza que la comunicación entre el servidor y los usuarios sea segura y cifrada, mejorando la confidencialidad y la integridad de los datos. Además, la renovación automática configurada por Certbot asegura que el certificado se mantenga actualizado sin intervención manual.
