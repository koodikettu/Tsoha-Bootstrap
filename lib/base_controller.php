<?php

class BaseController {

    public static function get_kayttaja_logged_in() {
        // Toteuta kirjautuneen käyttäjän haku tähän

        if (isset($_SESSION['kayttajaid'])) {
            $kayttajaid = $_SESSION['kayttajaid'];
            $asiakas = Asiakas::find($kayttajaid);
            return $asiakas;
        }
        return null;
    }

    public static function get_yllapitaja_logged_in() {
        // Toteuta kirjautuneen käyttäjän haku tähän
        
        if (isset($_SESSION['yllapitajaid'])) {
            $yllapitajaid = $_SESSION['yllapitajaid'];
            $yllapitaja = Yllapitaja::getYllapitaja($yllapitajaid);
            return $yllapitaja;
        }
        return null;
    }

    public static function check_kayttaja_logged_in() {
        // Toteuta kirjautumisen tarkistus tähän.
        // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
        if (!isset($_SESSION['kayttajaid'])) {
            Redirect::to('/', array('error' => 'Kirjaudu ensin sisään.'));
        }
    }

    public static function check_user_logged_in() {
        // Toteuta kirjautumisen tarkistus tähän.
        // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
        
    }

    public static function check_yllapitaja_logged_in() {
        // Toteuta kirjautumisen tarkistus tähän.
        // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
        if (!isset($_SESSION['yllapitajaid'])) {
            Redirect::to('/yllapitajan_kirjautuminen', array('error' => 'Kirjaudu ensin sisään.'));
        }
    }

}
