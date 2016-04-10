# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = '2'

@script = <<SCRIPT
DOCUMENT_ROOT_ZEND="/var/www/zf/public"
apt-get update
apt-get install -y apache2 git curl php5-cli php5 php5-intl libapache2-mod-php5

echo "ejecutar a mano dentro de vagrant"
sudo apt-get install software-properties-common
sudo add-apt-repository ppa:ondrej/php5-5.6
sudo apt-get -y update
sudo apt-get install python-software-properties
sudo apt-get update
sudo apt-get install php5

echo "
<VirtualHost *:80>
    ServerName skeleton-zf.local
    DocumentRoot $DOCUMENT_ROOT_ZEND
    <Directory $DOCUMENT_ROOT_ZEND>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
" > /etc/apache2/sites-available/skeleton-zf.conf
a2enmod rewrite
a2dissite 000-default
a2ensite skeleton-zf
service apache2 restart
cd /var/www/zf
curl -Ss https://getcomposer.org/installer | php
php composer.phar install --no-progress


echo "Prepararando mysql"
apt-get install debconf-utils -y > /dev/null
debconf-set-selections <<< "mysql-server mysql-server/root_password password root"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password root"

echo "Instalando mysql"
apt-get install mysql-server -y > /dev/null

echo "Inicializando BD"
mysql -u root -proot -e "create database myappnfc";

echo "Inicializando tablas"
mysql -uroot -proot myappnfc < /var/www/zf/public/BD/myappnfc_banco_ids.sql
mysql -uroot -proot myappnfc < /var/www/zf/public/BD/myappnfc_claves_notificaciones.sql
mysql -uroot -proot myappnfc < /var/www/zf/public/BD/myappnfc_info_servicio.sql
mysql -uroot -proot myappnfc < /var/www/zf/public/BD/myappnfc_info_user.sql
mysql -uroot -proot myappnfc < /var/www/zf/public/BD/myappnfc_permisos_user_servicio.sql
mysql -uroot -proot myappnfc < /var/www/zf/public/BD/myappnfc_users.sql




echo "** [ZEND] Visit http://localhost:8085 in your browser for to view the application **"
SCRIPT



Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = 'bento/ubuntu-14.04'
  config.vm.network "forwarded_port", guest: 80, host: 8085
  config.vm.hostname = "skeleton-zf.local"
  config.vm.synced_folder '.', '/var/www/zf'
  config.vm.provision 'shell', inline: @script

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

end
