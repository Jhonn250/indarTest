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


7. En otra terminal o con VSCode abierto en la raíz de `frontend`, escribir `npm install` para descargar las dependencias.
8. Ejecutar `npm run dev` para iniciar el servidor de Next.js.

**Asegúrate de que el backend esté corriendo en el puerto 8000.**

## Pruebas para backend desde Postman

1. Abrir Postman e importar la colección "Indar" del proyecto.
2. Tendremos 3 carpetas: `METAS`, `TASKS`, `STATUS`.

### CRUD de METAS:

1.1. **GetAll**: Nos regresa un objeto con todas las metas registradas.  
1.2. **ByID**: Nos regresa una meta especificada por ID.  
1.3. **Update Meta**: Permite actualizar la descripción de la meta dado un ID.  
1.4. **Post Meta**: Permite crear una nueva meta.  
1.5. **Delete Meta**: Permite eliminar una meta dado un ID.  

### CRUD de TASKS:

2.1. **GetAll**: Nos regresa un objeto con todas las tareas registradas, puede ser con filtros de busqueda y filtro de metaID, ademas de paginacion incluida.  
2.2. **ByID**: Nos regresa una tarea especificada por ID.  
2.3. **Update Task**: Permite actualizar la descripción de la tarea dado un ID.  
2.4. **Post Task**: Permite crear una nueva tarea.  
2.5. **Delete Task**: Permite eliminar una tarea dado un ID.  

### CRUD de STATUS:

3.1. **GetAll**: Nos regresa un objeto con todos los status registrados. 
