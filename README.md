
# Proyecto Portfolio ReactJS
Este es un proyecto de portafolio desarrollado principalmente en **ReactJS**. Este portafolio tiene soporte para diseño **responsive** y utiliza **FontAwesome** para la integración de íconos. Puedes personalizarlo según tus necesidades.

## Características

- Creado con **ReactJS**, aprovechando componentes reutilizables y funcionales.
- Diseño **responsive** compatible con dispositivos móviles, tabletas y escritorios.
- Uso de **FontAwesome** para íconos estilizados.
- Código limpio y modular para facilitar la personalización.

## Requisitos

Para ejecutar este proyecto, asegúrate de tener instalado lo siguiente:

- **Node.js** (versión recomendada LTS)
- **Git** para clonar el repositorio

## Instalación del Proyecto Portfolio ReactJS

Sigue estos pasos para instalar y configurar el proyecto en tu máquina local:

### 1. Clona este repositorio:

Si tienes **Git** instalado, clona el repositorio en tu máquina local ejecutando:

```bash
git clone https://github.com/Milan3s/portfolio_reactjs.git
```

Luego, accede al directorio del proyecto:

```bash
cd portfolio_reactjs
```

### 2. Instalar dependencias:

Dentro del directorio del proyecto, instala las dependencias ejecutando:

```bash
npm install
```

### 3. Instalar FontAwesome:

Si necesitas usar los íconos de **FontAwesome**, instala el paquete ejecutando:

```bash
npm install --save @fortawesome/fontawesome-svg-core @fortawesome/free-solid-svg-icons @fortawesome/react-fontawesome
```

Asegúrate de importar y usar los íconos en tus componentes React, por ejemplo:

```javascript
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faCoffee } from '@fortawesome/free-solid-svg-icons';

<FontAwesomeIcon icon={faCoffee} />;
```

## Uso

### Iniciar el servidor de desarrollo:

Para ejecutar el proyecto en modo de desarrollo, usa:

```bash
npm start
```

Esto abrirá tu navegador en `http://localhost:3000`. Los cambios que realices en el código se actualizarán automáticamente.

### Crear una versión de producción:

Si deseas generar una versión optimizada para producción, ejecuta:

```bash
npm run build
```

Esto creará una carpeta `build` con los archivos listos para ser desplegados en un servidor web.

## Tecnologías Utilizadas

<p align="left">
  <img src="https://img.shields.io/badge/-ReactJS-61DAFB?style=for-the-badge&logo=react&logoColor=white" alt="ReactJS" height="40">
  <img src="https://img.shields.io/badge/-HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5" height="40">
  <img src="https://img.shields.io/badge/-CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3" height="40">
</p>

## Contribuciones

Si deseas contribuir al proyecto, por favor abre un _pull request_ o contacta con el administrador del repositorio. Agradecemos tus sugerencias para mejorar este portafolio.

## Licencia

Este proyecto está bajo la licencia MIT. Para más información, consulta el archivo `LICENSE`.
