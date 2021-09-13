create table if not exists trabajador(
  id_trabajador int(11) not null auto_increment primary key,
  ci varchar(15) not null,
  exp varchar(20),
  nombres varchar(150) not null,
  direccion varchar(200) not null,
  sexo VARCHAR(20) not null,
  nacionalidad VARCHAR(50) not null,
  fecha_nacimiento date not null,
  estado_trabajador varchar(20) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table if not exists usuario(
	id_usuario int(11) not null auto_increment primary key,
	cuenta varchar(50) not null,
	password varchar(200) not null,
	fecha_registro datetime not null,
	fecha_actualizacion DATETIME not null,
	fecha_ultimo_ingreso datetime not null,
	estado_usuario tinyint(1) not null,
	id_trabajador int not null,
	foreign key(id_trabajador) references trabajador(id_trabajador)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Asistencia de trabajadores segun su cargo
create table if not exists asistencia(
	id_asistencia int(11) not null auto_increment primary key,
	departamento_asistencia varchar(100),
	nombre_asistencia varchar(150),
	carnet_asistencia varchar(20),
	fecha_hora_asistencia varchar(80),
	locacion_id_asistencia int(1),
	id_numero_asistencia int(1),
	verificaCod_asistencia varchar(20),
	nro_tarjeta_asistencia int(2)
	)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table if not exists bruto_zktECO_continuo(
	numero varchar(50),
	nombre varchar(150),
	tiempo varchar(100),
	estado varchar(100),
	dispositivo varchar(50),
	tipo_registro varchar(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table if not exists zktECO_continuo(
	numero_continuo varchar(50),
	nombre_continuo varchar(150),
	fecha_continuo varchar(10),
	hora_continuo varchar(10),
	estado_continuo varchar(100),
	dispositivo_continuo varchar(50),
	tipo_registro_continuo varchar(50)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table if not exists marcaciones_zaktECO_continuo(
	id_marcaciones int not null auto_increment primary key,
	numero_marcaciones varchar(50) not null,
	nombre_marcaciones varchar(100) not null,
	fecha_marcaciones varchar(10) not null,
	hora_marcaciones varchar(8) not null,
	estado_marcaciones varchar(8) not null,
	dispositivo_marcaciones varchar(30) not null,
	registro_countinuo varchar(30) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table if not exists atrasos(
	id_atraso int not null auto_increment primary key,
	tiempo_atraso int(3) not null,
	estado_atraso int(3) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table if not exists turno(
	id_turno int not null auto_increment primary key,
	tipo_turno varchar(50) not null,
	estado_turno int(3) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table if not exists horario(
	id_horario int not null auto_increment primary key,
	inicio_horario varchar(8) not null,
	fin_horario varchar(8) not null,
	estado_horario int(3) not null,
	id_turno int not null,
	foreign key (id_turno) references turno(id_turno) 
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- create table if not exists asistencia_zktECO_continuo(
-- 	id_aistencia_continuo int not null auto_increment primary key,
-- 	numero_continuo varchar(50),
-- 	nombre_continuo varchar(150),
-- 	$fecha_continuo varchar(10),
-- 	$hora_continuo varchar(10),
-- 	$estado_continuo varchar(100),
-- 	$dispositivo_continuo varchar(50),
-- 	tipo_registro_continuo varchar(50)
-- )ENGINE=InnoDB DEFAULT CHARSET=utf8;