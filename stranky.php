<?php
$db = new PDO(
    "mysql:host=localhost;dbname=primakavarna;charset=utf8",
    "root",
    "Harry123.",
    array (
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ),
);

class Stranka {
    public $id;
    public $titulek;
    public $menu;

    function __construct($id, $titulek, $menu) {
        $this->id = $id;
        $this->titulek = $titulek;
        $this->menu = $menu;
    }

    function getObsah() {
        //return file_get_contents("$this->id.html");

        global $db;
        $dotaz = $db->prepare("SELECT obsah FROM stranka WHERE id = ?");
        $dotaz->execute([$this->id]);
        $vysledek = $dotaz->fetch();
        
        if ($vysledek == false) {
            return ""; // Pokud by databáze nic nevrátila, tak vrátíme prázdný obsah
        } else {
            return $vysledek["obsah"];
        }
    }

    function setObsah($obsah) {
        // file_put_contents("$this->id.html", $obsah);

        // Nastavit obsah do databáze
        global $db;
        $dotaz = $db->prepare("UPDATE stranka SET obsah = ? WHERE id = ?");
        $vysledek = $dotaz->execute([$obsah, $this->id]);
    }
    
    // funkce na uložení id, titulku a menu v databázi
    function ulozit($puvodniId) {
        global $db;

        if ($puvodniId != "") {
            // Updatujeme stávající stránku
            $dotaz = $db->prepare("UPDATE stranka SET id = ?, titulek = ?, menu = ? WHERE id = ?");
            $dotaz->execute([$this->id, $this->titulek, $this->menu, $puvodniId]);
        } else {
            // Vložení nové stránky
            $dotaz = $db->prepare("SELECT MAX(poradi) AS poradi FROM stranka");
            $dotaz->execute();
            $vysledek = $dotaz->fetch();
            $poradi = $vysledek["poradi"] + 1;

            $dotaz = $db->prepare("INSERT INTO stranka SET id = ?, titulek = ?, menu = ?, poradi = ?");
            $dotaz->execute([$this->id, $this->titulek, $this->menu, $poradi]);
        }
        
    }

    // funkce pro vymazání stránky
    function smazat() {
        global $db;

        $dotaz = $db->prepare("DELETE FROM stranka WHERE id = ?");
        $dotaz->execute([$this->id]);

    }

    // Funkce pro změnu pořadí všech stránek pomocí JS (proto statická funkce, týká se to všech instancí)
    static function zmenaPoradi($poradi) {
        global $db;

        foreach ($poradi as $cisloPoradi => $idStranky) {
            $dotaz = $db->prepare("UPDATE stranka SET poradi = ? WHERE id = ?");
            $dotaz->execute([$cisloPoradi, $idStranky]);
        }    
    }
}

/*
$seznamStranek = [
    "uvod" => new Stranka("uvod", "PrimaPenzion", "Domů"),
    "nabidka" => new Stranka("nabidka", "PrimaPenzion - Nabídka", "Nabídka"),
    "galerie" => new Stranka("galerie", "PrimaPenzion - Galerie", "Galerie"),
    "rezervace" => new Stranka("rezervace", "PrimaPenzion - Rezervace", "Rezervace"),
    "kontakt" => new Stranka("kontakt", "PrimaPenzion - Kontakt", "Kontakt"),
    // "cenik" => new Stranka("cenik", "PrimaPenzion - Ceník", "Ceník"),
    "404" => new Stranka ("404", "Stránka neexistuje", ""),
];
*/

$seznamStranek = [];
// pole se seznamem stránek načteme dynamicky z databáze

$dotaz = $db->prepare("SELECT id, titulek, menu FROM stranka ORDER BY poradi");
$dotaz->execute();
$vysledek = $dotaz->fetchAll();
// var_dump($vysledek);

foreach ($vysledek as $stranka) {
    $idStranky = $stranka["id"];
    $seznamStranek[$idStranky] = new Stranka($idStranky, $stranka["titulek"], $stranka["menu"]);
}