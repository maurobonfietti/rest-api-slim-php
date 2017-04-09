## MODO DE USO:


### Ver usuarios:
```
$ curl -s http://localhost:8080/users
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
            "created": "2017-04-09 15:09:49",
            "updated": "2017-04-09 15:09:49"
        },
        {
            "id": "2",
            "name": "Federico",
            "email": null,
            "created": "2017-04-09 15:09:49",
            "updated": "2017-04-09 15:09:49"
        },
        {
            "id": "3",
            "name": "Leo",
            "email": null,
            "created": "2017-04-09 15:09:49",
            "updated": "2017-04-09 15:09:49"
        },
        {
            "id": "4",
            "name": "Carlos",
            "email": null,
            "created": "2017-04-09 15:09:49",
            "updated": "2017-04-09 15:09:49"
        },
        {
            "id": "5",
            "name": "Diego",
            "email": "diego10@gmail.com",
            "created": "2017-04-09 15:09:49",
            "updated": "2017-04-09 15:09:49"
        }
    ]
}
```


### Ver usuario:
```
$ curl -s http://localhost:8080/users/1
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
        "created": "2017-04-09 15:09:49",
        "updated": "2017-04-09 15:09:49"
    }
}
```


### Buscar usuarios por nombre:
```
$ curl -s http://localhost:8080/users/search/le
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
            "created": "2017-04-09 15:09:49",
            "updated": "2017-04-09 15:09:49"
        }
    ]
}
```


### Crear usuario:
```
$ curl -s -X POST http://localhost:8080/users --data name=Sergio
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
        "created": "2017-04-09 15:09:51",
        "updated": "2017-04-09 15:09:51"
    }
}
```


### Actualizar usuario:
```
$ curl -s -X PUT http://localhost:8080/users/1 --data name=Javier
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "1",
        "name": "Javier",
        "email": "juanmartin@delpotro.com",
        "created": "2017-04-09 15:09:49",
        "updated": "2017-04-09 15:09:51"
    }
}
```


### Eliminar usuario:
```
$ curl -s -X DELETE http://localhost:8080/users/1
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
$ curl -s http://localhost:8080/tasks
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
            "created": "2017-04-09 15:09:49",
            "updated": "2017-04-09 15:09:49"
        },
        {
            "id": "2",
            "task": "Comprar zapatillas",
            "status": "1",
            "created": "2017-04-09 15:09:49",
            "updated": "2017-04-09 15:09:49"
        },
        {
            "id": "5",
            "task": "Hacer tarea...",
            "status": "0",
            "created": "2017-04-09 15:09:49",
            "updated": "2017-04-09 15:09:49"
        },
        {
            "id": "1",
            "task": "Ir al centro",
            "status": "1",
            "created": "2017-04-09 15:09:49",
            "updated": "2017-04-09 15:09:49"
        },
        {
            "id": "3",
            "task": "Ir al super",
            "status": "1",
            "created": "2017-04-09 15:09:49",
            "updated": "2017-04-09 15:09:49"
        }
    ]
}
```


### Ver tarea:
```
$ curl -s http://localhost:8080/tasks/3
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
        "created": "2017-04-09 15:09:49",
        "updated": "2017-04-09 15:09:49"
    }
}
```


### Buscar tareas por nombre:
```
$ curl -s http://localhost:8080/tasks/search/ir
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
            "created": "2017-04-09 15:09:49",
            "updated": "2017-04-09 15:09:49"
        },
        {
            "id": "3",
            "task": "Ir al super",
            "status": "1",
            "created": "2017-04-09 15:09:49",
            "updated": "2017-04-09 15:09:49"
        }
    ]
}
```


### Crear tarea:
```
$ curl -s -X POST http://localhost:8080/tasks --data task=Super
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
        "created": "2017-04-09 15:09:51",
        "updated": "2017-04-09 15:09:51"
    }
}
```


### Actualizar tarea:
```
$ curl -s -X PUT http://localhost:8080/tasks/4 --data task=Viajar
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": {
        "id": "4",
        "task": "Viajar",
        "status": "1",
        "created": "2017-04-09 15:09:49",
        "updated": "2017-04-09 15:09:51"
    }
}
```


### Eliminar tarea:
```
$ curl -s -X DELETE http://localhost:8080/tasks/5
```

Respuesta:
```
{
    "code": 200,
    "status": "success",
    "message": "La tarea fue eliminada correctamente."
}
```


