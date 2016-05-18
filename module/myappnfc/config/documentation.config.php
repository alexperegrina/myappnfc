<?php
return array(
    'myappnfc\\V1\\Rpc\\Login\\Controller' => array(
        'GET' => array(
            'response' => '{
  "valido": "indica si el usuario es valido",
  "tipo": "Tipo de usuario [user, comercializador, servicio]"
}',
            'description' => 'Servicio para validar si el usuario y password son validos en el sistema',
        ),
        'POST' => array(
            'response' => '{
  "valido": "indica si el usuario es valido",
  "tipo": "Tipo de usuario [user, comercializador, servicio]"
}',
            'request' => '{
   "user": "user a identificar",
   "password": "password del usuario a validar"
}',
            'description' => 'Servicio para validar si el usuario y password son validos en el sistema',
        ),
        'description' => 'Servicio para validar si el usuario y password son validos en el sistema',
    ),
    'myappnfc\\V1\\Rpc\\ProfileByUser\\Controller' => array(
        'description' => 'Servicio para cojer la información del usuario',
        'GET' => array(
            'description' => 'Servicio para cojer la información del usuario',
            'response' => '{
  "user": {
    "id": "int id del usuario",
    "username": "string username del usuario",
    "password": "string password de usuario encriptado en MD5",
    "mail": "string mail del usuario",
    "id_user": "int id del usuario",
    "nombre": "string nombre del usuario",
    "apellidos": "string apellidos del usuario",
    "fecha_nacimiento": "date YYYY-mm-dd hh:mm:ss"
  }
}',
        ),
        'POST' => array(
            'response' => '{
  "user": {
    "id": "int id del usuario",
    "username": "string username del usuario",
    "password": "string password de usuario encriptado en MD5",
    "mail": "string mail del usuario",
    "id_user": "int id del usuario",
    "nombre": "string nombre del usuario",
    "apellidos": "string apellidos del usuario",
    "fecha_nacimiento": "date YYYY-mm-dd hh:mm:ss"
  }
}',
            'request' => '{
   "username": "username del usuario"
}',
            'description' => 'Servicio para cojer la información del usuario',
        ),
    ),
    'myappnfc\\V1\\Rpc\\SaveUser\\Controller' => array(
        'description' => 'Servicio para guardar modificar un usuario o añadir un usuario, si se introduce con id se modifica y si no tiene id se añadira',
        'POST' => array(
            'description' => 'Servicio para guardar modificar un usuario o añadir un usuario, si se introduce con id se modifica y si no tiene id se añadira',
            'request' => '{
   "id": "Identificador del usuario, si no se pasa como parametro creara un nuevo usuario",
   "username": "username del usuario, tiene que se unico",
   "password": "pasword en MD5",
   "mail": "mail del usuario",
   "nombre": "Nombre del usuario",
   "apellidos": "Apellidos del usuario",
   "fecha_nacimiento": "Fecha de nacimiento del usuario, en formato YYYY-mm-dd hh:mm:ss"
}',
            'response' => '{
  "response": "true o false, segun si se a podido modificar/añadir a la bd"
}',
        ),
    ),
    'myappnfc\\V1\\Rpc\\ServicesByUser\\Controller' => array(
        'description' => 'Servicio para obtener todos los servicios del sistema indicando para el usuari con username pasado por parametro si el servicio lo tiene activado o no',
        'GET' => array(
            'description' => 'Servicio para obtener todos los servicios del sistema indicando para el usuari con username pasado por parametro si el servicio lo tiene activado o no',
            'response' => '{
  "servicios": [
    {
      "username": "servicio",
      "nombre": "servicio",
      "activado": true
    },
    {
      "username": "servicio2",
      "nombre": "servicio2",
      "activado": false
    },
    {
      "username": "servicio3",
      "nombre": "servicio3",
      "activado": false
    }
  ]
}',
        ),
    ),
);
