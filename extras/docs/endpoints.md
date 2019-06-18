
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
            "status": "http://localhost:8080/status",
            "this help": "http://localhost:8080"
        },
        "version": "0.22.2",
        "timestamp": 1560897542
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
        "db": {
            "users": 9,
            "tasks": 10,
            "notes": 5
        },
        "version": "0.22.2",
        "timestamp": 1560897579
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


Status: Login Failed | Code: 400



```js
{
    "message": "Login failed: Email or password incorrect.",
    "class": "UserException",
    "status": "error",
    "code": 400
}
```



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



## Notes
Manage Notes.



### 1. Get All Notes



***Endpoint:***

```bash
Method: GET
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/notes
```



### 2. Get One Note



***Endpoint:***

```bash
Method: GET
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/notes/3
```



### 3. Search Notes



***Endpoint:***

```bash
Method: GET
Type: 
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
  "name": "New Soccer Note",
  "description": "Magic Goal..."
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
Type: FORMDATA
URL: {{domain-api-rest-slimphp}}/api/v1/notes/27
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



### 2. Get One Task


Get one task of a user.


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/tasks/7
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |



### 3. Search Tasks


Search tasks of a user.


***Endpoint:***

```bash
Method: GET
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/tasks/search/sleep
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |



### 4. Create Task


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



### 5. Update Task


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



### 6. Delete Task


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



### 3. Search Users



***Endpoint:***

```bash
Method: GET
Type: 
URL: {{domain-api-rest-slimphp}}/api/v1/users/search/d
```


***Headers:***

| Key | Value | Description |
| --- | ------|-------------|
| Authorization | {{jwt}} |  |



### 4. Create User


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



### 5. Update User


Update a user.


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
  "name": "Jhon R",
  "email": "ram@hotmail.com"
}
```



### 6. Delete User


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
> Made with &#9829; by [thedevsaddam](https://github.com/thedevsaddam) | Generated at: 2019-06-18 19:55:31 by [docgen](https://github.com/thedevsaddam/docgen)
