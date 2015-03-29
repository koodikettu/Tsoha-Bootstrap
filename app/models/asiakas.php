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

    public static function find($asiakasid) {
        $query = DB::connection()->prepare('SELECT * FROM asiakas WHERE asiakasid= :asiakasid LIMIT 1');
        $query->execute(array('asiakasid' => $asiakasid));
        $row=$query->fetch();
        
        if($row) {
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
        $row=$query->fetch();
        
//                Kint::trace();
//        Kint::dump($row);
        
        if($row) {
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
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO asiakas (kayttajatunnus, salasana, etunimi, sukunimi, nimimerkki, syntymaaika, sukupuoli, katuosoite, postinumero, paikkakunta) VALUES (:kayttajatunnus, :salasana, :etunimi, :sukunimi, :nimimerkki, :syntymaaika, :sukupuoli, :katuosoite, :postinumero, :paikkakunta) RETURNING asiakasid');
        $query->execute(array('kayttajatunnus' => $this->kayttajatunnus, 'salasana' => $this->salasana, 'etunimi' => $this->etunimi, 'sukunimi' => $this->sukunimi, 'nimimerkki' => $this->nimimerkki, 'syntymaaika' => $this->syntymaaika, 'sukupuoli' => $this->sukupuoli, 'katuosoite' => $this->katuosoite, 'postinumero' => $this->postinumero, 'paikkakunta' => $this->paikkakunta));
        $row = $query->fetch();
        
//        Kint::trace();
//        Kint::dump($row);
        
        $this->asiakasid=$row['asiakasid'];
    }

}
