sudo apt update
sudo apt install vsftpd

sudo useradd -m usuario1
sudo useradd -m usuario6

sudo usermod -s /sbin/nologin usuario1
sudo usermod -s /sbin/nologin usuario6

sudo mkdir /home/usuario1/ftp
sudo mkdir /home/usuario6/ftp

sudo chmod 750 /home/usuario1/ftp
sudo chmod 750 /home/usuario6/ftp

sudo chown root:root /home/usuario1
sudo chown root:root /home/usuario6
sudo chown usuario1:usuario1 /home/usuario1/ftp
sudo chown usuario6:usuario6 /home/usuario6/ftp

sudo useradd -m usuario2
sudo useradd -m usuario5

sudo useradd -m usuario3
sudo useradd -m usuario4

sudo usermod -s /sbin/nologin usuario3
sudo usermod -s /sbin/nologin usuario4

sudo nano /etc/vsftpd.conf

sudo nano /etc/vsftpd.user_list

sudo openssl req -new -x509 -days 365 -nodes -out /etc/ssl/certs/vsftpd.crt -keyout
/etc/ssl/private/vsftpd.key

sudo systemctl restart vsftpd

grep usuario1 /etc/passwd
grep usuario2 /etc/passwd
grep usuario6 /etc/passwd

openssl s_client -connect localhost:21
