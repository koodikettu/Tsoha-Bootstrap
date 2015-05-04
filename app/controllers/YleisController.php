<?php

class YleisController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
//   	  View::make('home.html');
        View::make('suunnitelmat/etusivu.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
//      View::make('helloworld.html');
        $asiakas = new Asiakas(array(
            'etunimi' => 'fgd',
            'sukunimi' => 'asdf',
            'nimimerkki' => 'asdf0',
            'kayttajatunnus' => 'asd',
            'salasana' => 'sddddddda',
            'syntymaaika' => '2015-01-01',
            'sukupuoli' => 'F',
            'katuosoite' => 'Pitkäkatu',
            'postinumero' => 'ffffffff',
            'paikkakunta' => 'aa'
        ));

        $errors = $asiakas->errors();

        Kint::dump($errors);
    }

    public static function etusivu() {
        if(self::get_yllapitaja_logged_in()!=null) {
            Redirect::to('/yllapitajan_kayttajalistaus');
        }
        if(self::get_kayttaja_logged_in()!=null) {
            Redirect::to('/kayttajatiedot');
        }
        View::make('asiakasnakymat/etusivu.html');
    }

    public static function esittely_julkinen() {
        View::make('asiakasnakymat/esittely_julkinen.html');
    }

    public static function profiilin_muokkaus() {
        View::make('suunnitelmat/profiilin_muokkaus.html');
    }

    public static function tulosten_listaus() {
        View::make('suunnitelmat/tulosten_listaus.html');
    }

    public static function kirjautuminen() {
        View::make('suunnitelmat/kirjautuminen.html');
    }



    public static function rekisteroityminen() {
        View::make('suunnitelmat/rekisteroityminen.html');
    }

    public static function viestien_listaus() {
        View::make('suunnitelmat/viestien_listaus.html');
    }


}
