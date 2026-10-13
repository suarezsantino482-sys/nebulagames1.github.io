# Normalización aplicada a Nebula Games

El prototipo de Nebula Games presenta un catálogo de videojuegos retro organizado por consolas. Para el modelo de datos se toma como entidad principal el videojuego: un juego puede estar disponible para varias consolas, y una consola puede tener muchos juegos.

## 1. Ejemplo sin normalizar

Un registro hipotético del catálogo podría guardar varios juegos y sus consolas en listas dentro de una misma fila:

| id_ficha | nombre_juego | genero | consolas | fabricantes |
|---:|---|---|---|---|
| 1 | Super Mario Bros.; Donkey Kong | Plataformas; Arcade | NES; Game Boy | Nintendo; Nintendo |

Los campos `nombre_juego`, `genero`, `consolas` y `fabricantes` contienen listas. Además, nombres de género y fabricante se repiten en distintos registros.

## 2. Proceso de normalización

### Primera Forma Normal (1FN)

Se reemplazan las listas por valores atómicos, con un juego y una consola por fila:

| id_juego | titulo | genero | id_consola | consola | fabricante |
|---:|---|---|---:|---|---|
| 1 | Super Mario Bros. | Plataformas | 1 | NES | Nintendo |
| 1 | Super Mario Bros. | Plataformas | 2 | Game Boy | Nintendo |
| 2 | Donkey Kong | Arcade | 1 | NES | Nintendo |

Cada celda contiene un único valor. Un videojuego que aparece en más de una consola ocupa más de una fila.

### Segunda Forma Normal (2FN)

En la tabla anterior, la clave natural de cada fila sería `(id_juego, id_consola)`. El título y el género dependen solamente de `id_juego`, mientras que el nombre de consola y su fabricante dependen solamente de `id_consola`; son dependencias parciales respecto de la clave compuesta.

Se descomponen esos datos en entidades propias y se conserva la relación en una tabla puente:

- `juegos(id_juego, titulo, genero, ...)`
- `consolas(id_consola, nombre, fabricante, ...)`
- `juego_consola(id_juego_consola, id_juego, id_consola, ...)`

Así, los atributos de cada entidad dependen de la clave de su propia tabla. La tabla puente guarda únicamente la asociación entre ambas.

### Tercera Forma Normal (3FN)

El género depende del juego mediante `id_genero`, y el fabricante depende de la consola mediante `id_fabricante`. Guardar sus nombres directamente en las tablas de juegos o consolas produciría dependencias transitivas (por ejemplo, `id_juego → id_genero → nombre_genero`).

Se extraen esos datos descriptivos a tablas maestras:

- `generos(id_genero, nombre, descripcion)`
- `fabricantes(id_fabricante, nombre, pais)`
- `juegos(..., id_genero)`
- `consolas(..., id_fabricante)`

Los datos de usuario también se separan de su rol mediante `usuarios.id_rol → roles.id_rol`.

## 3. Tablas resultantes y claves

| Tabla | Clave primaria (PK) | Claves foráneas (FK) | Propósito |
|---|---|---|---|
| `roles` | `id_rol` | — | Roles de acceso, como administrador y jugador. |
| `usuarios` | `id_usuario` | `id_rol → roles.id_rol` | Autenticación y datos personales del usuario. |
| `generos` | `id_genero` | — | Géneros de los videojuegos. |
| `fabricantes` | `id_fabricante` | — | Fabricantes de consolas. |
| `consolas` | `id_consola` | `id_fabricante → fabricantes.id_fabricante` | Consolas del catálogo. |
| `juegos` | `id_juego` | `id_genero → generos.id_genero` | Ficha principal de cada videojuego. |
| `juego_consola` | `id_juego_consola` | `id_juego → juegos.id_juego`; `id_consola → consolas.id_consola` | Resuelve la relación muchos-a-muchos entre juegos y consolas. |

La pareja `(id_juego, id_consola)` es única en `juego_consola`, aunque la tabla también tiene una PK autoincremental para cumplir el estándar técnico del esquema.
