FROM php:8.2-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN mkdir -p /var/www/html/img
COPY Logo_VG_color.png /var/www/html/img/logo_ipvg.png

