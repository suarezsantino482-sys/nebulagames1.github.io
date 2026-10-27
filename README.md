# Nebula Games

Sitio web de videojuegos retro. La entrega de la **Clase 5** incorpora el
procesamiento de formularios con PHP y se encuentra en [`clase5/`](./clase5/).

## Clase 5: formularios y procesamiento seguro

La página [`clase5/index.php`](./clase5/index.php) incluye dos formularios:

- **Contacto (POST):** recibe nombre, correo electrónico y mensaje. El servidor
  comprueba campos obligatorios, longitud y formato del correo. Si hay errores,
  muestra mensajes y conserva los valores ingresados; si la validación es
  correcta, informa que el mensaje fue recibido.
- **Búsqueda (GET):** filtra un catálogo de demostración por nombre del juego y
  consola (Nintendo, Sega o Atari). Los criterios se reflejan en la URL y se
  muestran los resultados correspondientes.

Los valores recibidos se recortan y validan en el servidor, y todo dato dinámico
se escapa al imprimirlo en HTML con `htmlspecialchars()`. La búsqueda limita la
longitud del texto y restringe las consolas a una lista permitida.

### Ejecutar localmente

Se necesita PHP. Desde la raíz del repositorio, iniciar el servidor integrado:

```bash
php -S 127.0.0.1:8000
```

Abrir <http://127.0.0.1:8000/clase5/index.php>. También se puede acceder desde
el enlace **Clase 5** de la navegación principal.

### Capturas de funcionamiento

Las imágenes muestran la validación del formulario POST con los campos
conservados, el mensaje de éxito y una búsqueda GET filtrada:

![Errores de validación POST y valores conservados](./clase5/capturas/post-validacion.png)

![Envío POST exitoso](./clase5/capturas/post-exito.png)

![Resultados de búsqueda GET](./clase5/capturas/get-busqueda.png)

## Clase 6: catálogo CRUD con MySQL y PDO

El módulo [`admin/`](./admin/) administra la entidad `juegos` del modelo de
Nebula Games. Conserva sus relaciones con `generos`, `consolas` y
`juego_consola`, y permite listar, filtrar, crear, editar y eliminar juegos.
Las altas y ediciones actualizan el juego y sus consolas dentro de una
transacción. La aplicación valida los campos en el servidor, escapa los valores
impresos con `htmlspecialchars()`, usa consultas preparadas de PDO y protege las
acciones POST con un token CSRF.

### Configurar en XAMPP

1. Iniciá Apache y MySQL desde el panel de XAMPP.
2. En phpMyAdmin, importá [`database/clase6.sql`](./database/clase6.sql). Este
   archivo crea (sin borrar datos existentes) la base `nebula_games` y las
   tablas del modelo relacionadas con juegos, géneros, consolas y fabricantes,
   e incorpora opciones iniciales de géneros, fabricantes y consolas.
3. Si tu usuario MySQL no es `root` sin contraseña, definí las variables de
   entorno `DB_HOST`, `DB_NAME`, `DB_USER` y `DB_PASS` antes de iniciar PHP.
   Los valores predeterminados son `127.0.0.1`, `nebula_games`, `root` y
   contraseña vacía.
4. Podés abrir <http://localhost/nebulagames1.github.io/admin/> si el repositorio
   está dentro de `htdocs`. Si está en otra ubicación, iniciá el servidor PHP
   desde la raíz del proyecto con `php -S 127.0.0.1:8000` y abrí
   <http://127.0.0.1:8000/admin/>. Desde la navegación principal también está el
   enlace **Catálogo CRUD**.

La conexión PDO está en [`config/conexion.php`](./config/conexion.php). Las
operaciones de lectura, alta, edición y baja se implementan en `admin/`.
