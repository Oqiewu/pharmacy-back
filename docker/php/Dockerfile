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

# Установите Xdebug
RUN apk add --no-cache $PHPIZE_DEPS linux-headers \
    && pecl install xdebug-3.2.1 \
    && docker-php-ext-enable xdebug

# Настройте Xdebug
COPY docker/php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Установите Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

USER www-data

WORKDIR /var/www/html