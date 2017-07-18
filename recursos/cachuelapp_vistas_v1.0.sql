/********************************************
 *******************VISTAS*******************
 ********************************************/

CREATE VIEW vw_empleo
AS
  SELECT e.codEmpleo, e.titulo, 
		e.descripcion, e.remuneracion, e.fechaCreacion, e.horas, e.categoria, e.etiquetas,
        u.codUbicacion, u.direccion, u.distrito, u.provincia, u.departamento
  FROM empleo e
  LEFT JOIN ubicacion u ON u.codUbicacion = e.codUbicacion;
  


