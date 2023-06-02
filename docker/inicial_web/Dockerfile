FROM ubuntu

ENV TZ=Europe/Madrid
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone


# RUN apt-get update \
#   && apt-get install -y apt apt-utils dialog mc aptitude php7.4 php7.4-intl php7.4-xml php7.4-curl php7.4-mbstring php7.4-gd php7.4-zip unzip adminer git

RUN \
  sed -i 's/# \(.*multiverse$\)/\1/g' /etc/apt/sources.list && \
  apt-get update && \
  apt-get -y upgrade && \
#  apt-get install -y build-essential && \
# apt-get install -y software-properties-common && \
#  apt-get install -y byobu curl git htop man unzip vim wget && \
  apt-get install -y apache2 mc aptitude php8.1 php8.1-intl php8.1-xml php8.1-curl php8.1-mbstring php8.1-gd php8.1-zip adminer composer npm && \
  rm -rf /var/lib/apt/lists/*
  
COPY index.php /var/www/html/
COPY compone /var/www/html/
COPY composer /var/www/html/
COPY app_local.php /var/www/html/
COPY 000-default.conf /etc/apache2/sites-available/
#COPY php.ini /etc/php/8.1/apache2/
COPY milligram.min.css /var/www/html/


# componer
RUN /var/www/html/compone webtareas3
RUN mv /var/www/html/app_local.php /var/www/html/webtareas3/config
RUN cd /var/www/html/webtareas3; chown www-data:www-data -R *
RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
COPY composer.json /var/www/html/webtareas3
RUN cd /var/www/html/webtareas3; composer update


COPY src /var/www/html/webtareas3/src/
COPY templates /var/www/html/webtareas3/templates/
COPY milligram.min.css /var/www/html/webtareas3/webroot/css



WORKDIR /var/www/html
CMD ["apachectl", "-D", "FOREGROUND"]
EXPOSE 80

