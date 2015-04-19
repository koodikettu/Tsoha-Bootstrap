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
class Viesti extends BaseModel {

    //put your code here
    public $viestiid, $lahettaja, $vastaanottaja, $sisalto;


    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoi_sisalto');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Viesti');
        $query->execute();
        $rows = $query->fetchAll();
        $viestit = array();
        foreach ($rows as $row) {
            $viestit[] = new Viesti(array(
                'viestiid' => $row['viestiid'],
                'lahettaja' => $row['lahettaja'],
                'vastaanottaja' => $row['vastaanottaja'],
                'sisalto' => $row['sisalto']
            ));
        }

        return $viestit;
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
        $query = DB::connection()->prepare('INSERT INTO Viesti (lahettaja, vastaanottaja, sisalto) VALUES (:lahettaja, :vastaanottaja, :sisalto) RETURNING viestiid');
        $query->execute(array('lahettaja' => $this->lahettaja, 'vastaanottaja' => $this->vastaanottaja, 'sisalto' => $this->sisalto));
        $row = $query->fetch();

//        Kint::trace();
//        Kint::dump($row);

        $this->viestiid = $row['viestiid'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Viesti WHERE viestiid=:viestiid');
        $query->execute(array('viesti' => $this->viestiid));

//        Kint::trace();
//        Kint::dump($row);
    }

    public function update_asiakastiedot($params) {
        $query = DB::connection()->prepare('UPDATE asiakas SET kayttajatunnus=:kayttajatunnus, salasana=:salasana, etunimi=:etunimi, sukunimi=:sukunimi, nimimerkki=:nimimerkki, syntymaaika=:syntymaaika, sukupuoli=:sukupuoli, katuosoite=:katuosoite, postinumero=:postinumero, paikkakunta=:paikkakunta WHERE asiakasID=:asiakasid');
        $query->execute(array('kayttajatunnus' => $params['kayttajatunnus'], 'salasana' => $params['salasana'], 'etunimi' => $params['etunimi'], 'sukunimi' => $params['sukunimi'], 'nimimerkki' => $params['nimimerkki'], 'syntymaaika' => $params['syntymaaika'], 'sukupuoli' => $params['sukupuoli'], 'katuosoite' => $params['katuosoite'], 'postinumero' => $params['postinumero'], 'paikkakunta' => $params['paikkakunta'], 'asiakasid' => $this->asiakasid));

//        Kint::trace();
//        Kint::dump($row);
    }

    public function validoi_sisalto() {
        $errors = array();
        if (!$this->val_strlen($this->etunimi, 3))
            $errors[] = 'Viestissä on oltava vähintään 3 merkkiä';
        if (!$this->notNull($this->etunimi))
            $errors[] = 'Viesti ei saa olla tyhjä';
        return $errors;
    }

    

}
