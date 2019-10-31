FROM php:7.3-fpm

RUN apt-get -y update
RUN curl -L -C - --progress-bar -o /usr/local/bin/composer https://getcomposer.org/composer.phar
RUN chmod 755 /usr/local/bin/composer
RUN docker-php-ext-install pdo_mysql mysqli
RUN pecl install redis && docker-php-ext-enable redis
RUN pecl install xdebug-2.7.2 && docker-php-ext-enable xdebug
RUN echo "date.timezone=UTC" >> /usr/local/etc/php/conf.d/timezone.ini
