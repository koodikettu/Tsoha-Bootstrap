<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AsiakasController
 *
 * @author markku
 */
class ViestiController extends BaseController {

    //put your code here

    public static function store() {
        $params = $_POST;

        $attributes = array(
            'lahettaja' => $params['lahettaja'],
            'vastaanottaja' => $params['vastaanottaja'],
            'sisalto' => $params['sisalto']
        );
        $viesti = new Viesti($attributes);

//        Kint::dump($params);
        $errors = $viesti->errors();
        if (count($errors) == 0) {

            $viesti->save();

            Redirect::to('/etusivu', array('message' => 'Viestisi on lähetetty.'));
        } else {
            View::make('/suunnitelmat/viestin_lahettaminen.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    

    public static function naytaKayttaja($kayttajatunnus) {
        self::check_yllapitaja_logged_in();
        $kayttaja = Asiakas::haeKayttaja($kayttajatunnus);
//        Kint::dump($kayttaja);
        View::make('suunnitelmat/kayttajatiedot.html', array('kayttaja' => $kayttaja));
    }

    public static function yllapitajan_muokkausnakyma($kayttajatunnus) {
        self::check_yllapitaja_logged_in();
        $kayttaja = Asiakas::haeKayttaja($kayttajatunnus);
//        Kint::dump($kayttaja);
        View::make('suunnitelmat/yllapitajan_muokkausnakyma.html', array('asiakas' => $kayttaja));
    }

    public static function yllapitajan_muokkaus_ja_poisto() {
        self::check_yllapitaja_logged_in();
        $params = $_POST;
//            Kint::trace();
//            Kint::dump($params);
        if ($params['action'] == 'Tallenna') {
            $asiakas = Asiakas::haeKayttaja($params['kayttajatunnus']);
//            Kint::trace();
//            Kint::dump($asiakas);
            $asiakas->update_asiakastiedot($params);
            HelloWorldController::yllapitajan_kayttajalistaus();
        }
        if ($params['action'] == 'Poista') {
            $asiakas = Asiakas::haeKayttaja($params['kayttajatunnus']);
            $asiakas->destroy();
            HelloWorldController::yllapitajan_kayttajalistaus();
        }
    }

    public static function index() {
        View::make('suunnitelmat/etusivu.html');
    }

    public static function nayta_kayttajatiedot() {
        self::check_kayttaja_logged_in();
        $asiakas = self::get_kayttaja_logged_in();

//                Kint::trace();
//        Kint::dump($asiakas);
        View::make('suunnitelmat/kayttajatiedot.html', array('kayttaja' => $asiakas));
    }

    public static function nayta_hakutulokset() {
        self::check_kayttaja_logged_in();
        $kayttaja = self::get_kayttaja_logged_in();
        $asiakkaat = Asiakas::haku();

//        Kint::trace();
//        Kint::dump($asiakkaat);
//        Kint::dump($kayttaja);
        View::make('suunnitelmat/hakutulokset.html', array('kayttaja' => $kayttaja, 'asiakkaat' => $asiakkaat));
    }

}
