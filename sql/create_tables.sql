CREATE TABLE Asiakas(
	asiakasID SERIAL PRIMARY KEY,
	etunimi varchar(15) NOT NULL,
	sukunimi varchar(25) NOT NULL,
	nimimerkki varchar(20) NOT NULL,
	kayttajatunnus varchar(20) UNIQUE NOT NULL,
	salasana varchar(20) NOT NULL,
	syntymaaika DATE NOT NULL,
	sukupuoli char NOT NULL,
	katuosoite varchar(30) NOT NULL,
	postinumero varchar(6) NOT NULL,
	paikkakunta varchar(25) NOT NULL,
	haettu_ika_min integer,
	haettu_ika_max integer,
	haettu_sukupuoli char,
	esittelyteksti varchar(2000)
);

CREATE TABLE Esittelysivu(
	sivuID SERIAL PRIMARY KEY,
	asiakasID integer REFERENCES Asiakas (asiakasID),
	sisalto varchar(2000),
	salainen boolean
);

CREATE TABLE Viesti(
	viestiID SERIAL PRIMARY KEY,
	lahettaja integer REFERENCES Asiakas (asiakasID),
	vastaanottaja integer REFERENCES Asiakas (asiakasID),
	sisalto varchar(2000)
);

CREATE TABLE Lukuoikeus(
	sivuID integer REFERENCES Esittelysivu (sivuID),
	asiakasID integer REFERENCES Asiakas (AsiakasID),
	PRIMARY KEY (sivuID, asiakasID)
);

CREATE TABLE Yllapitaja(
	yllapitajaID SERIAL PRIMARY KEY,
	kayttajatunnus varchar(20) UNIQUE NOT NULL,
	salasana varchar(20) NOT NULL
);
	