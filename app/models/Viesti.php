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
    public $viestiid, $lahettaja, $vastaanottaja, $sisalto, $aikaleima, $luettu;

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
                'sisalto' => $row['sisalto'],
                'aikaleima' => $row['aikaleima'],
                'luettu' => $row['luettu']
            ));
        }

//                Kint::trace();
//        Kint::dump($viestit);


        return $viestit;
    }

    public static function kayttajan_saapuneet_viestit() {
        $query = DB::connection()->prepare('SELECT v.viestiid AS viestiid, a.nimimerkki AS lahettaja, v.vastaanottaja AS vastaanottaja, v.sisalto AS sisalto, v.aikaleima AS aikaleima, v.luettu AS luettu FROM Viesti AS v, Asiakas AS a WHERE v.vastaanottaja=:vastaanottajaid AND v.lahettaja=a.asiakasid ORDER BY luettu, aikaleima DESC');
        $query->execute(array('vastaanottajaid' => $_SESSION['kayttajaid']));
        $rows = $query->fetchAll();
//        Kint::dump($rows);
        $viestit = array();
        $i=0;
        foreach ($rows as $row) {
            $viestit[$i]=array(
                'viestiid' => $row['viestiid'],
                'lahettaja' => $row['lahettaja'],
                'vastaanottaja' => $row['vastaanottaja'],
                'sisalto' => $row['sisalto'],
                'aikaleima' => $row['aikaleima'],
                'luettu' => $row['luettu']
            );
            $i++;

        }

//                Kint::trace();
//        Kint::dump($viestit);


        return $viestit;
    }

    public static function kayttajan_lahettamat_viestit() {
        $query = DB::connection()->prepare('SELECT v.viestiid as viestiid, v.lahettaja as lahettaja, a.nimimerkki as vastaanottaja, v.sisalto as sisalto, v.aikaleima as aikaleima, v.luettu as luettu FROM Viesti AS v, Asiakas AS a WHERE v.lahettaja=:lahettajaid AND v.vastaanottaja=a.asiakasid ORDER BY aikaleima DESC');
        $query->execute(array('lahettajaid' => $_SESSION['kayttajaid']));
        $rows = $query->fetchAll();
        $viestit = array();
        
        $i=0;
        foreach ($rows as $row) {
            $viestit[$i]=array(
                'viestiid' => $row['viestiid'],
                'lahettaja' => $row['lahettaja'],
                'vastaanottaja' => $row['vastaanottaja'],
                'sisalto' => $row['sisalto'],
                'aikaleima' => $row['aikaleima'],
                'luettu' => $row['luettu']
            );
            $i++;

        }
        

//                Kint::trace();
//        Kint::dump($viestit);


        return $viestit;
    }

    public static function hae_viesti($vid) {
        $query = DB::connection()->prepare('SELECT viestiid, lahettaja, vastaanottaja, sisalto, aikaleima, luettu FROM Viesti WHERE viestiid=:viestiid');
        $query->execute(array('viestiid' => $vid));
        $query->execute();
        $row = $query->fetch();

        $viesti = new Viesti(array(
            'viestiid' => $row['viestiid'],
            'lahettaja' => $row['lahettaja'],
            'vastaanottaja' => $row['vastaanottaja'],
            'sisalto' => $row['sisalto'],
            'aikaleima' => $row['aikaleima'],
            'luettu' => $row['luettu']
        ));


//                Kint::trace();
//        Kint::dump($viestit);


        return $viesti;
    }



    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Viesti (lahettaja, vastaanottaja, sisalto ,aikaleima, luettu) VALUES (:lahettaja, :vastaanottaja, :sisalto, now()::timestamp(0), false) RETURNING viestiid, aikaleima');
        $query->execute(array('lahettaja' => $this->lahettaja, 'vastaanottaja' => $this->vastaanottaja, 'sisalto' => $this->sisalto));
        $row = $query->fetch();
// Kint::trace();
// Kint::dump($row);
        $this->viestiid = $row['viestiid'];
        $this->aikaleima = $row['aikaleima'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Viesti SET sisalto=:sisalto, aikaleima=now()::timestamp(0), luettu=false WHERE viestiid=:viestiid');
        $query->execute(array('sisalto' => $this->sisalto, 'viestiid' => $this->viestiid));
        $row = $query->fetch();
    }

    public function merkitse_luetuksi() {
        $query = DB::connection()->prepare('UPDATE Viesti SET luettu=true WHERE viestiid=:viestiid');
        $query->execute(array('viestiid' => $this->viestiid));
        $row = $query->fetch();
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Viesti WHERE viestiid=:viestiid');
        $query->execute(array('viestiid' => $this->viestiid));

//        Kint::trace();
//        Kint::dump($row);
    }

    public function validoi_sisalto() {
        $errors = array();
        if (!$this->val_strlen(trim($this->sisalto), 3))
            $errors[] = 'Viestissä on oltava vähintään 3 merkkiä';
        if (!$this->notNull(trim($this->sisalto)))
            $errors[] = 'Viesti ei saa olla tyhjä';
        return $errors;
    }
    

    
        public static function yllapitajanViestilistaus() {
        $haku1 = 'SELECT lah.kayttajatunnus as lahettaja, vas.kayttajatunnus as vastaanottaja, viesti.sisalto as sisalto, viesti.aikaleima as aikaleima, viesti.luettu as luettu ';
        $haku2 = 'FROM viesti, asiakas as lah, asiakas as vas ';
        $haku3 = 'WHERE viesti.lahettaja=lah.asiakasid AND viesti.vastaanottaja=vas.asiakasid ';
        $haku4 = 'ORDER BY aikaleima DESC';
        $haku=$haku1.$haku2.$haku3.$haku4;
        $query = DB::connection()->prepare($haku);
        $query->execute();
//        $query->execute();
        $rows = $query->fetchAll();
        $viestit = array();
        $i=0;
        foreach ($rows as $row) {
            $viestit[$i]=array(
                'lahettaja' => $row['lahettaja'],
                'vastaanottaja' => $row['vastaanottaja'],
                'sisalto' => $row['sisalto'],
                'aikaleima' => $row['aikaleima'],
                'luettu' => $row['luettu']
            );
            $i++;

        }

//                Kint::trace();
//        Kint::dump($viestit);


        return $viestit;
    }

}
