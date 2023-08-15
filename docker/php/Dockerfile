FROM php:8.2-fpm-alpine

# Создайте нового пользователя с указанными идентификаторами
ARG PUID=1000
ARG PGID=1000
RUN apk --no-cache add shadow && \
    groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

USER root

# Установите необходимые пакеты и PHP-расширения
RUN apk add --no-cache \
        autoconf \
        g++ \
        make \
        icu-dev \
        postgresql-dev \
        zlib-dev \
        libzip-dev \
        bash \
        git \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install \
        intl \
        opcache \
        pdo \
        pdo_pgsql \
        zip

RUN curl -Ss getcomposer.org/installer | php

RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

COPY --chown=data:www-data docker/php/conf.d/local.ini $PHP_INI_DIR/conf.d
RUN chown -R www-data:www-data .

RUN   sed -i "s|memory_limit = 128M|memory_limit = 256M |g" $PHP_INI_DIR/php.ini-development
RUN   sed -i "s|memory_limit = 128M|memory_limit = 256M |g" $PHP_INI_DIR/php.ini-production

# Установите Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

USER www-data

WORKDIR /var/www/html