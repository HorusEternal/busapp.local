FROM php:8.3-fpm-alpine
LABEL authors="ifattakhov"

RUN apk add --no-cache $PHPIZE_DEPS \
    git \
    libpq \
    libzip-dev \
    postgresql-dev \
    bash \
    icu-dev \
    linux-headers

RUN docker-php-ext-configure intl \
    && docker-php-ext-install pdo_pgsql zip intl opcache

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet


RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

EXPOSE 9000

ENTRYPOINT ["php-fpm"]