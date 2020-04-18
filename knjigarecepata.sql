drop database if exists KnjigaRecepata;
create database KnjigaRecepata default character set utf8;
#c:\xampp\mysql\bin\mysql.exe -uivor -pivor --default_character_set=utf8 < d:\Programiranje\MamineSlastice\mamineslastice.tenja.hr\knjigarecepata.sql
use KnjigaRecepata;



create table operater(
    operater_ID int not null primary key auto_increment,
    email       varchar(50) not null,
    lozinka     char(60) not null,
    ime         varchar(50) not null,
    prezime     varchar(50) not null,
    uloga       varchar(20) not null,
    kategorija int,
    aktivan     boolean not null default false,
    sessionid   varchar(100)
);
insert into operater values 
(null,'ivorcelic@gmail.com',
'$2y$10$8iHyMHuBvpA.10UgKgT4Zu.RjbKobwE6Jzi2doUrlJZcdyS8DZrGi',
'Ivor','Ćelić','admin', null, true, null);
insert into operater values 
(null,'mirela@gmail.com',
'$2y$10$BB4/./Z8JIhRlvlmFkK2bOtNrfhnve/8zj6TxxKVQE5cfJYkfPwzW',
'Mirela','Skoko Ćelić','korisnik', null, true, null);



create table kategorija (
    kategorija_ID           int not null primary key auto_increment,
    nadredena_kategorija    int,
    naziv                   varchar(100) not null
);

create table recept (
    recept_ID       int not null primary key auto_increment,
    kategorija      int not null,
    naziv           varchar(100) not null,
    priprema        text,
    slika           varchar(255)
);

create table sastojak (
    sastojak_ID int not null primary key auto_increment,
    naziv       varchar(20)
);

create table recept_sastojak (
    recept_sastojak_ID int not null primary key auto_increment,
    recept              int not null,
    sastojak            int not null,
    kolicina            varchar(50)
);

create table komentar (
    komentar_ID         int not null primary key auto_increment,
    nadredeni_komentar  int not null,
    recept              int not null
);


alter table operater add foreign key (kategorija) references kategorija (kategorija_ID);

alter table kategorija add foreign key (nadredena_kategorija) references kategorija (kategorija_ID);

alter table recept add foreign key (kategorija) references kategorija (kategorija_ID);

alter table recept_sastojak add foreign key (recept) references recept (recept_ID);
alter table recept_sastojak add foreign key (sastojak) references sastojak (sastojak_ID);

alter table komentar add foreign key (recept) references recept (recept_ID);
alter table komentar add foreign key (nadredeni_komentar) references komentar (komentar_ID);



# 1-25
insert into kategorija (kategorija_ID, nadredena_kategorija, naziv) values
    # Kategorije
    (null, null, 'Slana jela'), #-1
    (null, null, 'Slatka jela'), #-2
    (null, 1, 'Topla predjela'), #-3
    (null, 1, 'Hladna predjela'), #-4
    (null, 1, 'Glavna jela'), #-5
    (null, 2, 'Torte'), #-6
    (null, 2, 'Kolači'), #-7
    (null, 5, 'Jela od mesa'), #-8
    (null, 5, 'Jela od tijesta'), #-9
    (null, 5, 'Jela od ribe'); #-10


# 1-11
insert into recept (recept_ID, kategorija, naziv) values
    # Hladna predjela
    (null, 4, 'Francuska salata'), #-1
    (null, 4, 'Salata sa feta sirom'), #-2
    (null, 4, 'Salate s krastavcima'), #-3
    (null, 4, 'Šopska salata'), #-4
    (null, 4, 'Salata od krompira'), #-5
    # Jela od mesa
    (null, 8, 'Carsko meso sa zapečenim mlincima'), #-6
    (null, 8, 'Teleće meso sa zapečenim krompirom'), #-7
    # Jela od tijesta
    (null, 9, 'Lasagne bolognese'), #-8
    (null, 9, 'Spaghetti bolognese'), #-9
        # Jela od ribe
    (null, 10, 'Marinirana riba na gradele'), #-10
    (null, 10, 'Bijela riba s umakom od naranče i povrćem'); #-11


# 1-10
insert into sastojak (sastojak_ID, naziv) values
    (null, 'grašak'), #-1
    (null, 'mrkva'), #-2
    (null, 'krumpir'), #-3
    (null, 'kiseli krastavci'), #-4
    (null, 'sol'), #-5
    (null, 'majoneza'), #-6
    (null, 'jabuka'), #-7
    (null, 'kiselo vrhnje'), #-8
    (null, 'senf'), #-9
    (null, 'crni papar'); #-10


# 1-10
insert into recept_sastojak (recept_sastojak_ID, recept, sastojak, kolicina) values
    # Francuska salata
    (null, 1, 1, '225 g'), #-1
    (null, 1, 2, '225 g'), #-2
    (null, 1, 3, '300 g'), #-3
    (null, 1, 4, '200 g'), #-4
    (null, 1, 5, null), #-5
    (null, 1, 6, '360 g'), #-6
    (null, 1, 7, '1/4'), #-7
    (null, 1, 8, '2 žlice'), #-8
    (null, 1, 9, '1 žličica'), #-9
    (null, 1, 10, null); #-10



