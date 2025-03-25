<?php

// vytvoreni pripojeni na databazi
$db = new PDO(
    "mysql:host=localhost;dbname=db_saunaklub_editace;charset=utf8",
    "root",
    "", // heslo
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ),
);