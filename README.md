viewHTML is a simple pastehtml clone wrote in PHP

Let users paste HTML code and published in a temporal webpage<br>
for others to see, or can be use as a general pastebin like<br>
by adding the &raw=1 at the end of the generated URL.<br>

Uses mysql_pdo driver and adds a Disqus, Adsense deal in the web,<br>
but you can take it off by removing the adsense and disqus functions.<br>

INSTALL

Extract all files in the document webroot or whatever <br>
Create a table usind the pastehtml.sql in /sql folder<br>
copy include/pastehtml.ini.example to include/pastehtml.ini
Edit include/pastehtml.ini to reflect your needs<br>
Edit include/funciones.php and modify adsense and disqus functions<br>
to use your own credentials<br>

PRECONFIG:
sudo apt install mariadb-server
sudo apt install phpmyadmin
sudo mysql_secure_installation

sudo mysql -u root -p
Welcome to the MariaDB monitor.  Commands end with ; or \g.
Your MariaDB connection id is 150
Server version: 10.3.23-MariaDB-0+deb10u1 Raspbian 10

Copyright (c) 2000, 2018, Oracle, MariaDB Corporation Ab and others.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

MariaDB [(none)]> GRANT ALL PRIVILEGES ON *.* TO 'phpmyadmin'@'localhost' WITH GRANT OPTION;
MariaDB [(none)]> FLUSH PRIVILEGES;
MariaDB [(none)]> EXIT;

cd
mkdir public_html
cd public_html/
git clone https://github.com/dzup/viewhtml.git
sudo a2enmod userdir
sudo a2enmod php7.3
sudo -Hu pi sh -c 'chmod 755 $HOME $HOME/public_html'

sudo nano /etc/apache2/mods-enabled/php7.3.conf
#SEARCH for php_admin_flag engine Off to 
# php_admin_flag engine On

sudo service apache2 restart

cd $HOME/public_html/include
ls
cp pastehtml.ini.example pastehtml.ini
nano pastehtml.ini  #<- change that file
cd ..
cd sql
#either open and copy-paste the whole file into 
#phpmyadmin SQL section for viewhtml sql database or
#use mysql -u root -p to create a username
#named viewhtml, database viewhtml like soo:
CREATE USER 'viewhtml'@'localhost' IDENTIFIED VIA mysql_native_password USING 'viewhtml';GRANT USAGE ON *.* TO 'viewhtml'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS `viewhtml`;GRANT ALL PRIVILEGES ON `viewhtml`.* TO 'viewhtml'@'localhost';GRANT ALL PRIVILEGES ON `viewhtml\_%`.* TO 'viewhtml'@'localhost';

#THEN run the sql file: pastehtml.sql

#browse to your lab site
http://localhost/~USERNAME/viewhtml/





Browse your website.

Send any comments to dzupd@yahoo.com
Thank You
