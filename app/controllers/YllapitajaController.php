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
class YllapitajaController extends BaseController {

    //put your code here

    public static function yllapitajan_kirjautuminen() {
        if(self::get_yllapitaja_logged_in()!=null) {
            Redirect::to('/yllapitajan_kayttajalistaus');
        }
        View::make('yllapitonakymat/yllapitajan_kirjautuminen.html');
    }

    public static function kasittele_yllapitajan_kirjautuminen() {

        $params = $_POST;

        $yllapitaja = Yllapitaja::authenticate($params['kayttajatunnus'], $params['salasana']);

        if (!$yllapitaja) {
            View::make('/yllapitonakymat/yllapitajan_kirjautuminen.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
        } else {
            $_SESSION['yllapitajaid'] = $yllapitaja->yllapitajaid;
            $_SESSION['kayttajaid'] = NULL;
            Redirect::to('/yllapitajan_kayttajalistaus', array('message' => 'Tervetuloa takaisin ' . $yllapitaja->kayttajatunnus . '!'));
        }
    }

    public static function logout() {
        if (self::get_yllapitaja_logged_in()!=null) {
            $_SESSION['kayttajaid'] = null;
            $_SESSION['yllapitajaid'] = null;
            Redirect::to('/yllapitajan_kirjautuminen', array('message' => 'Olet kirjautunut ulos!'));
        }
        $_SESSION['kayttajaid'] = null;
        $_SESSION['yllapitajaid'] = null;
        Redirect::to('/etusivu', array('message' => 'Olet kirjautunut ulos!'));
    }

}
