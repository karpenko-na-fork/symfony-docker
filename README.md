# Тестовое задание Symfony 5 + PHP 7.4 + Docker

Используя PHP 7 и фреймворк Symfony 5 (последние версии PHP 7.4 и Symfony 5.2), а также Doctrine ORM и с использованием Docker контейнера, написать REST API для создания и получения книг и авторов из базы данных в формате JSON.

Требования к заданию:
- Написать миграцию, засеивающую тестовые таблицы ~10 000 книгами и ~10 000 авторами
- Реализовать запросы на создание книги и автора в базе `/book/create`, `/author/create`
- Реализовать запрос на получение списка книг с автором из базы `/book/search` c поиском по названию книги
- Написать Unit-тест
- Используя возможности Symfony по локализации контента, сделать мультиязычный метод получения информации о книге `/{lang}/book/{Id}`, где {lang} = en|ru и {Id} = Id книги. Формат ответа: `{Id: 1, 'Name':'War and Peace|Война и мир'}` - поле Name выводить на языке локализации запроса.

Пример формата сущностей:
```json
Автор: {
   'Id': 1,
   'Name': 'Лев Толстой'
}

Книга: { 
    'Id': 1, 
    'Name': ' War and peace|Война и мир', 
    'Author': [
         { 
            'Id': 1, 
            'Name': 'Лев Толстой' 
         }
    ]
}
```

### Контейнеры
 - [php-fpm](https://hub.docker.com/_/php) 7.4.+
    - [composer](https://getcomposer.org/) 
    - [yarn](https://yarnpkg.com/lang/en/) and [node.js](https://nodejs.org/en/) (if you will use [Encore](https://symfony.com/doc/current/frontend/encore/installation.html) for managing JS and CSS)
 - [nginx](https://hub.docker.com/_/nginx) 1.21.+
 - [mysql](https://hub.docker.com/_/mysql/) 5.7.+
 - [adminer](https://hub.docker.com/_/adminer/) 4.8.1

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

Выполнение миграций
```shell
php bin/console doctrine:migrations:migrate
```

### Готово
Откройте в браузере [localhost](http://localhost/)

Базу данный можно посмотреть по ссылке [localhost:8080](http://localhost:8080/)

![Вход в Adminer](./help/adminer-login.png)
