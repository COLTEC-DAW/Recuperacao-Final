SELECT * FROM pensamentos;
USE daw;

CREATE TABLE usuarios(
	id INT AUTO_INCREMENT,
	nome VARCHAR(50) NOT NULL,
	usuario VARCHAR(10) NOT NULL,
	senha VARCHAR(45) NOT NULL,
	PRIMARY KEY(id)	
);

CREATE TABLE categorias(
	id INT AUTO_INCREMENT,
	tipo VARCHAR(45) NOT NULL,
	PRIMARY KEY(id)	
);

CREATE TABLE pensamentos(
	id INT AUTO_INCREMENT,
	pensamento VARCHAR(1000) NOT NULL,
    criado_em DATETIME NOT NULL,
    categorias_id INT ,
	usuarios_id INT,
    
    PRIMARY KEY(id),
    CONSTRAINT pensamentos_categorias_fk FOREIGN KEY(categorias_id)
		REFERENCES categorias (id),
	CONSTRAINT pensamentos_usuarios_fk FOREIGN KEY(usuarios_id)
		REFERENCES usuarios(id)
);