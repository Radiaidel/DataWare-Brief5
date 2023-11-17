CREATE DATABASE dataware;

use dataware;

create table equipe(
id_equipe int PRIMARY KEY,
    nom_equipe varchar(50),
    date_creation date,
);

INSERT into equipe VALUES (1,'Front-end' , NOW()),
(2,'Back-end' , NOW()),
(3,'DevOps' , NOW()),
(4,'QA' , NOW()),
(5,'UX/UI ' , NOW()),
(6,'Gestion de Projet' , NOW()),
(8,'Support Technique' , NOW());



create table membre(
	id_membre int PRIMARY KEY,
    nom_membre varchar(50),
    prenom_membre varchar(50),
    email varchar(50) UNIQUE,
    telephone varchar(20),
    role varchar(50),
    status_membre varchar(50),
    id_equipe int,
    FOREIGN KEY (id_equipe) REFERENCES equipe(id_equipe)
);



INSERT INTO `membre`(`id_membre`, `nom_membre`, `prenom_membre`, `email`, `telephone`, `role`, `status_membre`, `id_equipe`) VALUES (1,'Jean', 'Dupont' , 'jean.dupont@email.com', '0634567890','developpeur front-end','Actif',1);
INSERT INTO `membre`(`id_membre`, `nom_membre`, `prenom_membre`, `email`, `telephone`, `role`, `status_membre`, `id_equipe`) VALUES (2,'Marie', 'Martin' , 'marie.martin@email.com', '0634567890','Développeuse Back-end','Actif',2)

INSERT INTO `membre`(`id_membre`, `nom_membre`, `prenom_membre`, `email`, `telephone`, `role`, `status_membre`, `id_equipe`) VALUES (3,' Ahmed', 'Khan' , 'ahmed.khan@email.com', '0634567890','Ingénieur DevOps','Actif',3);

INSERT INTO `membre`(`id_membre`, `nom_membre`, `prenom_membre`, `email`, `telephone`, `role`, `status_membre`, `id_equipe`) VALUES (4,' Laura', 'Garcia' , 'laura.garcia@email.com', '0634567890','Chef d\'équipe','Actif',4);

INSERT INTO `membre`(`id_membre`, `nom_membre`, `prenom_membre`, `email`, `telephone`, `role`, `status_membre`, `id_equipe`) VALUES (5,' Alex', 'Chen' , 'alex.chen@email.com', '0634567890','Chef d\'équipe','Actif',5);

INSERT INTO `membre`(`id_membre`, `nom_membre`, `prenom_membre`, `email`, `telephone`, `role`, `status_membre`, `id_equipe`) VALUES (6,' Vincent', 'Lambert' , 'vincent.lambert@email.com', '0634567890','Chef de Projet','Actif',6);

INSERT INTO `membre`(`id_membre`, `nom_membre`, `prenom_membre`, `email`, `telephone`, `role`, `status_membre`, `id_equipe`) VALUES (7,' Emily', 'Brown' , 'emily.brown@email.com', '0634567890',' Chef d\'équipe','Actif',8);






