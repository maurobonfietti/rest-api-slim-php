
# REST API IN SLIM PHP

## TROUBLESHOOTING:

### 1- Clone project and install dependencies:

```bash
$ git clone https://github.com/maurobonfietti/rest-api-slim-php.git
$ cd rest-api-slim-php
$ cp .env.example .env
$ composer install
```


### 2- Create a new MySQL database. For example: "rest_api_slim_php".

From the command line run:

```bash
$ mysql -e 'CREATE DATABASE rest_api_slim_php;'
```


### 3- Create the structure and load test data into the database.

The database can be updated manually using the following file: [database.sql](database/database.sql).

It can also be run from the command line:

```bash
$ mysql rest_api_slim_php < database/database.sql
```


### 4- Configure the connection data with MySQL.

Edit and complete configuration file: `.env`. For example:

```
DB_HOST='127.0.0.1'
DB_NAME='rest_api_slim_php'
DB_USER='root'
DB_PASS=''
DB_PORT='3306'
```


### 5- Configure optional environment variables.

For example:

```
DISPLAY_ERROR_DETAILS=true
APP_DOMAIN='https://www.yourdomain.com'
REDIS_URL=''
SECRET_KEY='YourSuperSecret-KeY'
```


## LOCAL SERVER:

You can start the PHP internal web server by running:

```bash
$ composer start
```

### NOTE:

The `composer start` command would be the equivalent to execute:

```bash
$ php -S 0.0.0.0:8080 -t public public/index.php
```


## CHECK IT OUT:

If everything went well :sunglasses:, you can access the project locally by entering:
[Help](http://localhost:8080), 
[Status](http://localhost:8080/status) and
[Notes](http://localhost:8080/api/v1/notes).
