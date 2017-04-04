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
            "id": "2",
            "name": "Federico",
            "email": null,
            "created": "2017-04-02 23:20:34",
            "updated": "2017-04-02 23:20:34"
        },
        {
            "id": "3",
            "name": "Leandro",
            "email": "a@m.com.ar",
            "created": "2017-04-02 23:20:34",
            "updated": "2017-04-03 00:03:28"
        },
        {
            "id": "5",
            "name": "Diego",
            "email": "diego10@gmail.com",
            "created": "2017-04-02 23:20:34",
            "updated": "2017-04-02 23:20:34"
        },
        {
            "id": "15",
            "name": "Lionel",
            "email": null,
            "created": "2017-04-03 21:43:06",
            "updated": "2017-04-03 21:43:06"
        },
        {
            "id": "18",
            "name": "Sergio",
            "email": null,
            "created": "2017-04-03 22:14:08",
            "updated": "2017-04-03 22:14:08"
        },
        {
            "id": "19",
            "name": "Sergio",
            "email": null,
            "created": "2017-04-03 22:14:47",
            "updated": "2017-04-03 22:14:47"
        }
    ]
}
```
