<?php

  $routes->get('/', function() {
    HelloWorldController::index();
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
  
    $routes->get('/rekisteroityminen', function() {
    HelloWorldController::rekisteroityminen();
  });
  
    $routes->get('/viestien_listaus', function() {
    HelloWorldController::viestien_listaus();
  });
  
    $routes->get('/yllapitajan_kayttajalistaus', function() {
    HelloWorldController::yllapitajan_kayttajalistaus();
  });
