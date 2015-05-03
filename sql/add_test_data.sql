-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Asiakas (etunimi, sukunimi, nimimerkki, kayttajatunnus, salasana, syntymaaika, sukupuoli, katuosoite, postinumero, paikkakunta, haettu_ika_min, haettu_ika_max, haettu_sukupuoli, esittelyteksti) VALUES ('Antti','Virtanen','Pelimies','av_dude','123456','1988-05-12','M','Hämeentie 78 B 12','00260','Helsinki',1985, 1995,'F','Olen iloinen ja reipas tietojenkäsittelytieteen opiskelija. Pidän kovasti tietokonepeleistä ja energiajuomista.');

INSERT INTO Asiakas (etunimi, sukunimi, nimimerkki, kayttajatunnus, salasana, syntymaaika, sukupuoli, katuosoite, postinumero, paikkakunta, haettu_ika_min, haettu_ika_max, haettu_sukupuoli, esittelyteksti) VALUES ('Minttu','Korhonen','Barbie','bb-mint','123456','1990-04-24','F','Helsinginkatu 21 C 5','00240','Helsinki',1986, 1996,'M','Olen jazz-tanssia ja kuorolaulua harrastava matemaatikko.');

INSERT INTO Asiakas (etunimi, sukunimi, nimimerkki, kayttajatunnus, salasana, syntymaaika, sukupuoli, katuosoite, postinumero, paikkakunta, haettu_ika_min, haettu_ika_max, haettu_sukupuoli, esittelyteksti) VALUES ('Sami','Lahtinen','Samppa','samppa','123456','1989-04-24','M','Porvoonkatu 4 A 5','00240','Helsinki', 1987, 1997, 'F', 'Harrastan benjihyppyä ja postimerkkeilyä.');

INSERT INTO Viesti (lahettaja, vastaanottaja, sisalto, aikaleima, luettu) VALUES (1,2,'Hei, haluaisitko lähetä keskiviikkoiltana kahville?', '2015-04-21 12:00:00', false);
INSERT INTO Viesti (lahettaja, vastaanottaja, sisalto, aikaleima, luettu) VALUES (2,1,'Hei, keskiviikko ei käy, miten olis torstai?', '2015-04-21 12:46:00', false);


INSERT INTO Esittelysivu (asiakasID, otsikko, sisalto, salainen) VALUES (1, 'Testisivu', 'En ole vielä keksinyt tähän mitään...', true);
INSERT INTO Esittelysivu (asiakasID, otsikko, sisalto, salainen) VALUES (2, 'Karkkimaku', 'Salainen paheeni on kettukarkit!',false);

INSERT INTO Esittelysivu (asiakasID, otsikko, sisalto, salainen) VALUES (1, 'Pääsiäinen', 'En tykkää yhtään mämmistä.',true);

INSERT INTO Lukuoikeus (sivuID, asiakasID) VALUES (3,2);

INSERT INTO Yllapitaja (kayttajatunnus, salasana) VALUES ('admin','anasalas');
