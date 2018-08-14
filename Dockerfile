FROM evilfreelancer/alpine-apache-php7:php-7.1

ADD . /app
WORKDIR /app
RUN chown -R apache:apache /app \
 && composer install
