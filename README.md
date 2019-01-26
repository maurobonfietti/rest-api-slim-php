# REST API IN SLIM PHP

Example of REST API with [Slim PHP micro framework](http://www.slimframework.com).

This simple RESTful API made in Slim version 3, allows CRUD operations to manage entities such as: Users, Tasks and Notes :-)

[![Build Status](https://travis-ci.org/maurobonfietti/rest-api-slim-php.svg?branch=master)](https://travis-ci.org/maurobonfietti/rest-api-slim-php)
[![Test Coverage](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/badges/coverage.svg)](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/coverage)
[![Code Quality](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/?branch=master)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=maurobonfietti_rest-api-slim-php&metric=alert_status)](https://sonarcloud.io/dashboard?id=maurobonfietti_rest-api-slim-php)

[README IN SPANISH](README_SPANISH.md)

## INSTALLATION:

### 1- Download the project:

```bash
$ cd path-to-your-projects
$ git clone https://github.com/maurobonfietti/rest-api-slim-php.git
$ cd rest-api-slim-php
$ cp .env.example .env
$ composer install
```


### 2- Create new MySQL database. For example: "rest_api_slim_php".

From the command line run:

```bash
mysql -e 'CREATE DATABASE rest_api_slim_php;'
```


### 3- Create the structure and load test data into the database.

The database can be updated manually using the following file: [database.sql](app/data/database.sql).

It can also be run from the command line:

```
mysql rest_api_slim_php < app/data/database.sql
```


### 4- Configure the connection data with MySQL.

Edit and complete configuration file: `.env`. For example:

```
DB_HOSTNAME = '127.0.0.1'
DB_DATABASE = 'rest_api_slim_php'
DB_USERNAME = 'root'
DB_PASSWORD = ''
```


## LOCAL SERVER:

You can start the PHP internal web server by running:

```bash
$ composer start
```


### NOTE:

If everything went well :sunglasses:, you can access the project locally by entering:
[Help](http://localhost:8080), 
[Status](http://localhost:8080/status), 
[Users](http://localhost:8080/api/v1/users), 
[Tasks](http://localhost:8080/api/v1/tasks) and
[Notes](http://localhost:8080/api/v1/notes).

The `composer start` command would be the equivalent to execute:

```bash
$ php -S 0.0.0.0:8080 -t public public/index.php
```


## TESTS:

Access the project route and run the tests with `phpunit`.

```bash
PHPUnit 6.5.8 by Sebastian Bergmann and contributors.

............................................                      44 / 44 (100%)

Time: 735 ms, Memory: 10.00MB

OK (44 tests, 255 assertions)
```


## GIVE IT A TRY:

[Live demo](http://bit.ly/2DdwKkd) hosted on Heroku.


## DOCUMENTATION:

### IMPORT WITH POSTMAN:

All the information of the API, prepared to download and use as postman collection: [Import Collection](https://www.getpostman.com/collections/b8493a923ab81ef53ebb).

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/b8493a923ab81ef53ebb)

### HELP AND DOCS:

For more information on how to use the REST API, see the following document: [User's Manual](DOC.md).

Documentation also available on [Postman Documenter](https://documenter.getpostman.com/view/1915278/RztfwByr).
