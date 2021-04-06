CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nom_usuario` varchar(45) NOT NULL,
  `apel_usuario` varchar(50) NOT NULL,
  `email_usuario` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `pass_usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_usuario`,`user_name`,`email_usuario`)
);

CREATE TABLE oficio(
  num_oficio INT AUTO_INCREMENT NOT NULL,
  fecha_oficio DATE NOT NULL,
  remitente_oficio VARCHAR(300) NOT NULL,
  destinatario_oficio VARCHAR(300) NOT NULL,
  asunto_oficio VARCHAR(1000) NOT NULL,
  PRIMARY KEY(num_oficio)
);

CREATE TABLE proyecto(
  num_proyecto VARCHAR(50) NOT NULL,
  num_oficio VARCHAR(50) NOT NULL,
  fecha_proyecto DATE NOT NULL,
  nombre_proyecto VARCHAR(50) NOT NULL,
  actividad_proyecto VARCHAR(50) NOT NULL,
  tipo_actividad VARCHAR(50) NOT NULL,
  beneficiario_proyecto VARCHAR(150) NOT NULL,
  inversion_proyecto FLOAT NOT NULL,
  estado_proyecto INT NOT NULL,
  PRIMARY KEY(num_proyecto),
	FOREIGN KEY(num_oficio) REFERENCES oficio(num_oficio)
);

CREATE TABLE avance_proyecto(
	id_avance INT NOT NULL AUTO_INCREMENT,
  num_proyecto VARCHAR(50) NOT NULL,
  num_oficio VARCHAR(50) NOT NULL,
  fecha_avance DATE NOT NULL,
  nombre_proyecto VARCHAR(50) NOT NULL,
  actividad_proyecto VARCHAR(50) NOT NULL,
  tipo_actividad VARCHAR(50) NOT NULL,
  beneficiario_proyecto VARCHAR(150) NOT NULL,
  inversion_proyecto FLOAT NOT NULL,
  estado_proyecto INT NOT NULL,
  informe_avance VARCHAR(100) NOT NULL,
  PRIMARY KEY(id_avance),
  FOREIGN KEY(num_proyecto) REFERENCES proyecto(num_proyecto),
	FOREIGN KEY(num_oficio) REFERENCES oficio(num_oficio)
);

CREATE PROCEDURE `sp_login_usuario`(nombre_u VARCHAR(50), pass_u VARCHAR(50))
BEGIN
  IF EXISTS (SELECT * FROM usuario WHERE (user_name = nombre_u OR email_usuario = nombre_u) AND pass_usuario = MD5(pass_u))
    THEN
      SELECT id_usuario 
      FROM usuario 
      WHERE (user_name = nombre_u OR email_usuario = nombre_u) AND pass_usuario = MD5(pass_u);
  END IF;
  SELECT 0;
END

CREATE PROCEDURE `sp_get_usuario_by_id`(id_user INT)
BEGIN
	SELECT nom_usuario, apel_usuario, email_usuario, user_name
	FROM usuario
  WHERE id_usuario = id_user;
END

CREATE `sp_create_new_oficio`(remit_of VARCHAR(300), desti_of VARCHAR(300), asunt_of VARCHAR(1000))
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
    ROLLBACK;
    SET @errorNum = 0;
		SELECT @errorNum;
	END;
    
  SET @nOficio = 'INDER-GG-DRT-RDHC-OTTA-';
  SET @qOficio = (SELECT COUNT(num_oficio)+1 FROM oficio WHERE YEAR(fecha_oficio) = YEAR(CURDATE()));
  IF (@qOficio >= 1 AND @qOficio < 10) THEN
    SET @nOficio = CONCAT('INDER-GG-DRT-RDHC-OTTA-000', @qOficio, '-', YEAR(CURDATE()));
  ELSE
		IF (@qOficio >= 10 AND @qOficio < 100) THEN
			SET @nOficio = CONCAT('INDER-GG-DRT-RDHC-OTTA-00', @qOficio, '-', YEAR(CURDATE()));
    ELSE
			IF (@qOficio >= 100 AND @qOficio < 1000) THEN
				SET @nOficio = CONCAT('INDER-GG-DRT-RDHC-OTTA-0', @qOficio, '-', YEAR(CURDATE()));
      ELSE
				IF (@qOficio >= 1000 AND @qOficio < 10000) THEN
					SET @nOficio = CONCAT('INDER-GG-DRT-RDHC-OTTA-', @qOficio, '-', YEAR(CURDATE()));
        END IF;
      END IF;
    END IF;
  END IF;
    
  INSERT INTO oficio(
		num_oficio,
    fecha_oficio,
    remitente_oficio,
    destinatario_oficio,
    asunto_oficio
  )VALUES(
		@nOficio,
    CURDATE(),
    remit_of,
    desti_of,
    asunt_of
  );
  SELECT MAX(num_oficio) FROM oficio;
END

CREATE PROCEDURE `sp_get_all_oficio`()
BEGIN
	SELECT
    num_oficio,
    fecha_oficio,
    remitente_oficio,
    destinatario_oficio,
    asunto_oficio
  FROM oficio;
END

CREATE PROCEDURE `sp_create_new_proyecto`(
  oficio_p INT, 
  nombre_p VARCHAR(50),
  actividad_p VARCHAR(50),
  tipo_p VARCHAR(50),
  beneficiario_p VARCHAR(150),
  inversion_p FLOAT
)
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		ROLLBACK;
    SET @errorNum = 0;
		SELECT @errorNum;
	END;
    
    IF NOT EXISTS (SELECT num_oficio FROM oficio WHERE num_oficio = oficio_p) THEN
      SET @falseNoOficio = -1;
      SELECT @falseNoOficio;
    END IF;
    
    INSERT INTO proyecto(
      num_oficio,
      fecha_proyecto,
      nombre_proyecto,
      actividad_proyecto,
      tipo_actividad,
      beneficiario_proyecto,
      inversion_proyecto,
      estado_proyecto
    ) VALUES (
      oficio_p,
      CURDATE(),
      nombre_p,
      actividad_p,
      tipo_p,
      beneficiario_p,
      inversion_p,
      0
    );
    
    SELECT MAX(num_proyecto) FROM proyecto;
END;

CREATE PROCEDURE `sp_get_all_proyecto`()
BEGIN
	SET @qProyectos = (SELECT COUNT(num_proyecto) FROM proyecto);
  IF (@qProyectos > 0) THEN
    SELECT
			num_proyecto, 
			num_oficio, 
			fecha_proyecto, 
			nombre_proyecto, 
			actividad_proyecto, 
			tipo_actividad, 
			beneficiario_proyecto, 
			inversion_proyecto, 
			estado_proyecto
		FROM proyecto;
	ELSE
		SELECT @qProyectos;
    END IF;
END;