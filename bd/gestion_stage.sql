create database if not exists gestion_stage;
use gestion_stage;

create table filieres(
    idfilieres int(4) auto_increment primary key,
    nomFiliere varchar(50),
    niveau varchar(50)
);

create table stagiaires(
    idstagiaire int(4) auto_increment primary key,
    nom varchar(50),
    prenom varchar(50),
    civilite varchar(1),
    photo varchar(100),
    idfilieres int(4)
    );

create table utilisateurs(
    idutilisateur int(4) auto_increment primary key,
    login varchar(50),
    email varchar(255),
    role varchar(50),
    etat int(1),
    psswd varchar(255)
);

alter table stagiaires add constraint fk1 foreign key(idfilieres) references filieres(idfilieres);

use gestion_stage;

insert into filieres(nomFiliere,niveau) values
('TSD1','TS'),
('TSGE','TS'),
('TG1','T'),
('TSRI','TSR'),
('TCE','TE');

insert into utilisateurs(login,email,role,etat,psswd) values
('admin','mechackmutokabulambo@gmail.com','ADMIN',1, md5('123')),
('user1','maxinisse@gmail.com','VISITEUR',0, md5('123')),
('user2','mutoka@gmail.com','VISITEUR',1, md5('123'));

insert into stagiaires(nom,prenom,civilite,photo,idfilieres) values
('MUTOKA','Mechack','M','mechack.jpg',1),
('MUTOKA','Eben','M','eben.jpg',2),
('NGALIMA','Lor','F','lor.jpg',3),
('KITO','Rachel','F','rachel.jpg',1),
('ABALA','Jemima','F','jemima.jpg',2),
('CASIMIR','Richeman','M','richman.jpg',3),

('ILOMBE','Chris','M','chris.jpg',1),
('MUTOKA','Maguy','F','maguy.jpg',2),
('KUNGWA','Lea','F','lea.jpg',3),
('NGALIMA','Pierrette','F','pierrette.jpg',1),
('WITANGILA','Michael','M','michael.jpg',2),
('KYALUMBA','Micheline','F','micheline.jpg',3),

('WITANGILA','ReneOscar','M','reneoscar.jpg',1),
('MUBUMBI','Elue','M','elu.jpg',2),
('KYALUMBA','Gracia','F','gracia.jpg',3),
('MUTOKA','Melissa','F','melissa.jpg',1),
('KYALUMBA','Madali','F','madali.jpg',2),
('KYALUMBA','Estha','F','estha.jpg',3);
