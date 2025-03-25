<?php
$db = new PDO(
	"mysql:host=hodiny.saunaklubslany.cz;dbname=hodiny-saunaklub;charset=utf8mb4",
	"hodiny-saunaklub",
	"Yc5VqnNP4zV6",
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);