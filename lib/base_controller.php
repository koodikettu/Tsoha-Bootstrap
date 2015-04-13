<?php

class BaseController {

    public static function get_kayttaja_logged_in() {
        // Toteuta kirjautuneen käyttäjän haku tähän

        if (isset($_SESSION['kayttaja'])) {
            $kayttajatunnus = $_SESSION['kayttaja'];
            $asiakas = Asiakas::find($kayttajatunnus);
            return $asiakas;
        }
        return null;
    }

    public static function get_user_logged_in() {
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
        if (!isset($_SESSION['yllapitajaid'])) {
            Redirect::to('/yllapitajan_kirjautuminen', array('error' => 'Kirjaudu ensin sisään.'));
        }
    }

    public static function check_user_logged_in() {
        // Toteuta kirjautumisen tarkistus tähän.
        // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
        if (!isset($_SESSION['yllapitajaid'])) {
            Redirect::to('/yllapitajan_kirjautuminen', array('error' => 'Kirjaudu ensin sisään.'));
        }
    }

    public static function check_yllapitaja_logged_in() {
        // Toteuta kirjautumisen tarkistus tähän.
        // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
        self::check_user_logged_in();
    }

}
