# ★ NEBULA GAMES ★ - Plataforma de Videojuegos Retro

## 📖 Descripción del Proyecto
Nebula Games es una aplicación web interactiva desarrollada para la comunidad de videojuegos retro y cultura arcade. El proyecto surgió como una maqueta estática (HTML/CSS/JS) y evolucionó hacia una arquitectura web basada en **PHP 8.x** aplicando renderizado en el servidor (**SSR - Server-Side Rendering**).

### 🚀 Refactorización y Arquitectura Backend (Unidad 4):
* **Modularización por Plantillas (SSI - Server Side Includes):** Se eliminó la duplicación de código dividiendo las vistas en componentes reutilizables (`header.php`, `nav.php` y `footer.php`) almacenados en la carpeta `/includes/`.
* **Renderizado Server-Side (SSR):** El servidor procesa dinámicamente las variables de estado (como `$titulo_pagina`) para personalizar la pestaña del navegador y resaltar automáticamente el enlace activo en el menú de navegación según la sección visitada.
* **Manejo de Variables de Entorno (`.env`):** Centralización de constantes globales (nombre de la app, entorno de ejecución, correos de soporte) mediante un archivo `config/env.php`. Se garantizó la seguridad del proyecto excluyendo este archivo sensible del control de versiones mediante `.gitignore` y adjuntando la plantilla `env.example.php`.
* **Interacción Cliente-Servidor:** Mantenimiento de funcionalidades JavaScript puras (reloj en tiempo real, cambio de tema claro/oscuro, acordeón desplegable, galería modal y validación de formularios).

---

## 🎨 Enlace al Prototipo de Figma
Puedes consultar el diseño web original y la maqueta de UI/UX en el siguiente enlace:
👉 [Ver Prototipo de Nebula Games en Figma](https://www.figma.com/site/PVYqEAdTReC8EBLuKWpkEP/paguina-de-juegos?node-id=0-1&t=883P3YFZLWIHZ7uq-1)

---

## 🛠️ Tecnologías Utilizadas
* **HTML5 & CSS3:** Maquetación semántica y hojas de estilo personalizadas con estética Arcade/Retro.
* **JavaScript (ES6+):** Funcionalidades dinámicas del lado del cliente sin librerías externas.
* **PHP 8.x:** Procesamiento en el servidor, gestión de plantillas SSI y variables dinámicas.
* **XAMPP / Laragon:** Entorno de servidor local (Apache/PHP).
* **Git & GitHub:** Control de versiones con flujo de trabajo basado en ramas (`feature/migracion-php-ssi`).

---

## 📥 Instrucciones de Instalación y Ejecución Local

### 1. Requisitos Previos
Asegúrate de contar con un servidor web local como **XAMPP** o **Laragon** en funcionamiento.

### 2. Clonar el Repositorio
Abre tu terminal y clona el proyecto dentro del directorio raíz de tu servidor local (`htdocs` para XAMPP o `www` para Laragon):

```bash
cd C:/xampp/htdocs/  # O la ruta correspondiente en tu sistema
git clone [https://github.com/TU_USUARIO/NebulaGames.git](https://github.com/TU_USUARIO/NebulaGames.git)
## Clase 5: Formularios y seguridad

La carpeta `clase5/` contiene una demostración autocontenida del procesamiento de formularios del lado del servidor:

- **POST, contacto:** recibe nombre, correo y mensaje; comprueba campos obligatorios, longitudes y formato de correo. Ante errores mantiene los valores ingresados y muestra mensajes de validación. Al completar el envío muestra una confirmación.
- **GET, búsqueda:** recibe texto y consola desde la URL, limita la consola a una lista permitida y filtra un catálogo de ejemplo.
- **Protección XSS:** normaliza entradas con `trim()` y `filter_var()` y escapa cada dato dinámico al insertarlo en HTML con `htmlspecialchars()` (`ENT_QUOTES`, UTF-8). La validación se realiza en el servidor; los atributos HTML son una ayuda adicional.

### Ejecutar localmente

Se necesita PHP 8 o superior. Desde la carpeta raíz del proyecto, ejecutá:

```sh
php -S localhost:8000
```

Luego abrí <http://localhost:8000/clase5/>. También se puede colocar el proyecto dentro de `htdocs` de XAMPP y entrar a `http://localhost/nebulagames1.github.io-main/clase5/`.

GitHub Pages solo publica archivos estáticos y no ejecuta PHP. Para mostrar esta versión PHP públicamente, hace falta un hosting con PHP; de lo contrario, la demo local sirve para la presentación técnica.

### Capturas para la entrega

Todavía faltan agregar capturas reales, porque deben tomarse después de ejecutar la página con PHP. Guardalas dentro de `clase5/capturas/` y agregalas aquí:

1. Formulario y confirmación luego de enviar datos válidos.
2. Errores de validación y campos conservados después de enviar datos inválidos.
3. Búsqueda GET con resultados y la consulta visible en la URL.

Para probar XSS, ingresá texto como `<script>alert('xss')</script>` en el nombre o la búsqueda y verificá que se muestre como texto, sin ejecutarse.
