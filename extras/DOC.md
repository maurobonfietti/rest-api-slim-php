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
            "password": null,
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "2",
            "name": "James",
            "email": "jbond@yahoo.net",
            "password": null,
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "3",
            "name": "Lionel",
            "email": "mess10@gmail.gol",
            "password": null,
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "4",
            "name": "Carlos",
            "email": "bianchini@hotmail.com.ar",
            "password": null,
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "5",
            "name": "Diego",
            "email": "diego1010@gmail.com",
            "password": null,
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "6",
            "name": "One User",
            "email": "one@user.com",
            "password": null,
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "7",
            "name": "Diegol",
            "email": "diego@gol.com.ar",
            "password": null,
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "8",
            "name": "Test User",
            "email": "test@user.com",
            "password": "d5f4da62059760b35de35f8fbd8efb43eee26ac741ef8c6e51782a13ac7d50e927b653160c591616a9dc8a452c877a6b80c00aecba14504756a65f88439fcd1e",
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
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
    "message": "JWT Token required.",
    "class": "NoteException",
    "status": "error",
    "code": 400
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
            "email": "mess10@gmail.gol",
            "password": null,
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        }
    ]
}
```


## Create user:

Request:
```
$ curl -X POST http://localhost:8080/api/v1/users --data name=Michael --data email=michael@gmail.com --data password=OnePass100
```

Response:
```
{
    "code": 201,
    "status": "success",
    "message": {
        "id": "9",
        "name": "Michael",
        "email": "michael@gmail.com",
        "password": "f85dc90aba571604387206fd2cb7302d31c065a61d5c57b5256299d6ddbea13fad80d2607a11c4ec55f22072d197d2c718b28d34307e9881b388c3b216f74cc6",
        "created_at": "2019-03-27 23:06:21",
        "updated_at": "2019-03-27 23:06:21"
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
        "email": "one@user.com",
        "password": null,
        "created_at": "2019-03-27 23:06:21",
        "updated_at": "2019-03-27 23:06:21"
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
            "userId": "6",
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "2",
            "name": "Buy shoes",
            "status": "0",
            "userId": "6",
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "3",
            "name": "Go to shopping",
            "status": "0",
            "userId": "6",
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "4",
            "name": "Pay the credit card ;-)",
            "status": "1",
            "userId": "6",
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "5",
            "name": "Do math homework...",
            "status": "0",
            "userId": "6",
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
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
        "status": "0",
        "userId": "6",
        "created_at": "2019-03-27 23:06:21",
        "updated_at": "2019-03-27 23:06:21"
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
            "userId": "6",
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
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
    "message": "JWT Token required.",
    "class": "NoteException",
    "status": "error",
    "code": 400
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
    "message": "Task not found.",
    "class": "TaskException",
    "status": "error",
    "code": 404
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
    "message": "Task not found.",
    "class": "TaskException",
    "status": "error",
    "code": 404
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
            "name": "My Note 1",
            "description": "My first online note",
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "2",
            "name": "Note 2",
            "description": null,
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "3",
            "name": "Long Note 3",
            "description": "This is a very large note, or maybe not...",
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "4",
            "name": "Note Number 4",
            "description": null,
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "5",
            "name": "Note 5",
            "description": "A Random Note",
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
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
        "name": "Long Note 3",
        "description": "This is a very large note, or maybe not...",
        "created_at": "2019-03-27 23:06:21",
        "updated_at": "2019-03-27 23:06:21"
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
            "name": "My Note 1",
            "description": "My first online note",
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "2",
            "name": "Note 2",
            "description": null,
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "3",
            "name": "Long Note 3",
            "description": "This is a very large note, or maybe not...",
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "4",
            "name": "Note Number 4",
            "description": null,
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
        },
        {
            "id": "5",
            "name": "Note 5",
            "description": "A Random Note",
            "created_at": "2019-03-27 23:06:21",
            "updated_at": "2019-03-27 23:06:21"
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
        "created_at": "2019-03-27 23:06:22",
        "updated_at": "2019-03-27 23:06:22"
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
        "created_at": "2019-03-27 23:06:22",
        "updated_at": "2019-03-27 23:06:22"
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
        "version": "19.03",
        "timestamp": 1553738782
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
            "users": 8,
            "tasks": 5,
            "notes": 5
        },
        "version": "19.03",
        "timestamp": 1553738782
    }
}
```


