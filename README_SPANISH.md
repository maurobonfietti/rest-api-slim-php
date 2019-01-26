# API REST EN SLIM PHP

Ejemplo de API REST con micro framework [Slim PHP](http://www.slimframework.com).

Esta simple API RESTful hecha en Slim version 3, permite operaciones CRUD para administrar entidades como por ejemplo: Usuarios, Tareas y Notas :-)

[![Build Status](https://travis-ci.org/maurobonfietti/rest-api-slim-php.svg?branch=master)](https://travis-ci.org/maurobonfietti/rest-api-slim-php)
[![Test Coverage](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/badges/coverage.svg)](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/coverage)
[![Code Quality](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/?branch=master)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=maurobonfietti_rest-api-slim-php&metric=alert_status)](https://sonarcloud.io/dashboard?id=maurobonfietti_rest-api-slim-php)

[README IN ENGLISH](README.md)

## INSTALACIÓN:

### 1- Descargar el proyecto:

```bash
$ cd path-to-your-projects
$ git clone https://github.com/maurobonfietti/rest-api-slim-php.git
$ cd rest-api-slim-php
$ cp .env.example .env
$ composer install
```


### 2- Crear nueva base de datos MySQL. Por ejemplo: "rest_api_slim_php".

Desde la línea de comandos ejecutar:

```bash
mysql -e 'CREATE DATABASE rest_api_slim_php;'
```


### 3- Crear la estructura y cargar datos de prueba en la base de datos.

La base de datos se puede actualizar manualmente utilizando el siguiente archivo: [database.sql](app/data/database.sql).

También se puede ejecutar desde la línea de comandos:

```
mysql rest_api_slim_php < app/data/database.sql
```


### 4- Configurar los datos de conexión con MySQL.

Editar y completar archivo de configuración: `.env`. Por ejemplo:

```
DB_HOSTNAME = '127.0.0.1'
DB_DATABASE = 'rest_api_slim_php'
DB_USERNAME = 'root'
DB_PASSWORD = ''
```


## SERVIDOR LOCAL:

Se puede iniciar el servidor web interno de PHP ejecutando:

```bash
$ composer start
```


### NOTA:

Si todo fue bien :sunglasses:, se puede acceder localmente al proyecto ingresando a: 
[Ayuda](http://localhost:8080), 
[Estado](http://localhost:8080/status), 
[Usuarios](http://localhost:8080/api/v1/users), 
[Tareas](http://localhost:8080/api/v1/tasks) y
[Notas](http://localhost:8080/api/v1/notes).

El comando `composer start` sería el equivalente a ejecutar:

```bash
$ php -S 0.0.0.0:8080 -t public public/index.php
```


## TESTS:

Acceder a la ruta del proyecto y ejecutar los tests con `phpunit`.

```bash
PHPUnit 6.5.8 by Sebastian Bergmann and contributors.

............................................                      44 / 44 (100%)

Time: 735 ms, Memory: 10.00MB

OK (44 tests, 255 assertions)
```


## VER ONLINE:

[Demo online](http://bit.ly/2DdwKkd) hosteado usando Heroku.


## DOCUMENTACIÓN:

### IMPORTAR EN POSTMAN:

Toda la información de la API, preparada para descargar y utilizar como colección de postman: [Importar Colección](https://www.getpostman.com/collections/b8493a923ab81ef53ebb).

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/b8493a923ab81ef53ebb)

### AYUDA Y MANUAL DE USO:

Para más información sobre el modo de uso de la API REST, ver el siguiente documento: [Manual de Uso](DOC.md).

Documentación también disponible en [Postman Documenter](https://documenter.getpostman.com/view/1915278/RztfwByr).
