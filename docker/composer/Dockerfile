FROM php:8.2.3-alpine

RUN apk update && \
  apk add git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer 

WORKDIR /var/www/html