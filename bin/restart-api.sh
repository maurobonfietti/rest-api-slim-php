#!/bin/bash

echo -e "Reading environment variables..."
source .env

echo -e "Restarting demo database..."
mysql -u$DB_USERNAME -p$DB_PASSWORD -h$DB_HOSTNAME -e 'DROP DATABASE IF EXISTS $DB_DATABASE ; CREATE DATABASE $DB_DATABASE' 2> /dev/null

echo -e "Creating testing data..."
mysql -u$DB_USERNAME -p$DB_PASSWORD -h$DB_HOSTNAME $DB_DATABASE < app/data/database.sql 2> /dev/null

echo -e "Generating example documentation..."
./bin/generate-doc.sh > DOC.md 2> /dev/null

echo -e "Running unit tests..."
./vendor/bin/phpunit
