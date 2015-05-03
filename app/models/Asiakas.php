<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KayttajaController
 *
 * @author markku
 */
class Asiakas extends BaseModel {

    //put your code here
    public $asiakasid, $etunimi, $sukunimi, $nimimerkki;
    public $kayttajatunnus, $salasana, $syntymaaika, $sukupuoli;
    public $katuosoite, $postinumero, $paikkakunta;
    public $haettu_ika_max, $haettu_ika_min, $haettu_sukupuoli;
    public $esittelyteksti;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoi_etunimi', 'validoi_sukunimi', 'validoi_nimimerkki', 'validoi_kayttajatunnus', 'validoi_salasana', 'validoi_syntymaaika', 'validoi_sukupuoli', 'validoi_katuosoite', 'validoi_postinumero', 'validoi_paikkakunta');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Asiakas');
        $query->execute();
        $rows = $query->fetchAll();
        $asiakkaat = array();
        foreach ($rows as $row) {
            $asiakkaat[] = new Asiakas(array(
                'asiakasid' => $row['asiakasid'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'nimimerkki' => $row['nimimerkki'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
                'syntymaaika' => $row['syntymaaika'],
                'sukupuoli' => $row['sukupuoli'],
                'katuosoite' => $row['katuosoite'],
                'postinumero' => $row['postinumero'],
                'paikkakunta' => $row['paikkakunta'],
                'haettu_ika_max' => $row['haettu_ika_max'],
                'haettu_ika_min' => $row['haettu_ika_min'],
                'haettu_sukupuoli' => $row['haettu_sukupuoli'],
                'esittelyteksti' => $row['esittelyteksti']
            ));
        }

        return $asiakkaat;
    }

    public static function haku() {
        $k = AsiakasController::get_kayttaja_logged_in();


        $query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE asiakasid<>:kayttaja');
        $query->execute(array('kayttaja' => $k->asiakasid));
        $rows = $query->fetchAll();
        $asiakkaat = array();
        foreach ($rows as $row) {
            $asiakkaat[] = new Asiakas(array(
                'asiakasid' => $row['asiakasid'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'nimimerkki' => $row['nimimerkki'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
                'syntymaaika' => $row['syntymaaika'],
                'sukupuoli' => $row['sukupuoli'],
                'katuosoite' => $row['katuosoite'],
                'postinumero' => $row['postinumero'],
                'paikkakunta' => $row['paikkakunta'],
                'haettu_ika_max' => $row['haettu_ika_max'],
                'haettu_ika_min' => $row['haettu_ika_min'],
                'haettu_sukupuoli' => $row['haettu_sukupuoli'],
                'esittelyteksti' => $row['esittelyteksti']
            ));
        }
//        Kint::trace();
//        Kint::dump($k);
//        Kint::dump($asiakkaat);

        return $asiakkaat;
    }

    public static function filtterihaku() {
        $k = AsiakasController::get_kayttaja_logged_in();


        $query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE asiakasid<>:kayttaja');
        $query->execute(array('kayttaja' => $k->asiakasid));
        $rows = $query->fetchAll();
        $asiakkaat = array();
        foreach ($rows as $row) {
            $asiakkaat[] = new Asiakas(array(
                'asiakasid' => $row['asiakasid'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'nimimerkki' => $row['nimimerkki'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
                'syntymaaika' => $row['syntymaaika'],
                'sukupuoli' => $row['sukupuoli'],
                'katuosoite' => $row['katuosoite'],
                'postinumero' => $row['postinumero'],
                'paikkakunta' => $row['paikkakunta'],
                'haettu_ika_max' => $row['haettu_ika_max'],
                'haettu_ika_min' => $row['haettu_ika_min'],
                'haettu_sukupuoli' => $row['haettu_sukupuoli'],
                'esittelyteksti' => $row['esittelyteksti']
            ));
        }
//        Kint::trace();
//        Kint::dump($k);
//        Kint::dump($asiakkaat);

        return $asiakkaat;
    }

    public static function find($asiakasid) {
        $query = DB::connection()->prepare('SELECT * FROM asiakas WHERE asiakasid= :asiakasid LIMIT 1');
        $query->execute(array('asiakasid' => $asiakasid));
        $row = $query->fetch();

        if ($row) {
            $asiakas = new Asiakas(array(
                'asiakasid' => $row['asiakasid'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'nimimerkki' => $row['nimimerkki'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
                'syntymaaika' => $row['syntymaaika'],
                'sukupuoli' => $row['sukupuoli'],
                'katuosoite' => $row['katuosoite'],
                'postinumero' => $row['postinumero'],
                'paikkakunta' => $row['paikkakunta'],
                'haettu_ika_max' => $row['haettu_ika_max'],
                'haettu_ika_min' => $row['haettu_ika_min'],
                'haettu_sukupuoli' => $row['haettu_sukupuoli'],
                'esittelyteksti' => $row['esittelyteksti']
            ));
            return $asiakas;
        }
    }

    public static function authenticate($ktunnus, $ssana) {
        $query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE kayttajatunnus = :kayttajatunnus AND salasana = :salasana LIMIT 1');
        $query->execute(array('kayttajatunnus' => $ktunnus, 'salasana' => $ssana));

        $row = $query->fetch();
        if ($row) {
            $asiakas = new Asiakas(array(
                'asiakasid' => $row['asiakasid'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'nimimerkki' => $row['nimimerkki'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
                'syntymaaika' => $row['syntymaaika'],
                'sukupuoli' => $row['sukupuoli'],
                'katuosoite' => $row['katuosoite'],
                'postinumero' => $row['postinumero'],
                'paikkakunta' => $row['paikkakunta'],
                'haettu_ika_max' => $row['haettu_ika_max'],
                'haettu_ika_min' => $row['haettu_ika_min'],
                'haettu_sukupuoli' => $row['haettu_sukupuoli'],
                'esittelyteksti' => $row['esittelyteksti']
            ));
            return $asiakas;
        }

        return null;
    }

    public static function get_kayttaja_by_nimimerkki($nm) {
        $query = DB::connection()->prepare('SELECT * FROM asiakas WHERE nimimerkki= :nimimerkki LIMIT 1');
        $query->execute(array(':nimimerkki' => $nm));
        $row = $query->fetch();

//                Kint::trace();
//        Kint::dump($row);

        if ($row) {
            $asiakas = new Asiakas(array(
                'asiakasid' => $row['asiakasid'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'nimimerkki' => $row['nimimerkki'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
                'syntymaaika' => $row['syntymaaika'],
                'sukupuoli' => $row['sukupuoli'],
                'katuosoite' => $row['katuosoite'],
                'postinumero' => $row['postinumero'],
                'paikkakunta' => $row['paikkakunta'],
                'haettu_ika_max' => $row['haettu_ika_max'],
                'haettu_ika_min' => $row['haettu_ika_min'],
                'haettu_sukupuoli' => $row['haettu_sukupuoli'],
                'esittelyteksti' => $row['esittelyteksti']
            ));
            return $asiakas;
        }
    }

    public static function haeKayttaja($kayttajatunnus) {
        $query = DB::connection()->prepare('SELECT * FROM asiakas WHERE kayttajatunnus= :kayttajatunnus LIMIT 1');
        $query->execute(array(':kayttajatunnus' => $kayttajatunnus));
        $row = $query->fetch();

//                Kint::trace();
//        Kint::dump($row);

        if ($row) {
            $asiakas = new Asiakas(array(
                'asiakasid' => $row['asiakasid'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'nimimerkki' => $row['nimimerkki'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana'],
                'syntymaaika' => $row['syntymaaika'],
                'sukupuoli' => $row['sukupuoli'],
                'katuosoite' => $row['katuosoite'],
                'postinumero' => $row['postinumero'],
                'paikkakunta' => $row['paikkakunta'],
                'haettu_ika_max' => $row['haettu_ika_max'],
                'haettu_ika_min' => $row['haettu_ika_min'],
                'haettu_sukupuoli' => $row['haettu_sukupuoli'],
                'esittelyteksti' => $row['esittelyteksti']
            ));
            return $asiakas;
        }
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO asiakas (kayttajatunnus, salasana, etunimi, sukunimi, nimimerkki, syntymaaika, sukupuoli, katuosoite, postinumero, paikkakunta) VALUES (:kayttajatunnus, :salasana, :etunimi, :sukunimi, :nimimerkki, :syntymaaika, :sukupuoli, :katuosoite, :postinumero, :paikkakunta) RETURNING asiakasid');
        $query->execute(array('kayttajatunnus' => $this->kayttajatunnus, 'salasana' => $this->salasana, 'etunimi' => $this->etunimi, 'sukunimi' => $this->sukunimi, 'nimimerkki' => $this->nimimerkki, 'syntymaaika' => $this->syntymaaika, 'sukupuoli' => $this->sukupuoli, 'katuosoite' => $this->katuosoite, 'postinumero' => $this->postinumero, 'paikkakunta' => $this->paikkakunta));
        $row = $query->fetch();

//        Kint::trace();
//        Kint::dump($row);

        $this->asiakasid = $row['asiakasid'];
    }

    public function profiiliUpdate() {
        $query = DB::connection()->prepare('UPDATE asiakas SET haettu_ika_min=:himin, haettu_ika_max=:himax, haettu_sukupuoli=:his, esittelyteksti=:et WHERE asiakasID=:asiakasid');
        $query->execute(array('himax' => $this->haettu_ika_max, 'himin' => $this->haettu_ika_min, 'his' => $this->haettu_sukupuoli, 'et' => $this->esittelyteksti, 'asiakasid' => $this->asiakasid));

        $row = $query->fetch();
        Kint::dump($this);
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE asiakas SET kayttajatunnus=:kayttajatunnus, salasana=:salasana, etunimi=:etunimi, sukunimi=:sukunimi, nimimerkki=:nimimerkki, syntymaaika=:syntymaaika, sukupuoli=:sukupuoli, katuosoite=:katuosoite, postinumero=:postinumero, paikkakunta=:paikkakunta WHERE asiakasID=:asiakasid');
        $query->execute(array('kayttajatunnus' => $this->kayttajatunnus, 'salasana' => $this->salasana, 'etunimi' => $this->etunimi, 'sukunimi' => $this->sukunimi, 'nimimerkki' => $this->nimimerkki, 'syntymaaika' => $this->syntymaaika, 'sukupuoli' => $this->sukupuoli, 'katuosoite' => $this->katuosoite, 'postinumero' => $this->postinumero, 'paikkakunta' => $this->paikkakunta, 'asiakasid' => $this->asiakasid));

        $row = $query->fetch();
        Kint::dump($this);
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM asiakas WHERE kayttajatunnus=:kayttajatunnus');
        $query->execute(array('kayttajatunnus' => $this->kayttajatunnus));

//        Kint::trace();
//        Kint::dump($row);
    }

    public function update_asiakastiedot($params) {
        $query = DB::connection()->prepare('UPDATE asiakas SET kayttajatunnus=:kayttajatunnus, salasana=:salasana, etunimi=:etunimi, sukunimi=:sukunimi, nimimerkki=:nimimerkki, syntymaaika=:syntymaaika, sukupuoli=:sukupuoli, katuosoite=:katuosoite, postinumero=:postinumero, paikkakunta=:paikkakunta WHERE asiakasID=:asiakasid');
        $query->execute(array('kayttajatunnus' => $params['kayttajatunnus'], 'salasana' => $params['salasana'], 'etunimi' => $params['etunimi'], 'sukunimi' => $params['sukunimi'], 'nimimerkki' => $params['nimimerkki'], 'syntymaaika' => $params['syntymaaika'], 'sukupuoli' => $params['sukupuoli'], 'katuosoite' => $params['katuosoite'], 'postinumero' => $params['postinumero'], 'paikkakunta' => $params['paikkakunta'], 'asiakasid' => $this->asiakasid));

//        Kint::trace();
//        Kint::dump($row);
    }

    public function validoi_etunimi() {
        $errors = array();
        if (!$this->val_strlen($this->etunimi, 2))
            $errors[] = 'Etunimessä on oltava vähintään 2 merkkiä';
        if (!$this->notNull($this->etunimi))
            $errors[] = 'Etunimi ei saa olla tyhjä';
        return $errors;
    }

    public function validoi_sukunimi() {
        $errors = array();
        if (!$this->val_strlen($this->sukunimi, 2))
            $errors[] = 'Sukunimessä on oltava vähintään 2 merkkiä';
        if (!$this->notNull($this->sukunimi))
            $errors[] = 'Sukunimi ei saa olla tyhjä';
        return $errors;
    }

    public function validoi_kayttajatunnus() {
        $errors = array();
        if (!$this->val_strlen($this->kayttajatunnus, 3))
            $errors[] = 'Käyttäjätunnuksessa on oltava vähintään 3 merkkiä';
        if (!$this->notNull($this->kayttajatunnus))
            $errors[] = 'Käyttäjätunnus ei saa olla tyhjä';
        return $errors;
    }

    public function validoi_nimimerkki() {
        $errors = array();
        if (!$this->val_strlen($this->nimimerkki, 3))
            $errors[] = 'Nimimerkissä on oltava vähintään 3 merkkiä';
        if (!$this->notNull($this->nimimerkki))
            $errors[] = 'Nimimerkki ei saa olla tyhjä';
        return $errors;
    }

    public function validoi_salasana() {
        $errors = array();
        if (!$this->val_strlen($this->salasana, 6))
            $errors[] = 'Salasanassa on oltava vähintään 6 merkkiä';
        if (!$this->notNull($this->salasana))
            $errors[] = 'Salasana ei saa olla tyhjä';
        return $errors;
    }

    public function validoi_syntymaaika() {
        $errors = array();
        $date_arr = array();
        $date_arr = explode('-', $this->syntymaaika);
        if (!$this->val_strlen($this->syntymaaika, 10))
            $errors[] = 'Syntymäajassa on oltava vähintään 10 merkkiä: YYYY-MM-DD';
        if (substr($this->syntymaaika, 4, 1) != '-' && substr($this->syntymaaika, 7, 1) != '-') {
            $errors[] = 'Päivämääräerottimena on käytettävä merkkiä -';
        } else if (!(is_numeric(substr($this->syntymaaika, 0, 4))) && is_numeric(substr($this->syntymaaika, 5, 2)) && is_numeric(substr($this->syntymaaika, 8, 2))) {
            $errors[] = 'Syntymäaika ei ole muodossa YYYY-MM-DD';
        } else if (!$date_arr[0] || !$date_arr[1] || !$date_arr[2]) {
            $errors[] = 'Syntymäaika ei ole vaditussa muodossa';
        } else if (!checkdate($date_arr[1], $date_arr[2], $date_arr[0])) {
            $errors[] = 'Syntymäajan on oltava muotoa YYYY-MM-DD';
        }


        return $errors;
    }

    public function validoi_sukupuoli() {
        $errors = array();
        if ($this->sukupuoli != 'M' && $this->sukupuoli != 'F')
            $errors[] = 'Sukupuolen on oltava M tai F';
        return $errors;
    }

    public function validoi_katuosoite() {
        $errors = array();
        if (!$this->val_strlen($this->katuosoite, 3))
            $errors[] = 'Katunimessä on oltava vähintään 3 merkkiä';
        if (!$this->notNull($this->katuosoite))
            $errors[] = 'Katunimi ei saa olla tyhjä';
        return $errors;
    }

    public function validoi_postinumero() {
        $errors = array();
        if (strlen($this->postinumero) != 5)
            $errors[] = 'Postinumerossa on oltava 5 numeroa';
        if (!is_numeric($this->postinumero))
            $errors[] = 'Postinumeron on oltava numero';
        return $errors;
    }

    public function validoi_paikkakunta() {
        $errors = array();
        if (!$this->val_strlen($this->paikkakunta, 2))
            $errors[] = 'Paikkakunnassa on oltava vähintään 2 merkkiä';
        if (!$this->notNull($this->paikkakunta))
            $errors[] = 'Paikkakunta ei saa olla tyhjä';
        return $errors;
    }

}
