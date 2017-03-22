# API REST SLIM PHP

Ejemplo de API REST con Slim PHP Framework.


## INSTALACIÓN:

1- Descargar el proyecto:
```
$ cd path-to-projects
$ git clone https://github.com/maurobonfietti/api-rest-slimphp.git
$ composer install
```


2- Crear nueva base de datos MySQL. Por ejemplo: "api-rest-slimphp".


3- Crear las tablas "users" y "tasks":
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
SET FOREIGN_KEY_CHECKS=1;


--
-- Table structure for `tasks`
--
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL,
  `task` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
ALTER TABLE `tasks` ADD PRIMARY KEY (`id`);
ALTER TABLE `tasks` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
```


4- Cargar algunos datos de prueba en la base de datos:
```
TRUNCATE users;

INSERT INTO `users` VALUES ('1', 'Juan', 'juanmartin@delpotro.com');
INSERT INTO `users` VALUES ('2', 'Federico', null);
INSERT INTO `users` VALUES ('3', 'Leo', null);
INSERT INTO `users` VALUES ('4', 'Carlos', null);
INSERT INTO `users` VALUES ('5', 'Diego', 'diego@gmail.com');

TRUNCATE tasks;

INSERT INTO `tasks` (`id`, `task`, `status`, `created_at`) VALUES
(1, 'Find bugs', 1, '2016-04-10 23:50:40'),
(2, 'Review code', 1, '2016-04-10 23:50:40'),
(3, 'Fix bugs', 1, '2016-04-10 23:50:40'),
(4, 'Refactor Code', 1, '2016-04-10 23:50:40'),
(5, 'Push to prod', 1, '2016-04-10 23:50:50');
```


5- Configurar los datos de acceso a la base de datos.

Archivo: src/settings.php
```
        // Database connection settings
        'db' => [
            'host' => '127.0.0.1',
            'dbname' => 'api-rest-slimphp',
            'user' => 'root',
            'pass' => '',
        ],
```


## INICIAR SERVIDOR:

Se puede iniciar el servidor web integrado de PHP ejecutando:
```
$ composer start
```


### NOTA:

El comando/script "composer start" sería el equivalente a:
```
$ php -S 0.0.0.0:8080 -t public public/index.php
```


## TESTS:

Acceder a la ruta del proyecto y ejecutar tests con phpunit:
```
$ cd api-rest-slimphp/
$ phpunit
```

Ejemplo de salida:
```
PHPUnit 5.7.17 by Sebastian Bergmann and contributors.

..................                                                18 / 18 (100%)

Time: 199 ms, Memory: 4.00MB

OK (18 tests, 78 assertions)
```
