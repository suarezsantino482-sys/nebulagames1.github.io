CREATE DATABASE IF NOT EXISTS nebula_games
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE nebula_games;

CREATE TABLE IF NOT EXISTS roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    id_rol INT NOT NULL,
    gamertag VARCHAR(50) NOT NULL UNIQUE,
    nombre VARCHAR(80) NOT NULL,
    apellido VARCHAR(80),
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuarios_roles
        FOREIGN KEY (id_rol) REFERENCES roles (id_rol)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS generos (
    id_genero INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(80) NOT NULL UNIQUE,
    descripcion VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS fabricantes (
    id_fabricante INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    pais VARCHAR(80),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS consolas (
    id_consola INT AUTO_INCREMENT PRIMARY KEY,
    id_fabricante INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    generacion VARCHAR(40),
    anio_lanzamiento SMALLINT UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT uq_consolas_nombre_fabricante UNIQUE (nombre, id_fabricante),
    CONSTRAINT fk_consolas_fabricantes
        FOREIGN KEY (id_fabricante) REFERENCES fabricantes (id_fabricante)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS juegos (
    id_juego INT AUTO_INCREMENT PRIMARY KEY,
    id_genero INT NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    anio_lanzamiento SMALLINT UNSIGNED,
    descripcion TEXT,
    imagen_url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_juegos_generos
        FOREIGN KEY (id_genero) REFERENCES generos (id_genero)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS juego_consola (
    id_juego_consola INT AUTO_INCREMENT PRIMARY KEY,
    id_juego INT NOT NULL,
    id_consola INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT uq_juego_consola UNIQUE (id_juego, id_consola),
    CONSTRAINT fk_juego_consola_juegos
        FOREIGN KEY (id_juego) REFERENCES juegos (id_juego)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_juego_consola_consolas
        FOREIGN KEY (id_consola) REFERENCES consolas (id_consola)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE INDEX idx_juegos_genero ON juegos (id_genero);
CREATE INDEX idx_juego_consola_consola ON juego_consola (id_consola);
