
# Proyecto para tu recordatorio medicinal
Este es un proyecto de recordatorio-medicinal desarrollado principalmente en PHP. El sistema permite gestionar y rastrear los recordatorios de medicamentos utilizando una base de datos MySQL. Para utilizar este sistema, es necesario registrarse primero como usuario.

## Características

- Gestión de usuarios con roles para controlar el acceso y permisos.
- Creación y seguimiento de recordatorios de medicamentos con fechas y horarios de toma.
- Notificación automática para recordar a los usuarios la toma de sus medicamentos.
- Panel administrativo para gestionar usuarios, medicamentos y recordatorios.
- Filtro avanzado para buscar y organizar los recordatorios por fecha, medicamento o usuario.
- Interfaz amigable y sencilla de usar, con soporte para múltiples usuarios.

## Requisitos

Para poder ejecutar este proyecto, necesitarás tener instalado lo siguiente:

- **PHP** 7.4 o superior
- **MySQL** 5.7 o superior
- **Apache** o **Nginx** como servidor web
- **Composer** para gestionar las dependencias de PHP

## Instalación

Sigue estos pasos para instalar y configurar el proyecto:

1. Clona este repositorio:

    ```bash
    git clone https://github.com/Milan3s/recordatorio-medicinal.git
    ```

2. Instala las dependencias de PHP con Composer:

    ```bash
    composer install
    ```

3. Crea una base de datos en MySQL:

    ```sql
    CREATE DATABASE gestion_incidencias;
    ```

4. Importa el archivo SQL que se encuentra en la carpeta `database` para configurar las tablas necesarias:

    ```bash
    mysql -u usuario -p gestion_incidencias < database/gestion_incidencias.sql
    ```

5. Configura tu archivo `.env` para la conexión a la base de datos:

    ```bash
    DB_HOST=localhost
    DB_DATABASE=gestion_incidencias
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```

6. Inicia el servidor:

    ```bash
    php -S localhost:8000
    ```

7. Accede al proyecto en tu navegador en `http://localhost:8000`.

## Uso

1. **Registro de usuario: Para comenzar a utilizar el sistema, debes registrarte como usuario. Puedes hacerlo desde la página de registro disponible en la raíz del proyecto.
2. **Crear recordatorio: Una vez registrado, podrás crear nuevos recordatorios medicinales desde el panel de usuario, incluyendo detalles como el medicamento, la dosis y los horarios.
3. **Panel de administración: Si tienes privilegios administrativos, podrás acceder al panel de administración para gestionar usuarios, medicamentos y editar los recordatorios de otros usuarios.

## Tecnologías Utilizadas

<p align="left">
  <img src="https://img.shields.io/badge/-PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" height="40">
  <img src="https://img.shields.io/badge/-MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" height="40">
  <img src="https://img.shields.io/badge/-HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5" height="40">
  <img src="https://img.shields.io/badge/-CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3" height="40">
</p>

## Contribuciones

Si deseas contribuir al proyecto, por favor abre un _pull request_ o contacta con el administrador del repositorio. Agradecemos tus sugerencias para mejorar el sistema.

## Licencia

Este proyecto está bajo la licencia MIT. Para más información, consulta el archivo `LICENSE`.
