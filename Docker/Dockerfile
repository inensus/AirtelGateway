FROM php:7.2-apache

RUN a2enmod rewrite
RUN a2enmod ssl

RUN apt-get update && \
    apt-get install -y \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libssl-dev \
    zlib1g-dev \
    bzip2 \
    supervisor \
    vim



# remove apt lists
RUN rm -rf /var/lib/apt/lists/*

# install php extentions
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-png-dir=/usr --with-jpeg-dir=/usr
RUN docker-php-ext-install gd zip mbstring pdo  soap ftp opcache bcmath pcntl
RUN touch /usr/local/etc/php/conf.d/xdebug.ini; \
    echo xdebug.remote_enable=1 >> /usr/local/etc/php/conf.d/xdebug.ini; \
    echo xdebug.remote_autostart=0 >> /usr/local/etc/php/conf.d/xdebug.ini; \
    echo xdebug.remote_connephpct_back=1 >> /usr/local/etc/php/conf.d/xdebug.ini; \
    echo xdebug.remote_port=9000 >> /usr/local/etc/php/conf.d/xdebug.ini; \
    echo xdebug.remote_log=/tmp/php5-xdebug.log >> /usr/local/etc/php/conf.d/xdebug.ini;

COPY configuration/webserver/sites-enabled/000-default.conf /etc/apache2/sites-enabled
RUN a2enmod ssl
RUN service apache2 restart