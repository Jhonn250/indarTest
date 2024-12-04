# indarTest

## Cómo ejecutar el proyecto

1. Descargar el proyecto
2. Desde SQL Server, crear una nueva base de datos
3. Importar los archivos SQL a nuestra nueva base de datos, deberían importarse 3 nuevas tablas: `Metas`, `Tasks`, `Status`
4. Importar el archivo `.env` a la raíz del backend
5. Cambiar los valores de:
   1.1. `DB_HOST=localhost`  
   1.2. `DB_PORT=`  
   1.3. `DB_DATABASE=`  
   1.4. `DB_USERNAME=sa`  
   1.5. `DB_PASSWORD=`  

6. Ejecutar `php artisan serve` en la terminal desde la carpeta `backend` y deberia aparecer algo como `   INFO  Server running on [http://127.0.0.1:8000].  `
7. En otra terminal o con vscode abierto en la raiz de `frontend` escribimos `npm install` para descargar las dependencias.
8. Ejecutar `npm run dev` para ejecutar nextjs.

*Debemos asegurarnos que el backend este corriendo en el puerto 8000*

## Pruebas para backend desde postman
1. Abrir postman e importar la coleccion Indar del proyecto
2. Tendremos 3 carpetas, `METAS, TASKS, STATUS`
3. CRUD de METAS:
   1.1. `GetAll nos regresa un objeto metas con todas las metas registradas.`
   1.2 `ByID nos regresa una meta especificada por ID.`
   1.3 `Update Meta permite actualizar la descripcion de la meta dado un ID`
   1.4 `Post Meta permite crear una nueva meta`
   1.5 `Delete Meta permite eliminar una meta dado un ID.`
4. CRUD DE TASKS
