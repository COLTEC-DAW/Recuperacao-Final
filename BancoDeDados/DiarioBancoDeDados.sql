/*database*/
use diarioDATA;

/*criação das tabelas*/
create table usuarios(
	id int auto_increment,
    nome varchar(50) not null,
    login varchar(10) not null,
    senha varchar(45) not null,
    
    constraint usuarios_pk primary key(id)
);

create table categorias(
	id int auto_increment,
    nome varchar(45) not null,
    
    constraint categorias_pk primary key(id)
);

create table pensamentos(
	id int auto_increment,
    pensamento varchar(1000) not null,
    criado_em datetime not null,
    categorias_id int not null,
    usuarios_id int not null,
    
    constraint pensamentos_pk primary key(id),
    constraint pensamentos_categorias_fk foreign key (categorias_id) references categorias(id),
    constraint pensamentos_usuarios_fk foreign key (usuarios_id) references usuarios(id)
);