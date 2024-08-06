FROM php:7.2-apache

COPY src/ /var/www/html/
# COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN docker-php-ext-install mysqli
RUN a2enmod proxy
RUN a2enmod proxy_http
# RUN systemctl restart apache2
CMD ["apache2-foreground"]