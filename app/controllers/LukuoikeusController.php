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
class LukuoikeusController extends BaseController {

    //put your code here

    public static function oikeuksien_paivittaminen() {
        $params = $_POST;
        $taulu = $params['taulukko'];
        $kayttaja = $params['kohde'];


        foreach ($taulu as $a) {
            if (isset($params['oikeus'][$a])) {
                Lukuoikeus::lisaaLukuoikeus($a, $kayttaja);
            } else {

                Lukuoikeus::poistaLukuoikeus($a, $kayttaja);
            }
        }
        Redirect::to('/lukuoikeuksien_myontaminen/' . $kayttaja, array('message' => 'Lukuoikeudet on päivitetty.'));
    }

}
