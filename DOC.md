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
            "updated": "2018-12-01 03:21:40"
        },
        {
            "id": "2",
            "name": "James",
            "email": null,
            "updated": "2018-12-01 03:21:41"
        },
        {
            "id": "3",
            "name": "Lionel",
            "email": null,
            "updated": "2018-12-01 03:21:41"
        },
        {
            "id": "4",
            "name": "Carlos",
            "email": null,
            "updated": "2018-12-01 03:21:42"
        },
        {
            "id": "5",
            "name": "Diego",
            "email": "diego1010@gmail.com",
            "updated": "2018-12-01 03:21:43"
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
        "updated": "2018-12-01 03:21:40"
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
            "updated": "2018-12-01 03:21:41"
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
        "updated": "2018-12-01 03:22:21"
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
        "updated": "2018-12-01 03:22:23"
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
            "updated": "2018-12-01 03:21:36"
        },
        {
            "id": "2",
            "name": "Buying shoes",
            "status": "1",
            "updated": "2018-12-01 03:21:36"
        },
        {
            "id": "3",
            "name": "Go to shopping",
            "status": "1",
            "updated": "2018-12-01 03:21:37"
        },
        {
            "id": "4",
            "name": "Buy milk",
            "status": "1",
            "updated": "2018-12-01 03:21:37"
        },
        {
            "id": "5",
            "name": "Do homework...",
            "status": "0",
            "updated": "2018-12-01 03:21:37"
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
        "updated": "2018-12-01 03:21:37"
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
            "updated": "2018-12-01 03:21:36"
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
        "updated": "2018-12-01 03:22:56"
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
        "updated": "2018-12-01 03:22:58"
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
        "tasks": "\/api\/v1\/tasks",
        "users": "\/api\/v1\/users",
        "status": "\/status",
        "this help": "\/"
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
        "status": "OK",
        "version": "18.11",
        "timestamp": 1543634581
    }
}
```


## :

Request:
```
$ 
```

Response:
```

```


