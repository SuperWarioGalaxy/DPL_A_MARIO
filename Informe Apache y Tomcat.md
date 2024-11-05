<h2>P1.¿Cuáles son las tres capas de la arquitectura web y cuál es la función de cada una de ellas?</h2>

La arquitectura web se basa en un modelo de tres capas que se estructuran como sigue:

    Capa de presentación (Frontend):
    Esta capa está encargada de interactuar directamente con el usuario. En ella se encuentran todos los elementos visuales, como las interfaces de usuario (UI), los formularios, los botones, y la presentación de los datos. Los desarrolladores web usan tecnologías como HTML, CSS, y JavaScript para crear esta capa. El objetivo principal de esta capa es proporcionar una experiencia de usuario fluida y eficiente.

    Capa de lógica de negocio (Backend):
    La capa de backend se encarga de la lógica y procesamiento de la información. Aquí se gestionan las peticiones que realiza el usuario desde la capa de presentación, se procesan y se devuelven los resultados. Esta capa incluye servidores web, bases de datos, y servicios de aplicaciones que se encargan de procesar las solicitudes y tomar decisiones en función de la lógica de la aplicación. Las tecnologías comunes incluyen PHP, Python, Ruby, Node.js, etc.

    Capa de datos (Base de datos):
    La capa de datos es la encargada de almacenar y gestionar la información que utiliza la aplicación web. Aquí es donde se encuentran las bases de datos, como MySQL, PostgreSQL, MongoDB, etc. Los datos se extraen, modifican y almacenan a partir de las interacciones que se producen en las otras dos capas. Esta capa asegura que los datos sean persistentes y puedan ser recuperados o modificados según sea necesario.

<h2>P2. ¿En qué consiste cada una de las plataformas web LAMP y WISA?</h2>

    LAMP (Linux, Apache, MySQL, PHP/Python/Perl):
    LAMP es una pila de software utilizada comúnmente para desarrollar aplicaciones web dinámicas. Los componentes de esta plataforma son:
        Linux: Sistema operativo, proporcionando la base sobre la que se ejecutarán los demás servicios.
        Apache: Servidor web que procesa y responde a las solicitudes HTTP.
        MySQL: Sistema de gestión de bases de datos relacional que se utiliza para almacenar y gestionar los datos de las aplicaciones.
        PHP/Python/Perl: Lenguajes de programación que se utilizan para el desarrollo de la lógica de la aplicación web. PHP es el más común en esta pila, pero también se pueden usar Python o Perl.

    Uso: LAMP es ampliamente utilizado en aplicaciones web de código abierto y se caracteriza por su alta estabilidad y flexibilidad.

    WISA (Windows, IIS, SQL Server, ASP.NET):
    WISA es otra plataforma de desarrollo web, pero basada en tecnologías de Microsoft. Sus componentes son:
        Windows: El sistema operativo que sirve como base para el desarrollo de aplicaciones web en entornos Microsoft.
        IIS (Internet Information Services): El servidor web de Microsoft que maneja las peticiones HTTP y los servicios relacionados.
        SQL Server: Sistema de gestión de bases de datos que permite almacenar y gestionar la información para las aplicaciones.
        ASP.NET: Framework de desarrollo web que utiliza C# o VB.NET para crear aplicaciones dinámicas del lado del servidor.

    Uso: WISA se utiliza principalmente en entornos empresariales que requieren de un ecosistema controlado por Microsoft, con una integración profunda con otras herramientas de Microsoft.

<h2>P3. Pasos para instalar y configurar Apache y Tomcat en Ubuntu</h2>
3.1 Instalar Apache desde terminal

  Primero, se debe actualizar la lista de paquetes disponibles:
  
    apt-get update
  
  Luego, se instala Apache con el siguiente comando:
  
    apt-get install apache2
  
  Una vez completada la instalación, Apache debería iniciar automáticamente. Para asegurarse de que el servicio se está ejecutando:
  
      systemctl status apache2

3.2 Comprobar que está funcionando el servidor Apache desde terminal

  Se puede comprobar el estado de Apache con el siguiente comando:
  
    systemctl status apache2
  
  Este comando nos dirá si Apache está corriendo. Si está activo, aparecerá algo como active (running).
  
  También, se puede comprobar si el puerto 80 (predeterminado de Apache) está escuchando:
  
      netstat -tuln | grep :80

3.3 Comprobar que está funcionando el servidor Apache desde navegador

    Abrir un navegador web e ingresar la dirección http://localhost o http://<dirección-ip-del-servidor>.

    Si Apache está funcionando correctamente, se debería ver una página predeterminada de Apache que dice "It works!"

3.4 Cambiar el puerto por el cual está escuchando Apache a 82

    Editar el archivo de configuración de Apache ports.conf para cambiar el puerto:

      nano /etc/apache2/ports.conf

  En este archivo, agregar o modificar la línea para que Apache escuche en el puerto 82:

    Listen 82

  Luego, editar el archivo de configuración de sitios habilitados para que también use el puerto 82. El archivo puede ser 000-default.conf:
  
    nano /etc/apache2/sites-available/000-default.conf
  
  Cambiar la línea que define el puerto 80 por el 82:
  
    <VirtualHost *:82>
  
  Guardar y cerrar el archivo. Después, reiniciar Apache para aplicar los cambios:
  
    systemctl restart apache2
  
  Ahora, para comprobar que Apache está escuchando en el puerto 82:
  
      netstat -tuln | grep :82
  
      También puedes verificar en el navegador accediendo a http://localhost:82.

3.5 Instalar el servidor de aplicaciones Tomcat

    Primero, se debe descargar e instalar el paquete de Tomcat. hay que tener Java instalado, ya que Tomcat depende de él. Para instalar Java:
  
  apt-get install openjdk-6-jdk
  
  Descargar la última versión de Apache Tomcat desde su sitio web:
  
    wget https://archive.apache.org/dist/tomcat/tomcat-9/v9.0.70/bin/apache-tomcat-9.0.70.tar.gz
  
  Extraer el archivo descargado:
  
    tar xzvf apache-tomcat-9.0.70.tar.gz
  
  Mover el directorio extraído a /opt para tener una ubicación estándar:
  
    mv apache-tomcat-9.0.70 /opt/tomcat
  
  Asegúrese de que los permisos sean correctos:
  
    chmod +x /opt/tomcat/bin/*.sh
  
  Iniciar Tomcat:
  
    /opt/tomcat/bin/startup.sh
