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
class SivuController extends BaseController {

    //put your code here

    public static function store() {
        self::check_kayttaja_logged_in();
        $params = $_POST;

        $attributes = array(
            'asiakasid' => $_SESSION['kayttajaid'],
            'otsikko' => $params['otsikko'],
            'sisalto' => $params['sisalto'],
            'salainen' => $params['salainen']
        );
        $sivu = new Esittelysivu($attributes);

//        Kint::dump($viesti);
        $errors = $sivu->errors();
        if (count($errors) == 0) {

            $sivu->save();

            Redirect::to('/kayttajan_sivut', array('message' => 'Sivusi on tallennettu.'));
        } else {
            View::make('/asiakasnakymat/uusi_esittelysivu.html', array('errors' => $errors, 'sivu' => $sivu));
        }
    }

    public static function uusi_esittelysivu() {
        View::make('/asiakasnakymat/uusi_esittelysivu.html');
    }

    public static function esittelysivun_muutos() {
        self::check_kayttaja_logged_in();
        $params = $_POST;
        $attributes = array(
            'sivuid' => $params['sivuid'],
            'asiakasid' => $_SESSION['kayttajaid'],
            'otsikko' => $params['otsikko'],
            'sisalto' => $params['sisalto'],
            'salainen' => $params['salainen']
        );

        $sivu = new Esittelysivu($attributes);
        if ($sivu->salainen == FALSE)
            Lukuoikeus::poistaLukuoikeudet($sivu->sivuid);
        if ($params['action'] == 'paivita') {
            if ($_SESSION['kayttajaid'] == $sivu->asiakasid) {
                $sivu->update();
                Redirect::to('/kayttajan_sivut', array('message' => 'Muutokset esittelysivuun on tallennettu.'));
            } else {
                Redirect::to('/etusivu', array('message' => 'Sinulla ei ole oikeutta nähdä tätä sivua.'));
            }
        } else {
            if ($_SESSION['kayttajaid'] == $sivu->asiakasid) {
                $sivu->destroy();
                Redirect::to('/kayttajan_sivut', array('message' => 'Esittelysivu on poistettu.'));
            } else {
                Redirect::to('/etusivu', array('message' => 'Sinulla ei ole oikeutta nähdä tätä sivua.'));
            }
        }
    }

    public static function esittelysivun_muokkaus($sivuid) {
        self::check_kayttaja_logged_in();
        $sivu = Esittelysivu::find($sivuid);
        if ($_SESSION['kayttajaid'] == $sivu->asiakasid) {
            View::make('/asiakasnakymat/esittelysivun_muokkaus.html', array('sivu' => $sivu));
        } else {
            Redirect::to('/etusivu', array('message' => 'Sinulla ei ole oikeutta nähdä tätä sivua.'));
        }
    }

//    public static function viestin_muokkaus($vid) {
//        self::check_kayttaja_logged_in();
//        $viesti = Viesti::hae_viesti($vid);
//        if ($_SESSION['kayttajaid'] == $viesti->lahettaja) {
//
//            $kohde = Asiakas::find($viesti->vastaanottaja);
//
//            View::make('/asiakasnakymat/viestin_muokkaus.html', array('viesti' => $viesti, 'kohde' => $kohde));
//        } else {
//            $asiakas = Asiakas::find($_SESSION['kayttajaid']);
//            Redirect::to('/kayttajatiedot', array('message' => 'Sinulla ei ole oikeutta nähdä tätä viestiä.', 'kayttaja' => $asiakas));
//        }
//    }

//    public static function viestin_paivitys() {
//        self::check_kayttaja_logged_in();
//        $params = $_POST;
//
//        if ($params['action'] == 'poista') {
//            $viesti = Viesti::hae_viesti($params['viestiid']);
//            $viesti->destroy();
//            Redirect::to('/lahetetyt_viestit', array('message' => 'Viestisi on poistettu!'));
//        }
//        if ($params['action'] == 'paivita') {
//
//            $attributes = array(
//                'viestiid' => intval($params['viestiid']),
//                'lahettaja' => $_SESSION['kayttajaid'],
//                'vastaanottaja' => intval($params['vastaanottaja']),
//                'sisalto' => $params['sisalto'],
//                'luettu' => false,
//            );
//            $viesti = new Viesti($attributes);
//
////        Kint::dump($viesti);
//            $errors = $viesti->errors();
//            if (count($errors) == 0) {
//
//                $viesti->update();
//
//                Redirect::to('/lahetetyt_viestit', array('message' => 'Muutokset viestiin on tallennettu.'));
//            } else {
//                View::make('/suunnitelmat/esittely_julkinen.html', array('errors' => $errors, 'attributes' => $attributes));
//            }
//        }
//    }

    public static function kayttajan_sivut() {
        self::check_kayttaja_logged_in();
        $sivut = Esittelysivu::kayttajan_sivut();
        View::make('/asiakasnakymat/kayttajan_sivut.html', array('sivut' => $sivut));
    }

    public static function oikeuksien_antaminen($aid) {
        self::check_kayttaja_logged_in();
        $sivut = Esittelysivu::haeSalaisetSivut($aid);
        $kohde = Asiakas::find($aid);

        View::make('/asiakasnakymat/lukuoikeuksien_myontaminen.html', array('sivut' => $sivut, 'kohde' => $kohde));
    }

    public static function naytaEsittelysivu($sid) {
        self::check_kayttaja_logged_in();
        $kayttaja=$_SESSION['kayttajaid'];
        $sivu = Esittelysivu::haeSivuJaNimimerkki($sid);
        if(!$sivu['salainen']) {
            View::make('/asiakasnakymat/nayta_esittelysivu.html', array('sivu' => $sivu));
        } else if (Lukuoikeus::tarkistaLukuoikeus($sid, $kayttaja)) {
            View::make('/asiakasnakymat/nayta_esittelysivu.html', array('sivu' => $sivu));
        } else
            Redirect::to('/etusivu', array('message' => 'Sinulla ei ole oikeutta nähdä tätä viestiä.'));
    }

}
