# Nebula Games

Sitio web en español dedicado a videojuegos y consolas retro. Incluye secciones informativas, un catálogo de juegos por plataforma y género, una sala arcade, cuentas de usuario, perfiles y administración del catálogo.

## Contenido

- [Tecnologías y requisitos](#tecnologías-y-requisitos)
- [Instalación local](#instalación-local)
- [Configuración de la base de datos](#configuración-de-la-base-de-datos)
- [Funciones del sitio](#funciones-del-sitio)
- [Dónde cambiar enlaces y direcciones de imágenes](#dónde-cambiar-enlaces-y-direcciones-de-imágenes)
- [Estructura del proyecto](#estructura-del-proyecto)
- [Solución de problemas](#solución-de-problemas)

## Tecnologías y requisitos

- PHP 8 o superior.
- MySQL o MariaDB.
- Apache con XAMPP o Laragon (alternativamente, el servidor integrado de PHP).
- Extensiones de PHP: PDO MySQL, Fileinfo y Mbstring.
- Git, si vas a clonar el repositorio.

El sitio usa HTML, CSS propio y JavaScript; Bootstrap no es un requisito.

## Instalación local

1. Instala XAMPP o Laragon e inicia Apache y MySQL.
2. Clona el repositorio dentro de la carpeta pública del servidor web. En XAMPP, normalmente es `C:\xampp\htdocs`:

   ```bash
   cd C:\xampp\htdocs
   git clone <URL_DEL_REPOSITORIO> Nebula
   ```

   Cambia `<URL_DEL_REPOSITORIO>` por la dirección HTTPS o SSH real del repositorio. Si ya tienes una copia del proyecto, puedes omitir este paso.
3. En la raíz del proyecto, copia `.env.example` y nombra la copia `.env`. En Windows PowerShell:

   ```powershell
   Copy-Item .env.example .env
   ```

4. Revisa los valores de `.env`, especialmente los datos de conexión a MySQL y `APP_URL` (ver [Dónde cambiar enlaces y direcciones de imágenes](#dónde-cambiar-enlaces-y-direcciones-de-imágenes)).
5. En phpMyAdmin, importa `schema.sql` para crear la base `nebula_games` y sus tablas.
6. Opcional: importa `catalogo_juegos.sql` para cargar los juegos de ejemplo.
7. Abre <http://localhost/Nebula/> en el navegador.

También puedes iniciar el servidor integrado de PHP desde la carpeta raíz del proyecto:

```bash
php -S 127.0.0.1:8000
```

Luego abre <http://127.0.0.1:8000/>. La conexión con MySQL debe estar configurada y el servicio MySQL debe seguir iniciado.

> Si ya tienes una base creada con la tabla antigua `usuarios_app`, haz una copia de seguridad y ejecuta `migrar_usuarios.sql` una sola vez. No vuelvas a importar `schema.sql` sobre una base existente sin revisar primero su contenido.

## Configuración de la base de datos

La aplicación lee primero las variables de entorno del sistema y luego las del archivo `.env`. Los valores de ejemplo están en [`.env.example`](./.env.example); la carga de configuración se realiza en [`config/env.php`](./config/env.php) y la conexión PDO en [`config/conexion.php`](./config/conexion.php).

Variables principales:

| Variable | Uso | Valor local de ejemplo |
| --- | --- | --- |
| `APP_NAME` | Nombre mostrado en el sitio | `Nebula Games` |
| `APP_ENV` | Entorno de ejecución | `local` |
| `APP_EMAIL` | Correo de contacto | `contacto@nebulagames.com` |
| `APP_URL` | Dirección base donde se sirve el proyecto | `http://localhost/Nebula/` |
| `NEBULA_DB_HOST` | Servidor de MySQL | `127.0.0.1` |
| `NEBULA_DB_PORT` | Puerto de MySQL | `3306` |
| `NEBULA_DB_NAME` | Nombre de la base | `nebula_games` |
| `NEBULA_DB_USER` | Usuario de MySQL | `root` |
| `NEBULA_DB_PASSWORD` | Contraseña de MySQL | Vacía en una instalación local típica de XAMPP |

No publiques `.env` ni guardes contraseñas reales en `.env.example`. El archivo `.gitignore` excluye `.env`.

### Archivos SQL

- [`schema.sql`](./schema.sql): crea roles, géneros, fabricantes, consolas, juegos, relaciones entre juegos y consolas, y usuarios.
- [`catalogo_juegos.sql`](./catalogo_juegos.sql): carga opcional de juegos de ejemplo.
- [`migrar_usuarios.sql`](./migrar_usuarios.sql): migración para instalaciones con el esquema antiguo de usuarios.
- [`consultas.sql`](./consultas.sql): consultas de demostración y operaciones CRUD.
- [`consultas_cv.sql`](./consultas_cv.sql) y [`perfil_usuario.sql`](./perfil_usuario.sql): archivos SQL complementarios del proyecto.
- [`normalizacion.md`](./normalizacion.md): documentación de normalización hasta 3FN.

Para asignar el rol de administrador a una cuenta ya registrada, ejecuta en phpMyAdmin y sustituye el correo de ejemplo:

```sql
USE nebula_games;

UPDATE usuarios
SET id_rol = (SELECT id_rol FROM roles WHERE nombre = 'admin')
WHERE email = 'admin@example.com';
```

## Funciones del sitio

- **Navegación y secciones:** inicio, consolas, juegos, blog, curso, contacto, CV y quiénes somos.
- **Catálogo:** búsqueda de juegos por título, descripción, género o consola desde la página de inicio.
- **Cuentas:** registro, inicio y cierre de sesión; las contraseñas se guardan con hash.
- **Perfiles y acceso:** el panel de usuario requiere una sesión iniciada; las herramientas de administración requieren el rol `admin`.
- **Administración del catálogo:** listado, alta, edición y eliminación de juegos en [`admin/`](./admin/).
- **Formularios de Clase 5:** ejemplos de procesamiento POST y búsqueda GET en [`clase5/`](./clase5/).
- **Plantillas compartidas:** [`includes/header.php`](./includes/header.php), [`includes/nav.php`](./includes/nav.php) e [`includes/footer.php`](./includes/footer.php) centralizan encabezado, navegación y pie de página.

Para probar registro e inicio de sesión, abre <http://localhost/Nebula/auth/login.php> (o la URL equivalente si usas otro servidor). Después de iniciar sesión, puedes acceder a **Mi panel**. Para probar administración, asigna el rol `admin` mediante la consulta SQL anterior.

## Dónde cambiar enlaces y direcciones de imágenes

Hay varios tipos de direcciones en el proyecto. Cambia la que corresponda al resultado que buscas:

| Qué quieres cambiar | Dónde hacerlo | Ejemplo |
| --- | --- | --- |
| URL del repositorio al clonar | Comando `git clone` de este README | Reemplaza `<URL_DEL_REPOSITORIO>` por la URL de tu repositorio. |
| Dirección base del sitio | `.env`, variable `APP_URL` | Para XAMPP con la carpeta `Nebula`: `http://localhost/Nebula/`. Si cambias el nombre de la carpeta o el dominio local, actualiza esta dirección. |
| Imagen de una página del sitio | El atributo `src` de la etiqueta `<img>` en el archivo PHP de esa página | En [`index.php`](./index.php), cambia `src="imagenes/retro.jpg"` por otra ruta, por ejemplo `src="imagenes/mi-imagen.jpg"`. |
| Imagen de un juego del catálogo | Formulario **Agregar/Editar juego** de administración, campo de imagen (`imagen_url`) | Usa una ruta local, como `imagenes/mi-juego.jpg`, o la URL completa de una imagen accesible. |
| Imagen enlazada desde otro sitio | El `src` de `<img>` en el archivo PHP correspondiente | Sustituye la URL completa `https://...` por una dirección válida o guarda la imagen en `imagenes/` y usa su ruta local. |
| Captura mostrada en este README | Ruta dentro del Markdown, entre `![descripción](ruta)` | Las capturas de Clase 5 están en `clase5/capturas/`; al reemplazar una captura, conserva el nombre o cambia también la ruta del enlace. |
| Enlace al prototipo de Figma | Añade o cambia el enlace en esta sección | Pega la URL pública de lectura del prototipo si quieres documentarlo. |

### Imágenes locales y externas

- Las imágenes del sitio se guardan en [`imagenes/`](./imagenes/). Si agregas una imagen, copia el archivo ahí y escribe su ruta en `src`, respetando exactamente el nombre y la extensión. Por ejemplo: `src="imagenes/portada-nueva.jpg"`.
- La ruta local es relativa a la dirección web del proyecto; no uses una ruta de Windows como `C:\xampp\htdocs\Nebula\imagenes\...` en `src`.
- Para reemplazar una imagen solo en una página, busca el texto `src="..."` en el archivo PHP de esa página. Algunas imágenes de secciones están enlazadas externamente, por ejemplo en [`secion_de_quienes_somos.php`](./secion_de_quienes_somos.php), [`la_seccion_para_poder_jugar.php`](./la_seccion_para_poder_jugar.php) y [`seccion_de_blog_.php`](./seccion_de_blog_.php).
- En las fichas del catálogo, el campo `imagen_url` se guarda en la base de datos. Puedes escribir una ruta como `imagenes/sonic.jpg` o una URL pública. Para una ruta local, comprueba que el archivo exista dentro del proyecto.
- Las imágenes remotas dependen de que el otro sitio permita mostrarlas y pueden dejar de funcionar. Para tener control sobre ellas, usa una imagen que puedas guardar en `imagenes/`.
- En el README, las imágenes se insertan con la sintaxis `![Texto alternativo](ruta/de/la/imagen.png)`. Eso es independiente de las etiquetas `<img>` del sitio.

### Enlaces a otras páginas

Los enlaces de navegación se definen en [`includes/nav.php`](./includes/nav.php); los enlaces de cada contenido están en el archivo PHP de su página, en el atributo `href`. Para cambiar un destino, actualiza el valor de `href="..."` correspondiente, no el de una imagen (`src`). Para enlaces entre páginas del proyecto, usa rutas relativas, por ejemplo `href="seccion_de_NES.php"`.

## Estructura del proyecto

```text
Nebula/
├── admin/                 # Administración CRUD del catálogo
├── auth/                  # Registro, login y logout
├── clase5/                # Formularios POST/GET y capturas
├── config/                # Configuración y conexión PDO
├── imagenes/              # Imágenes locales del sitio
├── includes/              # Plantillas, funciones y control de sesión
├── uploads/perfiles/      # Imágenes de perfil subidas
├── index.php              # Inicio y catálogo
├── schema.sql             # Esquema de la base de datos
└── README.md
```

## Solución de problemas

- **No conecta con MySQL:** confirma que MySQL esté iniciado y que host, puerto, base, usuario y contraseña de `.env` sean correctos.
- **No encuentra la base o las tablas:** importa `schema.sql` desde phpMyAdmin. Si usas una base existente, revisa la nota sobre `migrar_usuarios.sql`.
- **No se ve una imagen:** comprueba que la ruta sea relativa a la raíz del sitio, que el archivo exista en esa ubicación y que coincidan mayúsculas, espacios y extensión.
- **No abre la página local:** confirma que Apache esté iniciado y que la carpeta del proyecto esté dentro de `htdocs` (XAMPP) o `www` (Laragon). Si usas otra ruta, abre la URL que corresponda y actualiza `APP_URL` en `.env`.

## Prototipo de Figma

Agrega aquí la URL pública de lectura del prototipo, si corresponde a tu entrega: `<URL_PUBLICA_DE_FIGMA>`.
