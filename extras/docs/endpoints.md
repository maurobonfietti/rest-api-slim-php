
# Rest Api Slim PHP

Example of REST API with [Slim PHP micro framework](http://www.slimframework.com).

This simple RESTful API made in Slim version 3, allows CRUD operations to manage entities like: Users, Tasks and Notes :-)


## Indices

* [Info](#info)

  * [Get Help](#1-get-help)
  * [Get Status](#2-get-status)

* [Login](#login)

  * [Login](#1-login)

* [Notes](#notes)

  * [Get All Notes](#1-get-all-notes)
  * [Get One Note](#2-get-one-note)
  * [Search Notes](#3-search-notes)
  * [Create Note](#4-create-note)
  * [Update Note](#5-update-note)
  * [Delete Note](#6-delete-note)

* [Tasks](#tasks)

  * [Get All Tasks](#1-get-all-tasks)
  * [Get One Task](#2-get-one-task)
  * [Search Tasks](#3-search-tasks)
  * [Create Task](#4-create-task)
  * [Update Task](#5-update-task)
  * [Delete Task](#6-delete-task)

* [Users](#users)

  * [Get All Users](#1-get-all-users)
  * [Get One User](#2-get-one-user)
  * [Search Users](#3-search-users)
  * [Create User](#4-create-user)
  * [Update User](#5-update-user)
  * [Delete User](#6-delete-user)


--------


## Info
Get information about API.


### 1. Get Help


Get help about this api.


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{domain-api-rest-slimphp}}
```


### 2. Get Status


Get status of this api.


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{domain-api-rest-slimphp}}/status
```


## Login


### 1. Login


Login and get a JWT Token Authorization Bearer to use this api.


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: {{domain-api-rest-slimphp}}/login
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Content-Type | application/json |  |


***Body:***

```js        
{
    "email": "m@b.com.ar",
    "password": "123"
}
```


## Notes
Manage Notes.


### 1. Get All Notes


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/notes
```


### 2. Get One Note


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/notes/3
```


### 3. Search Notes


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/notes/search/my
```


### 4. Create Note


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/notes
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Content-Type | application/json |  |


***Body:***

```js        
{
  "name": "CR7 Notes",
  "description": "Magic Goal."
}
```


### 5. Update Note


***Endpoint:***

```bash
Method: PUT
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/notes/4
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Content-Type | application/json |  |


***Body:***

```js        
{
  "name": "My Note Number 4",
  "description": "Free Note"
}
```


### 6. Delete Note


***Endpoint:***

```bash
Method: DELETE
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/notes/12
```


## Tasks
Manage Tasks.


### 1. Get All Tasks


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/tasks
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |


### 2. Get One Task


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/tasks/2
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |


### 3. Search Tasks


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/tasks/search/now
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |


### 4. Create Task


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/tasks
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Content-Type | application/json |  |
| Authorization | {{jwt}} |  |


***Body:***

```js        
{
  "name": "Go To Sleep now!!",
  "status": 1
}
```


### 5. Update Task


***Endpoint:***

```bash
Method: PUT
Type: URLENCODED
URL: {{domain-api-rest-slimphp}}/api/v1/tasks/2
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Content-Type | application/x-www-form-urlencoded |  |
| Authorization | {{jwt}} |  |


***Body:***


| Key | Value | Description |
| --- | ------|-------------|
| name | Testing |  |


### 6. Delete Task


***Endpoint:***

```bash
Method: DELETE
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/tasks/5
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |


## Users
Manage Users.


### 1. Get All Users


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/users
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |


### 2. Get One User


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/users/8
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |


### 3. Search Users


***Endpoint:***

```bash
Method: GET
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/users/search/d
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |


### 4. Create User


***Endpoint:***

```bash
Method: POST
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/users
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Content-Type | application/json |  |


***Body:***

```js        
{
  "name": "MNB",
  "email": "m@b.com.ar",
  "password": "123"
}
```


### 5. Update User


***Endpoint:***

```bash
Method: PUT
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/users/4
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Content-Type | application/json |  |
| Authorization | {{jwt}} |  |


***Body:***

```js        
{
  "name": 123,
  "email": "cr7@asd.com.ar"
}
```


### 6. Delete User


***Endpoint:***

```bash
Method: DELETE
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/users/112
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |


---
[Back to top](#rest-api-slim-php)
> Made with &#9829; by [thedevsaddam](https://github.com/thedevsaddam) | Generated at: 2019-04-19 15:35:17 by [docgen](https://github.com/thedevsaddam/docgen)
