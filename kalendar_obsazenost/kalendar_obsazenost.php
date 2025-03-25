<html>
    
<head>
    <title>Obsazenost</title>
    <meta http-equiv="Content-Language" content="cs" /> <!-- jazyk stránky -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" /> <!-- kodovani stranky -->
    <meta name = "description" content = "kalendar">
    <meta name = "keywords" content = "obsazenost kalendar">
    <meta name = "robots" content = "all, follow">

    
    <link rel="stylesheet" href="knihovna/styly_kalendar_obsazenost.css">
    
</head>
<body>
<?php


require "knihovna/fce_dny_mesice.php";
require "knihovna/sql.php";
require "knihovna/zobrazeni_rezervaci1.php";


echo"<article>";
    require "knihovna/kalendarindex.php";
echo"</article>";
echo"<div class='cistic'></div>";
echo"<footer class='cistic'>";
    zobrazeni_rezervaci1($fden_stamp);
echo"</footer>";


?>
</body>
</html>