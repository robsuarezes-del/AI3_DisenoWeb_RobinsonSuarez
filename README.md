
# Actividad Integradora 3 - Diseño Web

## Sistema Web de Gestión de Usuarios

**Universidad:** ECOTEC  
**Carrera:** Ingeniería en Sistemas Inteligentes  
**Asignatura:** Diseño Web  
**Estudiante:** Robinson Eduardo Suárez Luna  
**Periodo académico:** 2026

## 1. Descripción del proyecto

El proyecto consiste en desarrollar un sistema web dinámico para registrar usuarios y consultar la información almacenada en una base de datos relacional MySQL.

La aplicación utiliza PHP para procesar la información, PDO para la conexión con la base de datos y HTML5/CSS3 para la interfaz de usuario.

## 2. Tecnologías utilizadas

- PHP
- MySQL
- PDO (PHP Data Objects)
- HTML5
- CSS3
- XAMPP
- phpMyAdmin
- Git y GitHub

## 3. Funcionalidades

- Registro de usuarios mediante un formulario web.
- Almacenamiento de datos en MySQL.
- Consulta de usuarios registrados.
- Visualización de los registros en una tabla HTML.
- Uso de sentencias preparadas para las operaciones de inserción.
- Saneamiento de datos de salida mediante `htmlspecialchars()` para reducir riesgos de XSS.

## 4. Estructura del proyecto

```text
ai3_sistema_web/
├── index.php
├── registrar.php
├── conexion.php
├── diagnostico.php
├── prueba.php
└── README.md
```

Los archivos de diagnóstico y prueba son auxiliares y no son necesarios para el funcionamiento normal del sistema.

## 5. Requisitos previos

- Tener instalado XAMPP.
- Tener Apache y MySQL en ejecución.
- Disponer de PHP con soporte para PDO MySQL.
- Crear la base de datos `db_sistema_web`.

## 6. Instalación y ejecución

1. Iniciar Apache y MySQL desde el panel de control de XAMPP.
2. Copiar la carpeta del proyecto dentro de `htdocs`.
3. Crear la base de datos `db_sistema_web` en phpMyAdmin.
4. Importar el archivo SQL de creación de la tabla `usuarios`.
5. Configurar los parámetros de conexión en `conexion.php`.
6. Abrir el sistema desde el navegador:

   `http://localhost/ai3_sistema_web/index.php`

7. Para registrar un usuario, acceder a:

   `http://localhost/ai3_sistema_web/registrar.php`

## 7. Seguridad

El proyecto contempla las siguientes medidas de seguridad:

- Uso de sentencias preparadas para insertar registros.
- Validación de los datos recibidos en el servidor.
- Uso de `htmlspecialchars()` al mostrar información en HTML.
- Separación de la conexión a la base de datos en `conexion.php`.
- Manejo controlado de errores para evitar exponer información técnica sensible.

## 8. Base de datos

La base de datos utilizada es `db_sistema_web` y contiene la tabla principal `usuarios`.

Los campos implementados son:

- `id`: clave primaria autoincremental.
- `nombres`: nombres del usuario.
- `apellidos`: apellidos del usuario.
- `correo`: correo electrónico.
- `telefono`: número de teléfono.
- `estado`: estado del registro.
- `fecha_creacion`: fecha y hora de creación.

## 9. Repositorio

Repositorio público de GitHub:

https://github.com/robsuarezes-del/AI3_DisenoWeb_RobinsonSuarez

## 10. Autor

Robinson Eduardo Suárez Luna  
Actividad Integradora 3 - Diseño Web  
Universidad ECOTEC - 2026
