<?php
session_start();

require_once "./pripojeni.php";

if (array_key_exists("jePrihlasen", $_SESSION)) {
    $uzivatel = $_SESSION["jePrihlasen"]["jmeno"];
    $heslo = $_SESSION["jePrihlasen"]["heslo"];

    if (array_key_exists("data", $_POST)) {
        $setUpPage = $_POST["data"];
        echo $setUpPage;
        
        $dotaz = $db->prepare("UPDATE hodinysetup SET setUpPage=? WHERE uzivatel=? AND heslo=?");
        $dotaz->execute([$setUpPage, $uzivatel, $heslo]);
    }
   
} else {
    echo "Stranka neuložena nepřihlášený uživatel";
}


