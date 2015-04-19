<?php

$routes->get('/', function() {
    HelloWorldController::index();
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
    HelloWorldController::sandbox();
});

$routes->get('/etusivu', function() {
    HelloWorldController::etusivu();
});

$routes->get('/esittely_julkinen', function() {
    HelloWorldController::esittely_julkinen();
});

$routes->get('/profiilin_muokkaus', function() {
    HelloWorldController::profiilin_muokkaus();
});

$routes->get('/tulosten_listaus', function() {
    HelloWorldController::tulosten_listaus();
});
$routes->get('/kirjautuminen', function() {
    HelloWorldController::kirjautuminen();
});

$routes->get('/yllapitajan_kirjautuminen', function() {
    YllapitajaController::yllapitajan_kirjautuminen();
});

$routes->post('/yllapitajan_kirjautuminen', function() {
    YllapitajaController::kasittele_yllapitajan_kirjautuminen();
});

$routes->get('/rekisteroityminen', function() {
    HelloWorldController::rekisteroityminen();
});

$routes->post('/rekisteroityminen', function() {
    AsiakasController::store();
});

$routes->get('/viestien_listaus', function() {
    HelloWorldController::viestien_listaus();
});

$routes->get('/yllapitajan_kayttajalistaus', function() {
    HelloWorldController::yllapitajan_kayttajalistaus();
});

$routes->get('/yllapitajan_viestilistaus', function() {
    YllapitajaController::yllapitajan_viestilistaus();
});
$routes->get('/viestin_lahettaminen', function() {
    HelloWorldController::viestin_lahettaminen();
});
$routes->get('/viestiin_vastaaminen', function() {
    HelloWorldController::viestiin_vastaaminen();
});

$routes->get('/kayttaja/:kayttajatunnus', function($kayttajatunnus) {
    AsiakasController::naytaKayttaja($kayttajatunnus);
});

$routes->get('/esittely/:nimimerkki', function($nimimerkki) {
    AsiakasController::nayta_esittelysivu($nimimerkki);
});

$routes->get('/yllapitajan_muokkausnakyma/:kayttajatunnus', function($kayttajatunnus) {
    AsiakasController::yllapitajan_muokkausnakyma($kayttajatunnus);
});

$routes->post('/yllapitajan_muokkaus_ja_poisto', function () {
    AsiakasController::yllapitajan_muokkaus_ja_poisto();
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
