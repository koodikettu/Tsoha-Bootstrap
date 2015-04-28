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
        $query = DB::connection()->prepare('SELECT * FROM Viesti WHERE vastaanottaja=:vastaanottajaid');
        $query->execute(array('vastaanottajaid' => $_SESSION['kayttajaid']));
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

    public static function kayttajan_lahettamat_viestit() {
        $query = DB::connection()->prepare('SELECT * FROM Viesti WHERE lahettaja=:lahettajaid');
        $query->execute(array('lahettajaid' => $_SESSION['kayttajaid']));
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

    public static function yllapitajan_viestilistaus() {
        $query = DB::connection()->prepare('SELECT * FROM Viesti, Asiakas');
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

        return $viestit;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Viesti (lahettaja, vastaanottaja, sisalto) VALUES (:lahettaja, :vastaanottaja, :sisalto) RETURNING viestiid');
        $query->execute(array('lahettaja' => $this->lahettaja, 'vastaanottaja' => $this->vastaanottaja, 'sisalto' => $this->sisalto));
        $row = $query->fetch();
// Kint::trace();
// Kint::dump($row);
        $this->viestiid = $row['viestiid'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Viesti SET lahettaja=:lahettaja, vastaanottaja=:vastaanottaja, sisalto=:sisalto, aikaleima=now()::timestamp(0), luettu=:luettu WHERE viestiid=:viestiid RETURNING aikaleima');
        $query->execute(array('lahettaja' => $this->lahettaja, 'vastaanottaja' => $this->vastaanottaja, 'sisalto' => $this->sisalto, 'luettu' => $this->luettu, 'viestiid' => $this->viestiid));
        $row = $query->fetch();


        $this->aikaleima = $row['aikaleima'];
    }

    public function merkitse_luetuksi() {
        $query = DB::connection()->prepare('UPDATE Viesti SET luettu=true WHERE viestiid=:viestiid');
        $query->execute(array('viestiid' => $this->viestiid));
        $row = $query->fetch();
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Viesti WHERE viestiid=:viestiid');
        $query->execute(array('viesti' => $this->viestiid));

//        Kint::trace();
//        Kint::dump($row);
    }

    public function validoi_sisalto() {
        $errors = array();
        if (!$this->val_strlen($this->sisalto, 3))
            $errors[] = 'Viestissä on oltava vähintään 3 merkkiä';
        if (!$this->notNull($this->sisalto))
            $errors[] = 'Viesti ei saa olla tyhjä';
        return $errors;
    }

}
