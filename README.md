# recordatorio-medicinal

**Descripción:**

Este es un proyecto personal, pero puede ser utilizado para gestionar recordatorios medicinales para uso personal. El sistema está desarrollado utilizando tecnologías como PHP, HTML, CSS, y usa PDO (PHP Data Objects) y POO (Programación Orientada a Objetos) con el patrón de arquitectura **MVC** (Modelo-Vista-Controlador).

**Tecnologías utilizadas:**

- ![PHP](https://img.shields.io/badge/-PHP-777BB4?style=flat&logo=php&logoColor=fff) **PHP**: Para la lógica del backend y gestión de operaciones.
- ![HTML](https://img.shields.io/badge/-HTML-E34F26?style=flat&logo=html5&logoColor=fff) **HTML**: Para la estructura de las páginas web.
- ![CSS](https://img.shields.io/badge/-CSS-1572B6?style=flat&logo=css3&logoColor=fff) **CSS**: Para el diseño y estilo de las páginas.
- ![PDO](https://img.shields.io/badge/-PDO-003B57?style=flat&logo=php&logoColor=fff) **PDO (PHP Data Objects)**: Para la interacción con la base de datos MySQL de forma segura.
- **POO (Programación Orientada a Objetos)**: Para estructurar el código de manera modular y reutilizable.
- **MVC (Modelo-Vista-Controlador)**: Patrón de arquitectura para separar la lógica de la aplicación en componentes distintos y facilitar el mantenimiento.

---

## Requisitos previos

Para poder ejecutar este proyecto en tu máquina local, necesitas tener instalado:

1. **XAMPP** (para servir archivos PHP y gestionar bases de datos con MySQL).
2. **PHPMyAdmin** (para gestionar la base de datos MySQL).
3. Un navegador web para acceder a la interfaz de usuario.

---

## Instrucciones de instalación

### Paso 1: Descargar y configurar XAMPP

1. Descarga [XAMPP](https://www.apachefriends.org/es/index.html) e instálalo en tu computadora.
2. Abre XAMPP y arranca los servicios de **Apache** (para servir PHP) y **MySQL** (para la base de datos).

### Paso 2: Importar la base de datos

1. Accede a **PHPMyAdmin** a través de tu navegador en [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
2. Crea una nueva base de datos, por ejemplo, `recordatorio_medicinal`.
3. Importa el archivo SQL de la base de datos que encontrarás en el proyecto en la carpeta `db`.

### Paso 3: Configurar el proyecto

1. Coloca el proyecto en la carpeta `htdocs` de tu instalación de XAMPP (por ejemplo, `C:/xampp/htdocs/recordatorio-medicinal`).
2. Asegúrate de que el archivo `config.php` en el proyecto tenga la configuración correcta para conectar con la base de datos.

### Paso 4: Ejecutar el proyecto

1. Abre tu navegador y navega a [http://localhost/recordatorio-medicinal](http://localhost/recordatorio-medicinal) para acceder a la interfaz de usuario del proyecto.

---

## Estructura del proyecto

