# API REST EN SLIM PHP

Este es un ejemplo de una API RESTful construida con el micro-framework [Slim PHP](https://www.slimframework.com).

Esta simple API permite administrar recursos tales como: usuarios, tareas y notas.

También puedes leerlo en inglés [README IN ENGLISH](README.md).


[![Software License][ico-license]](LICENSE.md)
[![Build Status](https://travis-ci.org/maurobonfietti/rest-api-slim-php.svg?branch=master)](https://travis-ci.org/maurobonfietti/rest-api-slim-php)
[![Code Quality](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/?branch=master)
[![Test Coverage](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/badges/coverage.svg)](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/coverage)
[![Packagist Version](https://img.shields.io/packagist/v/maurobonfietti/rest-api-slim-php)](https://packagist.org/packages/maurobonfietti/rest-api-slim-php)


![alt text](https://i.ibb.co/KwZtpCt/REST-API-SLIM-PHP.png "Example of RESTful API with Slim PHP micro framework")


## 🖥️ TECNOLOGÍAS UTILIZADAS:

Las principales tecnologías utilizadas en este proyecto son:

- PHP 8
- Slim 3
- MySQL
- Redis
- dotenv
- PHPUnit
- JSON Web Tokens (JWT)


### Herramientas Adicionales:

Además, utilizo otras herramientas adicionales como por ejemplo:

- Docker & Docker Compose
- Travis CI
- Swagger
- Code Climate
- Scrutinizer
- Sonar Cloud
- PHPStan
- PHP Insights
- Heroku
- CORS


## ⚙️ INSTALACIÓN RÁPIDA:

### Requerimientos:

- Git
- Composer
- PHP >= 8.0
- MySQL/MariaDB
- Redis (Opcional)
- O simplemente Docker


### Usando Composer:

Puede crear un nuevo proyecto ejecutando los siguientes comandos:

```bash
$ composer create-project maurobonfietti/rest-api-slim-php [my-api-name]
$ cd [my-api-name]
$ composer restart-db
$ composer test
$ composer start
```

[![How to install](https://cdn.loom.com/sessions/thumbnails/0ca3648baa674de2ba2f4180e781eb21-with-play.gif)](https://youtu.be/Zp_vod5wWWk)


### Usando Git:

En su terminal favorita ejecute estos comandos:

```bash
$ git clone https://github.com/maurobonfietti/rest-api-slim-php.git && cd rest-api-slim-php
$ cp .env.example .env
$ composer install
$ composer restart-db
$ composer test
$ composer start
```


### Usando Docker:

Puedes probar este proyecto usando **docker** y **docker-compose**.


**Version Requerida Docker:**

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


## 🛠️ INSTALACIÓN PASO A PASO:

Si tuviste alguna duda o problema, puedes consultar [esta guía](TROUBLESHOOTING.md) paso a paso.


## 🎦 TUTORIALS:

Mira esta mini serie de videos acerca de Slim PHP.

### :video_camera: VIDEO #1

[Cómo instalar y configurar esta API.](https://youtu.be/Zp_vod5wWWk)

### :movie_camera: VIDEO #2

[Ejemplo de cómo utilizar esta API con JWT para autenticación.](https://youtu.be/TPnoPLBgZTg)

### :video_camera: VIDEO #3

[Cómo usar Redis en esta API con Slim PHP.](https://youtu.be/qX_TVjxEZSc)

### :movie_camera: VIDEO #4

[Cómo hacer el despliegue de una API con Slim PHP usando Heroku.](https://youtu.be/-F09LCgNuGg)


## 📦 DEPENDENCIAS:

### LISTA DE DEPENDENCIAS REQUERIDAS:

- [slim/slim](https://github.com/slimphp/Slim): Micro framework PHP que ayuda a escribir rápidamente aplicaciones y APIs simples pero potentes.
- [respect/validation](https://github.com/Respect/Validation): El motor de validación más impresionante jamás creado para PHP.
- [palanik/corsslim](https://github.com/palanik/CorsSlim): Middleware de intercambio de recursos de origen cruzado (CORS) para PHP Slim.
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv): Carga las variables de entorno de `.env` a `getenv()`, `$_ENV` y `$_SERVER` automágicamente.
- [predis/predis](https://github.com/nrk/predis/): Cliente Redis flexible y con funciones completas para PHP y HHVM.
- [firebase/php-jwt](https://github.com/firebase/php-jwt): Una biblioteca simple para codificar y decodificar JSON Web Tokens (JWT) en PHP.

### LISTA DE DEPENDENCIAS PARA DESARROLLO:

- [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit): Framework para hacer Unit Testing en PHP.
- [phpstan/phpstan](https://github.com/phpstan/phpstan): PHPStan, herramienta de análisis estático para PHP.
- [pestphp/pest](https://github.com/pestphp/pest): Pest es un elegante PHP Testing Framework con un enfoque en la simplicidad.
- [nunomaduro/phpinsights](https://github.com/nunomaduro/phpinsights): Comprobaciones instantáneas de calidad PHP desde su consola.
- [vimeo/psalm](https://github.com/vimeo/psalm): Una herramienta de análisis estático para encontrar errores en aplicaciones PHP.
- [rector/rector](https://github.com/rectorphp/rector): Actualizaciones y refactorización instantánea de cualquier código PHP 5.3+.


## 🚥 TESTING:

Ejecutar los tests PHPUnit con `composer test`.

```bash
$ composer test
> phpunit
PHPUnit 9.5.28 by Sebastian Bergmann and contributors.

........................................................          56 / 56 (100%)

Time: 00:00.697, Memory: 18.00 MB

OK (56 tests, 343 assertions)
```


## CAPTURA DE PANTALLA:

<img width="493" alt="Screen Shot API using Browser" src="https://user-images.githubusercontent.com/24535949/121755366-58c07580-caed-11eb-9688-28183f80ab2a.png">

----

<img width="902" alt="Screen Shot API using Postman" src="https://user-images.githubusercontent.com/24535949/121755370-5b22cf80-caed-11eb-8d82-bf1de5a9fa83.png">

----


## 📚 DOCUMENTACIÓN:

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


## 🚀 DESPIEGLE:

Puedes hacer deploy de esta API usando Heroku.

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)


## ℹ️ MAS INFORMACIÓN:

Para obtener más información sobre este proyecto, consulta mi publicación: [Cómo crear una API REST con Slim PHP](https://maurobonfietti.github.io/2019-06-03-rest-api-slim-php/).

También puede echar un vistazo a la [aplicación web de la lista de tareas](https://github.com/maurobonfietti/rest-api-slim-php-web-app) que desarrollé usando esta API en Angular.


## 💬 CONTRIBUCIONES:

Si desea contribuir al proyecto, abra un isse o envíe una solicitud de extracción (PR). ¡Las contribuciones son siempre bienvenidas!


## :heart: ¿TE GUSTA EL PROYECTO?

Puedes apoyar este proyecto invitándome un café :coffee: :yum: o dando una estrella a este repo :star: :sunglasses:.

<a href='https://ko-fi.com/maurobonfietti' target='_blank'>
  <img height='36' style='border:0px;height:36px;' src='https://az743702.vo.msecnd.net/cdn/kofi3.png?v=2' border='0' alt='Buy Me a Coffee at ko-fi.com' />
</a>


## :page_facing_up: LICENCIA

Licencia MIT. Consultar [Archivo de licencia](LICENSE.md) para obtener más información.


[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat
