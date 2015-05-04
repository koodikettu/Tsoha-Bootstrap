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

            Redirect::to('/lahetetyt_viestit', array('message' => 'Viestisi on lähetetty.'));
        } else {
            View::make('/suunnitelmat/esittely_julkinen.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function viestin_muokkaus($vid) {
        self::check_kayttaja_logged_in();
        $viesti = Viesti::hae_viesti($vid);
        if ($_SESSION['kayttajaid'] == $viesti->lahettaja) {

            $kohde = Asiakas::find($viesti->vastaanottaja);

            View::make('/asiakasnakymat/viestin_muokkaus.html', array('viesti' => $viesti, 'kohde' => $kohde));
        } else {
            $asiakas = Asiakas::find($_SESSION['kayttajaid']);
            Redirect::to('/kayttajatiedot', array('message' => 'Sinulla ei ole oikeutta nähdä tätä viestiä.', 'kayttaja' => $asiakas));
        }
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

    public static function viesti($id) {
        self::check_kayttaja_logged_in();
        $viesti = Viesti::hae_viesti($id);
        if ($_SESSION['kayttajaid'] == $viesti->vastaanottaja) {


            $lahettaja = Asiakas::find($viesti->lahettaja);
            $viesti->merkitse_luetuksi();
            View::make('suunnitelmat/viesti.html', array('lahettaja' => $lahettaja, 'viesti' => $viesti));
        } else {
            $asiakas = Asiakas::find($_SESSION['kayttajaid']);
            Redirect::to('/kayttajatiedot', array('message' => 'Sinulla ei ole oikeutta nähdä tätä viestiä.', 'kayttaja' => $asiakas));
        }
    }

    public static function kayttajan_saapuneet_viestit() {
        self::check_kayttaja_logged_in();
        $viestit = Viesti::kayttajan_saapuneet_viestit();

        View::make('asiakasnakymat/saapuneet_viestit.html', array('viestit' => $viestit));
    }

    public static function kayttajan_lahettamat_viestit() {
        self::check_kayttaja_logged_in();
        $viestit = Viesti::kayttajan_lahettamat_viestit();
        View::make('asiakasnakymat/lahetetyt_viestit.html', array('viestit' => $viestit));
    }

    public static function yllapitajan_viestilistaus() {
        self::check_yllapitaja_logged_in();
//        $viestit = Viesti::all();
//        $kayttajat = Asiakas::all();
        $viestit = Viesti::yllapitajanViestilistaus();
//        Kint::dump($viestit);
//        echo 'Onkssetää';
        View::make('yllapitonakymat/yllapitajan_viestilistaus.html', array('viestit' => $viestit));
    }

}
