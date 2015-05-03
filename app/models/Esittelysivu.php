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
class Esittelysivu extends BaseModel {

    //put your code here
    public $sivuid, $asiakasid, $otsikko, $sisalto, $salainen;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoi_otsikko', 'validoi_sisalto');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Esittelysivu');
        $query->execute();
        $rows = $query->fetchAll();
        $sivut = array();
        foreach ($rows as $row) {
            $sivut[] = new Esittelysivu(array(
                'sivuid' => $row['sivuid'],
                'asiakasid' => $row['asiakasid'],
                'otsikko' => $row['otsikko'],
                'sisalto' => $row['sisalto'],
                'salainen' => $row['salainen']
            ));
        }

//                Kint::trace();
//        Kint::dump($viestit);


        return $sivut;
    }

    public static function kayttajan_sivut() {
        $query = DB::connection()->prepare('SELECT * FROM Esittelysivu WHERE asiakasID=:asiakasid ORDER BY sivuID');
        $query->execute(array('asiakasid' => $_SESSION['kayttajaid']));
        $query->execute();
        $rows = $query->fetchAll();
        $sivut = array();
        foreach ($rows as $row) {
            $sivut[] = new Esittelysivu(array(
                'sivuid' => $row['sivuid'],
                'asiakasid' => $row['asiakasid'],
                'otsikko' => $row['otsikko'],
                'sisalto' => $row['sisalto'],
                'salainen' => $row['salainen']
            ));
        }

//                Kint::trace();
//        Kint::dump($viestit);


        return $sivut;
    }

    public static function haeJulkisetSivut($aid) {
        $query = DB::connection()->prepare('SELECT * FROM Esittelysivu WHERE asiakasID=:asiakasid AND salainen=false ORDER BY sivuID');
        $query->execute(array('asiakasid' => $aid));
        $query->execute();
        $rows = $query->fetchAll();
        $sivut = array();
        foreach ($rows as $row) {
            $sivut[] = new Esittelysivu(array(
                'sivuid' => $row['sivuid'],
                'asiakasid' => $row['asiakasid'],
                'otsikko' => $row['otsikko'],
                'sisalto' => $row['sisalto'],
                'salainen' => $row['salainen']
            ));
        }

//                Kint::trace();
//        Kint::dump($viestit);


        return $sivut;
    }

    public static function haeSalaisetSivut($aid) {
        $kayttaja = $_SESSION['kayttajaid'];
        $haku1 = 'SELECT sivuid, asiakasid, otsikko, sisalto, salainen, ';
        $haku2 = 'CASE WHEN EXISTS (';
        $haku3 = 'SELECT sivuid FROM Lukuoikeus WHERE Lukuoikeus.sivuid=Esittelysivu.sivuid AND Lukuoikeus.asiakasid=:asiakasid) ';
        $haku4 = "THEN TRUE ELSE FALSE END AS oikeudet FROM Esittelysivu WHERE asiakasid=:kayttajaid AND salainen=TRUE";
        $haku=$haku1.$haku2.$haku3.$haku4;
        $query = DB::connection()->prepare($haku);
        $query->execute(array('asiakasid' => $aid, 'kayttajaid' => $kayttaja));
//        $query->execute();
        $rows = $query->fetchAll();
        $sivut = array();
        $i=0;
        foreach ($rows as $row) {
            $sivut[$i]=array(
                'sivuid' => $row['sivuid'],
                'asiakasid' => $row['asiakasid'],
                'otsikko' => $row['otsikko'],
                'sisalto' => $row['sisalto'],
                'salainen' => $row['salainen'],
                'lukuoikeus'=> $row['oikeudet']
            );
            $i++;
//            $sivut[]=$temp;
        }

//                Kint::trace();
//        Kint::dump($viestit);


        return $sivut;
    }

    public static function haeJulkisetJaSalaisetSivut($aid) {
        $kayttaja = $_SESSION['kayttajaid'];
        $haku1 = 'SELECT sivuid, asiakasid, otsikko, sisalto, salainen FROM Esittelysivu WHERE asiakasID=:aid AND salainen=false';
        $haku2 = 'SELECT es.sivuid AS sivuid, es.asiakasid AS asiakasid, es.otsikko AS otsikko, es.sisalto AS sisalto, es.salainen AS salainen FROM Esittelysivu AS es, Lukuoikeus AS lo ';
        $haku3 = 'WHERE es.sivuid=lo.sivuid AND lo.asiakasid=:kayttaja AND es.asiakasid=:aid';
        $haku = '(' . $haku1 . ') UNION (' . $haku2 . $haku3 . ') ORDER BY sivuid';
        $query = DB::connection()->prepare($haku);
        $query->execute(array('aid' => $aid, 'kayttaja' => $kayttaja));
        $rows = $query->fetchAll();
        $sivut = array();
        foreach ($rows as $row) {
            $sivut[] = new Esittelysivu(array(
                'sivuid' => $row['sivuid'],
                'asiakasid' => $row['asiakasid'],
                'otsikko' => $row['otsikko'],
                'sisalto' => $row['sisalto'],
                'salainen' => $row['salainen']
            ));
        }

//        Kint::trace();
//        Kint::dump($aid);
//        Kint::dump($rows);
//        Kint::dump($haku);
//        Kint::dump($sivut);


        return $sivut;
    }

//    public static function kayttajan_lahettamat_viestit() {
//        $query = DB::connection()->prepare('SELECT * FROM Viesti WHERE lahettaja=:lahettajaid ORDER BY aikaleima DESC');
//        $query->execute(array('lahettajaid' => $_SESSION['kayttajaid']));
//        $query->execute();
//        $rows = $query->fetchAll();
//        $viestit = array();
//        foreach ($rows as $row) {
//            $viestit[] = new Viesti(array(
//                'viestiid' => $row['viestiid'],
//                'lahettaja' => $row['lahettaja'],
//                'vastaanottaja' => $row['vastaanottaja'],
//                'sisalto' => $row['sisalto'],
//                'aikaleima' => $row['aikaleima'],
//                'luettu' => $row['luettu']
//            ));
//        }
//
////                Kint::trace();
////        Kint::dump($viestit);
//
//
//        return $viestit;
//    }

//    public static function hae_viesti($vid) {
//        $query = DB::connection()->prepare('SELECT viestiid, lahettaja, vastaanottaja, sisalto, aikaleima, luettu FROM Viesti WHERE viestiid=:viestiid');
//        $query->execute(array('viestiid' => $vid));
//        $query->execute();
//        $row = $query->fetch();
//
//        $viesti = new Viesti(array(
//            'viestiid' => $row['viestiid'],
//            'lahettaja' => $row['lahettaja'],
//            'vastaanottaja' => $row['vastaanottaja'],
//            'sisalto' => $row['sisalto'],
//            'aikaleima' => $row['aikaleima'],
//            'luettu' => $row['luettu']
//        ));
//
//
////                Kint::trace();
////        Kint::dump($viestit);
//
//
//        return $viesti;
//    }

//    public static function yllapitajan_viestilistaus() {
//        $query = DB::connection()->prepare('SELECT * FROM Viesti, Asiakas');
//        $query->execute();
//        $rows = $query->fetchAll();
//        $viestit = array();
//        foreach ($rows as $row) {
//            $viestit[] = new Viesti(array(
//                'viestiid' => $row['viestiid'],
//                'lahettaja' => $row['lahettaja'],
//                'vastaanottaja' => $row['vastaanottaja'],
//                'sisalto' => $row['sisalto'],
//                'aikaleima' => $row['aikaleima'],
//                'luettu' => $row['luettu']
//            ));
//        }
//
//        return $viestit;
//    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Esittelysivu (asiakasid, otsikko, sisalto ,salainen) VALUES (:asiakasid, :otsikko, :sisalto, :salainen) RETURNING sivuid');
        $query->execute(array('asiakasid' => $this->asiakasid, 'otsikko' => $this->otsikko, 'sisalto' => $this->sisalto, 'salainen' => $this->salainen));
        $row = $query->fetch();
// Kint::trace();
// Kint::dump($row);
        $this->sivuid = $row['sivuid'];
    }

    public function find($sid) {
        $query = DB::connection()->prepare('SELECT * FROM Esittelysivu WHERE sivuid=:sivuid LIMIT 1');
        $query->execute(array('sivuid' => $sid));
        $row = $query->fetch();

        $sivu = new Esittelysivu(array(
            'sivuid' => $row['sivuid'],
            'asiakasid' => $row['asiakasid'],
            'otsikko' => $row['otsikko'],
            'sisalto' => $row['sisalto'],
            'salainen' => $row['salainen']
        ));
        return $sivu;
    }
    
        public function haeSivuJaNimimerkki($sid) {
        $query = DB::connection()->prepare('SELECT sivuid, asiakas.nimimerkki as nimimerkki, otsikko, sisalto, salainen FROM Esittelysivu, Asiakas WHERE esittelysivu.asiakasid=asiakas.asiakasid AND esittelysivu.sivuid=:sivuid LIMIT 1');
        $query->execute(array('sivuid' => $sid));
        $row = $query->fetch();

        $sivu = array(
            'sivuid' => $row['sivuid'],
            'otsikko' => $row['otsikko'],
            'sisalto' => $row['sisalto'],
            'salainen' => $row['salainen'],
            'nimimerkki' => $row['nimimerkki']
        );
        
        return $sivu;
    }

    public function paivita_sivu($params) {


        $sivu = new Esittelysivu(array(
            'sivuid' => $row['sivuid'],
            'asiakasid' => $row['asiakasid'],
            'otsikko' => $row['otsikko'],
            'sisalto' => $row['sisalto'],
            'salainen' => $row['salainen']
        ));
        return $sivu;
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Esittelysivu SET otsikko=:otsikko, sisalto=:sisalto, salainen=:salainen WHERE sivuid=:sivuid');
        $query->execute(array('otsikko' => $this->otsikko, 'sisalto' => $this->sisalto, 'salainen' => $this->salainen, 'sivuid' => $this->sivuid));
        $row = $query->fetch();
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Esittelysivu WHERE sivuid=:sivuid');
        $query->execute(array('sivuid' => $this->sivuid));

//        Kint::trace();
//        Kint::dump($row);
    }

    public function validoi_otsikko() {
        $errors = array();
        if (!$this->val_strlen($this->otsikko, 3))
            $errors[] = 'Otsikon on oltava vähintään 3 merkkiä pitkä';
        if (!$this->notNull($this->otsikko))
            $errors[] = 'Otsikko ei saa olla tyhjä';
        return $errors;
    }

    public function validoi_sisalto() {
        $errors = array();
        if (!$this->val_strlen($this->sisalto, 3))
            $errors[] = 'Sisällön on oltava vähintään 3 merkkiä pitkä';
        if (!$this->notNull($this->sisalto))
            $errors[] = 'Sisältö ei saa olla tyhjä';
        return $errors;
    }

}
