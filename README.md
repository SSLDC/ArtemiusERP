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

# Guía para Desplegar un Proyecto en XAMPP y Configurar una Base de Datos en MySQL
## → Descargar XAMPP: https://www.apachefriends.org/es/index.html ←
________________________________________

Paso 1: Preparar el Entorno de Trabajo en XAMPP:

  1.1 Localizar la carpeta htdocs
  - Una vez descargado e instalado XAMPP, busca la carpeta de instalación, que normalmente se encuentra en C:\xampp.
  - Dentro de esta carpeta, abre la subcarpeta htdocs.

  1.2 Pegar el proyecto en htdocs
  - Copia la carpeta de tu proyecto descargada de GitHub y pégala en htdocs.
  -	Ejemplo: Si tu proyecto se llama "MiProyecto", la ruta completa será C:\xampp\htdocs\MiProyecto.

________________________________________

Paso 2: Iniciar XAMPP y Acceder al Proyecto:

  2.1 Iniciar los servicios de XAMPP
  -	Abre la aplicación de XAMPP.
  -	Haz clic en Start al lado de Apache para activar el servidor web.
  -	Haz clic en Start al lado de MySQL para activar el servidor de base de datos.

  2.2 Acceder al proyecto en tu navegador
  -	Abre tu navegador y escribe:
      - http://localhost/MiProyecto ( Esto te permitirá ver tu proyecto en funcionamiento )

________________________________________

Paso 3: Configurar la Base de Datos en MySQL:

3.1 Acceder a phpMyAdmin
  -	Con MySQL activo, haz clic en el botón Admin junto a MySQL en XAMPP. Esto abrirá phpMyAdmin en tu navegador.

3.2 Crear la base de datos
  -	En phpMyAdmin, haz clic en Nueva en la barra lateral izquierda.
  -	Introduce el nombre de la base de datos  [ artemus ]  y haz clic en Crear.
  -	Nota: No es necesario modificar el segundo campo.

3.3 Importar el archivo SQL
-	Una vez creada la base de datos, haz clic en la pestaña Importar.
-	Selecciona el archivo .sql de tu base de datos en la opción Archivo a importar.
-	Desplázate hacia abajo y haz clic en Importar para cargar el archivo.

________________________________________
<details>
<summary>EXTRA INFO</summary>

### Done by ＡＶＫ

</details>
