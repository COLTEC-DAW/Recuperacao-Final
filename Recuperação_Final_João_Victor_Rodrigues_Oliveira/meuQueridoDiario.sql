CREATE DATABASE MeuQueridoDiario;
USE MeuQueridoDiario;

CREATE TABLE usuarios(
	id INT,
    nome VARCHAR(50) NOT NULL,
    login VARCHAR(10) NOT NULL,
    senha VARCHAR(45) NOT NULL,
    
    CONSTRAINT usuarios_pk PRIMARY KEY(id),
    CONSTRAINT usuarios_un UNIQUE (login)
);

CREATE TABLE categorias(
	id INT,
    nome VARCHAR(45) NOT NULL,
    
    CONSTRAINT categorias_pk PRIMARY KEY(id) 
);

CREATE TABLE pensamentos(
	id INT,
    pensamento VARCHAR(1000) NOT NULL,
    criado_em DATETIME NOT NULL,
    categorias_id INT NOT NULL,
    usuarios_id INT NOT NULL,
    
    CONSTRAINT pensamentos_pk PRIMARY KEY(id),
    CONSTRAINT pensamentos_categorias_fk FOREIGN KEY(categorias_id)
		REFERENCES categorias(id),
	CONSTRAINT pensamentos_usuarios_fk FOREIGN KEY(usuarios_id)
		REFERENCES usuarios(id)
);

INSERT INTO categorias VALUES (0, "Pessoal");
INSERT INTO categorias VALUES (1, "Família");
INSERT INTO categorias VALUES (2, "Trabalho");
INSERT INTO categorias VALUES (3, "Sem categoria");