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
