FROM php:8.0-apache

WORKDIR /var/www/html
COPY . /var/www/html/

RUN apt-get update && apt-get install -y curl

RUN docker-php-ext-install mysqli

EXPOSE 80

RUN chmod +x /var/www/html/init.sh

CMD ["bash", "/var/www/html/init.sh"]