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
class AsiakasController extends BaseController{
    //put your code here
    
    public static function store(){
        $params = $_POST;
        
        $asiakas = new Asiakas(array(
                'etunimi' => $params['etunimi'],
                'sukunimi' => $params['sukunimi'],
                'nimimerkki' => $params['nimimerkki'],
                'kayttajatunnus' => $params['kayttajatunnus'],
                'salasana' => $params['salasana'],
                'syntymaaika' => $params['syntymaaika'],
                'sukupuoli' => $params['sukupuoli'],
                'katuosoite' => $params['katuosoite'],
                'postinumero' => $params['postinumero'],
                'paikkakunta' => $params['paikkakunta']
//                'haettu_ika_max' => $params['haettu_ika_max'],
//                'haettu_ika_min' => $params['haettu_ika_min'],
//                'haettu_sukupuoli' => $params['haettu_sukupuoli'],
//                'esittelyteksti' => $params['esittelyteksti']
            
        ));
        
//        Kint::dump($params);
        
        $asiakas->save();
        
        Redirect::to('/etusivu', array('message' => 'Tervetuloa palvelun käyttäjäksi, ' . $params['etunimi'] . '!'));
    }
    
    public static function naytaKayttaja($kayttajatunnus){
        $kayttaja = Asiakas::haeKayttaja($kayttajatunnus);
//        Kint::dump($kayttaja);
        View::make('suunnitelmat/kayttajatiedot.html', array('kayttaja' => $kayttaja));
    }
}
