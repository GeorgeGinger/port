<?php
session_start();

require_once "./pripojeni.php";

if(array_key_exists("jePrihlasen", $_SESSION)) {
    $uzivatel = $_SESSION["jePrihlasen"]["jmeno"];
    $heslo = $_SESSION["jePrihlasen"]["heslo"];

    $dotaz = $db->prepare("SELECT * FROM hodinysetup WHERE uzivatel=? AND heslo=?");
    $dotaz->execute([$uzivatel, $heslo]);
    $vysledek = $dotaz->fetch();

    if($vysledek) {
        echo json_encode($vysledek); 
    }

}else {
    echo false;
}

