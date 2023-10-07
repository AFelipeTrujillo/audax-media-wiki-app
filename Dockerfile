FROM php:8.1-apache
RUN apt-get update && apt-get upgrade -y
RUN apt-get install libxml2-dev -y
RUN apt-get install git -y
RUN apt-get install zip unzip libzip-dev -y
RUN docker-php-ext-install zip
RUN docker-php-ext-install ctype
RUN docker-php-ext-install iconv
RUN docker-php-ext-install session
RUN docker-php-ext-install simplexml
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');" 
RUN mv composer.phar /usr/local/bin/composer