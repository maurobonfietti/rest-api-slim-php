
# Rest Api Slim PHP

[Example of REST API](https://github.com/maurobonfietti/rest-api-slim-php) with Slim PHP micro framework.

This simple API allows you to manage resources such as: users, tasks and notes.

## Indices

* [Info](#info)

  * [Get Help](#1-get-help)
  * [Get Status](#2-get-status)

* [Login](#login)

  * [Login](#1-login)

* [Notes](#notes)

  * [Get All Notes](#1-get-all-notes)
  * [Get One Note](#2-get-one-note)
  * [Create Note](#3-create-note)
  * [Update Note](#4-update-note)
  * [Delete Note](#5-delete-note)

* [Tasks](#tasks)

  * [Get All Tasks](#1-get-all-tasks)
  * [Get One Task](#2-get-one-task)
  * [Create Task](#3-create-task)
  * [Update Task](#4-update-task)
  * [Delete Task](#5-delete-task)

* [Users](#users)

  * [Get All Users](#1-get-all-users)
  * [Get One User](#2-get-one-user)
  * [Create User](#3-create-user)
  * [Update User](#4-update-user)
  * [Delete User](#5-delete-user)


--------


## Info
Get information about API.



### 1. Get Help


Get help about this api.


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{domain-api-rest-slimphp}}
```



***Responses:***


Status: Get Help | Code: 200



```js
{
    "code": 200,
    "status": "success",
    "message": {
        "endpoints": {
            "tasks": "http://localhost:8080/api/v1/tasks",
            "users": "http://localhost:8080/api/v1/users",
            "notes": "http://localhost:8080/api/v1/notes",
            "docs": "http://localhost:8080/docs/index.html",
            "status": "http://localhost:8080/status",
            "this help": "http://localhost:8080"
        },
        "version": "2.13.0",
        "timestamp": 1624812953
    }
}
```



### 2. Get Status


Get status of this api.


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{domain-api-rest-slimphp}}/status
```



***Responses:***


Status: Get Status | Code: 200



```js
{
    "code": 200,
    "status": "success",
    "message": {
        "stats": {
            "tasks": 8,
            "users": 42,
            "notes": 63
        },
        "MySQL": "OK",
        "Redis": "Disabled",
        "version": "2.12.0",
        "timestamp": 1624808196
    }
}
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
    "email": "super.email@host.com",
    "password": "OnePass1"
}
```



***Responses:***


Status: Login OK | Code: 200



```js
{
    "code": 200,
    "status": "success",
    "message": {
        "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMSIsImVtYWlsIjoibUBiLmNvbS5hciIsIm5hbWUiOiJNTkIiLCJpYXQiOjE1NTg1NTMwNTIsImV4cCI6MTU1OTE1Nzg1Mn0.OQyICWlGW0oSUB-ANrYL2OJTdC2v0OQQO3RQQ3W_KLo"
    }
}
```



Status: Login Failed | Code: 400



```js
{
    "message": "Login failed: Email or password incorrect.",
    "class": "UserException",
    "status": "error",
    "code": 400
}
```



## Notes
Manage Notes.



### 1. Get All Notes



***Endpoint:***

```bash
Method: GET
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/notes
```



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| page | 1 | Number of the page |
| perPage | 10 | Quantity of items per page |
| name |  | Search by name |
| description |  | Search by description |



### 2. Get One Note



***Endpoint:***

```bash
Method: GET
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/notes/3
```



### 3. Create Note



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
  "name": "New Soccer Note",
  "description": "Magic Goal..."
}
```



### 4. Update Note



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
  "name": "My Note Number 433333",
  "description": "Free Note?!?!?!"
}
```



### 5. Delete Note



***Endpoint:***

```bash
Method: DELETE
Type: FORMDATA
URL: {{domain-api-rest-slimphp}}/api/v1/notes/22
```



## Tasks
Manage Tasks.



### 1. Get All Tasks


Get all tasks of a user.


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/tasks
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| page | 1 | Number of the page |
| perPage | 5 | Quantity of items per page |
| name |  | Search by name |
| description |  | Search by description |
| status |  | Search by status |



### 2. Get One Task


Get one task of a user.


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/tasks/13
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |



### 3. Create Task


Create a task.


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
  "name": "Go To Sleep",
  "description": "It's too late, go to sleep man ;-)",
  "status": 0
}

```



### 4. Update Task


Update a task of a user.


***Endpoint:***

```bash
Method: PUT
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/tasks/29
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Content-Type | application/json |  |
| Authorization | {{jwt}} |  |



***Body:***

```js        
{
  "name": "Go To Sleep NOW!!",
  "description": "It's too late, go to sleep man haha...",
  "status": 1
}

```



### 5. Delete Task


Delete a task of a user.


***Endpoint:***

```bash
Method: DELETE
Type: FORMDATA
URL: {{domain-api-rest-slimphp}}/api/v1/tasks/29
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
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/users
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |



***Query params:***

| Key | Value | Description |
| --- | ------|-------------|
| page | 1 | Number of the page |
| perPage | 10 | Quantity of items per page |
| name |  | Search by name |
| email |  | Search by email |



### 2. Get One User



***Endpoint:***

```bash
Method: GET
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/users/8
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |



### 3. Create User


Register a new user.


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
  "name": "John User",
  "email": "super.email@host.com",
  "password": "OnePass1"
}
```



### 4. Update User


Update a user.


***Endpoint:***

```bash
Method: PUT
Type: RAW
URL: {{domain-api-rest-slimphp}}/api/v1/users/12
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Content-Type | application/json |  |
| Authorization | {{jwt}} |  |



***Body:***

```js        
{
    "name": "John The User 22",
    "email": "super.email@host.com.br"
}
```



### 5. Delete User


Delete a user.


***Endpoint:***

```bash
Method: DELETE
Type: FORMDATA
URL: {{domain-api-rest-slimphp}}/api/v1/users/112
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |



---
[Back to top](#rest-api-slim-php)
> Made with &#9829; by [thedevsaddam](https://github.com/thedevsaddam) | Generated at: 2021-06-27 14:36:22 by [docgen](https://github.com/thedevsaddam/docgen)
