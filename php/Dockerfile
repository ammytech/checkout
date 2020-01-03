FROM php:7.2-fpm
COPY www.conf /etc/php-fpm.d/www.conf    
RUN docker-php-ext-install mysqli
RUN apt-get update -y && apt-get install -y sendmail libpng-dev

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev 

RUN docker-php-ext-install mbstring

RUN docker-php-ext-install zip

RUN docker-php-ext-install gd

