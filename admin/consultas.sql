SELECT 
	   m.fecha_crear as fecha_creado,
	   concat(uc.primer_nombre,' ',uc.segundo_nombre,' ',uc.primer_apellido,' ',uc.segundo_apellido) as usuario_creado,       
       m.estado,
       m.anio,
       c.nombre as grado, 
	   m.valor_matricula,
       m.valor_pension,
       m.valor_formulario,
       m.valor_pension,
       m.observaciones_matricula,
       tp.nombre as tipo_documento,
       u.numero_documento,
       ce.nombre as ciudad_expedicion_documento,
       u.primer_nombre,
       u.segundo_nombre,
       u.primer_apellido,
       u.genero,
       cn.nombre as ciudad_nacimiento,
       u.fecha_nacimiento,
       u.usuario,
       td.nombre as tipo_discapacidad,
       u.rh,
       m.eps,
       m.ips,
       m.ars,
       m.sisben,
       m.celular,
       m.telefono,
       m.ubicacion,
       b.nombre as barrio,
       m.estrato,
       (SELECT concat(ai.parentesco,' ',ui.primer_nombre,' ',ui.segundo_nombre,' ',ui.primer_apellido,' ',ui.segundo_apellido) FROM acudiente AS ai INNER JOIN usuario AS ui ON ui.id=ai.usuario WHERE ai.matricula = m.id ORDER BY ui.id ASC LIMIT 1) AS padre_familia,
       (SELECT concat(ai.parentesco,' ',ui.primer_nombre,' ',ui.segundo_nombre,' ',ui.primer_apellido,' ',ui.segundo_apellido) FROM acudiente AS ai INNER JOIN usuario AS ui ON ui.id=ai.usuario WHERE ai.matricula = m.id ORDER BY ui.id ASC LIMIT 1,1) AS acudiente_familia
FROM matricula AS m
INNER JOIN usuario AS u ON m.estudiante = u.id
LEFT JOIN curso AS c ON m.curso = c.id
LEFT JOIN tipo_documento AS tp ON m.tipo_documento = tp.id
LEFT JOIN ciudad AS ce ON m.ciudad_expedicion = ce.id
LEFT JOIN ciudad AS cn ON u.ciudad_nacimiento = cn.id
LEFT JOIN tipo_discapacidad AS td ON m.tipo_discapacidad = td.id
LEFT JOIN barrio AS b ON m.barrio = b.id
LEFT JOIN usuario AS uc ON m.usuario_crear = uc.id
WHERE m.anio=2017
ORDER BY c.id,u.primer_nombre;