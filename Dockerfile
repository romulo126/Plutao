FROM php:8.0-apache

RUN apt-get update && \
    apt-get upgrade -y 

RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    docker-php-ext-enable pdo_mysql

RUN service apache2 restart

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Timezone
ENV TZ 'America/Sao_Paulo'
RUN echo $TZ > /etc/timezone
RUN rm /etc/localtime
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime
RUN dpkg-reconfigure -f noninteractive tzdata
USER root
RUN mkdir -p /var/deploy_Manager/Laravel
WORKDIR /var/deploy_Manager
COPY ./api/ /var/deploy_Manager/Laravel
RUN chown -R www-data:www-data /var/deploy_Manager
USER www-data
RUN cd /var/deploy_Manager/Laravel && \
    mkdir vendor && \
    composer install --no-dev && \
    cp .env.example .env && \
    php artisan key:generate