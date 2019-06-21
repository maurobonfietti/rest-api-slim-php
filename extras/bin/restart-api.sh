#!/bin/bash

echo -e "# Read environment variables."
source .env

echo -e "# Restart demo database."
mysql -u$DB_USERNAME -p$DB_PASSWORD -h$DB_HOSTNAME -e "DROP DATABASE IF EXISTS $DB_DATABASE ; CREATE DATABASE $DB_DATABASE" 2> /dev/null

echo -e "# Create testing data."
mysql -u$DB_USERNAME -p$DB_PASSWORD -h$DB_HOSTNAME $DB_DATABASE < database/database.sql 2> /dev/null

echo -e "# Run tests."
./vendor/bin/phpunit
