# Prueba Parte 1
## SQL
CREATE DATABASE IF NOT EXISTS `shop` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `shop`;

CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `createAt`  datetime default now(),
  `updateAt`  datetime default now() ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `product` (  
  `code` varchar(50)  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  primary key,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categoryId` int NOT NULL,
  `price` float,
  `createAt`  datetime default now(),
  `updateAt`  datetime default now()
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

alter table `product` Add constraint 
fk_Product_Category foreign key (categoryId) 
references category (ID);

INSERT INTO `category` ( `name`) VALUES
	( 'office'),
	( 'home'),
	( 'tecnologies'),
	( 'pets');
    
INSERT INTO `product` (`code`, `name`, `categoryId`, `price`) VALUES
	('off1', 'office-item-1',1,19.2),
    ('off2', 'office-item-2',1,10.2),
    ('off3', 'office-item-3',1,1.2),
    
	('hom1', 'home-item-2',2,89.9),
    ('hom2', 'home-item-1',2,9.9),
    ('hom3', 'home-item-3',2,5.6),
    
	('tec1', 'tecnologies-item-3',3,6.99),
    ('tec2', 'tecnologies-item-2',3,96.99),
    ('tec3', 'tecnologies-item-1',3,0.99),
    
	('pet1', 'pets-item-1',4,8.95),
    ('pet2', 'pets-item-2',4,6.95),
    ('pet3', 'pets-item-3',4,54.6);





# PRUEBA PARTE 2
CREATE DATABASE IF NOT EXISTS `prueba` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `prueba`;

CREATE TABLE IF NOT EXISTS `libro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `autor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `apellido` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `prestamo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libro_id` int DEFAULT NULL,
  `fecha_prestamo` date DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_prestamo_libro` (`libro_id`),
  KEY `FK_prestamo_usuario` (`usuario_id`),
  CONSTRAINT `FK_prestamo_libro` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`),
  CONSTRAINT `FK_prestamo_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `email`) VALUES
	(1, 'Usuario 1', 'Apellido 1', 'usuario1@email.com'),
	(2, 'Usuario 2', 'Apellido 2', 'usuario2@email.com'),
	(3, 'Usuario 3', 'Apellido 3', 'usuario3@email.com');

INSERT INTO `libro` (`id`, `titulo`, `autor`) VALUES
	(1, 'Libro 1', 'Autor 1'),
	(2, 'Libro 2', 'Autor 2'),
	(3, 'Libro 3', 'Autor 3');

INSERT INTO `prestamo` (`id`, `libro_id`, `fecha_prestamo`, `fecha_devolucion`, `usuario_id`) VALUES
	(1, 1, '2023-12-15', NULL, 1),
	(2, 2, '2023-12-20', NULL, 2),
	(3, 3, '2023-12-25', NULL, 3),
	(4, 1, '2023-12-30', '2024-01-05', 1),
	(5, 2, '2024-01-05', NULL, 2),
	(6, 3, '2024-01-10', NULL, 3),
	(7, 1, '2024-01-15', NULL, 1),
	(8, 2, '2024-01-20', NULL, 2),
	(9, 3, '2024-01-25', '2024-02-01', 3),
	(10, 1, '2024-01-30', NULL, 1),
	(11, 2, '2024-02-01', NULL, 2),
	(12, 3, '2024-02-05', NULL, 3),
	(13, 1, '2024-02-08', NULL, 1),
	(14, 2, '2024-02-12', '2024-02-19', 2),

	(15, 3, '2024-02-18', NULL, 3);



Select 
p.id as id,
l.titulo as tituloLibro,
l.autor as autorLibro,
u.nombre as usuario,
p.fecha_prestamo as fechaPrestamo,
p.fecha_devolucion as fechaDevolucion
from prestamo as p 
join libro l on p.libro_id = l.id
join usuario u on p.usuario_id = u.id
order by p.fecha_prestamo;

/*
2. Consulta 2 - Libros No Devueltos en 7 días:
• Encuentra los títulos y autores de los libros que fueron prestados hace
más de 7 días y aún no han sido devueltos. Incluye el nombre del
usuario que los tiene prestados y la fecha de préstamo.
*/
/*Agrego libros que superan los 7 dias*/
INSERT INTO `prestamo` (`id`, `libro_id`, `fecha_prestamo`, `fecha_devolucion`, `usuario_id`) VALUES
	(16, 1, '2023-12-15', '2024-01-15', 1),
	(17, 2, '2023-12-20', '2023-12-29', 2),
	(18, 3, '2023-12-25', '2024-01-03', 3),
	(19, 1, '2023-12-30', '2024-01-30', 1);

Select 
p.id as id,
l.titulo as tituloLibro,
l.autor as autorLibro,
u.nombre as usuario,
p.fecha_prestamo as fechaPrestamo,
p.fecha_devolucion as fechaDevolucion
from prestamo as p 
join libro l on p.libro_id = l.id
join usuario u on p.usuario_id = u.id
where 
p.fecha_devolucion is NULL OR
(p.fecha_devolucion IS NOT NULL 
AND datediff(p.fecha_devolucion,p.fecha_prestamo)>7)