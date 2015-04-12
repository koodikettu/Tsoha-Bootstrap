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
class Yllapitaja extends BaseModel {

    //put your code here
    public $yllapitajaid, $kayttajatunnus, $salasana;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function authenticate($ktunnus, $ssana) {
        $query = DB::connection()->prepare('SELECT * FROM Yllapitaja WHERE kayttajatunnus = :kayttajatunnus AND salasana = :salasana LIMIT 1');
        $query->execute(array('kayttajatunnus' => $ktunnus, 'salasana' => $ssana));

        $row = $query->fetch();
        if ($row) {
            $attribuutit = array(
                'yllapitajaid' => $row['yllapitajaid'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana']
            );
            $yllapitaja = new Yllapitaja($attribuutit);
            return $yllapitaja;
        }

        return null;
    }

    

}
