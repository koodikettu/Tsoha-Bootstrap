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
class AsiakasController extends BaseController {

    //put your code here

    public static function store() {
        $params = $_POST;

        $attributes = array(
            'etunimi' => $params['etunimi'],
            'sukunimi' => $params['sukunimi'],
            'nimimerkki' => $params['nimimerkki'],
            'kayttajatunnus' => $params['kayttajatunnus'],
            'salasana' => $params['salasana'],
            'syntymaaika' => $params['syntymaaika'],
            'sukupuoli' => $params['sukupuoli'],
            'katuosoite' => $params['katuosoite'],
            'postinumero' => $params['postinumero'],
            'paikkakunta' => $params['paikkakunta']
//                'haettu_ika_max' => $params['haettu_ika_max'],
//                'haettu_ika_min' => $params['haettu_ika_min'],
//                'haettu_sukupuoli' => $params['haettu_sukupuoli'],
//                'esittelyteksti' => $params['esittelyteksti']
        );
        $asiakas = new Asiakas($attributes);

//        Kint::dump($params);
        $errors = $asiakas->errors();
        if (count($errors) == 0) {

            $asiakas->save();

            Redirect::to('/etusivu', array('message' => 'Tervetuloa palvelun käyttäjäksi, ' . $params['etunimi'] . '! Voit nyt kirjautua sisään palveluun.'));
        } else {
            View::make('/suunnitelmat/rekisteroityminen.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function kasittele_kayttajan_kirjautuminen() {

        $params = $_POST;

        $asiakas = Asiakas::authenticate($params['kayttajatunnus'], $params['salasana']);


//        Kint::trace();
//        Kint::dump($asiakas);
        if (!$asiakas) {
            View::make('/suunnitelmat/etusivu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
        } else {
            $_SESSION['kayttajaid'] = $asiakas->asiakasid;
            Redirect::to('/kayttajatiedot', array('message' => 'Tervetuloa takaisin ' . $asiakas->kayttajatunnus . '!', 'asiakas' => $asiakas));
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
        View::make('yllapitonakymat/yllapitajan_muokkausnakyma.html', array('asiakas' => $kayttaja));
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
            AsiakasController::yllapitajan_kayttajalistaus();
        }
        if ($params['action'] == 'Poista') {
            $asiakas = Asiakas::haeKayttaja($params['kayttajatunnus']);
            $asiakas->destroy();
            AsiakasController::yllapitajan_kayttajalistaus();
        }
    }
    
        public static function yllapitajan_kayttajalistaus() {
        self::check_yllapitaja_logged_in();
        $asiakkaat = Asiakas::all();
        View::make('yllapitonakymat/yllapitajan_kayttajalistaus.html', array('asiakkaat' => $asiakkaat));
    }


    public static function nayta_kayttajatiedot() {
        self::check_kayttaja_logged_in();
        $asiakas = self::get_kayttaja_logged_in();

//                Kint::trace();
//        Kint::dump($asiakas);
        View::make('suunnitelmat/kayttajatiedot.html', array('kayttaja' => $asiakas));
    }

    public static function hae_nimimerkki($id) {
        self::check_kayttaja_logged_in();
        $asiakas = Asiakas::find($id);

//                Kint::trace();
//        Kint::dump($asiakas);
        return $asiakas->nimimerkki;
    }

    public static function nayta_esittelysivu($nimimerkki) {
        BaseController::check_kayttaja_logged_in();
        $kohde = Asiakas::get_kayttaja_by_nimimerkki($nimimerkki);

//                Kint::trace();
//        Kint::dump($asiakas);
        View::make('suunnitelmat/esittely_julkinen.html', array('kohde' => $kohde));
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
