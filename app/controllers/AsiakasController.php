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

            Redirect::to('/etusivu', array('message' => 'Tervetuloa palvelun käyttäjäksi, ' . $params['etunimi'] . '!'));
        } else {
            View::make('/suunnitelmat/rekisteroityminen.html', array('errors' => $errors, 'attributes' => $attributes));
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

}
