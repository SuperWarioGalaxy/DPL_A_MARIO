PASOS PARA EMPRESA1 HACER LO MISMO CON 2 y 3 

mkdirn -p /var/www/empresa1

chown -R usario /var/www/empresa1 

chmod -R 755 /var/www/emprea1

cd /etc/nginx/sites-avalible/

cp default empresa1

nano empresa1

en "listen:80" y listen[::] quitar default_server

root /var/www/html ponemos empresa1 donde pone html

donde pone server_name ponemos empresa1.com www.empresa1.com

cd ..

ln -s /etc/nginx/sites_avilable/empresa1 /etc/nginx/sites_enabled/

cd /sites_enabled/

rm default

nginx -t

nginx -s reload

nano /etc/hosts

Añadir al lado de 172.0.1.1 empresa1.com www.empresa1.com

cd /var/www/empresa1

nano index.html (pondremos un simple h1 con Empresa 1)

nginx -s reload

var en el navegador poniendo empresa1.com
