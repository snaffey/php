create database if not exists bleet;
use bleet;

create table if not exists socio(
    id int(11) primary key auto_increment,
    nome varchar(80) not null,
    email varchar(255) not null,
    username varchar(80) unique not null,
    password varchar(255) not null,
    associacaoId int(11) not null,
    permissions longtext not null
);

# super admin
# user admin password admin
INSERT INTO bleet.socio (id, nome, email, username, password, associacaoId, permissions) VALUES (1, 'admin', 'admin@gmail.com', 'admin', '$2y$10$ADvvtOMd5hmYGrj0slrcWuCFWh8x2Xnh2pnYu1N.jCGrublDL7GOK', 0, 'a:2:{i:0;s:3:"Any";i:1;s:10:"Superadmin";}');

create table if not exists loginTokens(
    id int(11) primary key auto_increment,
    socioId int(11) not null,
    token varchar(255) unique not null
);


create table if not exists associacao(
    id int(11) primary key auto_increment,
    nome varchar(80) not null,
    morada varchar(255) not null,
    telefone varchar(15) not null,
    nContribuinte varchar(10) not null
);

create table if not exists imagensAssociacao(
    id int(11) primary key auto_increment,
    caminho varchar(255) not null,
    associacaoId int(11) not null
);

create table if not exists noticias(
    id int(11) primary key auto_increment,
    titulo varchar(120) not null,
    conteudo varchar(255) not null,
    caminhoImg varchar(255) not null,
    associacaoId int(11) not null
);

create table if not exists eventos(
    id int(11) primary key auto_increment,
    titulo varchar(120) not null,
    conteudo varchar(255) not null,
    associacaoId int(11) not null,
    data datetime not null
);

create table if not exists sendemaillist(
    id int(11) primary key auto_increment,
    data datetime not null,
    #Guarda um Objeto Email Serializado
    email varchar(255) not null
);

create table if not exists eventoInscricoes(
    id int(11) primary key auto_increment,
    eventoId int(11) not null,
    socioId int(11) not null
);

create table if not exists quotas(
    id int(11) primary key auto_increment,
    socioId int(11) not null,
    dataComeco date not null,
    dataTermino date not null,
    preco int(4) not null,
    # active | inactive
    status varchar(12) not null
);

create table if not exists notificacoes(
    id int(11) primary key auto_increment,
    socioId int(11) not null,
    # Guarda um objeto Notificação serializado
    conteudo varchar(255) not null
);

create table if not exists noticiasGostos(
    id int(11) primary key auto_increment,
    noticiaId int(11) not null,
    socioId int(11) not null
);
