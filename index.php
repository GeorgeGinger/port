<?php 

session_start();

// echo phpversion();

// Valid PHP Version
// verze php musi byt vyssi nez 8
$minPHPVersion = "8.0";
if (phpversion() < $minPHPVersion)
	{
		die("Your PHP version must be {$minPHPVersion} or higher to run this app. Your current version is" . $phpversion());
	}

// Path to this file
// definujeme konstantu ROOTPATH ktery obsahuje cestu k souboru ktery otvirame tedy v tomto pripade index.php
// existenci teto konstanty budeme zjistovat v souborech php do kterych chceme zamezit pristup

define('ROOTPATH',__DIR__ . DIRECTORY_SEPARATOR);
// DIRECTORI_SEPARATOR je / nebo \ podle toho co system pouziva

// echo ROOTPATH;

require "./app/core/init.php";

DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

$app = new App;
$app->loadController();
