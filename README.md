# recordatorio-medicinal

**Descripción:**

Este es un proyecto personal, pero puede ser utilizado para gestionar recordatorios medicinales para uso personal. El sistema está desarrollado utilizando tecnologías como PHP, HTML, CSS, y usa PDO (PHP Data Objects) y POO (Programación Orientada a Objetos) con el patrón de arquitectura MVC (Modelo-Vista-Controlador).

**Tecnologías utilizadas:**

- **PHP**: Para la lógica del backend y gestión de operaciones.
- **HTML**: Para la estructura de las páginas web.
- **CSS**: Para el diseño y estilo de las páginas.
- **PDO (PHP Data Objects)**: Para la interacción con la base de datos MySQL de forma segura.
- **POO (Programación Orientada a Objetos)**: Para estructurar el código de manera modular y reutilizable.
- **MVC**: El proyecto sigue el patrón Modelo-Vista-Controlador para separar la lógica de la aplicación en componentes distintos y facilitar el mantenimiento.

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

### Paso 2: Subir los archivos del proyecto

1. Copia todos los archivos del proyecto a la carpeta `htdocs` de XAMPP. Generalmente, la ruta es: `C:\xampp\htdocs\`.
2. Dentro de `htdocs`, puedes crear una carpeta para tu proyecto, por ejemplo: `C:\xampp\htdocs\recordatorio-medicinal\`.

### Paso 3: Crear la base de datos

1. Abre **PHPMyAdmin** accediendo a `http://localhost/phpmyadmin/`.
2. Crea una nueva base de datos con el nombre `recordatorio_medicinal`.
3. Importa la estructura de la base de datos (si tienes un archivo `.sql` que defina las tablas) o crea las tablas manualmente.

### Paso 4: Configuración del proyecto

1. Asegúrate de que el archivo de configuración de la base de datos en tu proyecto (normalmente llamado `config.php` o similar) esté configurado correctamente con las credenciales de tu base de datos.

### Paso 5: Acceder al proyecto

1. Abre tu navegador y accede al proyecto mediante la URL: `http://localhost/recordatorio-medicinal/`.

---

## Vista previa

Aquí tienes una captura de pantalla del proyecto:

![Vista previa del proyecto](proyecto.jpg)

---

¡Eso es todo! Ahora puedes empezar a usar el proyecto de recordatorio medicinal en tu entorno local. Si tienes alguna pregunta o encuentras algún error, no dudes en ponerte en contacto conmigo.

