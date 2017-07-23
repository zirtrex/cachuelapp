/********************************************
 *******************VISTAS*******************
 ********************************************/

USE cachuelapp;

CREATE VIEW vw_empleo
AS
  SELECT e.codEmpleo, e.titulo, 
		e.descripcion, e.remuneracion, e.fechaCreacion, e.horas, e.categoria, e.etiquetas,
        u.codUbicacion, u.direccion, u.distrito, u.provincia, u.departamento
  FROM empleo e
  LEFT JOIN ubicacion u ON u.codUbicacion = e.codUbicacion;
  

CREATE VIEW vw_usuario
AS
  SELECT u.codUsuario, u.rol, u.usuario, u.clave,
        u.nombres, u.primerApellido, u.segundoApellido, u.numeroDNI,
        u.imagenDNI, u.enlaceFacebook, u.fechaNacimiento, u.correo, u.celular,
        u.imagenPerfil, u.imagenAdicional,
        u.fechaRegistro, u.tokenRegistro, u.correoConfirmado,
        ub.codUbicacion, ub.direccion, ub.distrito, ub.provincia, ub.departamento
  FROM usuario u
  LEFT JOIN ubicacion ub ON ub.codUbicacion = u.codUbicacion;
  


