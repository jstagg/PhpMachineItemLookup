# Spec the machine base
FROM php:7.3-apache

# Maintainer
LABEL maintainer="jstagg@gmail.com"

# Install dependencies
RUN apt-get update && apt-get install apt-utils python3-pip sqlite3 -y && apt clean

# Onboard the stuff
COPY ./app /app
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN chown -R www-data:www-data /app && a2enmod rewrite && pip3 install termsql
RUN termsql -d ',' -u '"' -c id,mydata -i /app/data.txt -o /app/myDB.db

WORKDIR /app

EXPOSE 80