# Guía de instalación y configuración de vsftpd

## Instalación de vsftpd
1. **Instalar el paquete `vsftpd`**:
    ```bash
    $ sudo apt-get install vsftpd
    ```

2. **Editar el archivo de configuración**:
    Las configuraciones se encuentran en el archivo `/etc/vsftpd.conf`:
    ```bash
    $ sudo gedit /etc/vsftpd.conf
    ```

## Configuración del acceso anónimo

1. **Habilitar el acceso anónimo**:
    Descomentar las siguientes líneas para habilitar el acceso anónimo:
    ```bash
    # anonymous_enable=YES
    # local_enable=YES
    # anon_root=/ftp
    ```
    - `anonymous_enable=YES`: Habilita el acceso anónimo.
    - `local_enable=YES`: Habilita el acceso de usuarios locales.
    - `anon_root=/ftp`: Especifica la carpeta a la que tendrá acceso el usuario anónimo.

2. **Crear el usuario anónimo**:
    Crear un usuario llamado `whoever`:
    ```bash
    $ sudo adduser whoever
    ```
    Se solicitará la contraseña del usuario.

3. **Configurar permisos de acceso**:
    Crear la carpeta `/ftp` y asignarle permisos al usuario `whoever`:
    ```bash
    $ sudo mkdir /ftp
    $ sudo chown whoever:whoever -R /ftp
    ```

4. **Reiniciar el servicio de vsftpd**:
    ```bash
    $ sudo service vsftpd restart
    ```

## Conexión desde el cliente

1. **Configurar FileZilla**:
    - Servidor: IP del servidor
    - Protocolo: FTP
    - Cifrado: "Use explicit FTP over TLS if available"
    - Modo de acceso: Anónimo

2. **Verificar permisos de escritura**:
    Intentamos crear un archivo en el servidor, pero inicialmente no se permite escritura. Asignamos permisos a la carpeta `/ftp`:
    ```bash
    $ sudo chmod 777 /ftp
    ```

3. **Error de escritura**:
    El error 500 indica que no se permite escritura en la raíz del sistema. Para solucionarlo, cambiamos los permisos en la carpeta `/ftp/`:
    ```bash
    $ sudo chmod 555 /ftp
    ```

4. **Crear una subcarpeta para subir archivos**:
    Crear la carpeta `/ftp/uploads` con permisos de escritura:
    ```bash
    $ sudo mkdir /ftp/uploads
    $ sudo chmod 777 /ftp/uploads
    $ sudo chown whoever:whoever -R /ftp
    ```

5. **Permitir la carga de archivos por el usuario anónimo**:
    Editar el archivo `/etc/vsftpd.conf` para habilitar el permiso de escritura:
    ```bash
    # write_enable=YES
    # anon_upload_enable=YES
    ```

6. **Reiniciar el servicio**:
    ```bash
    $ sudo service vsftpd restart
    ```

## Enjaular usuarios

1. **Configurar la enjaulación de usuarios**:
    Editar el archivo `/etc/vsftpd.conf` para habilitar la enjaulación:
    ```bash
    # chroot_local_user=YES
    # chroot_list_enable=YES
    # chroot_list_file=/etc/vsftpd.chroot_list
    # allow_writetable_chroot=YES
    ```

2. **Crear el archivo `/etc/vsftpd.chroot_list`**:
    Este archivo contiene los usuarios que no estarán enjaulados. En este caso, agregamos el usuario `noenjaulado`:
    ```bash
    $ sudo gedit /etc/vsftpd.chroot_list
    ```
    Contenido:
    ```
    noenjaulado
    ```

3. **Reiniciar el servicio**:
    ```bash
    $ sudo service vsftpd restart
    ```

4. **Verificación en el cliente**:
    Al conectarse con el usuario `noenjaulado`, se puede navegar fuera de su carpeta, mientras que el usuario `enjaulado` solo podrá acceder a su directorio de trabajo.

## Configuración de conexión cifrada

1. **Instalar OpenSSL**:
    Si no está instalado, instalar OpenSSL:
    ```bash
    $ sudo apt-get install openssl
    ```

2. **Crear el certificado SSL**:
    Generar el certificado SSL para el servidor FTP:
    ```bash
    $ sudo openssl req -x509 -nodes -days 365 -newkey rsa:1024 -keyout /etc/ssl/private/vsftpd.key -out /etc/ssl/certs/vsftpd.pem
    ```

3. **Configurar el archivo `vsftpd.conf` para usar SSL**:
    Modificar el archivo `/etc/vsftpd.conf` para habilitar SSL:
    ```bash
    ssl_enable=YES
    # listen_port=990
    allow_anon_ssl=NO
    force_local_data_ssl=YES
    force_local_logins_ssl=YES
    ssl_tlsv1=YES
    ssl_tlsv2=NO
    ssl_ciphers=HIGH
    rsa_cert_file=/etc/ssl/certs/vsftpd.pem
    rsa_private_key_file=/etc/ssl/private/vsftpd.key
    ```

4. **Reiniciar el servicio**:
    ```bash
    $ sudo service vsftpd restart
    ```

5. **Verificación en el cliente**:
    Al intentar conectarse con FileZilla, el cliente debería recibir una advertencia de certificado SSL, lo que indica que la conexión está cifrada.

---

**Resumen**:

1. Se instala y configura `vsftpd` para habilitar el acceso anónimo y permitir la carga de archivos.
2. Se asignan permisos adecuados en el servidor y se permite que los usuarios anónimos suban archivos.
3. Se configura la enjaulación de usuarios, donde algunos usuarios tienen acceso restringido a sus directorios.
4. Finalmente, se asegura la conexión mediante SSL, creando y configurando un certificado para cifrar la transmisión de datos.
