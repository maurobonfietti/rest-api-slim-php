# USE:


## Get all users:

Request:
```
$ curl http://localhost:8080/api/v1/users
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": [
        {
            "id": "1",
            "name": "Juan",
            "email": "juanmartin@mail.com",
            "updated": "2018-08-11 19:40:04"
        },
        {
            "id": "2",
            "name": "James",
            "email": null,
            "updated": "2018-08-11 19:40:05"
        },
        {
            "id": "3",
            "name": "Lionel",
            "email": null,
            "updated": "2018-08-11 19:40:05"
        },
        {
            "id": "4",
            "name": "Carlos",
            "email": null,
            "updated": "2018-08-11 19:40:06"
        },
        {
            "id": "5",
            "name": "Diego",
            "email": "diego1010@gmail.com",
            "updated": "2018-08-11 19:40:06"
        }
    ]
}
```


## Get one user:

Request:
```
$ curl http://localhost:8080/api/v1/users/1
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "1",
        "name": "Juan",
        "email": "juanmartin@mail.com",
        "updated": "2018-08-11 19:40:04"
    }
}
```


## Search users by name:

Request:
```
$ curl http://localhost:8080/api/v1/users/search/lio
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": [
        {
            "id": "3",
            "name": "Lionel",
            "email": null,
            "updated": "2018-08-11 19:40:05"
        }
    ]
}
```


## Create user:

Request:
```
$ curl -X POST http://localhost:8080/api/v1/users --data name=Michael
```

Response:
```
{
    "code": 201,
    "status": "success",
    "message": {
        "id": "6",
        "name": "Michael",
        "email": null,
        "updated": "2018-08-11 19:45:41"
    }
}
```


## Update user:

Request:
```
$ curl -X PUT http://localhost:8080/api/v1/users/6 --data name=John
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "6",
        "name": "John",
        "email": null,
        "updated": "2018-08-11 19:45:43"
    }
}
```


## Delete user:

Request:
```
$ curl -X DELETE http://localhost:8080/api/v1/users/6
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": "El usuario fue eliminado correctamente."
}
```


## Get all tasks:

Request:
```
$ curl http://localhost:8080/api/v1/tasks
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": [
        {
            "id": "1",
            "name": "Go to cinema",
            "status": "1",
            "updated": "2018-08-11 19:40:01"
        },
        {
            "id": "2",
            "name": "Buying shoes",
            "status": "1",
            "updated": "2018-08-11 19:40:02"
        },
        {
            "id": "3",
            "name": "Go to shopping",
            "status": "1",
            "updated": "2018-08-11 19:40:02"
        },
        {
            "id": "4",
            "name": "Buy milk",
            "status": "1",
            "updated": "2018-08-11 19:40:02"
        },
        {
            "id": "5",
            "name": "Do homework...",
            "status": "0",
            "updated": "2018-08-11 19:40:03"
        }
    ]
}
```


## Get one task:

Request:
```
$ curl http://localhost:8080/api/v1/tasks/3
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "3",
        "name": "Go to shopping",
        "status": "1",
        "updated": "2018-08-11 19:40:02"
    }
}
```


## Search tasks by name:

Request:
```
$ curl http://localhost:8080/api/v1/tasks/search/cine
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": [
        {
            "id": "1",
            "name": "Go to cinema",
            "status": "1",
            "updated": "2018-08-11 19:40:01"
        }
    ]
}
```


## Create task:

Request:
```
$ curl -X POST http://localhost:8080/api/v1/tasks --data name=Cine
```

Response:
```
{
    "code": 201,
    "status": "success",
    "message": {
        "id": "6",
        "name": "Cine",
        "status": "0",
        "updated": "2018-08-11 19:46:17"
    }
}
```


## Update task:

Request:
```
$ curl -X PUT http://localhost:8080/api/v1/tasks/6 --data name=Task
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "6",
        "name": "Task",
        "status": "0",
        "updated": "2018-08-11 19:46:25"
    }
}
```


## Detele task:

Request:
```
$ curl -X DELETE http://localhost:8080/api/v1/tasks/6
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": "La tarea fue eliminada correctamente."
}
```


## Get help:

Request:
```
$ curl http://localhost:8080
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "tasks": "\/api\/v1\/tasks",
        "users": "\/api\/v1\/users",
        "status": "\/status",
        "version": "\/version",
        "this help": "\/"
    }
}
```


## Get version:

Request:
```
$ curl http://localhost:8080/version
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "version": "18.08"
    }
}
```


## Check status:

Request:
```
$ curl http://localhost:8080/status
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "status": "OK"
    }
}
```


