<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
//   	  View::make('home.html');
        View::make('suunnitelmat/etusivu.html');
        
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }
    
    public static function etusivu(){
        View::make('suunnitelmat/etusivu.html');
    }
    
    public static function esittely_julkinen(){
        View::make('suunnitelmat/esittely_julkinen.html');
    }
    
    public static function profiilin_muokkaus(){
        View::make('suunnitelmat/profiilin_muokkaus.html');
    }
    
    public static function tulosten_listaus(){
        View::make('suunnitelmat/tulosten_listaus.html');
    }
    
    public static function kirjautuminen(){
        View::make('suunnitelmat/kirjautuminen.html');
    }
    
    public static function rekisteroityminen(){
        View::make('suunnitelmat/rekisteroityminen.html');
    }
    
    public static function viestien_listaus(){
        View::make('suunnitelmat/viestien_listaus.html');
    }
    
    public static function yllapitajan_kayttajalistaus(){
        View::make('suunnitelmat/yllapitajan_kayttajalistaus.html');
    }
    
    
  }
