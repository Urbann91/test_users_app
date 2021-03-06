FROM php:7.4

ARG UID
ARG GID

RUN apt-get update \
    && apt-get install -y git zlib1g-dev libxml2-dev unzip libzip-dev libpq-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install zip \
    && docker-php-ext-install bcmath \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo_pgsql pgsql

RUN echo "short_open_tag = Off" >> /usr/local/etc/php/conf.d/no_tags.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.0.14

# Create user
RUN groupadd -g $GID docker-users && \
    useradd -m --no-log-init -s /bin/bash -u $UID -g $GID docker && \
    echo "docker:docker" | chpasswd && \
    adduser docker sudo

WORKDIR /var/www/app

USER docker
