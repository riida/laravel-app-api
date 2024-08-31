FROM php:8.2.3-fpm-alpine3.17

RUN apk --update add tzdata && \
    cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && \
    apk del tzdata && \
    rm -rf /var/cache/apk/*

RUN apk add --no-cache \
  freetype-dev libxml2-dev oniguruma-dev \
  libjpeg-turbo-dev libpng-dev libmcrypt-dev \
  libmcrypt-dev libltdl \
  && docker-php-ext-install pdo_mysql mysqli mbstring gd \
  && rm -fr /var/cache/apk/*

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini
COPY my-php.ini $PHP_INI_DIR/conf.d/