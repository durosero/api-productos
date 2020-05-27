# api-productos
Servicios REST en php para guardar productos.

Todas las rutas devuelven un objeto con estas propiedades:

`{
    "error": false,
    "message": "Hola mundo"
}`

Si el endpoint devuelve datos estos se muestran en una propiedad adicional llamada `data`, en la siguiente tabla mostramos las rutas disponibles para el manejo de productos.

| RUTA| METODO|PARAMETROS|RESPUESTA|
| ----- | ---- |---- |---- |
| / | GET | | Objeto respuesta|
| /listar | GET | | Arreglo de Objetos|
| /listar/numero | GET | numero | Arreglo de Objetos|
| /listar/numero | GET | numero | Arreglo de Objetos|
| /guardar | POST | codigo, descripcion, precio1 | Objeto respuesta|
| /actualizar/id | POST | codigo, descripcion, precio1 | Objeto respuesta|
| /eliminar/codigo | DELETE | codigo | Objeto respuesta|

### Base de datos
El codigo sql para construir la base de datos está en el archivo con extención .txt

Creamos la base de datos:
`CREATE DATABASE /*!32312 IF NOT EXISTS*/ api-productos /*!40100 DEFAULT CHARACTER SET utf8 */;`

Borramos la tabla si existe
`DROP TABLE IF EXISTS productos;`

Creamos la tabla productos:
`CREATE TABLE productos (
  id int(11) NOT NULL AUTO_INCREMENT,
  codigo varchar(50) DEFAULT NULL,
  descripcion varchar(255) DEFAULT NULL,
  precio1 varchar(255) DEFAULT NULL,
  precio2 varchar(255) DEFAULT NULL,
  precio3 varchar(255) DEFAULT NULL,
  fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY codigo_UNIQUE (codigo)
) ENGINE=InnoDB AUTO_INCREMENT=22045 DEFAULT CHARSET=utf32;
`
