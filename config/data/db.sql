
USE `VOL`;
DROP TABLE IF EXISTS `PASSAGER`;
CREATE TABLE `PASSAGER`(
   `id_passager` INT(10) NOT NULL AUTO_INCREMENT,
   `nom` VARCHAR(128) NOT NULL,
   `prenom` VARCHAR(128) NOT NULL,
   `age` VARCHAR(128) NOT NULL,
   `email` VARCHAR(128) NOT NULL,
   `ville` VARCHAR(128) NOT NULL,
   PRIMARY KEY(`id_passager`)
)ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `BILLET`;
CREATE TABLE `BILLET`(
   `numeroBillet` INT(10) NOT NULL AUTO_INCREMENT,
   `dateDepart` DATE NOT NULL,
   `numeroPassager` INT(10) NOT NULL,
   `prix` DOUBLE NOT NULL,
   `id_passager_fk` INT(10) NOT NULL,
   PRIMARY KEY(`numeroBillet`),
   FOREIGN KEY(`id_passager_fk`) REFERENCES PASSAGER(`id_passager`)
)ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `PASSAGER` ( `nom`, `prenom`, `age`, `email`, `ville`) VALUES
('Amath', 'Fils', '26', 'Amath@gmail.fr', 'paris'),
('Martin', 'Bernard', '22', 'Martin@gmail.fr', 'paris'),
('Thomas', 'Petit', '41', 'Petit@gmail.fr', 'paris'),
('Petit', 'Robert', '15', 'Robert@gmail.fr', 'paris'),
('Richard', 'Durand', '18', 'Durand@gmail.fr', 'paris'),
('Dubois', 'Dur', '18', 'Dubois@gmail.fr', 'paris'),
('Duval', 'Mike', '25', 'Mike@gmail.fr', 'paris');

INSERT INTO `BILLET` ( `dateDepart`, `numeroPassager`, `prix`, `id_passager_fk`) VALUES
('2022-05-06', 156622, 128.5, 3),
('2022-05-11', 556222, 111, 8),
('2022-05-11', 5456, 100, 4),
('2022-05-11', 8888, 200, 5),
('2022-05-11', 1155, 20, 6),
('2022-05-11', 5554, 0, 7),
('2022-04-20', 4856, 55, 9);