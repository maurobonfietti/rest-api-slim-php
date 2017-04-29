# API REST SLIM PHP

Ejemplo de API REST con microframework Slim PHP.


[![Build Status](https://travis-ci.org/maurobonfietti/api-rest-slimphp.svg?branch=master)](https://travis-ci.org/maurobonfietti/api-rest-slimphp)
[![Test Coverage](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/badges/coverage.svg)](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/coverage)
[![Code Climate](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/badges/gpa.svg)](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp)
[![Code Quality](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/?branch=master)


## INSTALACIÓN:

1- Descargar el proyecto:
```
$ cd path-to-your-projects
$ git clone https://github.com/maurobonfietti/api-rest-slimphp.git
$ cd api-rest-slimphp
$ composer install
```


2- Crear nueva base de datos MySQL. Por ejemplo: "api_rest_slimphp".

Desde la línea de comandos ejecutar:

```
mysql -e 'CREATE DATABASE api_rest_slimphp;'
```


3- Crear la estructura y cargar datos de prueba en la base de datos.

La base de datos se puede actualizar manualmente utilizando el siguiente archivo: [database.sql](app/data/database.sql).

También se puede ejecutar desde la línea de comandos:

```
mysql api_rest_slimphp < app/data/database.sql
```


4- Configurar los datos de acceso a MySQL.

Editar archivo de configuración: `src/settings.php`
```
// Database connection settings
'db' => [
    'host' => '127.0.0.1',
    'dbname' => 'api-rest-slimphp',
    'user' => 'YourMysqlUser',
    'pass' => 'YourMysqlPass',
],
```


## SERVIDOR LOCAL:

Se puede iniciar el servidor web interno de PHP ejecutando:
```
$ composer start
```


### NOTA:

Si todo fue bien :sunglasses:, se puede acceder localmente al proyecto ingresando a: 
[Ayuda](http://localhost:8080), 
[Usuarios](http://localhost:8080/users), 
[Tareas](http://localhost:8080/tasks).

El comando `composer start` sería el equivalente a ejecutar:
```
$ php -S 0.0.0.0:8080 -t public public/index.php
```


## MODO DE USO:

Para más información sobre el uso de la API REST, ver el siguiente documento con el [Modo de Uso](DOC.md).


## TESTS:

Acceder a la ruta del proyecto y ejecutar los tests con `phpunit`:
```
$ phpunit
PHPUnit 6.1.2 by Sebastian Bergmann and contributors.

..............................                                    30 / 30 (100%)

Time: 202 ms, Memory: 4.00MB

OK (30 tests, 130 assertions)
```
