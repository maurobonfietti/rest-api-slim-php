# API REST SLIM PHP

Ejemplo de API REST con microframework Slim PHP.


## INSTALACIÓN:

1- Descargar el proyecto:
```
$ cd path-to-your-projects
$ git clone https://github.com/maurobonfietti/api-rest-slimphp.git
$ cd api-rest-slimphp
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
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for `tasks`
--
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```


4- Cargar datos de prueba en la base de datos:
```
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('1', 'Juan', 'juanmartin@delpotro.com');
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('2', 'Federico', null);
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('3', 'Leo', null);
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('4', 'Carlos', null);
INSERT INTO `users` (`id`, `name`, `email`) VALUES ('5', 'Diego', 'diego10@gmail.com');

INSERT INTO `tasks` (`id`, `task`, `status`) VALUES (1, 'Ir al centro', 1);
INSERT INTO `tasks` (`id`, `task`, `status`) VALUES (2, 'Comprar zapatillas', 1);
INSERT INTO `tasks` (`id`, `task`, `status`) VALUES (3, 'Ir al super', 1);
INSERT INTO `tasks` (`id`, `task`, `status`) VALUES (4, 'Comprar cereales', 1);
INSERT INTO `tasks` (`id`, `task`, `status`) VALUES (5, 'Hacer tarea...', 0);
```


5- Configurar los datos de acceso a MySQL.

Editar archivo de configuración: `src/settings.php`
```
// Database connection settings
'db' => [
    'host' => '127.0.0.1',
    'dbname' => 'api-rest-slimphp',
    'user' => 'YourMysqlUser',
    'pass' => 'YourMysqlPass',
],
```


## SERVIDOR LOCAL:

Se puede iniciar el servidor web interno de PHP ejecutando:
```
$ composer start
```


### NOTA:

Si todo fue bien :sunglasses:, se puede acceder localmente al proyecto ingresando a: 
[Ayuda](http://localhost:8080), 
[Usuarios](http://localhost:8080/users), 
[Tareas](http://localhost:8080/tasks).

El comando `composer start` sería el equivalente a ejecutar:
```
$ php -S 0.0.0.0:8080 -t public public/index.php
```


## MODO DE USO:

Para más información sobre el uso de la API REST, ver el siguiente documento con el [Modo de Uso](DOC.md).


## TESTS:

Acceder a la ruta del proyecto y ejecutar los tests con `phpunit`:
```
$ phpunit
PHPUnit 5.7.17 by Sebastian Bergmann and contributors.

..........................                                        26 / 26 (100%)

Time: 204 ms, Memory: 4.00MB

OK (26 tests, 111 assertions)
```
