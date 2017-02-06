ALTER TABLE `hint` CHANGE `indication` `type` ENUM("text","url") CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL;

insert into place(name,lat, lng, indication) 
		values ('Paris','48.862725','2.287592000000018','La ville lumière'),
        ('Metz','49.1193089','6.1757155999999895','Ancienne capitale de la Lorraine'),
        ('Château de Versailles','48.804865','2.120355','Elle fut la résidence de Louis XIV'),
        ('Belfort','47.639674','6.863849','Monument du lion'),
        ('Dijon','47.322047','5.041479999999979','La moutarde');

INSERT INTO `destination` (`id`, `name`, `lng`, `lat`) VALUES (NULL, 'Toulouse', '1.450488', '43.607489');
INSERT INTO `destination` (`id`, `name`, `lng`, `lat`) VALUES (NULL, 'Le havre', '0.121646', '49.527592');
INSERT INTO `destination` (`name`, `lng`, `lat`) VALUES ('Le Mont Saint Michel','-1.5120517','48.6360033');                                           
INSERT INTO `destination` (`name`, `lng`, `lat`) VALUES ('Disneyland Paris','2.7736192','48.8722344');


INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Commune du du Sud-Ouest de France', 'text', '1');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Basilique Saint-Sernin', 'text', '1');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Université Paul Sabatier', 'text', '1');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'La ville rose', 'text', '1');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'la quatrième commune la plus peuplée de France', 'text', '1');


INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Située sur la rive droite de l''estuaire de la Seine', 'text', '2');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Son port est le deuxième de France pour le trafic total, et le premier port français pour les conteneurs.', 'text', '2');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Musée d''art moderne André-Malraux', 'text', '2');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Saint Thomas Basket', 'text', '2');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, '../api/img/blason_le_havre.png', 'url', '2');

INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'apparaît comme une montagne circulaire qui semble s’affaisser sous la pyramide monumentale qui la couronne', 'text', '3');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'le site touristique le plus fréquenté de Normandie', 'text', '3');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Montois', 'text', '3');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Normandie', 'text', '3');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Le Mont était rattaché depuis l\'époque de Charlemagne au diocèse d\'Avranches', 'text', '3');

INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'complexe touristique et urbain ', 'text', '4');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, '../img/Mickey_Mouse', 'img', '4');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, '../img/Walt_Disney', 'img', '4');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'attraction', 'text', '4');
INSERT INTO `hint` (`id`, `value`, `type`, `id_destination`) VALUES (NULL, 'Le Château de la Belle au bois dormant,', 'text', '4');

INSERT INTO `place` (`id`, `lng`, `lat`, `indication`) VALUES
(NULL, 'Nice', '7.266555', '43.716896', 'Château de Valrose'),
(NULL, 'Strasbourg', '7.753173', '48.580887', 'Palais Rohan'),
(NULL, 'Le Havre', '0.103315', '49.485045', 'Musée d''art moderne André Malraux'),
(NULL, 'Limoges', '1.265599', '45.860447', 'Parc de l''Aurence'),
(NULL, 'Dijon', '5.069667', '47.311461', 'Université de Bourgogne'),
(NULL, 'Lille', '3.069648', '50.640208', 'Notre Dame de la Treille'),
(NULL, 'Calais', '1.865608', '50.966423', 'Port de Calais');
INSERT INTO `place`(`name`, `lng`, `lat`, `indication`) VALUES  
('Le Mont-Saint-Michel','-1.5462265','48.6244853','Le Mont-Saint-Michel est une commune française située dans le département de la Manche en Normandie'),
('Côte d\'Azur','5.3996418','43.3840896','La Côte d’Azur est la partie orientale du littoral méditerranéen français et inclut la côte monégasque');


INSERT INTO `destination` (`name`, `lng`, `lat`) VALUES 
('Le Mont Saint Michel','-1.5120517','48.6360033'),                                               
('Disneyland Paris','2.7736192','48.8722344');
