FROM php:8.3-fpm

# set main params
ARG BUILD_ARGUMENT_ENV=dev

ENV APP_HOME /var/www/html
COPY app.py /app/


# install all the dependencies and enable PHP modules
RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    curl \
    git \
    unzip \
    libicu-dev \
    zlib1g-dev \
    libxml2-dev \
    libreadline-dev \
    supervisor \
    cron \
    sudo \
    libzip-dev \
    wget \
    librabbitmq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js and npm
RUN apt update && apt install -y curl gnupg \
  && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
  && apt install -y nodejs


# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN chmod +x /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# Set working directory
WORKDIR /var/www/html

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql sockets intl opcache zip
RUN pecl install amqp && docker-php-ext-enable amqp

# Clean up
RUN rm -rf /tmp/* \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean