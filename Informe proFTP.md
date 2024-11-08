# Instalación y Configuración de un Servidor FTP (ProFTP)

## 1. Instalación del Servidor FTP
- **Actualizar paquetes**:
    ```bash
    sudo -i  
    apt-get update  
    ```

- **Instalar el servidor ProFTP**:
    ```bash
    apt-get install proftpd
    ```
    Durante la instalación, si aparece un entorno gráfico, seleccionamos **"independiente"** y presionamos **Aceptar**.

- **Verificar el estado del servicio**:
    ```bash
    service proftpd status
    ```
    Esto confirmará si el servidor está activo y funcionando.

- **Ver versión de ProFTP**:
    ```bash
    proftpd -v
    ```

## 2. Exploración de Archivos y Usuarios del Servidor
- **Ver los usuarios creados**:
    Después de la instalación, podemos ver los usuarios creados en el archivo `/etc/passwd`:
    ```bash
    cat /etc/passwd
    ```
    Esto mostrará los usuarios asociados al servidor FTP.

- **Archivos de configuración**:
    Se crean varios archivos de configuración en `/etc/proftpd`, siendo el más importante el archivo `proftpd.conf`. Para hacer una copia de seguridad de este archivo:
    ```bash
    cp /etc/proftpd/proftpd.conf /etc/proftpd/proftpd.conf.copia
    ```

## 3. Configuración del Archivo `proftpd.conf`
- **Editar el archivo de configuración**:
    Usamos `nano` para editar el archivo de configuración principal:
    ```bash
    nano /etc/proftpd/proftpd.conf
    ```
    Este archivo tiene muchas líneas comentadas y en blanco. Para limpiarlo, editamos con `vi`:
    ```bash
    vi /etc/proftpd/proftpd.conf
    ```
    - **Eliminar comentarios**:  
      Usamos el comando en `vi`:
      ```bash
      :g/^\s*#/d
      ```
    - **Eliminar líneas en blanco**:
      ```bash
      :g/^$/d
      ```
    Guardamos y salimos con `:w:q`.

- **Revisar archivo `/etc/ftpusers`**:
    Este archivo contiene una lista de usuarios que no tienen acceso al servidor FTP por razones de seguridad:
    ```bash
    cat /etc/ftpusers
    ```

## 4. Conexión al Servidor FTP
### Conexión desde el Terminal
- **Conectar vía FTP**:
    ```bash
    ftp ip_del_servidor_FTP
    ```
    Ingresamos el nombre de usuario y la contraseña local del sistema. Luego podemos usar los siguientes comandos:
    - Listar archivos:
      ```bash
      ftp> ls
      ```
    - Ver el directorio actual:
      ```bash
      ftp> pwd
      ```
    - Ver ayuda de comandos:
      ```bash
      ftp> ?
      ```
    - Salir:
      ```bash
      ftp> quit
      ```

### Conexión desde un Navegador
- **Usar el navegador**:
    ```text
    ftp://ip_del_servidor_FTP
    ```
    Luego, ingresamos el nombre de usuario y la contraseña.

### Conexión desde FileZilla
- **Instalar FileZilla**:
    ```bash
    apt-get install filezilla
    ```
- **Configurar FileZilla**:
    - Servidor: `ip_servidor`
    - Usuario: `nombre_usuario`
    - Contraseña: `password_usuario`
    - Puerto: `21`
    Luego ejecutamos FileZilla con:
    ```bash
    filezilla
    ```

## 5. Configuración Básica en el Archivo `proftpd.conf`
- **Editar parámetros clave**:
    Usamos `nano` para modificar el archivo `proftpd.conf`:
    ```bash
    nano /etc/proftpd/proftpd.conf
    ```
    Cambiamos los siguientes valores:
    - **ServerName**:  
      ```text
      ServerName “Mi servidor FTP”
      ```
    - **Desactivar DeferWelcome**:
      ```text
      DeferWelcome off
      ```
    - **TimeoutIdle** (tiempo de inactividad antes de desconectar al cliente):
      ```text
      TimeoutIdle 1200
      ```
    - **Port**:
      ```text
      Port 21
      ```
    - **MaxInstances** (máximo de conexiones simultáneas):
      ```text
      maxInstances 30
      ```
    - **Permitir seguir links simbólicos**:
      ```text
      showsymlinks
      ```
    - **Usuario y Grupo por defecto**:
      ```text
      User proftpd
      Group nogroup
      ```
    - **Máscara de permisos (Umask)**:
      ```text
      Umask 022 022
      ```
    - **Log de Transferencias**:
      ```text
      TransferLog /var/log/proftpd/xferlog
      ```
    - **Log del Servidor**:
      ```text
      SystemLog /var/log/proftpd/proftpd.log
      ```

    Guardamos los cambios y salimos.

## 6. Revisar Logs
- **Ver los últimos accesos al servidor FTP**:
    ```bash
    tail -n 15 /var/log/proftpd/proftpd.log
    ```
    Aquí se pueden ver los accesos al servidor, incluyendo la fecha, hora, usuario e IP.

- **Ver problemas de conexión**:
    ```bash
    tail -n 15 /var/log/proftpd/xfer.log
    ```
    Este archivo estará vacío si no ha habido problemas de conexión.

## 7. Personalización de Mensajes de Acceso
- **Añadir mensajes personalizados**:
    En el archivo `proftpd.conf`, agregamos las siguientes líneas:
    ```text
    AccessGrantMSG “Bienvenido al servidor FTP de MiServidor”
    AccessDenyMSG “Error de entrada a mi servidor FTP”
    ```
    Guardamos y salimos.

- **Probar mensajes**:
    - En la máquina cliente:
      ```bash
      ftp ip_servidor
      name: Usuario_valido
      ```
      Se mostrará el mensaje de bienvenida.
    - Para un usuario no válido:
      ```bash
      ftp ip_servidor
      name: Usuario_invalido
      ```
      Aparecerá el mensaje de error.

## 8. Configurar el Acceso a Directorios (DefaultRoot)
- **Limitar el acceso del usuario a su directorio home**:
    En `proftpd.conf`, modificamos:
    ```text
    DefaultRoot ~
    ```
    Esto restringe al usuario a su directorio home (`/home/usuario`) al conectarse.

- **Refrescar el servicio**:
    ```bash
    service proftpd reload
    ```

- **Probar la configuración**:
    El usuario solo podrá modificar archivos y carpetas dentro de su propio directorio home.

## 9. Configuración de Umask
- **Ver Umask en `proftpd.conf`**:
    El valor por defecto es `Umask 022 022`, lo que significa:
    - Archivos: `644`
    - Directorios: `755`

- **Probar la creación de archivos y directorios**:
    Conectados al servidor FTP, creamos un directorio y un archivo y verificamos los permisos.

    - **Crear un directorio**:
      ```bash
      ftp> mkdir carpeta_prueba
      ```
      Los permisos deberían ser `drwxr-xr-x`.

    - **Subir un archivo**:
      ```bash
      ftp> put /home/mi_usuario/documentos/apuntes.txt
      ```
      Los permisos del archivo deberían ser `-rw-r--r--`.

## 10. Crear Usuarios Virtuales
- **Incluir la configuración de usuarios virtuales**:
    En `proftpd.conf`, añadimos:
    ```text
    Include /etc/proftpd/modules.conf
    Require ValidShell off
    AuthUserFile /etc/proftpd/ftpd.passwd
    ```

- **Crear directorio para usuarios**:
    ```bash
    cd /var
    mkdir ftp
    mkdir /var/ftp/carpetauser1JSR
    ```

- **Crear usuario virtual**:
    Usamos el comando `ftpasswd`:
    ```bash
    ftpasswd --passwd --name=user1JSR --uid=3000 --gid=3000 --home=/var/ftp/carpetauser1JSR --shell=/bin/false
    ```

- **Desbloquear el usuario**:
    ```bash
    ftpasswd --passwd --name=user1JSR --unlock
    ```

- **Verificar acceso con FileZilla**:
    Iniciamos FileZilla y nos conectamos con el usuario `user1JSR`, usando los parámetros correspondientes.


