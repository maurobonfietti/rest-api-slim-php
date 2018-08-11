#!/bin/bash

echo -e "Restarting demo database..."
mysql -uroot -p -e 'DROP DATABASE IF EXITS api_rest_slimphp ; CREATE DATABASE api_rest_slimphp' 2> /dev/null
echo -e "Creating test data..."
mysql -uroot -p api_rest_slimphp < app/data/database.sql 2> /dev/null
echo -e "Generating example documentation..."
./bin/generate-doc.sh > DOC.md 2> /dev/null
echo -e "Running unit tests..."
./vendor/bin/phpunit
