create database gestione_alloggi;

use gestione_alloggi;

create table utente(
	email varchar(30) primary key, 
    nome varchar(30) not null,
    cognome varchar(30) not null,
    password_utente varchar(20) not null,
    n_telefono varchar(20) not null
);

create table amministratore_gerente(
	email varchar(30) primary key, 
    nome varchar(30) not null,
    cognome varchar(30) not null,
    password_admin_gerente varchar(20) not null,
    n_telefono varchar(20) not null
);

create table amministratore(
	email varchar(30) primary key, 
    nome varchar(30) not null,
    cognome varchar(30) not null
);

create table parametro(
	id int primary key,
    perc_cliente decimal(5,2) not null,
    check (perc_cliente >= 0.00 and perc_cliente <= 100.00),
    perc_struttura decimal(5,2) not null,
    check (perc_struttura >= 0.00 and perc_struttura <= 100.00)
);

create table fattura(
	id int primary key,
    perc_parametro decimal(5,2) not null,
    check (perc_parametro >= 0.00 and perc_parametro <= 100.00),
    id_parametro int not null,
    foreign key(id_parametro) references parametro(id)
);

create table tipologia(
	nome varchar(30) primary key
);

create table alloggio(
	id int primary key,
	regione varchar(30) not null,
    citta varchar(30) not null,
    nome_gerente varchar(30) not null,
    foreign key(nome_gerente) references amministratore_gerente(nome)
);

