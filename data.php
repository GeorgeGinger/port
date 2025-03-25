<?php
class Stranka
{
    private $id;
    private $titulek;
    private $menu;
    private $obrazek;

    function __construct($argId, $argTitulek, $argMenu, $argObrazek)
    {
        $this->id = $argId;
        $this->titulek = $argTitulek;
        $this->menu = $argMenu;
        $this->obrazek = $argObrazek;
    }

    //GETTERY
    function getId()
    {
        return $this->id;
    }

    function getTitulek()
    {
        return $this->titulek;
    }

    function getMenu()
    {
        return $this->menu;
    }

    function getObrazek()
    {
        return $this->obrazek;
    }
    function getObsah()
    {
        return file_get_contents("./{$this->id}.html");
    }
    function setObsah($argNovyObsah)
    {
        file_put_contents("./{$this->id}.html", $argNovyObsah);
    }
}

$poleStranek = array(
    "domu" => new Stranka("domu", "PrimaPenzion", "Domů", "primapenzion-main.jpg"),
    "kontakt" => new Stranka("kontakt", "Kontakt", "Kudy k nám", "primapenzion-room2.jpg"),
    "galerie" => new Stranka("galerie", "Fotogalerie", "Fotky", "primapenzion-pool-min.jpg"),
    
);






/*
$poleStranek = array(
    "domu" => [
        "id" => "domu",
        "titulek" => "PrimaPenzion",
        "menu" => "Domů",
        "obrazek" => "primapenzion-main.jpg"
    ],
    "galerie" => [
        "id" => "galerie",
        "titulek" => "Fotogalerie",
        "menu" => "Fotky",
        "obrazek" => "primapenzion-pool-min.jpg"
    ],
    "rezervace" => [
        "id" => "rezervace",
        "titulek" => "Rezervace",
        "menu" => "Chci pokoj",
        "obrazek" => "primapenzion-room.jpg"
    ],
    "kontakt" => [
        "id" => "kontakt",
        "titulek" => "Kontakt",
        "menu" => "Napište nám",
        "obrazek" => "primapenzion-room2.jpg"
    ],
);
*/