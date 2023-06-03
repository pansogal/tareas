# Tareas

Tareas es una aplicación web de tipo LAMP/CRUD con JS y Milligram CSS

LAMP = Linux, Apache, MariaDB, PHP8

Como framework usa CakePHP 4 https://github.com/cakephp/cakephp

El objeto de esta aplicación es organizar el trabajo de unos técnicos de diferentes delegaciones de una empresa de manera que las tareas que realicen relacionadas con diferentes proyectos estén coordinadas. 

La aplicación requiere la autentificación de cada usuario y, dependiendo de qué usuario sea, tiene autorización para ver o actualizar los datos que se le permitan en base a un control de autorizaciones.

La aplicación guarda notas de cada tarea realizada y guarda también archivos que se requieran para considerar la tarea completada. 
Para más detalle, me remito a la documentación. 

# Instalación

## PASO 1 : Descarga

OPCION 1: Descarga el ZIP de esta web, descomprime el archivo en un directorio

OPCION 2: (recomendada): Ejecutar "git clone https://github.com/pansogal/tareas.git" (sin las comillas) en un terminal.


## PASO 2 : Generación de images/containers Docker 

No voy a documentar la instalación bajo sistema operativo Windows de Docker y Docker-compose. Existe documentación sobre ello en la red.Toda la documentación que sigue presupone que eres un desarrollador con Linux.

El código se distribuye containerizado, bajo Docker. De esta manera la aplicación no altera tu sistema operativo y se ejecuta en un sandbox.Docker permite hacer pruebas limpiamente, facilitando probar diferentes configuraciones y pudiendo borrar aquello que ya no resulte útil de forma cómoda.

Es necesario disponer de un sistema Linux al cual se le haya instalado Docker y Docker-Compose previamente. 

Detalles: https://docs.docker.com/compose/install/linux/#install-using-the-repository


Una vez preparado el sistema para poder disponer de containers Docker, se ejecuta el script "crear_docker" dentro del directorio /docker de Tareas.

Dependiendo de las prestaciones del equipo y de la calidad de la conexión a Internet, el proceso que sigue puede durar varios minutos, al cabo de los cuales, si no hay un error, tendremos instalado: 

- Dos imágenes docker, de nombres "mariadb" conteniendo un servidor MariaDB (mySQL) y "httpd" que contiene Ubuntu Linux. Ambos son la última versión de los repositorios oficiales.

- Dos containers, llamados "dbtareaspng" y "webtareas3" correspondiendo, respectivamente, a la aplicación de base de datos y al servidor web.


La ejecución de "docker images" debería reflejar algo parecido a ésto:


> REPOSITORY                   TAG       IMAGE ID       CREATED         SIZE
> 
> httpd                        2.4       1248071c188b   2 weeks ago     352MB
> 
> mariadb                      latest    fc10eab913b0   2 weeks ago     235MB


La ejecución de "docker ps"debería reflejar algo como ésto:

>CONTAINER ID   IMAGE            COMMAND                  CREATED         STATUS         PORTS                                   NAMES
>
>9a14f5245f3c   httpd:2.4        "apachectl -D FOREGR…"   3 minutes ago   Up 3 minutes   0.0.0.0:8801->80/tcp, :::8801->80/tcp   webtareas3
>
>f3a5373a8f61   mariadb:latest   "/scripts/run.sh"        3 minutes ago   Up 3 minutes   3306/tcp                                dbtareaspng


Como se puede observar, el servidor apache escucha en el puerto 8801, y la aplicación web es accesible en el enlace http://localhost:8801

Para arrancar/parar los dos containers puedes usar los scripts start.sh y reset.sh, respectivamente. No se inician automáticamente al iniciar tu sistema ni necesitas crear los containers cada vez que quieras usarlos. Solo se crean una vez (a no ser que hagas cambios, ver siguiente sección de esta documentación).

# Ajuste fino (para manos expertas)

El ajuste fino de la instalación se logra editando los scripts "docker-compose.yml", "inicial_db/Dockerfile" y "inicial_web/Dockerfile".


## Editando docker-compose.yml

En este archivo podemos cambiar los nombres de las imágenes y los containers. Podemos cambiar el usuario y pass de la base de datos.

En caso de cambiar de nombre un servicio, tenemos que cambiar ese mismo nombre en aquellos otros servicios que refieran a éste (sección "depends_on"). 

En caso de cambiar el nombre "dbtareaspng" debemos cambiarlo también en "inicial_web/app_local.php" ya que este dato es necesario para que CakePHP se conecte a la base de datos.

## Editando inicial_db/Dockerfile

Aquí podemos cambiar el repositorio de la base de datos, que es yobasystems/alpine-mariaDB 

Este cambio no es crítico, muy probablemente no resultaria en incompatibilidades. Si crees que existen mejores versiones docker de MariaDB, adelante!!


## Editando inicial_web/Dockerfile

El directorio inicial_web está muy poblado, contiene muchos archivos que se han de copiar automáticamente dentro del container webtareas3. 

El Script que realiza esto es "Dockerfile". Lo que hace es descargar el último Ubuntu (puedes elegir otra distribución de Linux, pero no lo recomiendo) y acto seguido:

- Se instalan los paquetes que se requieren para Apache Webserver. También se instalan otros que necesito para manejarme cómodamente cuando "entramos" en el container (veremos como se hace eso en la sección "Persistencia") y, si nos fijamos, también instalamos "adminer", que es una aplicación muy útil para gobernar la base de datos.

Adminer es accesible via http://localhost:8801/adminer , Denemos poner como servidor "dbtareaspng" (y no "localhost").

- Luego copia algunos archivos desde inicial_web al directorio raiz de la web, dentro de webtareas3. Esos archivos los usaremos después.
- El siguiente paso es ejecutar el script "compone webtareas3" que es un script creado por mí para poder reusar el código en otras aplicaciones. Este es el script que instala una aplicación CakePHP de nopmbre "webtareas3". Para ello usa el sistema Composer de PHP, que permite resolver las dependencias de los paquetes PHP. Es importante que esta fase se ejecute bien, ya que CakePHP es la base de toda la aplicación Tareas.
- Luego se ejecutan unos comando de shell dentro del container webtareas3 para configurar el CakePHP recién instalado y el server Apache. 

Lo más reseñable aquí es que se substituye el archivo composer.json con el que está en el directorio inicial_web para añadir nuevos paquetes a la instalación de CakePHP y acto seguido se actualiza CakePHP con la orden "update". Esto convierte a "composer.json" en el archivo más importante con respecto a lo que podrá hacer CakePHP y verdadera muestra del avance del proyecto. 

## Editando inicial_web/compone









