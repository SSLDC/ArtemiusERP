# Proyecto ERP con Interfaz Mejorada y Gráficos Dinámicos

## Descripción

Este proyecto es una mejora a un ERP tradicional, con el objetivo de proporcionar una interfaz de usuario más amigable, sencilla y minimalista. La interfaz fue rediseñada para mejorar la experiencia del usuario y facilitar el acceso a las funcionalidades principales del sistema. Además, se integraron gráficos interactivos utilizando **Google Charts**, los cuales están conectados directamente con la base de datos, permitiendo visualizar datos en tiempo real de manera dinámica.

### Características principales

- **Interfaz de usuario mejorada**: Diseño sencillo, minimalista y funcional.
- **Gráficos dinámicos**: Visualización de datos con **Google Charts**, conectados a la base de datos.
- **Inicio de sesión personalizado**: El acceso cambia dependiendo del ID de usuario. Por ejemplo, si el ID es 3, el sistema mostrará una página personalizada para ese usuario. Lo mismo ocurre si el ID es 4, y así sucesivamente.
- **Operaciones CRUD**: El sistema permite realizar operaciones de inserción, eliminación y actualización de datos a través de la base de datos de forma sencilla.

## Requisitos previos

Antes de comenzar con la instalación y ejecución del proyecto, asegúrate de tener los siguientes requisitos:

1. **XAMPP**: Necesitarás un servidor local para ejecutar el proyecto.
2. **PHP** y **MySQL**: Están incluidos en XAMPP para manejar la base de datos y la lógica del backend.

## Instrucciones de instalación

### 1. Instalación de XAMPP

Para instalar el servidor local, sigue estos pasos:

1. Dirígete a [la página oficial de XAMPP](https://www.apachefriends.org/es/index.html) y descarga la versión correspondiente para tu sistema operativo.
2. Ejecuta el instalador y sigue los pasos del asistente para instalar XAMPP en tu máquina.

### 2. Preparar el proyecto

Una vez XAMPP esté instalado, sigue estos pasos para poner en marcha el proyecto:

1. Dirígete al disco principal (C:).
2. Dentro de la carpeta principal de XAMPP, localiza y entra en la carpeta `xampp`.
3. Accede a la carpeta `htdocs`.
4. Coloca los archivos del proyecto en la carpeta `htdocs`.
5. Cambia el nombre del archivo `index.php` a `index1.php`. Esto te permitirá acceder al servidor web local correctamente.

### 3. Configuración de la base de datos

Para configurar la base de datos y conectar el proyecto a ella, sigue estos pasos:

1. Abre XAMPP y ejecuta el **Panel de Control**.
2. Inicia el servicio de **Apache** y **MySQL**.
3. Accede a **phpMyAdmin** en tu navegador mediante la siguiente URL: [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
4. En phpMyAdmin, crea una nueva base de datos llamada **artemus**.
5. Una vez creada la base de datos, selecciona la opción **Importar**.
6. En la sección de importación, selecciona el archivo SQL proporcionado con el proyecto y haz clic en **Ejecutar**. Esto creará las tablas necesarias en la base de datos.

### 4. Iniciar el proyecto

1. Una vez configurada la base de datos, abre tu navegador y visita la siguiente URL: [http://localhost/
2. Para el inicio de sesion, debera poner los datos nevcesarios que estan en la base de datos, tabla usuarios sera el gamil y contraseña.

## Funcionalidades

### 1. **Inicio de sesión personalizado**
El sistema realiza una validación del ID de usuario. Si el ID es, por ejemplo, `3`, la interfaz mostrará información específica para ese usuario. El sistema se adapta a diferentes IDs para ofrecer una experiencia personalizada.

### 2. **Operaciones en la base de datos**
El proyecto permite realizar las siguientes operaciones en la base de datos:

- **Insertar** nuevos datos, y por defecto pondra el id al que pernece
- **Eliminar** registros, por medio de su respectivo campo
- **Actualizar** información existente.

### 3. **Gráficos interactivos**
La interfaz utiliza **Google Charts** para mostrar gráficos dinámicos con datos extraídos directamente de la base de datos. Estos gráficos permiten una visualización clara y precisa de las métricas más relevantes.

