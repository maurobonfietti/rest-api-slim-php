# API REST EN SLIM PHP

Ejemplo de API REST con micro framework [Slim PHP](https://www.slimframework.com).

![alt text](extras/img/slim-logo.png "Slim PHP micro framework")

Esta simple API RESTful, permite operaciones CRUD para administrar recursos como por ejemplo: Usuarios, Tareas y Notas.

[![Build Status](https://travis-ci.org/maurobonfietti/rest-api-slim-php.svg?branch=master)](https://travis-ci.org/maurobonfietti/rest-api-slim-php)
[![Test Coverage](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/badges/coverage.svg)](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/coverage)
[![Code Quality](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/?branch=master)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=maurobonfietti_rest-api-slim-php&metric=alert_status)](https://sonarcloud.io/dashboard?id=maurobonfietti_rest-api-slim-php)
[![Software License][ico-license]](LICENSE.md)

También puedes leerlo en inglés [README IN ENGLISH](README.md).

Principales tecnologías utilizadas: `PHP, Slim 3, MySQL, Redis, PHPUnit and JSON Web Tokens.`

Además, utilizo otras herramientas adicionales como: `Docker & Docker Compose, Travis CI, Swagger, Code Climate, Scrutinizer, Sonar Cloud, PHPStan, Heroku, CORS, environment variables, composer and git.`

Más información sobre este proyecto en mi publicación: [Cómo crear una API REST con Slim PHP](https://maurobonfietti.github.io/2019-06-03-rest-api-slim-php/).

Implementé esta API en [este proyecto](https://github.com/maurobonfietti/rest-api-slim-php-web-app). Es una aplicación web tipo lista de tareas, desarrollada en Angular.


## INSTALACIÓN RÁPIDA:

### Pre Requisitos:

- Git.
- Composer.
- PHP.
- MySQL/MariaDB.


### Usando Composer:

Puede crear un nuevo proyecto ejecutando los siguientes comandos:

```bash
$ composer create-project maurobonfietti/rest-api-slim-php [my-api-name]
$ cd [my-api-name]
$ cp .env.example .env
$ composer database
$ composer start
```

### Usando Git:

En su terminal favorita ejecute estos comandos:

```bash
$ git clone https://github.com/maurobonfietti/rest-api-slim-php.git && cd rest-api-slim-php
$ cp .env.example .env
$ composer install
$ composer database
$ composer start
```

[![How to install](extras/img/how-to-install-2.gif)](https://youtu.be/xQfTcKbD7NI)


### Usando Docker:

Puedes probar este proyecto usando **docker** y **docker-compose**.


### Version Requerida Docker:

* Engine: 18.03+
* Compose: 1.21+


**Comandos:**

```bash
# Start the API (this is my alias for: docker-compose up -d --build).
$ make up

# To create the database and import test data from scratch.
$ make db

# Checkout the API.
$ curl http://localhost:8081

# Stop and remove containers (it's like: docker-compose down).
$ make down
```


## INSTALACIÓN PASO A PASO:

Si tuviste alguna duda o problema, puedes consultar [esta guía paso a paso](TROUBLESHOOTING.md).


## DEPENDENCIAS:

### LISTA DE DEPENDENCIAS REQUERIDAS:

- [slim/slim](https://github.com/slimphp/Slim): Micro framework PHP que ayuda a escribir rápidamente aplicaciones y APIs simples pero potentes.
- [respect/validation](https://github.com/Respect/Validation): El motor de validación más impresionante jamás creado para PHP.
- [palanik/corsslim](https://github.com/palanik/CorsSlim): Middleware de intercambio de recursos de origen cruzado (CORS) para PHP Slim.
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv): Carga las variables de entorno de `.env` a `getenv()`, `$_ENV` y `$_SERVER` automágicamente.
- [predis/predis](https://github.com/phpredis/phpredis): Extensión de PHP para Redis.
- [firebase/php-jwt](https://github.com/firebase/php-jwt): Una biblioteca simple para codificar y decodificar JSON Web Tokens (JWT) en PHP.

### LISTA DE DEPENDENCIAS PARA DESARROLLO:

- [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit): Framework para hacer Unit Testing en PHP.
- [phpstan/phpstan](https://github.com/phpstan/phpstan): PHPStan, herramienta de análisis estático para PHP.


## TESTING:

Ejecutar los tests PHPUnit con `composer test`.

```bash
$ composer test
> phpunit
PHPUnit 8.4.1 by Sebastian Bergmann and contributors.

...............................................................   63 / 63 (100%)

Time: 436 ms, Memory: 16.00 MB

OK (63 tests, 305 assertions)
```


## DOCUMENTACIÓN:

### ENDPOINTS:

#### INFO:

- Help: `GET /`

- Status: `GET /status`


#### USERS:

- Login User: `POST /login`

- Create User: `POST /api/v1/users`

- Update User: `PUT /api/v1/users/{id}`

- Delete User: `DELETE /api/v1/users/{id}`


#### TASKS:

- Get All Tasks: `GET /api/v1/tasks`

- Get One Task: `GET /api/v1/tasks/{id}`

- Create Task: `POST /api/v1/tasks`

- Update Task: `PUT /api/v1/tasks/{id}`

- Delete Task: `DELETE /api/v1/tasks/{id}`


#### NOTES:

- Get All Notes: `GET /api/v1/notes`

- Get One Note: `GET /api/v1/notes/{id}`

- Create Note: `POST /api/v1/notes`

- Update Note: `PUT /api/v1/notes/{id}`

- Delete Note: `DELETE /api/v1/notes/{id}`

Ver documentación de la API con la [lista completa de endpoints](extras/docs/endpoints.md).


### IMPORTAR EN POSTMAN:

Toda la información de la API, preparada para descargar y utilizar como colección de postman: [Importar Colección](https://www.getpostman.com/collections/b8493a923ab81ef53ebb).

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/b8493a923ab81ef53ebb)


### AYUDA Y MANUAL DE USO:

Para más información sobre el modo de uso de la API REST, ver la siguiente documentación disponible en [Postman Documenter](https://documenter.getpostman.com/view/1915278/RztfwByr).


### OPEN API:

Además se puede ver la especificación OpenAPI, utilizando [Swagger UI](https://rest-api-slim-php.herokuapp.com/docs/index.html).


## VER ONLINE:

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)

Ver [demo online](http://bit.ly/2DdwKkd) hosteado en Heroku.


## LICENCIA

Licencia MIT. Consultar [Archivo de licencia](LICENSE.md) para obtener más información.


[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
