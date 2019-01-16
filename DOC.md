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
            "updated": "2019-01-16 03:56:38"
        },
        {
            "id": "2",
            "name": "James",
            "email": null,
            "updated": "2019-01-16 03:56:38"
        },
        {
            "id": "3",
            "name": "Lionel",
            "email": null,
            "updated": "2019-01-16 03:56:38"
        },
        {
            "id": "4",
            "name": "Carlos",
            "email": null,
            "updated": "2019-01-16 03:56:38"
        },
        {
            "id": "5",
            "name": "Diego",
            "email": "diego1010@gmail.com",
            "updated": "2019-01-16 03:56:38"
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
        "updated": "2019-01-16 03:56:38"
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
            "updated": "2019-01-16 03:56:38"
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
        "updated": "2019-01-16 03:56:43"
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
        "updated": "2019-01-16 03:56:43"
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
    "message": "The user was deleted."
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
            "updated": "2019-01-16 03:56:37"
        },
        {
            "id": "2",
            "name": "Buying shoes",
            "status": "1",
            "updated": "2019-01-16 03:56:37"
        },
        {
            "id": "3",
            "name": "Go to shopping",
            "status": "1",
            "updated": "2019-01-16 03:56:38"
        },
        {
            "id": "4",
            "name": "Buy milk",
            "status": "1",
            "updated": "2019-01-16 03:56:38"
        },
        {
            "id": "5",
            "name": "Do homework...",
            "status": "0",
            "updated": "2019-01-16 03:56:38"
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
        "updated": "2019-01-16 03:56:38"
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
            "updated": "2019-01-16 03:56:37"
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
        "updated": "2019-01-16 03:56:43"
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
        "updated": "2019-01-16 03:56:44"
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
    "message": "The task was deleted."
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
        "endpoints": {
            "tasks": "http:\/\/localhost:8080\/api\/v1\/tasks",
            "users": "http:\/\/localhost:8080\/api\/v1\/users",
            "notes": "http:\/\/localhost:8080\/api\/v1\/notes",
            "status": "http:\/\/localhost:8080\/status",
            "this help": "http:\/\/localhost:8080"
        },
        "version": "19.01",
        "timestamp": 1547611004
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
        "db": {
            "users": 5,
            "tasks": 5,
            "notes": 5
        },
        "version": "19.01",
        "timestamp": 1547611004
    }
}
```


