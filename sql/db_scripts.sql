-- TABLAS
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nom_usuario` varchar(45) NOT NULL,
  `apel_usuario` varchar(50) NOT NULL,
  `email_usuario` varchar(50) NOT NULL,
  `pass_usuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `admin_usuario` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_usuario`,`email_usuario`)
);

CREATE TABLE `oficio` (
  `num_oficio` varchar(50) NOT NULL,
  `fecha_oficio` date NOT NULL,
  `remitente_oficio` varchar(300) NOT NULL,
  `destinatario_oficio` varchar(300) NOT NULL,
  `asunto_oficio` varchar(1000) NOT NULL,
  PRIMARY KEY (`num_oficio`)
)

CREATE TABLE `proyecto` (
  `num_proyecto` varchar(50) NOT NULL,
  `num_oficio` varchar(50) NOT NULL,
  `fecha_proyecto` date NOT NULL,
  `nombre_proyecto` varchar(50) NOT NULL,
  `actividad_proyecto` varchar(50) NOT NULL,
  `tipo_actividad` varchar(50) NOT NULL,
  `beneficiario_proyecto` varchar(150) NOT NULL,
  `inversion_proyecto` float NOT NULL,
  `estado_proyecto` int(11) NOT NULL,
  PRIMARY KEY (`num_proyecto`),
  KEY `fk_proyecto_num_oficio` (`num_oficio`),
  CONSTRAINT `fk_proyecto_num_oficio` FOREIGN KEY (`num_oficio`) REFERENCES `oficio` (`num_oficio`)
)

CREATE TABLE `avance_proyecto` (
  `id_avance` int(11) NOT NULL AUTO_INCREMENT,
  `num_proyecto` varchar(50) NOT NULL,
  `num_oficio` varchar(50) NOT NULL,
  `fecha_avance` date NOT NULL,
  `nombre_proyecto` varchar(50) NOT NULL,
  `actividad_proyecto` varchar(50) NOT NULL,
  `tipo_actividad` varchar(50) NOT NULL,
  `beneficiario_proyecto` varchar(150) NOT NULL,
  `inversion_proyecto` float NOT NULL,
  `estado_proyecto` int(11) NOT NULL,
  `informe_avance` varchar(100) NOT NULL,
  PRIMARY KEY (`id_avance`),
  KEY `num_proyecto` (`num_proyecto`),
  KEY `num_oficio` (`num_oficio`),
  CONSTRAINT `avance_proyecto_ibfk_1` FOREIGN KEY (`num_proyecto`) REFERENCES `proyecto` (`num_proyecto`),
  CONSTRAINT `avance_proyecto_ibfk_2` FOREIGN KEY (`num_oficio`) REFERENCES `oficio` (`num_oficio`)
)

CREATE TABLE documento_oficio(
    id_documento INT AUTO_INCREMENT,
    num_oficio VARCHAR(50) NOT NULL,
    nom_documento VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_documento),
    FOREIGN KEY (num_oficio) REFERENCES oficio (num_oficio)
);

-- PROCEDIMIENTOS ALMACENADOS
CREATE PROCEDURE `sp_create_new_avance_proyecto`(
	num_p VARCHAR(50),
    num_o VARCHAR(50),
    nom_p VARCHAR(50),
    act_p VARCHAR(50),
    tip_a VARCHAR(50),
    ben_p VARCHAR(150),
    inv_p FLOAT,
    est_p INT,
    inf_a VARCHAR(100)
)
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		ROLLBACK;
        SET @errorNum = 0;
		SELECT @errorNum;
	END;
    
    INSERT INTO avance_proyecto(
		num_proyecto, 
		num_oficio, 
		fecha_avance, 
		nombre_proyecto, 
		actividad_proyecto, 
		tipo_actividad, 
		beneficiario_proyecto, 
		inversion_proyecto, 
		estado_proyecto, 
		informe_avance
	) VALUES (
		num_p,
        num_o,
        CURDATE(),
		nom_p,
		act_p,
		tip_a,
		ben_p,
		inv_p,
		est_p,
		inf_a
	);
    
    UPDATE proyecto
    SET fecha_proyecto = CURDATE(),
		nombre_proyecto = nom_p,
        actividad_proyecto = act_p,
        tipo_actividad = tip_a, 
        beneficiario_proyecto = ben_p, 
        inversion_proyecto = inv_p, 
        estado_proyecto = est_p
    WHERE num_proyecto = num_p;
    
    SELECT MAX(id_avance) FROM avance_proyecto;
END

CREATE PROCEDURE `sp_create_new_oficio`(remit_of VARCHAR(300), desti_of VARCHAR(300), asunt_of VARCHAR(1000))
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

CREATE PROCEDURE `sp_create_new_proyecto`(
	oficio_p VARCHAR(50),
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
	ELSE
		SET @nProyecto = 'INDER-GG-DRT-RDHC-OTTA-';
        SET @qProyecto = (SELECT COUNT(num_proyecto)+1 FROM proyecto WHERE YEAR(fecha_proyecto) = YEAR(CURDATE()));
        IF (@qProyecto >= 1 AND @qProyecto < 10) THEN
			SET @nProyecto = CONCAT('INDER-GG-DRT-RDHC-OTTA-000', @qProyecto, '-', YEAR(CURDATE()));
		ELSE
			IF (@qProyecto >= 10 AND @qProyecto < 100) THEN
				SET @nProyecto = CONCAT('INDER-GG-DRT-RDHC-OTTA-00', @qProyecto, '-', YEAR(CURDATE()));
			ELSE
				IF (@qProyecto >= 100 AND @qProyecto < 1000) THEN
					SET @nProyecto = CONCAT('INDER-GG-DRT-RDHC-OTTA-0', @qProyecto, '-', YEAR(CURDATE()));
				ELSE
					IF (@qProyecto >= 1000 AND @qProyecto < 10000) THEN
						SET @nProyecto = CONCAT('INDER-GG-DRT-RDHC-OTTA-', @qProyecto, '-', YEAR(CURDATE()));
					END IF;
				END IF;
			END IF;
		END IF;
        
        INSERT INTO proyecto(
			num_proyecto, 
            num_oficio, 
            fecha_proyecto, 
            nombre_proyecto, 
            actividad_proyecto, 
            tipo_actividad, 
            beneficiario_proyecto, 
            inversion_proyecto, 
            estado_proyecto
        )VALUES(
			@nProyecto,
            oficio_p,
            CURDATE(),
			nombre_p,
			actividad_p,
			tipo_p,
			beneficiario_p,
			inversion_p,
            0
        );
        
        INSERT INTO avance_proyecto(
			num_proyecto, 
            num_oficio, 
            fecha_avance, 
            nombre_proyecto, 
            actividad_proyecto, 
            tipo_actividad, 
            beneficiario_proyecto, 
            inversion_proyecto, 
            estado_proyecto, 
            informe_avance
        ) VALUES (
			@nProyecto,
            oficio_p,
            CURDATE(),
			nombre_p,
			actividad_p,
			tipo_p,
			beneficiario_p,
			inversion_p,
            0,
            'Proyecto registrado'
        );
        
        SELECT MAX(num_proyecto) FROM proyecto;
        
    END IF;
    
END

CREATE PROCEDURE `sp_create_new_usuario`(
	nom VARCHAR(45),
    apels VARCHAR(50),
    email VARCHAR(50),
    pass VARCHAR(255),
    admin TINYINT(1)
)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		ROLLBACK;
        SET @errorNum = 0;
		SELECT @errorNum;
	END;
    
    IF EXISTS (SELECT id_usuario FROM usuario WHERE email_usuario = email) THEN
		SELECT -1 AS emailRepit;
	ELSE
		INSERT INTO usuario (
			nom_usuario,
            apel_usuario,
            email_usuario,
            pass_usuario,
            admin_usuario
        ) VALUES (
			nom,
			apels,
			email,
			MD5(pass),
			admin
        );
        
        SELECT 1 AS newUser;
    END IF;

END

CREATE PROCEDURE `sp_delete_usuario_by_id`(
	id INT
)
BEGIN

	DELETE FROM usuario
    WHERE id_usuario = id;
    
    SELECT 1 AS userDeleted;

END

CREATE PROCEDURE `sp_edit_usuario_by_id`(
	id INT,
    nom VARCHAR(45),
    apels VARCHAR(50),
    email VARCHAR(50),
    admin TINYINT(1)
)
BEGIN

	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		ROLLBACK;
        SET @errorNum = -1;
		SELECT @errorNum;
	END;
    
    SET @userExist = 0;
    SET @userEdit = 1;
    
	IF EXISTS (SELECT id_usuario FROM usuario WHERE email_usuario = email) THEN
		
        SET @idUser = (SELECT id_usuario FROM usuario WHERE email_usuario = email);
        IF (id = @idUser) THEN
			UPDATE usuario
            SET nom_usuario = nom, apel_usuario = apels, admin_usuario = admin
            WHERE id_usuario = id;
            SELECT @userEdit;
		ELSE
			SELECT @userExist;
        END IF;
        
	ELSE
		
        UPDATE usuario
        SET nom_usuario = nom, apel_usuario = apels, email_usuario = email, admin_usuario = admin
        WHERE id_usuario = id;
        SELECT @userEdit;
        
    END IF;

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
		SELECT -1 AS VACIO;
    END IF;
END

CREATE PROCEDURE `sp_get_all_usuario`()
BEGIN

	SELECT 
		id_usuario,
        nom_usuario,
        apel_usuario,
        email_usuario,
        admin_usuario
    FROM usuario;

END

CREATE PROCEDURE `sp_get_avance_proyecto_by_id`(num_p VARCHAR(50))
BEGIN

	SELECT 
		id_avance, num_proyecto, num_oficio, 
        fecha_avance, nombre_proyecto, actividad_proyecto, 
        tipo_actividad, beneficiario_proyecto, inversion_proyecto, 
        estado_proyecto, informe_avance
	FROM avance_proyecto
    WHERE num_proyecto = num_p;

END

CREATE PROCEDURE `sp_get_proyecto_by_id`(id VARCHAR(50))
BEGIN

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
	FROM proyecto
	WHERE num_proyecto = id;

END

CREATE PROCEDURE `sp_get_usuario_by_id`(id_user INT)
BEGIN

	SELECT
		id_usuario,
        nom_usuario,
        apel_usuario,
        email_usuario,
        admin_usuario
	FROM usuario
    WHERE id_usuario = id_user;
END

CREATE PROCEDURE `sp_login_usuario`(nombre_u VARCHAR(50), pass_u VARCHAR(50))
BEGIN	
	IF EXISTS (SELECT * FROM usuario WHERE (email_usuario = nombre_u) AND pass_usuario = MD5(pass_u))
    THEN
		SELECT id_usuario 
        FROM usuario 
        WHERE (email_usuario = nombre_u) AND pass_usuario = MD5(pass_u);
    END IF;
    SELECT 0;
END