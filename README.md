# Symfony 5 Docker-Development-Stack
This is a lightweight stack based on Alpine Linux for running Symfony 5 into Docker containers using docker compose.

<!-- [![Build Status](https://travis-ci.com/coloso/symfony-docker.svg?branch=master)](https://travis-ci.org/coloso/symfony-docker) -->

For PHP8 use the following branch: https://github.com/coloso/symfony-docker/tree/php8-dev  

### Prerequisites
* [Docker](https://www.docker.com/)

### Контейнеры
 - [php-fpm](https://hub.docker.com/_/php) 7.4.+
    - [composer](https://getcomposer.org/) 
    - [yarn](https://yarnpkg.com/lang/en/) and [node.js](https://nodejs.org/en/) (if you will use [Encore](https://symfony.com/doc/current/frontend/encore/installation.html) for managing JS and CSS)
 - [nginx](https://hub.docker.com/_/nginx) 1.21.+
 - [mysql](https://hub.docker.com/_/mysql/) 5.7.+

### Установка

Запустите сборку Docker-а
```shell
# первая сборка
docker compose up --build
# пересоздание контейнеров 
docker compose up --build --force-recreate
```

Соединитесь с контейнером PHP
```shell
# в Linux
docker compose exec php sh

# в Windows 
winpty docker compose exec php sh
```

Установите последнюю версию [Symfony](http://symfony.com/doc/current/setup.html) с помощью composer-а:
```shell
# стандартное web-приложение: 
composer create-project symfony/website-skeleton .

# микросервис, консольное или API-приложение:
composer create-project symfony/skeleton .
```

Т.к. Symfony установится в папку skeleton (или website-skeleton), то переносим все в папку сайта:
```shell
mv /var/www/symfony/skeleton/* /var/www/symfony
mv /var/www/symfony/skeleton/.* /var/www/symfony
rm -Rf /var/www/symfony/skeleton
```

Измените DATABASE_URL в файле .env 
```
DATABASE_URL=mysql://root:root@mysql:3306/symfony?serverVersion=5.7
```

### Готово
Откройте в браузере [localhost](http://localhost/)
