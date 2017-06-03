## MODO DE USO:


### Ver usuarios:

Petición:
```
$ curl http://localhost:8080/users
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": [
        {
            "id": "1",
            "name": "Juan",
            "email": "juanmartin@delpotro.com",
            "updated": "2017-06-02 21:54:30"
        },
        {
            "id": "2",
            "name": "Federico",
            "email": null,
            "updated": "2017-06-02 21:54:30"
        },
        {
            "id": "3",
            "name": "Leo",
            "email": null,
            "updated": "2017-06-02 21:54:30"
        },
        {
            "id": "4",
            "name": "Carlos",
            "email": null,
            "updated": "2017-06-02 21:54:30"
        },
        {
            "id": "5",
            "name": "Diego",
            "email": "diego10@gmail.com",
            "updated": "2017-06-02 21:54:30"
        }
    ]
}
```


### Ver usuario:

Petición:
```
$ curl http://localhost:8080/users/1
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "1",
        "name": "Juan",
        "email": "juanmartin@delpotro.com",
        "updated": "2017-06-02 21:54:30"
    }
}
```


### Buscar usuarios por nombre:

Petición:
```
$ curl http://localhost:8080/users/search/le
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": [
        {
            "id": "3",
            "name": "Leo",
            "email": null,
            "updated": "2017-06-02 21:54:30"
        }
    ]
}
```


### Crear usuario:

Petición:
```
$ curl -X POST http://localhost:8080/users --data name=Sergio
```

Respuesta:
```
{
    "code": 201,
    "status": "success",
    "message": {
        "id": "6",
        "name": "Sergio",
        "email": null,
        "updated": "2017-06-02 21:54:30"
    }
}
```


### Actualizar usuario:

Petición:
```
$ curl -X PUT http://localhost:8080/users/6 --data name=Javier
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "6",
        "name": "Javier",
        "email": null,
        "updated": "2017-06-02 21:54:30"
    }
}
```


### Eliminar usuario:

Petición:
```
$ curl -X DELETE http://localhost:8080/users/6
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": "El usuario fue eliminado correctamente."
}
```


### Ver tareas:

Petición:
```
$ curl http://localhost:8080/tasks
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": [
        {
            "id": "1",
            "task": "Ir al centro",
            "status": "1",
            "updated": "2017-06-02 21:54:30"
        },
        {
            "id": "2",
            "task": "Comprar zapatillas",
            "status": "1",
            "updated": "2017-06-02 21:54:30"
        },
        {
            "id": "3",
            "task": "Ir al super",
            "status": "1",
            "updated": "2017-06-02 21:54:30"
        },
        {
            "id": "4",
            "task": "Comprar cereales",
            "status": "1",
            "updated": "2017-06-02 21:54:30"
        },
        {
            "id": "5",
            "task": "Hacer tarea...",
            "status": "0",
            "updated": "2017-06-02 21:54:30"
        }
    ]
}
```


### Ver tarea:

Petición:
```
$ curl http://localhost:8080/tasks/3
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "3",
        "task": "Ir al super",
        "status": "1",
        "updated": "2017-06-02 21:54:30"
    }
}
```


### Buscar tareas por nombre:

Petición:
```
$ curl http://localhost:8080/tasks/search/ir
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": [
        {
            "id": "1",
            "task": "Ir al centro",
            "status": "1",
            "updated": "2017-06-02 21:54:30"
        },
        {
            "id": "3",
            "task": "Ir al super",
            "status": "1",
            "updated": "2017-06-02 21:54:30"
        }
    ]
}
```


### Crear tarea:

Petición:
```
$ curl -X POST http://localhost:8080/tasks --data task=Super
```

Respuesta:
```
{
    "code": 201,
    "status": "success",
    "message": {
        "id": "6",
        "task": "Super",
        "status": "0",
        "updated": "2017-06-02 21:54:30"
    }
}
```


### Actualizar tarea:

Petición:
```
$ curl -X PUT http://localhost:8080/tasks/6 --data task=Viajar
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "6",
        "task": "Viajar",
        "status": "0",
        "updated": "2017-06-02 21:54:30"
    }
}
```


### Eliminar tarea:

Petición:
```
$ curl -X DELETE http://localhost:8080/tasks/6
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": "La tarea fue eliminada correctamente."
}
```


### Ver ayuda:

Petición:
```
$ curl http://localhost:8080
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "help": "http:\/\/localhost:8080\/",
        "tasks": "http:\/\/localhost:8080\/tasks",
        "users": "http:\/\/localhost:8080\/users",
        "version": "http:\/\/localhost:8080\/version"
    }
}
```


### Ver version:

Petición:
```
$ curl http://localhost:8080/version
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "api_version": "17.05"
    }
}
```


### Ver status:

Petición:
```
$ curl http://localhost:8080/status
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "api_status": "OK"
    }
}
```


