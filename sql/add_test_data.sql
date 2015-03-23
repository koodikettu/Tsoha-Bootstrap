-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Asiakas (etunimi, sukunimi, nimimerkki, kayttajatunnus, salasana, syntymaaika, sukupuoli, katuosoite, postinumero, paikkakunta, haettu_ika_min, haettu_ika_max, haettu_sukupuoli, esittelyteksti) VALUES ('Antti','Virtanen','Pelimies','av_dude','123456','1988-05-12','M','Hämeentie 78 B 12','00260','Helsinki',20,30,'F','Olen iloinen ja reipas tietojenkäsittelytieteen opiskelija. Pidän kovasti tietokonepeleistä ja energiajuomista.');

INSERT INTO Asiakas (etunimi, sukunimi, nimimerkki, kayttajatunnus, salasana, syntymaaika, sukupuoli, katuosoite, postinumero, paikkakunta, haettu_ika_min, haettu_ika_max, haettu_sukupuoli, esittelyteksti) VALUES ('Minttu','Korhonen','Barbie','bb-mint','123456','1990-04-24','F','Helsinginkatu 21 C 5','00240','Helsinki',20,30,'M','Olen jazz-tanssia ja kuorolaulua harrastava matemaatikko.');

INSERT INTO Viesti (lahettaja, vastaanottaja, sisalto) VALUES (1,2,'Hei, haluaisitko lähetä keskiviikkoiltana kahville?');
INSERT INTO Viesti (lahettaja, vastaanottaja, sisalto) VALUES (2,1,'Hei, keskiviikko ei käy, miten olis torstai?');

INSERT INTO Esittelysivu (asiakasID, sisalto, salainen) VALUES (1,'En ole vielä keksinyt tähän mitään...', true);
INSERT INTO Esittelysivu (asiakasID, sisalto, salainen) VALUES (2,'Salainen paheeni on kettukarkit!',false);

INSERT INTO Esittelysivu (asiakasID, sisalto, salainen) VALUES (1, 'En tykkää yhtään mämmistä.',true);

INSERT INTO Lukuoikeus (sivuID, asiakasID) VALUES (3,2);

INSERT INTO Yllapitaja (kayttajatunnus, salasana) VALUES ('admin','anasalas');
