FROM php:7.2-apache
RUN apt-get update 
RUN cd /usr/local/bin
RUN docker-php-ext-install mysqli
RUN service apache2 start
RUN service apache2 restart
EXPOSE 80