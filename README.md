# Tareas Realizadas

## Tareas realizadas por Julian Sanchez

### Categorías:
- Mostrar una tabla con las categorías (nombre), con opciones para editar, ver y eliminar cada categoría.
- Input para realizar búsquedas de categorías.
- Mostrar la cantidad de categorías.
- *Tiempo estimado:* 10hs.
- *Tiempo real:* 6hs.

### Productos:
- Mostrar tabla con las imágenes, nombre, precio de venta, stock, categoría relacionada, y estado de los productos.
- Funciones para ver el producto, editarlo, eliminarlo, y agregar stock.
- Input para realizar búsquedas por nombre de los productos.
- Botón para crear un nuevo producto.
- Mostrar la cantidad de productos.
- *Tiempo estimado:* 10hs.
- *Tiempo real:* 8hs.

### Inicio:
- Mostrar la cantidad de productos/artículos vendidos y las ventas realizadas en el día.
- Mostrar la cantidad de ventas y el monto total de las ventas realizadas.
- Mostrar al mejor vendedor y mejores compradores.
- *Tiempo estimado:* 16hs.
*Tiempo real:* 10hs.

### Módulo Negocio/Empresa:
- Mostrar el nombre, CUIT/CUIL de la empresa, eslogan de la empresa o negocio, mail, celular y dirección.
- Boton de editar la informacion
- *Tiempo estimado:* 8hs.
- *Tiempo real:* 5hs.

### Módulo Crear Clientes:
- Registrar los datos del cliente para adjuntar a la venta.
- Editr datos del cliente
- Realizar la baja logica del cliente
- *Tiempo estimado:* 12hs.
- *Tiempo real:* 8hs.

### Módulo Ventas:
- Crear una venta.
- Filtrar ventas por fecha.
- Mostrar los productos disponibles para su compra.
- Mostrar un cliente generico y/o poder registrar un cliente para realizar una compra.
- Funciones para ver la venta, editarla o realizar la eliminacion.
- Listar los clientes que realizaron una compra.
- Realizar factura de venta del cliente
- *Tiempo estimado:* 18hs.
- *Tiempo real:* 16hs.

### Módulo Usuario:
- Crear usuarios.
- Listar usuarios activos y desactivos.
- Editar usuarios
- Eliminar usuarios
- Ver usuarios
- *Tiempo estimado:* 10hs.
- *Tiempo real:* 6hs.

## Tareas realizadas por Nazarena Alvarez

### Módulo Login:
- Restringir el acceso a usuarios vendedores.
- Dar acceso a todos los módulos a usuarios administradores.
- Diseño
- Redireccion de logueo y deslogueo
- diseño responsive 
- *Tiempo estimado:* 10hs.
- *Tiempo real:* 6hs

### Módulo NavBar:
- Mostrar el nombre del usuario logueado.
- Botón/icono que direccione al inicio si se está en otro módulo.
- *Tiempo estimado:* 6hs.
- *Tiempo real:* 2hs.

### Pruebas 
- Pruebas de funcionalidad
- Pruebas de interfaz de usuario
- Pruebas de integracion
- *Tiempo estimado:* 12hs.
- *Tiempo real:* 8hs.

### Diseño
- Intefaz de Usuario
- Estilo visual
- Responsive
- *Tiempo estimado:* 20hs.
- *Tiempo real:* 12hs.

## Errores durante el desarrollo

### Compatibilidad de diseño:
- **Error encontrado:** Problema con la compatibilidad entre las clases de Bootstrap 5.2 y Bootstrap 4.6, que es la versión utilizada por AdminLTE.

### guardar en storage imágenes y mostrar
- **Error encontrado:** Las imágenes subidas no se mostraban correctamente en la aplicación.
- **Solución:** Correr el siguiente comando en la consola:
  ```bash
  php artisan storage:link 
  permite que los archivos almacenados en la carpeta storage/app/public sean accesibles públicamente desde el navegador

### Problema con la protección de rutas y módulos dentro de la app:
- **Error encontrado:** No se pueden proteger correctamente las rutas y módulos dentro de la aplicación, lo que permite que usuarios no autorizados accedan a recursos restringidos.
- **Solución:** Para proteger las rutas y módulos, es necesario crear un middleware que valide si el usuario tiene permisos de administrador antes de permitirles el acceso. Ejecuta el siguiente comando en la consola:
  ```bash
  php artisan make:middleware AdminMiddleware 
  es un comando utilizado en Laravel para crear un middleware personalizado llamado AdminMiddleware

### Error al crear las tablas:
- **Error encontrado:** Después de crear una migración para una tabla con el comando `php artisan make:migration`, la tabla no se crea en la base de datos.
- **Solución:** Una vez que hayas creado la migración con el comando:  
  ```bash
  php artisan make:migration NOMBRE_DE_LA_TABLA
  Permite añadir o eliminar columnas en tablas ya existentes

### Desafíos con el testeo de rendimiento de la aplicación
- **Error encontrado:** llenar las de tablas de muchos registros para testear la app.
- **Solución:** Utilizar Seeders para generar datos de prueba de manera automática y simular grandes volúmenes de productos en la base de datos. Esto permitió realizar pruebas de rendimiento sin necesidad de ingresar manualmente los datos.

### Problemas con la organización y disposición de los componentes en pantallas pequeñas:
- **Error econtrado:** A medida que la cantidad de información o los elementos de la interfaz aumentan, puede ser difícil organizar el contenido de forma efectiva en pantallas pequeñas (móviles y tablets).
- **Solución:** Usar el sistema de rejilla de Bootstrap para hacer un diseño fluido y responsivo, de manera que el contenido se reorganice y ajuste según el tamaño de la pantalla.

### Pruebas Unitarias:
- **Error encontrado:** Al realizar pruebas unitarias con el componente de Livewire para las categorías, se presentó el error `A facade root has not been set.` Este error ocurrió porque la referencia a `PHPUnit\Framework\TestCase` no estaba correctamente configurada para el contexto de pruebas unitarias. 
- **Solucion:** modificar la referencia correspondiente a `Tests\TestCase.`

## Módulo Categorias:

### Restricciones faltantes en el campo "Nombre":
- **Error econtrado:** Al crear o editar una categoría, el campo "Nombre" permite ingresar valores numéricos sin generar un error.
- **Solucion:** se agrego onkeypress que permite escribir solo letas y no numeros

### Eliminación de categoría con productos asignados
- **Error econtrado:** Al intentar eliminar una categoría que tiene productos asignados, se presenta el siguiente error de restricción de clave foránea: `SQLSTATE[23000]: Integrity constraint violation: 19 FOREIGN KEY constraint failed`
- **Solucion:** se agrego una columna para manejar el estado activo o desactivado de la tabla categorias.  se realiza solo la baja logica

## Módulo Productos:

### Campos vacíos en la creación de productos
- **Error econtrado:** Al crear un producto, se permiten seleccionar valores vacíos en el combobox de categorías, lo que genera inconsistencias al guardar el producto.
- **Solucion:** la etiqueta option estaba mal cerrada es por eso que luego de mostrar un registro aparecia uno vacio

### Restricciones faltantes en los campos de creación de productos
- **Error econtrado:** El campo "Nombre" permite ingresar solo números sin generar error. Los campos "Precio de compra" y "Precio de venta" permiten ingresar el valor 0 sin validación.
- **Solucion:** se agrego onkeypress al input de nombre para que solo acepte letras. y para los input precio compra y enta la clasula not_in:0 que no permite que sea 0 el valor.

### Eliminación de producto con ventas realizadas
- **Error econtrado:** La aplicación permite eliminar un producto que tiene ventas asociadas, y al acceder a las ventas, el producto eliminado ya no está disponible en el historial de la venta.
- **Solucion:** se agrego una columna para manejar el estado de las ventas y productos. si el producto se desactiva (dar de baja) aun asi se puede visualiar el historial de las ventas con productos que ya no se venden mas o estan de baja.

### Error con el Stock Mínimo y Máximo en el Modal de Producto
- **Error encontrado:** Se detectó un error en el modal de productos donde los valores de `stock mínimo` y `stock máximo` no se validaban correctamente. Esto causaba que los valores ingresados no respetaran la lógica de negocio establecida para el manejo del stock. 
- **Solucion:** Se corrigió la lógica para evitar que el valor del `stock máximo` se autorellenara en el campo de `stock mínimo`. Ahora, los campos son independientes y el usuario debe ingresar valores diferentes en cada uno si es necesario

## Módulo Ventas

### Registro de ventas con pago inferior al precio de venta
- **Error econtrado:** Si el monto del pago es menor que el precio de venta, la venta se puede registrar igualmente, lo que genera un vuelto en números negativos.
- **Solucion:** se agrego una condicion pago si es menor que el total no se realiza la venta.

### Problema con el botón de editar en la lista de ventas
- **Error econtrado:** El botón "Editar" en la lista de ventas no funciona correctamente y no permite modificar las ventas registradas.
- **Solucion:** se creo el componente para editar la venta y su logica

## Módulo Clientes

### Restricciones faltantes en los campos de cliente
- **Error econtrado:** Al crear o editar un cliente, los campos "Nombre" y "Empresa" permiten ingresar valores numéricos sin generar un error. Además, los campos "DNI", "Teléfono" y "CUIT/CUIL" permiten ingresar caracteres no numéricos, y no existe restricción respecto al mínimo de caracteres para "DNI" y "CUIT/CUIL".
- **Solucion:**se agregaron las restricciones onkeypress para los campos nombre,empresa solo aceptan letras. los campos dni y cuit solo acpetan numeros.

### Eliminación de cliente con compras realizadas
- **Error econtrado:** Al intentar eliminar un cliente que tiene compras realizadas, se presenta el siguiente error de restricción de clave foránea: `SQLSTATE[23000]: Integrity constraint violation: 19 FOREIGN KEY constraint failed`
- **Solucion:** se realiza la baja logica del cliente. se agrego una columna para manejar el estado

## Módulo Usuarios

### Restricciones faltantes en el campo "Nombre"
- **Error econtrado:** Al crear o editar un usuario, no se aplican restricciones adecuadas en el campo "Nombre", lo que permite ingresar números sin generar ningún tipo de error.
- **Solucion:** se agrego al input onkeypress para que solo acepte letras.

### La contraseña no se actualiza correctamente
- **Error econtrado:** Al editar un usuario, los campos de contraseña aparecen vacíos. Si se dejan vacíos, el sistema guarda la contraseña anterior sin realizar ningún cambio.
- **Solucion:** se resolvio usando la funcion bcrypt para que realiace el cambio de contraseña

## Modulo Shop

### Restricciones faltantes en los campos de texto
- **Error econtrado:** No existen restricciones en los campo "Ciudad", lo que permite ingresar valores numéricos en estos campos. El mismo comportamiento se presenta en el campo "Teléfono", donde no se genera un error si se ingresan caracteres no numéricos.
- **Solucion:** se restringio el input del campo telefono, donde ingresen solo numeros, campo ciudad tambien

## Modulo Inicio
 
- **Error encontrado:** si un vendedor tiene registrada ventas de telefonos por ejemplo y damos de baja el producto telefono. Ya no muestra sus ventas
- **Solucion:** se agrego la condicion que muestre todas las ventas aunque esten de baja

##
- *Tiempo estimado:* 15hs.
- *Tiempo real:* 8hs


