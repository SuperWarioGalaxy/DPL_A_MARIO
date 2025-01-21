1.Instalar BIND9:

    Ejecutar los siguientes comandos para instalar el software necesario:

    sudo apt update
    sudo apt install bind9 bind9utils bind9-doc

2.Verificar el estado de BIND9:

    Asegurarse de que el servicio esté activo:

    sudo systemctl status bind9

3.Configurar zonas DNS:

    Editar /etc/bind/named.conf.local para definir las zonas DNS. Ejemplo:

    zone "midominio.com" {
        type master;
        file "/etc/bind/db.midominio.com";
    };

4.Crear el archivo de zona:

    Copiar y editar el archivo de zona /etc/bind/db.local a /etc/bind/db.midominio.com. Ejemplo de configuración del archivo de zona:

    $TTL    604800
    @       IN      SOA     ns1.midominio.com. admin.midominio.com. (
                        2025012101 ; Serial
                        604800     ; Refresh
                        86400      ; Retry
                        2419200    ; Expire
                        604800 )   ; Negative Cache TTL
    ;
    @       IN      NS      ns1.midominio.com.
    @       IN      A       192.168.1.10
    ns1     IN      A       192.168.1.10

5.Configurar opciones de BIND9:

    Editar /etc/bind/named.conf.options para agregar servidores DNS de reenvío y otras configuraciones. Ejemplo de configuración:

    options {
        forwarders {
            8.8.8.8;  # Google DNS
            8.8.4.4;  # Google DNS
        };
        recursion yes;
        listen-on-v6 { any; };
    };

6.Verificar la configuración:

    Ejecutar los siguientes comandos para verificar que no haya errores:

    sudo named-checkconf
    sudo named-checkzone midominio.com /etc/bind/db.midominio.com

7.Reiniciar el servicio BIND9:

    Aplicar los cambios reiniciando el servicio:

    sudo systemctl restart bind9

8.Configurar el firewall:

    Permitir tráfico en el puerto 53 para DNS:

    sudo ufw allow 53
    sudo ufw reload

9.Probar la configuración:

    Usar herramientas como dig o nslookup para verificar que el servidor DNS está resolviendo correctamente:

    dig @192.168.1.10 midominio.com

