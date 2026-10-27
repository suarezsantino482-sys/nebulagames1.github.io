CREATE DATABASE IF NOT EXISTS nebula_games
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE nebula_games;

CREATE TABLE IF NOT EXISTS generos (
    id_genero INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(80) NOT NULL,
    descripcion VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_genero),
    UNIQUE KEY nombre (nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS fabricantes (
    id_fabricante INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    pais VARCHAR(80) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_fabricante),
    UNIQUE KEY nombre (nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS consolas (
    id_consola INT NOT NULL AUTO_INCREMENT,
    id_fabricante INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    generacion VARCHAR(40) DEFAULT NULL,
    anio_lanzamiento SMALLINT UNSIGNED DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_consola),
    UNIQUE KEY uq_consolas_nombre_fabricante (nombre, id_fabricante),
    KEY fk_consolas_fabricantes (id_fabricante),
    CONSTRAINT fk_consolas_fabricantes FOREIGN KEY (id_fabricante)
        REFERENCES fabricantes (id_fabricante) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS juegos (
    id_juego INT NOT NULL AUTO_INCREMENT,
    id_genero INT NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    anio_lanzamiento SMALLINT UNSIGNED DEFAULT NULL,
    descripcion TEXT DEFAULT NULL,
    imagen_url VARCHAR(500) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_juego),
    KEY idx_juegos_genero (id_genero),
    CONSTRAINT fk_juegos_generos FOREIGN KEY (id_genero)
        REFERENCES generos (id_genero) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS juego_consola (
    id_juego_consola INT NOT NULL AUTO_INCREMENT,
    id_juego INT NOT NULL,
    id_consola INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_juego_consola),
    UNIQUE KEY uq_juego_consola (id_juego, id_consola),
    KEY idx_juego_consola_consola (id_consola),
    CONSTRAINT fk_juego_consola_consolas FOREIGN KEY (id_consola)
        REFERENCES consolas (id_consola) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_juego_consola_juegos FOREIGN KEY (id_juego)
        REFERENCES juegos (id_juego) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO generos (nombre, descripcion) VALUES
    ('Accion', 'Juegos de accion y combate'),
    ('Aventura', 'Juegos de aventura y exploracion'),
    ('Plataformas', 'Juegos de plataformas'),
    ('RPG', 'Juegos de rol');

INSERT IGNORE INTO fabricantes (nombre, pais) VALUES
    ('Atari', 'Estados Unidos'),
    ('Nintendo', 'Japon'),
    ('Sega', 'Japon');

INSERT IGNORE INTO consolas (id_fabricante, nombre, generacion, anio_lanzamiento)
SELECT id_fabricante, 'Atari 2600', '8 bits', 1977
FROM fabricantes WHERE nombre = 'Atari';

INSERT IGNORE INTO consolas (id_fabricante, nombre, generacion, anio_lanzamiento)
SELECT id_fabricante, 'Nintendo Entertainment System', '8 bits', 1983
FROM fabricantes WHERE nombre = 'Nintendo';

INSERT IGNORE INTO consolas (id_fabricante, nombre, generacion, anio_lanzamiento)
SELECT id_fabricante, 'Super Nintendo', '16 bits', 1990
FROM fabricantes WHERE nombre = 'Nintendo';

INSERT IGNORE INTO consolas (id_fabricante, nombre, generacion, anio_lanzamiento)
SELECT id_fabricante, 'Game Boy Color', '8 bits', 1998
FROM fabricantes WHERE nombre = 'Nintendo';

INSERT IGNORE INTO consolas (id_fabricante, nombre, generacion, anio_lanzamiento)
SELECT id_fabricante, 'Game Boy Advance', '32 bits', 2001
FROM fabricantes WHERE nombre = 'Nintendo';

INSERT IGNORE INTO consolas (id_fabricante, nombre, generacion, anio_lanzamiento)
SELECT id_fabricante, 'Sega Genesis', '16 bits', 1988
FROM fabricantes WHERE nombre = 'Sega';

INSERT IGNORE INTO consolas (id_fabricante, nombre, generacion, anio_lanzamiento)
SELECT id_fabricante, 'Sega Master System', '8 bits', 1985
FROM fabricantes WHERE nombre = 'Sega';
