# MODO DE USO:


## Ver usuarios:

Petición:
```
$ curl http://localhost:8080/api/v1/users
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
            "updated": "2018-01-28 05:29:35"
        },
        {
            "id": "2",
            "name": "Federico",
            "email": null,
            "updated": "2018-01-28 05:29:35"
        },
        {
            "id": "3",
            "name": "Leo",
            "email": null,
            "updated": "2018-01-28 05:29:35"
        },
        {
            "id": "4",
            "name": "Carlos",
            "email": null,
            "updated": "2018-01-28 05:29:35"
        },
        {
            "id": "5",
            "name": "Diego",
            "email": "diego10@gmail.com",
            "updated": "2018-01-28 05:29:35"
        }
    ]
}
```


## Ver usuario:

Petición:
```
$ curl http://localhost:8080/api/v1/users/1
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
        "updated": "2018-01-28 05:29:35"
    }
}
```


## Buscar usuarios por nombre:

Petición:
```
$ curl http://localhost:8080/api/v1/users/search/le
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
            "updated": "2018-01-28 05:29:35"
        }
    ]
}
```


## Crear usuario:

Petición:
```
$ curl -X POST http://localhost:8080/api/v1/users --data name=Sergio
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
        "updated": "2018-01-28 05:29:35"
    }
}
```


## Actualizar usuario:

Petición:
```
$ curl -X PUT http://localhost:8080/api/v1/users/6 --data name=Javier
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
        "updated": "2018-01-28 05:29:35"
    }
}
```


## Eliminar usuario:

Petición:
```
$ curl -X DELETE http://localhost:8080/api/v1/users/6
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": "El usuario fue eliminado correctamente."
}
```


## Ver tareas:

Petición:
```
$ curl http://localhost:8080/api/v1/tasks
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": [
        {
            "id": "1",
            "name": "Ir al centro",
            "status": "1",
            "updated": "2018-01-28 05:29:35"
        },
        {
            "id": "2",
            "name": "Comprar zapatillas",
            "status": "1",
            "updated": "2018-01-28 05:29:35"
        },
        {
            "id": "3",
            "name": "Ir al super",
            "status": "1",
            "updated": "2018-01-28 05:29:35"
        },
        {
            "id": "4",
            "name": "Comprar cereales",
            "status": "1",
            "updated": "2018-01-28 05:29:35"
        },
        {
            "id": "5",
            "name": "Hacer tarea...",
            "status": "0",
            "updated": "2018-01-28 05:29:35"
        }
    ]
}
```


## Ver tarea:

Petición:
```
$ curl http://localhost:8080/api/v1/tasks/3
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "3",
        "name": "Ir al super",
        "status": "1",
        "updated": "2018-01-28 05:29:35"
    }
}
```


## Buscar tareas por nombre:

Petición:
```
$ curl http://localhost:8080/api/v1/tasks/search/ir
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": [
        {
            "id": "1",
            "name": "Ir al centro",
            "status": "1",
            "updated": "2018-01-28 05:29:35"
        },
        {
            "id": "3",
            "name": "Ir al super",
            "status": "1",
            "updated": "2018-01-28 05:29:35"
        }
    ]
}
```


## Crear tarea:

Petición:
```
$ curl -X POST http://localhost:8080/api/v1/tasks --data name=Super
```

Respuesta:
```
{
    "code": 201,
    "status": "success",
    "message": {
        "id": "6",
        "name": "Super",
        "status": "0",
        "updated": "2018-01-28 05:29:35"
    }
}
```


## Actualizar tarea:

Petición:
```
$ curl -X PUT http://localhost:8080/api/v1/tasks/6 --data name=Viajar
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "6",
        "name": "Viajar",
        "status": "0",
        "updated": "2018-01-28 05:29:35"
    }
}
```


## Eliminar tarea:

Petición:
```
$ curl -X DELETE http://localhost:8080/api/v1/tasks/6
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": "La tarea fue eliminada correctamente."
}
```


## Ver ayuda:

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
        "tasks": "http:\/\/localhost:8080\/api\/v1\/tasks",
        "users": "http:\/\/localhost:8080\/api\/v1\/users",
        "status": "http:\/\/localhost:8080\/status",
        "version": "http:\/\/localhost:8080\/version",
        "this help": "http:\/\/localhost:8080\/"
    }
}
```


## Ver version:

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
        "version": "18.01"
    }
}
```


## Ver status:

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
        "status": "OK"
    }
}
```


