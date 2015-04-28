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
        self::check_kayttaja_logged_in();
        $params = $_POST;

        $attributes = array(
            'lahettaja' => $_SESSION['kayttajaid'],
            'vastaanottaja' => intval($params['vastaanottaja']),
            'sisalto' => $params['sisalto'],
            'luettu' => false
        );
        $viesti = new Viesti($attributes);

//        Kint::dump($viesti);
        $errors = $viesti->errors();
        if (count($errors) == 0) {

            $viesti->save();

            Redirect::to('/hakutulokset', array('message' => 'Viestisi on lähetetty.'));
        } else {
            View::make('/suunnitelmat/esittely_julkinen.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function viestin_muokkaus($vid) {
        self::check_kayttaja_logged_in();
        $viesti = Viesti::hae_viesti($vid);
        $kohde = Asiakas::find($viesti->vastaanottaja);

        View::make('/asiakasnakymat/viestin_muokkaus.html', array('viesti' => $viesti, 'kohde' => $kohde));
    }

    public static function viestin_paivitys() {
        self::check_kayttaja_logged_in();
        $params = $_POST;

        if ($params['action'] == 'poista') {
            $viesti = Viesti::hae_viesti($params['viestiid']);
            $viesti->destroy();
            Redirect::to('/lahetetyt_viestit', array('message' => 'Viestisi on poistettu!'));
        }
        if ($params['action'] == 'paivita') {

            $attributes = array(
                'viestiid' => intval($params['viestiid']),
                'lahettaja' => $_SESSION['kayttajaid'],
                'vastaanottaja' => intval($params['vastaanottaja']),
                'sisalto' => $params['sisalto'],
                'luettu' => false,
            );
            $viesti = new Viesti($attributes);

//        Kint::dump($viesti);
            $errors = $viesti->errors();
            if (count($errors) == 0) {

                $viesti->update();

                Redirect::to('/lahetetyt_viestit', array('message' => 'Muutokset viestiin on tallennettu.'));
            } else {
                View::make('/suunnitelmat/esittely_julkinen.html', array('errors' => $errors, 'attributes' => $attributes));
            }
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

    public static function viesti($id) {
        self::check_kayttaja_logged_in();
        $viesti = Viesti::hae_viesti($id);
        if (!($_SESSION['kayttajaid'] == $viesti->vastaanottaja)) {
            $asiakas = Asiakas::find($_SESSION['kayttajaid']);
            Redirect::to('/kayttajatiedot', array('error' => 'Sinulla ei ole oikeutta nähdä tätä viestiä.', 'kayttaja' => $asiakas));
        }
        $lahettaja = Asiakas::find($viesti->lahettaja);
        $viesti->merkitse_luetuksi();


//                Kint::trace();
//        Kint::dump($asiakas);
        View::make('suunnitelmat/viesti.html', array('lahettaja' => $lahettaja, 'viesti' => $viesti));
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

    public static function kayttajan_saapuneet_viestit() {
        self::check_kayttaja_logged_in();
        $viestit = Viesti::kayttajan_saapuneet_viestit();
        $kayttajat = Asiakas::all();
        View::make('suunnitelmat/saapuneet_viestit.html', array('viestit' => $viestit, 'kayttajat' => $kayttajat));
    }

    public static function kayttajan_lahettamat_viestit() {
        self::check_kayttaja_logged_in();
        $viestit = Viesti::kayttajan_lahettamat_viestit();
        $kayttajat = Asiakas::all();
        View::make('suunnitelmat/lahetetyt_viestit.html', array('viestit' => $viestit, 'kayttajat' => $kayttajat));
    }

}
