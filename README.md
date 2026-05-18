# CodeAcademyPro - Plataforma Web de Recursos Académicos y Gestión de Cursos.

Aplicación web desarrollada para la gestión y distribución de recursos académicos, permitiendo a los usuarios registrarse, visualizar cursos, avanzar por temas y subtemas, así como generar certificados de progreso.

El sistema fue desarrollado utilizando Laravel bajo arquitectura MVC, integrando autenticación, control de progreso académico y persistencia de datos en MySQL mediante procedimientos almacenados y consultas estructuradas.

---

## Objetivo

Desarrollar una plataforma web que permita centralizar contenido académico estructurado por cursos, temas y subtemas, proporcionando herramientas para el seguimiento del progreso del usuario y generación de certificados.

---

## Tecnologías utilizadas

### Backend

* PHP
* Laravel
* Programación Orientada a Objetos (POO)
* Eloquent ORM
* Middlewares
* Form Request
* Stored Procedures

### Frontend

* HTML5
* CSS3
* JavaScript
* Blade
* Bootstrap
* Vite

### Base de datos

* MySQL 
* Migraciones
* Seeders
* Model - Factorys
* Scripts SQL
* Stored Procedures

### Herramientas y entorno

* Composer
* Visual Studio Code
* PHPUnit
* JSON
* HTTP
* Git y Github
* MySQL Workbench

---

## Características técnicas destacadas

* Arquitectura MVC implementada con Laravel
* Gestión relacional de cursos, temas y subtemas
* Sistema de autenticación basado en roles
* Sistema de autenticación con proveedor de OAuth 2.0 de Google
* Control de progreso académico por usuario
* Persistencia de avance mediante tablas de progreso
* Generación de certificados académicos
* Uso de procedimientos almacenados para operaciones específicas
* Aplicación de validaciones backend mediante Form Request
* Protección contra ataques CSRF, XSS e inyecciones SQL
* Creación de usuarios mediante Google o formulario nativo con verificación de email obligatoria

---

## Funcionalidades principales

### Gestión de usuarios

* Registro e inicio de sesión
* Sistema de roles y permisos
* Gestión de perfiles de usuario
* Actualización de perfil
* Verificación de email obligatoria
* Recuperación de password mediante token de un solo uso

### Gestión académica

* Visualización de cursos disponibles
* Organización por temas y subtemas
* Registro de progreso por usuario
* Seguimiento de avance académico

### Progreso y aprendizaje

* Persistencia del progreso por tema y subtema
* Registro de avance individual
* Visualización de contenido estructurado

### Certificaciones

* Generación de certificados académicos
* Validación del progreso e inscripción antes de emisión

### Administración

* Gestión de cursos y contenido académico
* Consulta de registros académicos
* Administración de usuarios y roles

---

## Arquitectura

El sistema está desarrollado bajo el patrón MVC (Modelo - Vista - Controlador), utilizando Laravel como framework principal.

La arquitectura permite una separación clara entre:

* Lógica de negocio
* Acceso a datos
* Interfaz de usuario

Esto facilita la mantenibilidad, escalabilidad y organización general del proyecto.

---

## Base de datos

### Motor utilizado

* MySQL (InnoDB)

### Entidades principales

* Users
* Roles
* Courses
* Topics
* Subtopics
* Registrations
* UserTopicProgresses
* UserSubtopicProgresses

### Características implementadas

* Relaciones entre cursos, temas y subtemas
* Persistencia de progreso académico
* Scripts SQL para inicialización de base de datos
* Uso de procedimientos almacenados

---

## Seguridad

El sistema implementa medidas de seguridad utilizando herramientas integradas de Laravel:

* Protección CSRF mediante tokens
* Prevención de inyecciones SQL usando Eloquent ORM
* Prevención de XSS mediante escape automático de Blade
* Validaciones backend mediante Form Request
* Autenticación basada en sesiones

---

## Instalación

1. Clonar el repositorio

```bash
git clone https://github.com/HarritoT1/CodeAcademyPro_V_1_0_2026.git
```

2. Instalar dependencias

```bash
composer install
npm install
```

3. Configurar variables de entorno

```bash
cp .env.example .env
```

4. Configurar conexión a base de datos en `.env`

5. Generar clave de aplicación

```bash
php artisan key:generate
```

6. Importar scripts SQL incluidos en el proyecto

* `CodeAcademyPro.sql`
* `CodeAcademyPro_DML.sql`

7. Ejecutar servidor de desarrollo

```bash
php artisan serve
```

---

## Uso del sistema

### Flujo general

1. Registro (verificando email) o inicio de sesión  
2. Visualización de cursos disponibles
3. Inscripción a curso de interés
4. Navegación por temas y subtemas
5. Registro manual del progreso
6. Consulta del avance académico
7. Generación de certificados
8. Consulta de tu perfil y edición
9. Consulta de otros perfiles (sin edición)
10. Consulta de información de contacto
11. Recuperación o cambio de contraseña

---

## Estado del proyecto

Proyecto funcional y completo desarrollado para cliente, enfocado en la construcción de una plataforma web educativa con persistencia de progreso y gestión de contenido académico.

---

## Capturas del sistema

### Autenticación

<p align="center">
  <img src="public\img\screenshots\autenticacion\a1.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\autenticacion\a2.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\autenticacion\a3.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\autenticacion\a4.png" width="70%">
</p>

### Creación de usuarios

<p align="center">
  <img src="public\img\screenshots\user_create\u1.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\user_create\u2.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\user_create\u3.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\user_create\u4.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\user_create\u5.png" width="70%">
</p>

### Dashboard

<p align="center">
  <img src="public\img\screenshots\dashboard\d1.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\dashboard\d2.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\dashboard\d3.png" width="70%">
</p>

### Inscripción a cursos

<p align="center">
  <img src="public\img\screenshots\course_inscription\c1.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\course_inscription\c2.png" width="50%">
  &nbsp;
  <img src="public\img\screenshots\course_inscription\c3.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\course_inscription\c4.png" width="70%">
</p>

### Navegación dentro del curso

<p align="center">
  <img src="public\img\screenshots\course_navigation\c1.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\course_navigation\c2.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\course_navigation\c3.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\course_navigation\c4.png" width="50%">
</p>

### Perfil del usuario y otros usuarios

<p align="center">
  <img src="public\img\screenshots\user_profile\u1.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\user_profile\u2.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\user_profile\u3.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\user_profile\u4.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\user_profile\u5.png" width="50%">
  &nbsp;
  <img src="public\img\screenshots\user_profile\u6.png" width="50%">
  &nbsp;
  <img src="public\img\screenshots\user_profile\u7.png" width="50%">
</p>

### Contacto

<p align="center">
  <img src="public\img\screenshots\Contacto\c1.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\Contacto\c2.png" width="50%">
  &nbsp;
  <img src="public\img\screenshots\Contacto\c3.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\Contacto\c4.png" width="50%">
</p>

### Recuperación/Actualización de contraseña

<p align="center">
  <img src="public\img\screenshots\password_reset\p1.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\password_reset\p2.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\password_reset\p3.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\password_reset\p4.png" width="70%">
  &nbsp;
  <img src="public\img\screenshots\password_reset\p5.png" width="70%">
</p>

### Certificados generados

<p align="center">
  <img src="public\img\screenshots\certificado.png" width="70%">
</p>

### Manejo errores 404

<p align="center">
  <img src="public\img\screenshots\404.png" width="70%">
</p>

---

## Autor

Harol Gael Cardenas Trejo
Ingeniería en Sistemas Computacionales
