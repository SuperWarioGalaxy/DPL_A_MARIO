# Configuración de SSL en Nginx usando OpenSSL para el host virtual `empresa1`

Este documento explica cómo configurar un certificado SSL en un servidor Nginx usando OpenSSL para un host virtual llamado `empresa1`.

## 1. Generar un Certificado SSL con OpenSSL

### Paso 1: Generar la clave privada

Primero, debemos generar una clave privada para el certificado. Ejecuta el siguiente comando:

```bash
openssl genpkey -algorithm RSA -out /etc/ssl/private/empresa1.key -aes256

Este comando generará una clave privada (empresa1.key) en la ubicación /etc/ssl/private/ y la cifra con AES-256.
Paso 2: Crear el archivo de solicitud de firma de certificado (CSR)

El siguiente paso es generar un archivo CSR (Certificate Signing Request), que será necesario si deseas que el certificado sea firmado por una autoridad certificadora (CA). Ejecuta:

openssl req -new -key /etc/ssl/private/empresa1.key -out /etc/ssl/certs/empresa1.csr

Se te pedirá que ingreses la siguiente información:

    Country Name: Código de dos letras de tu país.
    State or Province Name: Nombre de tu estado o provincia.
    Locality Name: Nombre de la ciudad.
    Organization Name: Nombre de tu empresa.
    Organizational Unit Name: Una unidad dentro de tu empresa (opcional).
    Common Name: El dominio para el que estás creando el certificado (por ejemplo, empresa1.tudominio.com).
    Email Address: Tu dirección de correo electrónico (opcional).

Paso 3: Crear un certificado autofirmado (opcional)

Si solo deseas crear un certificado autofirmado (por ejemplo, para pruebas o uso interno), puedes generar el certificado con este comando:

openssl x509 -req -in /etc/ssl/certs/empresa1.csr -signkey /etc/ssl/private/empresa1.key -out /etc/ssl/certs/empresa1.crt -days 365

Este comando genera un certificado autofirmado (empresa1.crt) válido por 365 días.
2. Configurar Nginx con el certificado SSL

Una vez que tengas el certificado (empresa1.crt) y la clave privada (empresa1.key), configura Nginx para usarlos.
Paso 1: Editar la configuración de Nginx

Abre el archivo de configuración del sitio para empresa1. Si está en /etc/nginx/sites-available/empresa1, edítalo con:

sudo nano /etc/nginx/sites-available/empresa1

Si no tienes el archivo, crea uno con el siguiente contenido:

server {
    listen 80;
    server_name empresa1.tudominio.com;

    # Redirigir tráfico HTTP a HTTPS
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl;
    server_name empresa1.tudominio.com;

    # Rutas al certificado SSL y clave privada
    ssl_certificate /etc/ssl/certs/empresa1.crt;
    ssl_certificate_key /etc/ssl/private/empresa1.key;

    # Opciones de seguridad recomendadas para SSL
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers 'TLS_AES_128_GCM_SHA256:TLS_AES_256_GCM_SHA384:TLS_ECDHE_RSA_WITH_AES_128_GCM_SHA256';
    ssl_prefer_server_ciphers on;

    # Configuración adicional de seguridad
    ssl_session_cache shared:SSL:10m;
    ssl_session_timeout 1d;
    ssl_session_tickets off;
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains; preload" always;

    # Configuración del servidor
    root /var/www/empresa1;
    index index.html index.htm;

    location / {
        try_files $uri $uri/ =404;
    }
}

Paso 2: Crear un enlace simbólico en sites-enabled

Para habilitar el sitio, crea un enlace simbólico en sites-enabled desde sites-available:

sudo ln -s /etc/nginx/sites-available/empresa1 /etc/nginx/sites-enabled/

3. Probar la configuración de Nginx

Antes de reiniciar Nginx, verifica que la configuración sea correcta con:

sudo nginx -t

Si la configuración es correcta, deberías ver algo como:

nginx: configuration file /etc/nginx/nginx.conf test is successful

4. Reiniciar Nginx

Reinicia Nginx para aplicar los cambios:

sudo systemctl restart nginx
