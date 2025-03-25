<?php

$min = $shortcode->getParameter("od", 15);
$max = $shortcode->getParameter("do");



$nahodneCislo = rand($min, $max);

echo $nahodneCislo;