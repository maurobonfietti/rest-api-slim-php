# REST API IN SLIM PHP

Example of RESTful API with [Slim PHP micro framework](https://www.slimframework.com).

This simple API allows you to manage resources such as: users, tasks and notes.

[![Software License][ico-license]](LICENSE.md)
[![Build Status](https://travis-ci.org/maurobonfietti/rest-api-slim-php.svg?branch=master)](https://travis-ci.org/maurobonfietti/rest-api-slim-php)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=maurobonfietti_rest-api-slim-php&metric=alert_status)](https://sonarcloud.io/dashboard?id=maurobonfietti_rest-api-slim-php)
[![Code Quality](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maurobonfietti/api-rest-slimphp/?branch=master)
[![Test Coverage](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/badges/coverage.svg)](https://codeclimate.com/github/maurobonfietti/api-rest-slimphp/coverage)
[![Packagist Version](https://img.shields.io/packagist/v/maurobonfietti/rest-api-slim-php)](https://packagist.org/packages/maurobonfietti/rest-api-slim-php)


![alt text](https://i.ibb.co/KwZtpCt/REST-API-SLIM-PHP.png "Example of RESTful API with Slim PHP micro framework")


You can also read this [README IN SPANISH](README_SPANISH.md).

Main technologies used: `PHP 8, Slim 3, MySQL, Redis, dotenv, PHPUnit and JSON Web Tokens.`

Also, I use other aditional tools like: `Docker & Docker Compose, Travis CI, Swagger, Code Climate, Scrutinizer, Sonar Cloud, PHPStan, PHP Insights, Heroku and CORS.`

More info about this project in my post: [How to create a REST API using Slim PHP](https://maurobonfietti.github.io/2019-06-03-rest-api-slim-php/).

I implemented this API in [this project](https://github.com/maurobonfietti/rest-api-slim-php-web-app). It's a todo list web app developed in Angular.


## :gear: QUICK INSTALL:

### Requirements:

- Git.
- Composer.
- PHP >= 8.0
- MySQL/MariaDB.
- Redis (Optional).
- or Docker.


### With Composer:

You can create a new project running the following commands:

```bash
$ composer create-project maurobonfietti/rest-api-slim-php [my-api-name]
$ cd [my-api-name]
$ composer restart-db
$ composer test
$ composer start
```

[![How to install](https://cdn.loom.com/sessions/thumbnails/0ca3648baa674de2ba2f4180e781eb21-with-play.gif)](https://youtu.be/Zp_vod5wWWk)


### With Git:

In your terminal execute this commands:

```bash
$ git clone https://github.com/maurobonfietti/rest-api-slim-php.git && cd rest-api-slim-php
$ cp .env.example .env
$ composer install
$ composer restart-db
$ composer test
$ composer start
```


### With Docker:

You can use this project using **docker** and **docker-compose**.


**Minimal Docker Version:**

* Engine: 18.03+
* Compose: 1.21+


**Commands:**

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


## :wrench: TROUBLESHOOTING:

If you get stuck, you can try [this guide step by step](TROUBLESHOOTING.md).


## :cinema: TUTORIALS:

Mini-series of videos about Slim PHP (Spanish Audio :sound: :es: :argentina:).

### :video_camera: VIDEO #1

[How to install and configure this API.](https://youtu.be/Zp_vod5wWWk)

### :movie_camera: VIDEO #2

[How to use JWT for Authentication.](https://youtu.be/TPnoPLBgZTg)

### :video_camera: VIDEO #3

[Using Redis Cache.](https://youtu.be/qX_TVjxEZSc)

### :movie_camera: VIDEO #4

[Deploy Slim PHP on Heroku.](https://youtu.be/-F09LCgNuGg)


## :package: DEPENDENCIES:

### LIST OF REQUIRE DEPENDENCIES:

- [slim/slim](https://github.com/slimphp/Slim): Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs.
- [respect/validation](https://github.com/Respect/Validation): The most awesome validation engine ever created for PHP.
- [palanik/corsslim](https://github.com/palanik/CorsSlim): Cross-origin resource sharing (CORS) middleware for PHP Slim.
- [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv): Loads environment variables from `.env` to `getenv()`, `$_ENV` and `$_SERVER` automagically.
- [predis/predis](https://github.com/nrk/predis/): Flexible and feature-complete Redis client for PHP and HHVM.
- [firebase/php-jwt](https://github.com/firebase/php-jwt): A simple library to encode and decode JSON Web Tokens (JWT) in PHP.

### LIST OF DEVELOPMENT DEPENDENCIES:

- [phpunit/phpunit](https://github.com/sebastianbergmann/phpunit): The PHP Unit Testing framework.
- [phpstan/phpstan](https://github.com/phpstan/phpstan): PHPStan - PHP Static Analysis Tool.
- [pestphp/pest](https://github.com/pestphp/pest): Pest is an elegant PHP Testing Framework with a focus on simplicity.
- [nunomaduro/phpinsights](https://github.com/nunomaduro/phpinsights): Instant PHP quality checks from your console.
- [vimeo/psalm](https://github.com/vimeo/psalm): A static analysis tool for finding errors in PHP applications.
- [rector/rector](https://github.com/rectorphp/rector): Instant Upgrades and Instant Refactoring of any PHP 5.3+ code.


## :traffic_light: TESTING:

Run all PHPUnit tests with `composer test`.

```bash
$ composer test
> phpunit
PHPUnit 9.5.10 by Sebastian Bergmann and contributors.

........................................................          56 / 56 (100%)

Time: 00:00.628, Memory: 18.00 MB

OK (56 tests, 343 assertions)
```


## SCREENSHOOTS:

<img width="493" alt="Screen Shot API using Browser" src="https://user-images.githubusercontent.com/24535949/121755366-58c07580-caed-11eb-9688-28183f80ab2a.png">

----

<img width="902" alt="Screen Shot API using Postman" src="https://user-images.githubusercontent.com/24535949/121755370-5b22cf80-caed-11eb-8d82-bf1de5a9fa83.png">

----


## :books: DOCUMENTATION:

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

Also, you can see the API documentation with the [full list of endpoints](extras/docs/endpoints.md).


### HELP AND DOCS:

For more information on how to use the REST API, see the following documentation available on [Postman Documenter](https://documenter.getpostman.com/view/1915278/RztfwByr).


### IMPORT WITH POSTMAN:

All the information of the API, prepared to download and use as postman collection: [Import Collection](https://www.getpostman.com/collections/b8493a923ab81ef53ebb).

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/b8493a923ab81ef53ebb)


### OPEN API SPEC:

Also, you can view the OpenAPI Specification, using [Swagger UI](https://rest-api-slim-php.herokuapp.com/docs/index.html).


## :rocket: DEPLOY:

You can deploy this API with Heroku Free.

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)


## :video_game: GIVE IT A TRY:

Check it out to this [LIVE DEMO](http://bit.ly/2DdwKkd).


## :heart: DO YOU LIKE THE PROJECT?

You can support this project inviting me a coffee :coffee: :yum: or giving a **star** to this repo :star: :sunglasses:.

<a href='https://ko-fi.com/maurobonfietti' target='_blank'>
  <img height='36' style='border:0px;height:36px;' src='https://az743702.vo.msecnd.net/cdn/kofi3.png?v=2' border='0' alt='Buy Me a Coffee at ko-fi.com' />
</a>


## :page_facing_up: LICENSE

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat
