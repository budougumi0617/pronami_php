FROM php:7.3.10-apache

# https://github.com/bufferings/phpstorm-docker-cakephp/blob/master/docker/Dockerfile
# Xdebug
RUN pecl install xdebug \
 && docker-php-ext-enable xdebug

# For CakePHP
RUN apt-get update && apt-get install -y \
    git \
    libicu-dev \
    libzip-dev \
    zip \
 && rm -rf /var/lib/apt/lists/* \
 && a2enmod rewrite \
 && NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
 && docker-php-ext-configure zip --with-libzip \
 && docker-php-ext-install -j${NPROC} zip intl pdo_mysql

# Composer
ENV COMPOSER_HOME /tmp
COPY --from=composer:1.8.6 /usr/bin/composer /usr/bin/composer

# Change DocumentRoot
WORKDIR /app
ENV APACHE_DOCUMENT_ROOT /app
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Change uid & gid of www-data
RUN usermod -o -u 1000 www-data && groupmod -o -g 1000 www-data

# To switch user on runtime
RUN apt-get update && apt-get -y install \
    gosu \
 && rm -rf /var/lib/apt/lists/*
COPY entrypoint.sh /usr/local/bin/docker-php-entrypoint
RUN chmod +x /usr/local/bin/docker-php-entrypoint

