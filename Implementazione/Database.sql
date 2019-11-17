create database if not exists efof_i16lazmat;

use efof_i16lazmat;

create table utente(
	email varchar(30) primary key, 
    nome varchar(30) not null,
    cognome varchar(30) not null,
    password_utente varchar(255) not null,
    n_telefono varchar(20) not null,
    hash varchar(255) not null,
    is_active int(1) default 0
);

create table amministratore_gerente(
	email varchar(30) primary key, 
    nome varchar(30) not null,
    cognome varchar(30) not null,
    password_admin_gerente varchar(255) not null,
    n_telefono varchar(20) not null,
    hash varchar(255) not null,
    is_active int(1) default 0
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
    email_utente varchar(30) not null,
    foreign key(id_parametro) references parametro(id),
    foreign key(email_utente) references utente(email)
);

create table tipologia(
	nome varchar(30) primary key
);

create table alloggio(
	id int primary key auto_increment,
    nome varchar(50) not null,
    indirizzo varchar(255) not null,
    link_immagine text not null,
	regione varchar(50) not null,
    citta varchar(50) not null,
    email_gerente varchar(50) not null,
    nome_tipologia varchar(50) not null,
    foreign key(email_gerente) references amministratore_gerente(email),
    foreign key(nome_tipologia) references tipologia(nome)
);

insert into tipologia values ("Albergo");
insert into tipologia values ("Bed & Breakfast");
insert into tipologia values ("Camping");

insert into amministratore_gerente values ("mattia.lazzaroni@samtrevano.ch", "Mattia", "Lazzaroni", "$2y$10$UwB.V5xhQAxhXRKZycFydeTtbs9j9AlSSvyWO0ZPla5vwTgTtyOqC", "+41764650110", "807685d729e35ac6862a94c069eb68b2", 1);

insert into amministratore values ("mattia.lazzaroni@samtrevano.ch", "Mattia", "Lazzaroni");

SET NAMES 'utf8';
SET CHARACTER SET utf8;

insert into alloggio values (1,
 "Hotel Fergus Geminis",
 "Carrer dels Tamarells, s/n, 07600 Palma, Illes Balears, Spain",
 "https://www.fergushotels.com/backoffice/images/1405-building-andpool.jpg",
 "Isole Baleari",
 "Palma di Maiorca",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Albergo")
);
insert into alloggio values (2,
 "Alla Galleria B&B",
 "Via Antonio Cantore, 4, 37121 Verona VR, Italy",
 "http://alla-galleria-bb.verona-hotel.org/data/Photos/767x460/5377/537700/537700563.JPEG",
 "Veneto",
 "Verona",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Bed & Breakfast")
);
insert into alloggio values (3,
 "Keswick Camping and Caravanning Club Site",
 "Crow Park Rd, Keswick CA12 5EP, UK",
 "https://mb.cision.com/Public/6265/9664585/b695f780fd664e45_800x800ar.jpg",
 "North West",
 "Keswick",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Camping")
);
insert into alloggio values (4,
 "The Temple House",
 "No. 81 Bitieshi Street, Jinjiang District, Chengdu, China 610021",
 "https://cdn-image.travelandleisure.com/sites/default/files/1558447972/temple-house-chengdu-china-96-BESTHOTELSWB19.jpg",
 "Sichuan",
 "Chengdu",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Albergo")
);
insert into alloggio values (5,
 "Borgo Egnazia",
 "Strada Comunale Egnazia, 72015 Savelletri, Fasano BR, Italy",
 "https://cdn-image.travelandleisure.com/sites/default/files/1558447972/borgo-egnazia-italy-98a-BESTHOTELSWB19.jpg",
 "Puglia",
 "Savelletri",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Albergo")
);
insert into alloggio values (6,
 "Belmond La Résidence Phou Vao",
 "Lao PDR, Luang Prabang 84330, Laos",
 "https://cdn-image.travelandleisure.com/sites/default/files/1558447972/belmond-la-residence-phou-vao-laos-91-BESTHOTELSWB19.jpg",
 "Luang Prabang",
 "Luang Prabang",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Albergo")
);
insert into alloggio values (7,
 "Le Meurice",
 "228 Rue de Rivoli, 75001 Paris, France",
 "https://cdn-image.travelandleisure.com/sites/default/files/le-meurice-paris-france-replacement-89-besthotelswb19.jpg",
 "Île-de-France",
 "Paris",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Albergo")
);
insert into alloggio values (8,
 "Post Ranch Inn",
 "47900 CA-1, Big Sur, CA 93920, United States",
 "https://cdn-image.travelandleisure.com/sites/default/files/1558447352/post-ranch-inn-california-84-BESTHOTELSWB19.jpg",
 "California",
 "Big Sur",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Albergo")
);
insert into alloggio values (9,
 "Triple Creek Ranch",
 "5551 W Fork Rd, Darby, MT 59829, United States",
 "https://cdn-image.travelandleisure.com/sites/default/files/1558447352/triple-creek-ranch-montana-79-BESTHOTELSWB19.jpg",
 "Montana",
 "Darby",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Albergo")
);
insert into alloggio values (10,
 "Katikies Hotel",
 "Nik. Nomikou (Main Street), Oía 847 02, Greece",
 "https://cdn-image.travelandleisure.com/sites/default/files/1558447352/katikies-hotel-greece-78-BESTHOTELSWB19.jpg",
 "South Aegean",
 "Oia",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Albergo")
);
insert into alloggio values (11,
 "Carson Ridge Luxury Cabins",
 "1261 Wind River Hwy, Carson, WA 98610, United States",
 "https://www.bedandbreakfast.com/files/live/sites/bnbus/files/shared/Inns/luxurious/1170x450_carson-ridge-luxury-cabins.jpg",
 "Washington",
 "Carson",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Bed & Breakfast")
);
insert into alloggio values (12,
 "Chestnut Hill Bed & Breakfast",
 "236 Caroline St, Orange, VA 22960, United States",
 "https://www.bedandbreakfast.com/files/live/sites/bnbus/files/shared/Inns/luxurious/1170x450_chestnut-hill.jpg",
 "Virginia",
 "Orange",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Bed & Breakfast")
);
insert into alloggio values (13,
 "Old Monterey Inn",
 "500 Martin St, Monterey, CA 93940, United States",
 "https://www.bedandbreakfast.com/files/live/sites/bnbus/files/shared/Inns/luxurious/1170x450_old-monterey.jpg",
 "California",
 "Monterey",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Bed & Breakfast")
);
insert into alloggio values (14,
 "Port d'Hiver Bed and Breakfast",
 "201 Ocean Ave, Melbourne Beach, FL 32951, United States",
 "https://www.bedandbreakfast.com/files/live/sites/bnbus/files/shared/Inns/luxurious/1170x450_port-dhiver.jpg",
 "Florida",
 "Melbourne",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Bed & Breakfast")
);
insert into alloggio values (15,
 "Camping La Pointe",
 "Camping La Pointe route de Saint Coulitz, 29150 Chateaulin, France",
 "https://i.guim.co.uk/img/media/569fa7ab4ab731d3330e0ab40415478a2256561c/5_0_2010_1206/master/2010.jpg?width=620&quality=45&auto=format&fit=max&dpr=2&s=52447bfcc60b2e02bef61e38e8512a3d",
 "Brittany",
 "Chateaulin",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Camping")
);
insert into alloggio values (16,
 "D’Olde Kamp",
 "Dwingelerweg 26, 7964 KK Ansen, Netherlands",
 "https://i.guim.co.uk/img/media/a9938ee548da93e7230c443c11b5f75557aed6f7/0_219_2048_1229/master/2048.jpg?width=620&quality=45&auto=format&fit=max&dpr=2&s=cddc6e6934d8cec1b56f4b25e1fa964f",
 "Drenthe",
 "Ansen",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Camping")
);
insert into alloggio values (17,
 "Camping Lindenhof",
 "Mörigenweg 2, 2572 Sutz-Lattrigen",
 "https://i.guim.co.uk/img/media/ca9e503799d408706e15f0130ad29065a136ba27/0_192_2560_1536/master/2560.jpg?width=620&quality=45&auto=format&fit=max&dpr=2&s=a8bd56d5fc4445f2b331d49949c9df27",
 "Bern",
 "Sutz-Lattrigen",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Camping")
);
insert into alloggio values (18,
 "Camping agritourism Karst",
 "Località Aurisina Cave, 55, 34011 Duino-Aurisina TS, Italy",
 "https://i.guim.co.uk/img/media/848f5804f0a85df0e2abc3433f0fa86deb08b315/0_97_960_576/master/960.jpg?width=620&quality=45&auto=format&fit=max&dpr=2&s=3216794549f1237cd02e26bfad1dab6a",
 "Friuli-Venezia Giulia",
 "Duino-Aurisina",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Camping")
);
insert into alloggio values (19,
 "Camp Vala",
 "20250, Postup, Croatia",
 "https://i.guim.co.uk/img/media/d2bbebf188b02f7f58076e1ce9b466660fd42557/25_0_750_450/master/750.jpg?width=620&quality=45&auto=format&fit=max&dpr=2&s=515dc49040d38b1d47a47bc88a30cba0",
 "Postup",
 "Mokalo",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Camping")
);
insert into alloggio values (20,
 "Camping Camino de Santiago",
 "Camping Camino de Santiago, 09110 Castrojeriz, Burgos, Spain",
 "https://i.guim.co.uk/img/media/9eb333ef82b241edae906dcf407f232a02c2e679/0_126_5424_3255/master/5424.jpg?width=620&quality=45&auto=format&fit=max&dpr=2&s=af277c60be60b9fe01ec315e0a840271",
 "Castile and Leon",
 "Burgos",
 (select email from amministratore_gerente where email = "mattia.lazzaroni@samtrevano.ch"),
 (select nome from tipologia where nome = "Camping")
);











