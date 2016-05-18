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
);
