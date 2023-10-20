create database dnevnik_rada_psiholog;
CREATE TABLE `ucenik` (
`id_uc` int(4) auto_increment primary key, 
`ime` char(15) NOT NULL,  
`prezime` char(30) NOT NULL,
`oib` int(11) NOT NULL,  
`datum_rodenja` date NOT NULL,  
`adresa` char(30) NOT NULL,
`grad` char(15) NOT NULL,
`spol` enum('musko','zensko') NOT NULL,
`rjesenje` char(45) NOT NULL,
`klasa` char(45) NOT NULL
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `roditelj` (
`id_ro` int(4) auto_increment primary key, 
`ime` char(15) NOT NULL,  
`prezime` char(30) NOT NULL,
`telefon` char(11) NOT NULL
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `roditelj_dijete` (
`id_ro` int(4) NOT NULL, 
`id_uc` int(4) NOT NULL
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `razrednik` (
`id_ra` int(4) auto_increment primary key, 
`ime` char(15) NOT NULL,  
`prezime` char(30) NOT NULL,
`telefon` char(11) NOT NULL
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `razred` (
`id_raz` int(3) primary key auto_increment NOT NULL, 
`oznaka_raz` char(3) NOT NULL
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `sk_godina` (
`id_skgod` int(5) primary key auto_increment NOT NULL, 
`sk_godina` char(10) NOT NULL
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `ucenik_razred` (
`id_ra` int(20) NOT NULL, 
`id_uc` int(20) NOT NULL,  
`id_skgod` int(20) NOT NULL
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `korisnik` (
`id_ko` int(2) auto_increment primary key, 
`ime` char(15) NOT NULL,  
`prezime` char(30) NOT NULL,
`titula` char(30) NOT NULL,
`korisnicko_ime` char(30) NOT NULL,
`lozinka` char(30) NOT NULL
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `dnevnik_rada` (
`id_dr` int(4) auto_increment primary key, 
`id_ko` int(2) NOT NULL, 
`opis` text,
`datum_unosa` datetime NOT NULL DEFAULT NOW()
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `dosje_ucenika` (
`id_do` int(10) auto_increment primary key, 
`id_uc` int(5) NOT NULL, 
`id_ko` int(2) NOT NULL, 
`opis` text,
`datum_unosa` datetime NOT NULL 
) 
ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `ucenik` (`ime`, `prezime`, `oib`, `datum_rodenja`,  `adresa`, `grad`, `spol`, `rjesenje`, `klasa`) VALUES 
('Nikolina', 'Smilović', 123456789, '2015-04-12', 'Uska ulica 5', 'Split', 'zensko', 'rjesenje1', 'klasa1'),
('Mate', 'Balić', 123111789, '1990-12-21', 'Vukovarska 45', 'Split', 'musko', 'rjesenje1', 'klasa1'),
('Marija', 'Franković', 222456789, '1991-11-05', 'Muslimanska 2a', 'Split', 'zensko', 'rjesenje1', 'klasa1'),
('Nikola', 'Lozert', 444456789, '1990-02-08', 'Mostarska 231', 'Split', 'musko', 'rjesenje1', 'klasa1');

INSERT INTO `roditelj` (`ime`, `prezime`, `telefon`) VALUES 
('Ante', 'Smilović','0917894516'),
('Ana', 'Balić', '0971452631'),
('Karlo', 'Balić', '0971452622'),
('Josip', 'Franković', '0981472536'),
('Jelena', 'Franković', '0981472511'),
('Anđelka', 'Lozert', '0917418520');

INSERT INTO `roditelj_dijete` (`id_ro`,`id_uc`) VALUES 
(1,1),(2,2),(3,2),(4,3),(5,3),(6,4);

INSERT INTO `razrednik` (`ime`, `prezime`, `telefon`) VALUES
('Nikolina', 'Smilović','0917894516'),
('Tomislav', 'Jukić', '0971452631'),
('Duška', 'Boban', '0971452622'),
('Nives', 'Škero', '0981472536'),
('Martina', 'Javorčić', '0981472511'),
('Jelena', 'Gluić', '0917418520');

INSERT INTO `razred` (`oznaka_raz`) VALUES
('g1m'),('g2m'),('g3m'),('g4m'),('g1b'),('g2b'),('g3b'),('g4b'),('g1a'),('g2a'),('g3a'),('g4a');

INSERT INTO `sk_godina` (`sk_godina`) VALUES
('15/16'),('16/17'),('17/18');

INSERT INTO `ucenik_razred` (`id_ra`, `id_uc`, `id_skgod`) VALUES 
(1, 1, 1),(1, 2, 1),(1, 3, 1),(2, 1, 2),(2, 2, 2),(2, 3, 2),(3, 4, 2),(3, 5, 2),(3, 6, 2);

INSERT INTO `korisnik` (`ime`, `prezime`, `titula`, `korisnicko_ime`, `lozinka`) VALUES 
('Antonija','Basic','pedagog','pedagog','pedagog'),('Natasa','Baras-Burilovic','psiholog','psiholog','psiholog');

INSERT INTO `dnevnik_rada` (`id_ko`, `opis`, `datum_unosa`) VALUES 
(1,'Dojava o bombi','2017-03-15 15:45'),(1,'Policija zaprimila izvještaj','2017-03-15 16:10'),(2,'Pronašli krivca: Ante Antic','2017-03-15 17:20');

INSERT INTO `dosje_ucenika` (`id_uc`, `id_ko`, `opis`, `datum_unosa`) VALUES 
(2,2,'Ima mokraćnih problema','2017-03-15 15:45'),(2,1,'Donio nalaze','2017-03-15 15:45'),(3,1,'Zelucane tegobe','2017-03-15 15:45');

