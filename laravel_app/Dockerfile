# FROM almalinux
FROM php:8.0-apache

# proxy
# RUN pear config-set http_proxy http://proxy0.screen.co.jp:8080

COPY php.ini /usr/local/etc/php/
COPY *.conf /etc/apache2/sites-enabled/

# other pachage
RUN apt-get update &&\
    apt-get install -y \
        vim \
        git \
        libonig-dev \
        unzip \
        libzip-dev \
        libpq-dev \
        libicu-dev

# supervisor
# RUN apt-get install -y supervisor

# cron
RUN apt-get install -y cron
#COPY cron/cron.conf /tmp/
#RUN crontab /tmp/cron.conf
#RUN rm -f /tmp/cron.conf

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - &&\
    apt-get install -y nodejs

# PHP extension
RUN docker-php-ext-install \
        mbstring \
        zip \
	    intl \
	    pcntl

RUN docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

# logrotate
# RUN apt-get install -y logrotate
# COPY logrotate/supervisord /etc/logrotate.d/supervisord

# xdebug
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

WORKDIR /var/www/html

# CMD ["/usr/bin/supervisord"]
