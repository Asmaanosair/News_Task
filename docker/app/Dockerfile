FROM php:8.3-fpm
RUN echo "Install COMPOSER"
RUN cd /tmp \
    && curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get -y install apt-utils nano wget dialog vim

RUN echo "Install important libraries"
RUN apt-get -y install --fix-missing \
    apt-utils \
    build-essential \
    git \
    curl \
    libcurl4 \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libzip-dev \
    zip \
    libbz2-dev \
    locales \
    libmcrypt-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www

# Install nodejs and npm
RUN curl -sL https://deb.nodesource.com/setup_20.x -o nodesource_setup.sh
RUN ["sh",  "./nodesource_setup.sh"]

RUN apt-get -y install nodejs

EXPOSE 9000

CMD ["php-fpm"]
