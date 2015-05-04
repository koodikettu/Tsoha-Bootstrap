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
class Lukuoikeus extends BaseModel {

    //put your code here
    public $sivuid, $asiakasid;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function poistaLukuoikeus($sivu, $kayttaja) {
        $query = DB::connection()->prepare('DELETE FROM Lukuoikeus WHERE sivuid=:sivuid AND asiakasid=:asiakasid');
        $query->execute(array('sivuid' => $sivu, 'asiakasid' => $kayttaja));
        $rows = $query->fetchAll();
//        Kint::trace();
//        Kint::dump($rows);
    }

    public static function poistaLukuoikeudet($sivu) {
        $query = DB::connection()->prepare('DELETE FROM Lukuoikeus WHERE sivuid=:sivuid');
        $query->execute(array('sivuid' => $sivu));
        $rows = $query->fetchAll();
//        Kint::trace();
//        Kint::dump($rows);
    }

    public static function lisaaLukuoikeus($sivu, $kayttaja) {
        $query = DB::connection()->prepare('INSERT INTO Lukuoikeus (sivuid, asiakasid) VALUES (:sivuid, :asiakasid)');
        $query->execute(array('sivuid' => $sivu, 'asiakasid' => $kayttaja));
        $rows = $query->fetchAll();
//        Kint::trace();
//        Kint::dump($rows);
    }
    
        public static function tarkistaLukuoikeus($sivu, $kayttaja) {
        $query = DB::connection()->prepare('SELECT * FROM Lukuoikeus WHERE sivuid=:sivuid AND asiakasid=:asiakasid');
        $query->execute(array('sivuid' => $sivu, 'asiakasid' => $kayttaja));
        $rows = $query->fetchAll();
//        Kint::dump($kayttaja);
//        Kint::dump($sivu);
//        Kint::dump($rows);
        if(empty($rows))
            return false;
        return true;
    }

}
