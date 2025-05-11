# Phonography Studio

Phonography Studio es un proyecto de desarrollo web para un estudio de grabación vintage que ofrece servicios de grabación, mezcla, mastering y producción. El sitio web está diseñado con un estilo estético retro y utiliza HTML, CSS, JavaScript, PHP y MySQL. La plataforma permite a los usuarios registrarse, iniciar sesión, realizar reservas de servicios y contactar con el estudio.

## Funcionalidades

- Página de inicio con vídeo de bienvenida y presentación del estudio.
- Sección 'Estudio' con un carrusel de imágenes del espacio de grabación.
- Sección 'Equipo' con un carrusel de fotos del equipamiento y listado del material disponible.
- Sección 'Servicios' con mockups visuales y descripciones detalladas de cada servicio ofrecido.
- Sección 'Tarifas' con tarjetas informativas sobre precios de servicios y condiciones.
- Sección 'Contacto' con formulario para enviar mensajes directamente al correo del estudio.
- Página de login que permite a los usuarios registrados acceder a su perfil.
- En el perfil del usuario, se puede ver el historial de reservas, crear nuevas reservas y eliminar las existentes.

## Estructura del Proyecto

```
phonographystudio/
   ├── frontend/
   │   ├── index.html
   │   ├── login.html
   │   ├── perfil.php
   │   ├── aviso-legal.html
   │   ├── política-privacidad.html
   │   ├── cookies.html
   │   ├── assets/
   │   │   ├── logo_typ.png
   │   │   ├── logo.png
   │   │   ├── fotos-carrusel/
   │   │   ├── mockups/
   │   │   └── videos/
   │   ├── css/
   │   │   └── estilos.css
   │   └── js/
   │       ├── app.js
   │       ├── perfil.js
   │       └── script.js
   ├── db/
   │   └── init.sql
   └── backend/
       ├── config.php
       ├── crear-reserva.php
       ├── eliminar-reserva.php
       ├── enviar-contacto.php
       ├── generar_hash.php
       ├── login.php
       ├── logout.php
       └── reservas.php
```

## Tecnologías Utilizadas

- HTML5 y CSS3
- Bootstrap 5
- JavaScript
- PHP 8
- MySQL

## Instalación y Ejecución

1. Clonar el repositorio:

```
git clone https://github.com/psauraf/phonography_studio
```

2. Importar la base de datos desde el archivo `init.sql` en phpMyAdmin.

3. Configurar la conexión a la base de datos en `backend/config.php`.

4. Ejecutar el proyecto a través de un servidor local como XAMPP.

5. Acceder al sitio mediante la URL: `https://localhost/phonographystudio/frontend/index.html`

## Información Adicional

- **Login demo:**
  - Email: demo@phonographystudio.com
  - Contraseña: demo1234

- **Repositorio GitHub:** [Enlace al repositorio](https://github.com/psauraf/phonography_studio)
- **Sitio web oficial:** [Phonography Studio](https://www.phonographystudio.com)

## Créditos
Proyecto desarrollado por Pedro Saura como parte del módulo de Proyecto del ciclo formativo de Desarrollo de Aplicaciones Web (DAW).
