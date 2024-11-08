# ArtemiusERP

## Descripcion

Un ERP para empresas que buscan potenciar su marketing. Ofrece herramientas para gestionar recursos, 
analizar consumidores y automatizar campañas, maximizando el retorno de inversión y mejorando la colaboración entre equipos.

## Tecnologías utilizadas
- **HTML**: Para la estructura del contenido, versión HTML5.2.
- **CSS**: Para el diseño y estilo visual, versión CSS3 (incluyendo Flexbox y Grid).
- **JavaScript**: Para interactividad y funcionalidad en el lado del cliente, versión ES6 (ECMAScript 2015).
- **PHP**: Para el procesamiento del lado del servidor y gestión de bases de datos, versión PHP 7.4.
- **MySQL**: Para la base de datos.
- **Servidor**: Xampp.

## Instalación

Sigue estos pasos para instalar y ejecutar el proyecto en tu entorno local:
1. Clonar el repositorio

Abre tu terminal y ejecuta el siguiente comando para clonar el repositorio del proyecto:

git clone https://github.com/usuario/ProcyectoERM.git
cd ProcyectoERM

2. Requerimientos

Asegúrate de tener instalados los siguientes programas:

    XAMPP: Para ejecutar PHP y MySQL. Puedes descargarlo desde https://www.apachefriends.org/index.html.
    Navegador web: Un navegador moderno como Chrome, Firefox, etc.

3. Configurar el servidor local

    Coloca la carpeta del proyecto (ProcyectoERM) dentro de la carpeta htdocs en tu instalación de XAMPP.
        En la instalación predeterminada de XAMPP, la ruta sería algo como C:\xampp\htdocs\ProcyectoERM (en Windows) o /opt/lampp/htdocs/ProcyectoERM (en Linux/macOS).
    Inicia el servidor Apache y MySQL desde el panel de control de XAMPP.

4. Crear la base de datos

    Abre phpMyAdmin desde tu navegador.
    Crea una nueva base de datos llamada artemius_erp (o el nombre que prefieras).
    Importa el archivo database.sql que se encuentra en la carpeta del proyecto (ProcyectoERM/database.sql). Esto creará las tablas necesarias en tu base de datos.

5. Configurar las credenciales de la base de datos

    Abre el archivo de configuración de PHP (config.php) en el proyecto.

    Modifica las credenciales de la base de datos para que coincidan con tu configuración local. Asegúrate de que los valores de DB_HOST, DB_USERNAME, DB_PASSWORD y DB_DATABASE sean correctos. Un ejemplo de configuración podría ser:

    <?php
    define('DB_HOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_DATABASE', 'artemius_erp');
    ?>

6. Acceder al proyecto

Una vez configurado todo, abre tu navegador y ve a:

http://localhost/ProcyectoERM

Ahora deberías poder acceder a la aplicación y comenzar a utilizarla.
