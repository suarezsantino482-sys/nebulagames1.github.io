# ★ NEBULA GAMES ★ - Plataforma de Videojuegos Retro

## Descripción del Proyecto
Nebula Games es una aplicación web interactiva dedicada a la comunidad de videojuegos retro. El proyecto evolucionó desde una maqueta estática (HTML/CSS) a una arquitectura dinámica basada en **PHP 8.x** con renderizado desde el servidor (**SSR - Server-Side Rendering**).

### Refactorización a PHP (Unidad 4):
* **Modularización por Plantillas (SSI):** Se eliminó el código duplicado dividiendo el sitio en componentes reutilizables (`header.php`, `nav.php` y `footer.php`) guardados en la carpeta `/includes/`.
* **Títulos Dinámicos:** Implementación de variables PHP (`$titulo_pagina`) para renderizar el encabezado y activar la clase activa en el menú de navegación según la sección abierta.
* **Variables de Entorno:** Configuración del archivo `config/env.php` para centralizar constantes globales como el nombre de la app y el correo de soporte, excluido del repositorio mediante `.gitignore` y respaldado por la plantilla `env.example.php`.

---

## Enlace al Prototipo de Figma
Puedes consultar el diseño original del proyecto en el siguiente enlace:
👉 [Ver Prototipo en Figma](https://www.figma.com/site/PVYqEAdTReC8EBLuKWpkEP/paguina-de-juegos?node-id=0-1&t=883P3YFZLWIHZ7uq-1)

---

## Tecnologías Utilizadas
* **HTML5 & CSS3:** Estructuración y maquetación visual retro/arcade.
* **JavaScript (ES6):** Interacciones del cliente (reloj en tiempo real, cambio de tema claro/oscuro, acordeón interactivo y validaciones).
* **PHP 8.x:** Renderizado server-side (SSR), manejo de Includes (SSI) y lógica de configuración.
* **XAMPP / Laragon:** Entorno de servidor web local y procesamiento de scripts PHP.
* **Git & GitHub:** Control de versiones y flujo de trabajo por ramas (`feature/migracion-php-ssi`).

---

## Instrucciones de Instalación y Ejecución Local

Sigue estos pasos para ejecutar el proyecto en tu máquina local:

### 1. Requisitos Previos
Tener instalado un servidor local como **XAMPP** o **Laragon**.

### 2. Clonar el Repositorio
Abre la terminal y clona el proyecto dentro de la carpeta del servidor local (`htdocs` en XAMPP o `www` en Laragon):

```bash
cd C:/xampp/htdocs/  # O la ruta de tu servidor local
git clone [https://github.com/TU_USUARIO/NebulaGames.git](https://github.com/TU_USUARIO/NebulaGames.git)
