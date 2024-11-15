qCXJKEDN# ArtemiusERP
qCXJKEDN# ArtemiusERP

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

    Guía para Desplegar un Proyecto en XAMPP y Configurar una Base de Datos en MySQL
Paso 1: Preparar el Entorno de Trabajo en XAMPP

    Buscar la carpeta htdocs:
        Una vez descargado e instalado XAMPP, localiza la carpeta de instalación. Generalmente, la ruta es C:\xampp.
        Dentro de esta carpeta, encontrarás otra llamada htdocs.

    Pegar el proyecto en htdocs:
        Copia el proyecto descargado de GitHub y pégalo en la carpeta htdocs. Por ejemplo, si tu proyecto se llama "MiProyecto", debería estar en C:\xampp\htdocs\MiProyecto.

Paso 2: Configurar la Base de Datos en MySQL

    Ejecutar XAMPP y activar Apache y MySQL:
        Abre la aplicación de XAMPP y haz clic en Start para iniciar el módulo MySQL y Apache.

    Acceder a phpMyAdmin:
        Una vez que MySQL esté en funcionamiento, haz clic en el botón Admin al lado del módulo MySQL en XAMPP. Esto abrirá una pestaña de phpMyAdmin en tu navegador.

    Crear la base de datos:
        En la barra lateral izquierda de phpMyAdmin, haz clic en Nueva.
        Se abrirá un panel en la pestaña Base de datos, donde verás dos campos. Introduce el nombre de la base de datos, por ejemplo, artemus, en el primer campo.
        No es necesario modificar el segundo campo (cotejamiento). Simplemente haz clic en el botón Crear.

    Esto te llevará a la nueva base de datos llamada artemus.

    Importar el archivo SQL:
        Haz clic en la pestaña Importar en la parte superior de la página.
        Busca la opción Archivo a importar y selecciona el archivo .sql de tu base de datos desde el explorador de archivos.
        Una vez seleccionado, desplázate hacia abajo y haz clic en Importar para cargar la base de datos.
