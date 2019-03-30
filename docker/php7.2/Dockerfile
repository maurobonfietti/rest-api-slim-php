FROM php:7.2-fpm

RUN apt-get -y update
RUN curl -L -C - --progress-bar -o /usr/local/bin/composer https://getcomposer.org/composer.phar
RUN chmod 755 /usr/local/bin/composer
RUN apt-get install -y git
RUN apt-get install -y zlib1g-dev git unzip zip
RUN docker-php-ext-install pdo_mysql mysqli bcmath zip pcntl
RUN pecl install redis && docker-php-ext-enable redis
RUN echo "date.timezone=UTC" >> /usr/local/etc/php/conf.d/timezone.ini
RUN apt-get install -y wget nano
