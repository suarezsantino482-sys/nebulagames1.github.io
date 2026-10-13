USE nebula_games;

-- CREATE: cargar roles y otros datos maestros.
INSERT INTO roles (nombre, descripcion) VALUES
    ('Administrador', 'Administra el catálogo y los usuarios'),
    ('Jugador', 'Usuario de la comunidad Nebula Games');

INSERT INTO generos (nombre, descripcion) VALUES
    ('Plataformas', 'Juegos de plataformas y aventura'),
    ('Accion', 'Juegos de accion y combate');

INSERT INTO fabricantes (nombre, pais) VALUES
    ('Nintendo', 'Japon'),
    ('Sega', 'Japon');

-- Crear dos usuarios de prueba asociados a roles existentes.
-- Reemplazar los hashes de ejemplo por hashes generados con password_hash() en PHP.
INSERT INTO usuarios (id_rol, gamertag, nombre, apellido, email, password_hash)
SELECT id_rol, 'NeoPixel', 'Nora', 'Gomez', 'nora@example.com',
       '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.'
FROM roles
WHERE nombre = 'Jugador';

INSERT INTO usuarios (id_rol, gamertag, nombre, apellido, email, password_hash)
SELECT id_rol, 'RetroFan', 'Leo', 'Perez', 'leo@example.com',
       '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.'
FROM roles
WHERE nombre = 'Jugador';

-- Crear consolas vinculadas a sus fabricantes.
INSERT INTO consolas (id_fabricante, nombre, generacion, anio_lanzamiento)
SELECT id_fabricante, 'Nintendo Entertainment System', '8 bits', 1983
FROM fabricantes
WHERE nombre = 'Nintendo';

INSERT INTO consolas (id_fabricante, nombre, generacion, anio_lanzamiento)
SELECT id_fabricante, 'Sega Genesis', '16 bits', 1988
FROM fabricantes
WHERE nombre = 'Sega';

-- CREATE: insertar juegos vinculados a sus generos.
INSERT INTO juegos (id_genero, titulo, anio_lanzamiento, descripcion, imagen_url)
SELECT id_genero, 'Super Mario Bros.', 1985,
       'Clasico de plataformas protagonizado por Mario.',
       'imagenes/nes.jfif'
FROM generos
WHERE nombre = 'Plataformas';

INSERT INTO juegos (id_genero, titulo, anio_lanzamiento, descripcion, imagen_url)
SELECT id_genero, 'Sonic the Hedgehog', 1991,
       'Aventura de plataformas protagonizada por Sonic.',
       'imagenes/sonic.jpg'
FROM generos
WHERE nombre = 'Plataformas';

-- Vincular cada juego con una consola (relacion muchos-a-muchos).
INSERT INTO juego_consola (id_juego, id_consola)
SELECT j.id_juego, c.id_consola
FROM juegos AS j
INNER JOIN consolas AS c
    ON c.nombre = 'Nintendo Entertainment System'
WHERE j.titulo = 'Super Mario Bros.';

INSERT INTO juego_consola (id_juego, id_consola)
SELECT j.id_juego, c.id_consola
FROM juegos AS j
INNER JOIN consolas AS c
    ON c.nombre = 'Sega Genesis'
WHERE j.titulo = 'Sonic the Hedgehog';

-- READ: filtrar por género y ordenar por año y título.
SELECT j.titulo, j.anio_lanzamiento, g.nombre AS genero
FROM juegos AS j
INNER JOIN generos AS g ON g.id_genero = j.id_genero
WHERE g.nombre = 'Plataformas'
ORDER BY j.anio_lanzamiento, j.titulo;

-- READ: unir juegos, consolas y fabricantes para mostrar el catálogo por plataforma.
SELECT j.titulo, c.nombre AS consola, f.nombre AS fabricante, j.anio_lanzamiento
FROM juego_consola AS jc
INNER JOIN juegos AS j ON j.id_juego = jc.id_juego
INNER JOIN consolas AS c ON c.id_consola = jc.id_consola
INNER JOIN fabricantes AS f ON f.id_fabricante = c.id_fabricante
ORDER BY c.nombre, j.titulo;

-- UPDATE: modificar un dato de un registro específico.
UPDATE juegos
SET descripcion = 'Clasico de plataformas de Nintendo lanzado en 1985.'
WHERE titulo = 'Super Mario Bros.';

-- DELETE: dar de baja el videojuego de prueba.
-- La asociacion en juego_consola se elimina mediante ON DELETE CASCADE.
DELETE FROM juegos
WHERE titulo = 'Sonic the Hedgehog'
  AND anio_lanzamiento = 1991;
