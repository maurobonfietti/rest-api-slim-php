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
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "2",
            "name": "James",
            "email": null,
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "3",
            "name": "Lionel",
            "email": null,
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "4",
            "name": "Carlos",
            "email": null,
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "5",
            "name": "Diego",
            "email": "diego1010@gmail.com",
            "updated": "2019-02-02 17:03:42"
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
        "updated": "2019-01-18 19:34:05"
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
            "updated": "2019-02-02 17:03:42"
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
        "updated": "2019-02-02 17:03:42"
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
        "updated": "2019-02-02 17:03:42"
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
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "2",
            "name": "Buying shoes",
            "status": "1",
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "3",
            "name": "Go to shopping",
            "status": "1",
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "4",
            "name": "Buy milk",
            "status": "1",
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "5",
            "name": "Do homework...",
            "status": "0",
            "updated": "2019-02-02 17:03:42"
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
        "updated": "2019-02-02 17:03:42"
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
            "updated": "2019-02-02 17:03:42"
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
        "updated": "2019-02-02 17:03:42"
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
        "updated": "2019-02-02 17:03:42"
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


## Get all notes:

Request:
```
$ curl http://localhost:8080/api/v1/notes
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": [
        {
            "id": "1",
            "name": "Note 1",
            "description": "My first online note",
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "2",
            "name": "Note 2",
            "description": null,
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "3",
            "name": "Note 3",
            "description": null,
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "4",
            "name": "Note 4",
            "description": null,
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "5",
            "name": "Note 5",
            "description": "Freedom Random Note",
            "updated": "2019-02-02 17:03:42"
        }
    ]
}
```


## Get one note:

Request:
```
$ curl http://localhost:8080/api/v1/notes/3
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "3",
        "name": "Note 3",
        "description": null,
        "updated": "2019-02-02 11:45:49"
    }
}
```


## Search notes by name:

Request:
```
$ curl http://localhost:8080/api/v1/notes/search/not
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": [
        {
            "id": "1",
            "name": "Note 1",
            "description": "My first online note",
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "2",
            "name": "Note 2",
            "description": null,
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "3",
            "name": "Note 3",
            "description": null,
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "4",
            "name": "Note 4",
            "description": null,
            "updated": "2019-02-02 17:03:42"
        },
        {
            "id": "5",
            "name": "Note 5",
            "description": "Freedom Random Note",
            "updated": "2019-02-02 17:03:42"
        }
    ]
}
```


## Create note:

Request:
```
$ curl -X POST http://localhost:8080/api/v1/notes --data name=MyNote
```

Response:
```
{
    "code": 201,
    "status": "success",
    "message": {
        "id": "6",
        "name": "MyNote",
        "description": null,
        "updated": "2019-02-02 17:03:43"
    }
}
```


## Update note:

Request:
```
$ curl -X PUT http://localhost:8080/api/v1/notes/6 --data name=Notes
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "6",
        "name": "Notes",
        "description": null,
        "updated": "2019-02-02 17:03:43"
    }
}
```


## Detele note:

Request:
```
$ curl -X DELETE http://localhost:8080/api/v1/notes/6
```

Response:
```
{
    "code": 200,
    "status": "success",
    "message": "The note was deleted."
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
        "version": "19.02",
        "timestamp": 1549137823
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
        "version": "19.02",
        "timestamp": 1549137823
    }
}
```


