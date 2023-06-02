# Tareas

Tareas es una aplicación LAMP/CRUD con NodeJS

LAMP = Linux, Apache, MariaDB, PHP8

Como framework usa CakePHP 4 https://github.com/cakephp/cakephp

El objeto de esta aplicación es organizar el trabajo de unos técnicos de diferentes delegaciones de una empresa de manera que las tareas que realicen estén coordinadas. 
La aplicación guarda notas de cada tarea realizada y guarda también archivos que se requieran para considerar la tarea completada. 
Para más detalle, me remito a la documentación. 

# Instalación

#PASO 1 : Descarga

OPCION 1: Descarga el ZIP de esta web, descomprime el archivo en un directorio

OPCION 2 (recomendada): Ejecutar "git clone https://github.com/pansogal/tareas.git" (sin las comillas) en un terminal.


#PASO 2 : Generación de container Docker 

El código se distribuye containerizado, bajo Docker. De esta manera la aplicación no altera tu sistema operativo y se ejecuta en un sandbox.

Es necesario disponer de un sistema Linux al cual se le haya instalado Docker y Docker-Compose previamente. 

Detalles: https://docs.docker.com/compose/install/linux/#install-using-the-repository


Una vez preparado el sistema para poder disponer de containers Docker, se ejecuta el script "crear_docker" dentro del directorio /docker.

Dependiendo de las prestaciones del equipo y de la calidad de la conexión a Internet, el proceso que sigue puede durar varios minutos, al cabo de los cuales, si no hay un error, tendremos instalado: 

- Dos imágenes docker, de nombres 



