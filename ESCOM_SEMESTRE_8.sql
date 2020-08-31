SELECT * FROM alumnophp.alumno;

UPDATE alumno SET nombre="Jose Antonio" WHERE boleta = "2015630084";

INSERT INTO alumno VALUES ('2016630020', 'Jaime', 'Bastida', 'Prado', MD5('qwerty'), 'jamesf6@gmail.com', '1997-09-22', '1997-09-22 23:50:50');

SELECT * FROM loginv3.alumno;

-- ----------------------------- B A N D E J A  S A L I D A ---------------------------------------------------

SELECT * FROM proyecto.usuario;
SELECT * FROM proyecto.admin;
SELECT * FROM proyecto.bandeja_salida;
SELECT * FROM proyecto.bandeja_entrada;
SELECT COUNT(*) FROM proyecto.bandeja_salida WHERE categoria = "amor";
SELECT COUNT(*) FROM proyecto.bandeja_salida WHERE categoria = "amistad";
SELECT COUNT(*) FROM proyecto.bandeja_salida WHERE categoria = "cumpleanos";
SELECT COUNT(*) FROM proyecto.bandeja_salida WHERE categoria = "festivos";

INSERT INTO proyecto.admin VALUES ('JaimeAdmin', 'jamesf6888@gmail.com', 'Hombre', '1997-09-22', MD5('admin'), '1997-09-22 23:50:50');
INSERT INTO proyecto.bandeja_salida VALUES ('juan@gmail.com', 'jamesf6888@gmail.com', 'Feli cumple', 'cumpleanos/2.jpg');

SET SQL_SAFE_UPDATES = 0;
DELETE FROM proyecto.usuario WHERE correo = 'juanes@gmail.com';
DELETE FROM proyecto.bandeja_entrada;
DELETE FROM proyecto.bandeja_salida;

UPDATE proyecto.usuario SET nombre = 'jaimee' WHERE correo = 'jaime@gmail.com';

SELECT * FROM postal;
DELETE FROM postal;

