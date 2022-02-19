CREATE DATABASE diario;
use diario;

CREATE TABLE categorias (
	id INT AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL,
    CONSTRAINT categorias_pk PRIMARY KEY (id)
);
 
CREATE TABLE usuarios (
	id INT AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    login VARCHAR(15) NOT NULL,
    senha VARCHAR(45) NOT NULL,
    CONSTRAINT usuarios_pk PRIMARY KEY (id)
);

CREATE TABLE pensamentos (
	id INT AUTO_INCREMENT,
    pensamento VARCHAR(1000) NOT NULL,
    created_at DATETIME NOT NULL,
    categoria_id INT NOT NULL,
    usuario_id INT NOT NULL,
    CONSTRAINT pensamentos_pk PRIMARY KEY (id),
    CONSTRAINT categorias_fk FOREIGN KEY (categoria_id)
		REFERENCES categorias(id),
	CONSTRAINT usuarios_fk FOREIGN KEY (usuario_id)
		REFERENCES usuarios(id)
);

INSERT INTO categorias (nome) VALUES ("Sonhos");
INSERT INTO categorias (nome) VALUES ("Romance");
INSERT INTO categorias (nome) VALUES ("Viagens");
INSERT INTO categorias (nome) VALUES ("Fofocas");
INSERT INTO categorias (nome) VALUES ("Relatório");

SELECT * from usuarios;
DELETE from usuarios;
SELECT * from categorias;
DELETE from categorias;
SELECT * from pensamentos;
DESC pensamentos;
DESC categorias;
DESC usuarios;
