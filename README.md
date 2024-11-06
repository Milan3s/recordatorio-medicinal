
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
- **Apache** o **Nginx** o **XAMPP** como servidor web

## Instalación del proyecto "recordatorio-medicinal"

Sigue estos pasos para instalar y configurar el proyecto en XAMPP:

1. **Clona este repositorio:**

    Si tienes **Git** instalado, clona el repositorio en tu máquina local con el siguiente comando:

    ```bash
    git clone https://github.com/Milan3s/recordatorio-medicinal.git
    ```

    Si no tienes **Git** instalado, puedes descargar el proyecto como un archivo ZIP desde GitHub, descomprimirlo y mover la carpeta a `htdocs` en el directorio de instalación de XAMPP.

2. **Mover el proyecto a la carpeta `htdocs`:**

    Copia la carpeta `recordatorio-medicinal` en el directorio `htdocs` de XAMPP, que generalmente se encuentra en:

    - **Windows:** `C:/xampp/htdocs/`
    - **Mac:** `/Applications/XAMPP/htdocs/`

3. **Acceder a PHPMyAdmin y crear la base de datos:**

    Abre **PHPMyAdmin** en tu navegador (`http://localhost/phpmyadmin/`) y crea una base de datos llamada `recordatorio_medicinal`.

    ```sql
    CREATE DATABASE recordatorio_medicinal;
    ```

4. **Importar las tablas necesarias:**

    Desde **PHPMyAdmin**, selecciona la base de datos `recordatorio_medicinal` y luego importa el archivo `.sql` que se encuentra en la carpeta `database` del proyecto. Si no encuentras esta carpeta, es posible que necesites crear las tablas manualmente o obtener el archivo SQL del repositorio.

5. **Configurar la conexión a la base de datos:**

    Edita el archivo de configuración para la conexión a la base de datos. Este archivo puede estar ubicado en `config/config.php` o similar. Asegúrate de configurar los valores correctos de conexión a la base de datos, por ejemplo:

    ```php
    define('DB_HOST', 'localhost');
    define('DB_DATABASE', 'recordatorio_medicinal');
    define('DB_USERNAME', 'tu_usuario');
    define('DB_PASSWORD', 'tu_contraseña');
    ```

6. **Iniciar el servidor:**

    Inicia el servidor de XAMPP y abre el navegador en `http://localhost/recordatorio-medicinal/` para acceder al proyecto.

¡Listo! Ya puedes comenzar a utilizar el sistema de recordatorios medicinales.

¡Listo! Ya puedes comenzar a utilizar el sistema de recordatorios medicinales.

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
