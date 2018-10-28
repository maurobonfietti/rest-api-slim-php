# API REST SLIM PHP

Ejemplo de API REST con micro framework Slim PHP.

[Readme english version](README.md).

[![Build Status](https://travis-ci.org/maurobonfietti/api-rest-slimphp.svg?branch=master)](https://travis-ci.org/maurobonfietti/api-rest-slimphp)
[![Test Coverage](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/badges/coverage.svg)](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/coverage)
[![Code Quality](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/?branch=master)


## INSTALACIÓN:

### 1- Descargar el proyecto:

```bash
$ cd path-to-your-projects
$ git clone https://github.com/maurobonfietti/api-rest-slimphp.git
$ cd api-rest-slimphp
$ cp .env.example .env
$ composer install
```


### 2- Crear nueva base de datos MySQL. Por ejemplo: "api_rest_slimphp".

Desde la línea de comandos ejecutar:

```bash
mysql -e 'CREATE DATABASE api_rest_slimphp;'
```


### 3- Crear la estructura y cargar datos de prueba en la base de datos.

La base de datos se puede actualizar manualmente utilizando el siguiente archivo: [database.sql](app/data/database.sql).

También se puede ejecutar desde la línea de comandos:

```
mysql api_rest_slimphp < app/data/database.sql
```


### 4- Configurar los datos de conexión con MySQL.

Editar y completar archivo de configuración: `.env`. Por ejemplo:

```
DB_HOSTNAME = '127.0.0.1'
DB_DATABASE = 'api_rest_slimphp'
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
[Usuarios](http://localhost:8080/api/v1/users), 
[Tareas](http://localhost:8080/api/v1/tasks).

El comando `composer start` sería el equivalente a ejecutar:

```bash
$ php -S 0.0.0.0:8080 -t public public/index.php
```


## TESTS:

Acceder a la ruta del proyecto y ejecutar los tests con `phpunit`.

```bash
PHPUnit 6.5.8 by Sebastian Bergmann and contributors.

................................                                  32 / 32 (100%)

Time: 212 ms, Memory: 8.00MB

OK (32 tests, 138 assertions)
```


## DOCUMENTACIÓN:

### AYUDA Y MANUAL DE USO:

Para más información sobre el modo de uso de la API REST, ver el siguiente documento: [Manual de Uso](DOC.md).


### IMPORTAR EN POSTMAN:

Toda la información de la API, preparada para descargar y utilizar como colección de postman: [Importar Colección](https://www.getpostman.com/collections/b8493a923ab81ef53ebb).
