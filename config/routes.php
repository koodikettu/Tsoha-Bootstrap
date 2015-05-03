<?php

$routes->get('/', function() {
    YleisController::etusivu();
});

$routes->post('/', function() {
    AsiakasController::kasittele_kayttajan_kirjautuminen();
});

$routes->get('/kayttajatiedot', function() {
    AsiakasController::nayta_kayttajatiedot();
});

$routes->get('/hakutulokset', function() {
    AsiakasController::nayta_hakutulokset();
});

$routes->get('/hiekkalaatikko', function() {
    YleisController::sandbox();
});

$routes->get('/etusivu', function() {
    YleisController::etusivu();
});

$routes->get('/esittely_julkinen', function() {
    YleisController::esittely_julkinen();
});

$routes->get('/profiilin_muokkaus', function() {
    YleisController::profiilin_muokkaus();
});

$routes->get('/tulosten_listaus', function() {
    YleisController::tulosten_listaus();
});
$routes->get('/kirjautuminen', function() {
    YleisController::kirjautuminen();
});

$routes->get('/yllapitajan_kirjautuminen', function() {
    YllapitajaController::yllapitajan_kirjautuminen();
});

$routes->post('/yllapitajan_kirjautuminen', function() {
    YllapitajaController::kasittele_yllapitajan_kirjautuminen();
});

$routes->get('/rekisteroityminen', function() {
    YleisController::rekisteroityminen();
});

$routes->post('/rekisteroityminen', function() {
    AsiakasController::store();
});

$routes->post('/viestin_lahetys', function() {
    ViestiController::store();
});

$routes->get('/viestin_muokkaus/:viestiid', function($viestiid) {
    ViestiController::viestin_muokkaus($viestiid);
});

$routes->post('/viestin_paivitys/', function() {
    ViestiController::viestin_paivitys();
});

$routes->get('/viestien_listaus', function() {
    YleisController::viestien_listaus();
});

$routes->get('/yllapitajan_kayttajalistaus', function() {
    AsiakasController::yllapitajan_kayttajalistaus();
});

$routes->get('/yllapitajan_viestilistaus', function() {
    ViestiController::yllapitajan_viestilistaus();
});
$routes->get('/viestin_lahettaminen', function() {
    YleisController::viestin_lahettaminen();
});
$routes->get('/viestiin_vastaaminen', function() {
    YleisController::viestiin_vastaaminen();
});

$routes->get('/kayttaja/:kayttajatunnus', function($kayttajatunnus) {
    AsiakasController::naytaKayttaja($kayttajatunnus);
});

$routes->get('/esittely/:nimimerkki', function($nimimerkki) {
    AsiakasController::nayta_esittelysivu($nimimerkki);
});

$routes->get('/viesti/:nimimerkki', function($viesti) {
    ViestiController::viesti($viesti);
});

$routes->get('/yllapitajan_muokkausnakyma/:kayttajatunnus', function($kayttajatunnus) {
    AsiakasController::yllapitajan_muokkausnakyma($kayttajatunnus);
});

$routes->post('/yllapitajan_muokkaus_ja_poisto', function () {
    AsiakasController::yllapitajan_muokkaus_ja_poisto();
});

$routes->get('/saapuneet_viestit', function () {
    ViestiController::kayttajan_saapuneet_viestit();
});

$routes->get('/lahetetyt_viestit', function () {
    ViestiController::kayttajan_lahettamat_viestit();
});

$routes->post('/logout', function() {
    YllapitajaController::logout();
});

$routes->get('/logout', function() {
    YllapitajaController::logout();
});

$routes->get('/login', function() {
    YllapitajaController::yllapitajan_kirjautuminen();
}
);

$routes->get('/kayttajan_sivut', function() {
    SivuController::kayttajan_sivut();
}
);

$routes->get('/luo_uusi_sivu', function() {
    SivuController::uusi_esittelysivu();
}
);

$routes->post('/luo_uusi_sivu', function() {
    SivuController::store();
}
);

$routes->get('/esittelysivun_muokkaus/:sivuid', function($sivuid) {
    SivuController::esittelysivun_muokkaus($sivuid);
}
);

$routes->post('/esittelysivun_muokkaus', function() {
    SivuController::esittelysivun_muutos();
}
);

$routes->get('/lukuoikeuksien_myontaminen/:kayttajaid', function($kayttajaid) {
    SivuController::oikeuksien_antaminen($kayttajaid);
}
);

$routes->post('/paivita_oikeudet', function() {
    LukuoikeusController::oikeuksien_paivittaminen();
}
);

$routes->get('/esittelysivu/:sid', function($sid) {
    SivuController::naytaEsittelysivu($sid);
}
);

$routes->get('/asiakastietojen_muokkaus', function() {
    AsiakasController::asiakastietojenMuokkaus();
}
);

$routes->post('/asiakastietojen_muokkaus', function() {
    AsiakasController::asiakastietojenPaivitys();
}
);

$routes->get('/profiilitietojen_muokkaus', function() {
    AsiakasController::profiilitietojenMuokkaus();
}
);

$routes->post('/profiilitietojen_muokkaus', function() {
    AsiakasController::profiilitietojenPaivitys();
}
);


