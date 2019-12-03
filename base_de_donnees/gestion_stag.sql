    drop database if exists gestion_stag;
	create database if not exists gestion_stag;
	   use gestion_stag;

		create table filiere(
			idFiliere int(4) auto_increment primary key,
    		nomFiliere varchar(50),
    		niveau varchar(50)
			);
		create table stagiaire(
			idStagiaire int(4) auto_increment primary key,
    		nom varchar(50),
    		prenom varchar(50),
    		civilite varchar(1),
    		photo varchar(100),
    		idFiliere int(4)
			);
    create table utilisateur(
        	iduser int(4) auto_increment primary key,
    		login varchar(50),
    		email varchar(255),
    		role varchar(50),
    		etat int(1),
    		pwd varchar(255)
    	);
    Alter table stagiaire add constraint fk1 foreign key(idFiliere) references filiere(idFiliere);