## MODO DE USO:


### Ver usuarios:
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
            "updated": "2017-04-30 04:48:52"
        },
        {
            "id": "2",
            "name": "Federico",
            "email": null,
            "updated": "2017-04-30 04:48:52"
        },
        {
            "id": "3",
            "name": "Leo",
            "email": null,
            "updated": "2017-04-30 04:48:52"
        },
        {
            "id": "4",
            "name": "Carlos",
            "email": null,
            "updated": "2017-04-30 04:48:52"
        },
        {
            "id": "5",
            "name": "Diego",
            "email": "diego10@gmail.com",
            "updated": "2017-04-30 04:48:52"
        }
    ]
}
```


### Ver usuario:
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
        "updated": "2017-04-30 04:48:52"
    }
}
```


### Buscar usuarios por nombre:
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
            "updated": "2017-04-30 04:48:52"
        }
    ]
}
```


### Crear usuario:
```
$ curl -X POST http://localhost:8080/users --data name=Sergio
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "6",
        "name": "Sergio",
        "email": null,
        "updated": "2017-04-30 04:48:52"
    }
}
```


### Actualizar usuario:
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
        "updated": "2017-04-30 04:48:52"
    }
}
```


### Eliminar usuario:
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
            "id": "4",
            "task": "Comprar cereales",
            "status": "1",
            "updated": "2017-04-30 04:48:52"
        },
        {
            "id": "2",
            "task": "Comprar zapatillas",
            "status": "1",
            "updated": "2017-04-30 04:48:52"
        },
        {
            "id": "5",
            "task": "Hacer tarea...",
            "status": "0",
            "updated": "2017-04-30 04:48:52"
        },
        {
            "id": "1",
            "task": "Ir al centro",
            "status": "1",
            "updated": "2017-04-30 04:48:52"
        },
        {
            "id": "3",
            "task": "Ir al super",
            "status": "1",
            "updated": "2017-04-30 04:48:52"
        }
    ]
}
```


### Ver tarea:
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
        "updated": "2017-04-30 04:48:52"
    }
}
```


### Buscar tareas por nombre:
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
            "updated": "2017-04-30 04:48:52"
        },
        {
            "id": "3",
            "task": "Ir al super",
            "status": "1",
            "updated": "2017-04-30 04:48:52"
        }
    ]
}
```


### Crear tarea:
```
$ curl -X POST http://localhost:8080/tasks --data task=Super
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "6",
        "task": "Super",
        "status": "0",
        "updated": "2017-04-30 04:48:52"
    }
}
```


### Actualizar tarea:
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
        "updated": "2017-04-30 04:48:52"
    }
}
```


### Eliminar tarea:
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
```
$ curl http://localhost:8080
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "help": {
            "tasks": "Ver Tareas: \/tasks",
            "users": "Ver Usuarios: \/users",
            "version": "Ver Version: \/version"
        }
    }
}
```


### Ver version:
```
$ curl http://localhost:8080/version
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "api_version": "17.04"
    }
}
```


