# recordatorio-medicinal

Este es un proyecto personal, pero puede ser utilizado para gestionar recordatorios medicinales para uso personal. El sistema está desarrollado utilizando **PHP**, **HTML**, **CSS**, y usa **PDO (PHP Data Objects)** y **POO (Programación Orientada a Objetos)** con el patrón de arquitectura **MVC (Modelo-Vista-Controlador)**.

## Características

- Gestión de usuarios con roles
- Creación y seguimiento de recordatorios medicinales
- Registro de medicamentos y horarios de toma
- Interfaz amigable y sencilla de usar
- Notificaciones de recordatorio para la toma de medicamentos
- Panel para la gestión de datos

## Requisitos

Para poder ejecutar este proyecto, necesitarás tener instalado lo siguiente:

- **PHP** 7.4 o superior
- **MySQL** 5.7 o superior
- **Apache** o **Nginx** como servidor web
- **Composer** para gestionar las dependencias de PHP
- **XAMPP** para el servidor local y PHPMyAdmin para la base de datos

## Instalación

Sigue estos pasos para instalar y configurar el proyecto:

1. Clona este repositorio:

    ```bash
    git clone https://github.com/Milan3s/recordatorio-medicinal.git
    ```

2. Coloca el proyecto en el directorio de tu servidor local de XAMPP, generalmente en `C:/xampp/htdocs/`.

3. Accede a **PHPMyAdmin** y crea una base de datos llamada `recordatorio_medicinal`.

    ```sql
    CREATE DATABASE recordatorio_medicinal;
    ```

4. Importa las tablas necesarias desde el archivo SQL proporcionado en la carpeta `database/recordatorio_medicinal.sql`.

    ```bash
    mysql -u usuario -p recordatorio_medicinal < database/recordatorio_medicinal.sql
    ```

5. Configura tu archivo de conexión a la base de datos en el proyecto. Si usas variables de entorno, configura el archivo `.env` con los datos correctos:

    ```bash
    DB_HOST=localhost
    DB_DATABASE=recordatorio_medicinal
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```

6. Inicia el servidor con el siguiente comando desde el directorio raíz del proyecto:

    ```bash
    php -S localhost:8000
    ```

---

## Tecnologías utilizadas

- **PHP**: Para la lógica del backend y gestión de operaciones.
- **HTML**: Para la estructura de las páginas web.
- **CSS**: Para el diseño y estilo de las páginas.
- **PDO (PHP Data Objects)**: Para la interacción con la base de datos MySQL de forma segura.
- **POO (Programación Orientada a Objetos)**: Para estructurar el código de manera modular y reutilizable.
- **MVC (Modelo-Vista-Controlador)**: Patrón de arquitectura para separar la lógica de la aplicación en componentes distintos y facilitar el mantenimiento.

---

## Tags

- ![PHP](https://img.shields.io/badge/-PHP-777BB4?style=flat&logo=php&logoColor=fff) **PHP**
- ![HTML](https://img.shields.io/badge/-HTML-E34F26?style=flat&logo=html5&logoColor=fff) **HTML**
- ![CSS](https://img.shields.io/badge/-CSS-1572B6?style=flat&logo=css3&logoColor=fff) **CSS**
- ![PDO](https://img.shields.io/badge/-PDO-003B57?style=flat&logo=php&logoColor=fff) **PDO**
- **POO (Programación Orientada a Objetos)**
- **MVC (Modelo-Vista-Controlador)**
