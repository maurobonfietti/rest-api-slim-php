#!/bin/bash

mysql -uroot -p -e 'DROP DATABASE IF EXITS api_rest_slimphp ; CREATE DATABASE api_rest_slimphp' 2> /dev/null
mysql -uroot -p api_rest_slimphp < data/database.sql 2> /dev/null
./bin/generate-doc.sh > DOC.md 2> /dev/null
