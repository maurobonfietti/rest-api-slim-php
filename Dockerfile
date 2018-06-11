FROM php:7.1-apache

RUN a2enmod rewrite env

ADD docker-config/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2ensite 000-default

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo_mysql mysqli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    && apt-get clean

RUN echo "date.timezone=UTC" >> /usr/local/etc/php/conf.d/timezone.ini

COPY ./composer.* /app/

RUN cd /app/ && composer install --no-dev -n

COPY . /app/

RUN chown www-data.www-data /app -R

RUN rm -fr /var/www/html && ln -s /app /var/www/html
