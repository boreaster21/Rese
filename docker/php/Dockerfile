FROM php:8.1-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
  && apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
  && docker-php-ext-install pdo_mysql zip \
  libpq-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
  && docker-php-ext-install \ 
  pdo_mysql \ 
  bcmath \
  gd \
  && docker-php-ext-configure gd \
  --with-freetype=/usr/include/ \
  --with-jpeg=/usr/include/ \
  && docker-php-ext-install -j$(nproc) gd

RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

WORKDIR /var/www