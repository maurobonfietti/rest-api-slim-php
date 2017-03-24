# API REST SLIM PHP

Ejemplo de API REST con microframework Slim PHP.


## INSTALACIÓN:

1- Descargar el proyecto:
```
$ cd path-to-your-projects
$ git clone https://github.com/maurobonfietti/api-rest-slimphp.git
$ composer install
```


2- Crear nueva base de datos MySQL. Por ejemplo: "api-rest-slimphp".


3- Crear la estructura de la base de datos:
```
-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for `tasks`
--
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```


4- Cargar datos de prueba en la base de datos:
```
INSERT INTO `users` VALUES ('1', 'Juan', 'juanmartin@delpotro.com');
INSERT INTO `users` VALUES ('2', 'Federico', null);
INSERT INTO `users` VALUES ('3', 'Leo', null);
INSERT INTO `users` VALUES ('4', 'Carlos', null);
INSERT INTO `users` VALUES ('5', 'Diego', 'diego10@gmail.com');


INSERT INTO `tasks` (`id`, `task`, `status`) VALUES (1, 'Ir al centro', 1);
INSERT INTO `tasks` (`id`, `task`, `status`) VALUES (2, 'Comprar zapatillas', 1);
INSERT INTO `tasks` (`id`, `task`, `status`) VALUES (3, 'Ir al super', 1);
INSERT INTO `tasks` (`id`, `task`, `status`) VALUES (4, 'Comprar cereales', 1);
INSERT INTO `tasks` (`id`, `task`, `status`) VALUES (5, 'Hacer tarea...', 0);
```


5- Configurar los datos de acceso a la base de datos.

Archivo: `src/settings.php`
```
    // Database connection settings
    'db' => [
        'host' => '127.0.0.1',
        'dbname' => 'api-rest-slimphp',
        'user' => 'root',
        'pass' => '',
    ],
```


## SERVIDOR LOCAL:

Se puede iniciar el servidor web interno de PHP ejecutando:
```
$ composer start
```


### NOTA:

Si todo fue bien :sunglasses:, se puede visualizar el proyecto ingresando a: 
[Ayuda](http://localhost:8080), 
[Usuarios](http://localhost:8080/users), 
[Tareas](http://localhost:8080/tasks).

El comando `composer start` sería el equivalente a ejecutar:
```
$ php -S 0.0.0.0:8080 -t public public/index.php
```


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
      "email": "juanmartin@delpotro.com"
    },
    {
      "id": "2",
      "name": "Federico",
      "email": null
    },
    {
      "id": "3",
      "name": "Leo",
      "email": null
    },
    {
      "id": "4",
      "name": "Carlos",
      "email": null
    },
    {
      "id": "5",
      "name": "Diego",
      "email": "diego@gmail.com"
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
    "email": "juanmartin@delpotro.com"
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
      "email": null
    }
  ]
}
```


### Crear usuario:
```
$ curl -X POST http://localhost:8080/users --data "name=Sergio"
```

Respuesta:
```
{
  "code": 200,
  "status": "success",
  "message": {
    "name": "Sergio",
    "id": "11"
  }
}
```


### Actualizar usuario:
```
$ curl -X PUT http://localhost:8080/users/1 --data "name=Javier"
```

Respuesta:
```
{
  "code": 200,
  "status": "success",
  "message": {
    "name": "Javier",
    "id": "1"
  }
}
```


### Eliminar usuario:
```
$ curl -X DELETE http://localhost:8080/users/1
```

Respuesta:
```
{
  "code": 200,
  "status": "success",
  "message": "El usuario fue eliminado correctamente."
}
```


***


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
      "created_at": "2017-03-24 19:26:47"
    },
    {
      "id": "2",
      "task": "Comprar zapatillas",
      "status": "1",
      "created_at": "2017-03-24 19:26:47"
    },
    {
      "id": "5",
      "task": "Hacer tarea...",
      "status": "0",
      "created_at": "2017-03-24 19:26:47"
    },
    {
      "id": "1",
      "task": "Ir al centro",
      "status": "1",
      "created_at": "2017-03-24 19:26:47"
    },
    {
      "id": "3",
      "task": "Ir al super",
      "status": "1",
      "created_at": "2017-03-24 19:26:47"
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
    "created_at": "2017-03-24 19:26:47"
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
      "created_at": "2017-03-24 19:26:47"
    },
    {
      "id": "3",
      "task": "Ir al super",
      "status": "1",
      "created_at": "2017-03-24 19:26:47"
    }
  ]
}
```


### Crear tarea:
```
$ curl -X POST http://localhost:8080/tasks --data "task=Comprar carne"
```

Respuesta:
```
{
  "code": 200,
  "status": "success",
  "message": {
    "task": "Comprar carne",
    "id": "27"
  }
}
```


### Actualizar tarea:
```
$ curl -X PUT http://localhost:8080/tasks/4 --data "task=Ir al aeropuerto"
```

Respuesta:
```
{
  "code": 200,
  "status": "success",
  "message": {
    "task": "Ir al aeropuerto",
    "id": "4"
  }
}
```


### Eliminar tarea:
```
$ curl -X DELETE http://localhost:8080/tasks/5
```

Respuesta:
```
{
  "code": 200,
  "status": "success",
  "message": "La tarea fue eliminada correctamente."
}
```


***


## TESTS:

Acceder a la ruta del proyecto y ejecutar los tests con `phpunit`:
```
$ cd api-rest-slimphp/
$ phpunit
PHPUnit 5.7.17 by Sebastian Bergmann and contributors.

..........................                                        26 / 26 (100%)

Time: 204 ms, Memory: 4.00MB

OK (26 tests, 111 assertions)
```
