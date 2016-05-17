SELECT i.id_servicio, i.nombre, i.descripcion
FROM users as u
JOIN permisos_user_servicio as p on u.id = p.id_user
LEFT JOIN info_servicio as i on i.id_servicio = p.id_servicio
LEFT JOIN users as s on s.id = p.id_servicio
WHERE u.username = 'alex'


