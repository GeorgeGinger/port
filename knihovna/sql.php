<?php

function save_akce_do_sql(){
//pripojeni k databazi
$spojeni=mysqli_connect("mysql.saunaklubslany.cz", "mysql-saunaklub", "4luggFcG8BaM", "mysql-saunaklub");
//if($spojeni ==false) echo "Chyba"; else echo "Spojeni OK";
//echo "<br>";

    $jmeno=   $_POST["fjmeno"];
    $email=   $_POST["femail"];
    $tel=     $_POST["ftel"];
    $datumrez=$_POST["fdatumrez"];
    $casrez=  $_POST["fcasrez"];
    $sluzba=  $_POST["fsluzba"];
    $doba=    $_POST["fdoba"];
    $poznamka=$_POST["fpoznamka"];
//ulozeni hodnot z formulare do databaze
mysqli_query($spojeni,"SET NAMES 'utf8' COLLATE 'utf8_czech_ci'");
$sql="INSERT INTO jednorazove_akce (jmeno,email,tel,datum,cas,sluzba,doba,poznamka)";
$sql=$sql." VALUES ('".$jmeno."','".$email."',".$tel.",'".$datumrez."','".$casrez."',".$sluzba.",".$doba.",'".$poznamka."')";
$vysledek=mysqli_query($spojeni,$sql);
//if($vysledek) echo "PRIDANO save_akce_do_sql"; else echo "Pridani save_akce_do_sql NEUSPESNE ";
//echo "<br>";
$pocet=mysqli_affected_rows($spojeni);
$posledni=mysqli_insert_id($spojeni);
//echo "pridano radku: ".$pocet." Poskedni id: ".$posledni;
//echo "<br>";
//ukonceni spojeni s databazi
mysqli_close($spojeni);
return $pocet;
}

function save_opakovanaakce_do_sql($fdatzacakce){
//pripojeni k databazi
$spojeni=mysqli_connect("mysql.saunaklubslany.cz", "mysql-saunaklub", "4luggFcG8BaM", "mysql-saunaklub");
if($spojeni ==false) echo "Chyba spojeni save opakovana akce d sql"; 
//else echo "Spojeni OK";
//echo "<br>";

mysqli_query($spojeni,"SET NAMES 'utf8' COLLATE 'utf8_czech_ci'");
$sql3="INSERT INTO opakovaneakce (nazevakce,datzacakce,caszacakce,delkaakce,opakovaniakce,datkonakce,poznamkaakce)";
$sql3=$sql3." VALUES ('".$_POST['fnazevakce']."','".$fdatzacakce."','".$_POST['fcaszacakce']."',".$_POST['fdelkaakce'].",".$_POST['fopakovaniakce'].",'".$_POST['fdatkonakce']."','".$_POST['fpoznamkaakce']."')";
$vysledek=mysqli_query($spojeni,$sql3);
if($vysledek) echo "PRIDANO save_opakovanaakce_do_sql"; else echo "Pridani save_opakovanaakce_do_sql NEUSPESNE";
echo "<br>";
$pocet=mysqli_affected_rows($spojeni);
$posledni=mysqli_insert_id($spojeni);
echo "pridano radku: ".$pocet." Poskedni id: ".$posledni;
echo "<br>";
//ukonceni spojeni s databazi
mysqli_close($spojeni);
}

function save_do_obsazenosti($pole, $datum){
    //ulozeni hodnot do databaze, tabulka obsazenost
    //pripojeni k databazi
    $spojeni=mysqli_connect("mysql.saunaklubslany.cz", "mysql-saunaklub", "4luggFcG8BaM", "mysql-saunaklub");
    if($spojeni ==false)echo "Chyba save do obsazenosti";
    //else echo "Spojeni OK";
    //echo "<br>";
            
            mysqli_query($spojeni,"SET NAMES 'utf8' COLLATE 'utf8_czech_ci'");
            $sql1="INSERT INTO `obsazenost` (`id`, `datum`";
            for($j=0;$j<96;$j++){
    
                $sql1=$sql1.", `".$j."`";
            }
            $sql1=$sql1.") VALUES (NULL,'".$datum."'";
            for($j=0;$j<96;$j++){
                $sql1=$sql1.", '".$pole[$j]."'";
            }
            $sql1=$sql1.")";
           //echo "vypis dotazu 1 ";
            //echo $sql1;
            //echo"<br>";
            
    
    //priklad fungujiciho dotazu pro ulozeni dat        
    //$sql="INSERT INTO `tobsazenost` (`id`, `datum`, `0`, `1`, `2`, `3`, `4`, `5`) VALUES (NULL,'".$_POST['fdatumrez']."',".$a.",".$a.",".$a.",".$a.",".$a.",".$a.")";
    
    $vysledek=mysqli_query($spojeni,$sql1);
    //if($vysledek) echo "PRIDANO do obsazenosti"; else echo "<br>Pridani do obsazenosti neuspesne";
    //echo "<br>";
    $pocet=mysqli_affected_rows($spojeni);
    $posledni=mysqli_insert_id($spojeni);
    //echo "pridano do obsazenosti radku: ".$pocet." Poskedni obsazenosti id: ".$posledni;
    //echo "<br>";
    mysqli_close($spojeni);
    }

    function update_obsazenosti($pole, $datum){
        //ulozeni hodnot do databaze, tabulka obsazenost
        //pripojeni k databazi
        $spojeni=mysqli_connect("mysql.saunaklubslany.cz", "mysql-saunaklub", "4luggFcG8BaM", "mysql-saunaklub");
        //if($spojeni ==false)echo "Chyba update obsazenosti"; 
        //else echo "Spojeni OK";
        //echo "<br>";
                
                mysqli_query($spojeni,"SET NAMES 'utf8' COLLATE 'utf8_czech_ci'");
                $sql1="UPDATE `obsazenost` SET `0` = '".$pole[0]."'";
                for($j=1;$j<96;$j++){
        
                    $sql1=$sql1.", `".$j."` = '".$pole[$j]."'";
                }
                $sql1=$sql1." WHERE `obsazenost`.`datum` = '".$datum."'";
                /*echo "vypis dotazu update1 <br> ";
                echo $sql1;
                echo"<br>";*/
                
        /*/$datum="2023-07-08";
        //priklad fungujiciho dotazu pro ulozeni dat   
        $sql1="UPDATE `obsazenost` SET `0` = '15', `1` = '1' WHERE `obsazenost`.`datum` = '$datum'";
        echo "vypis dotazu update2 <br> ";
        echo $sql1;
        echo"<br>";  */   
        $vysledek=mysqli_query($spojeni,$sql1);
        if($vysledek) echo "Update"; else echo "<br>Update obsazenosti neuspesne";
        echo "<br>";
        $pocet=mysqli_affected_rows($spojeni);
        $posledni=mysqli_insert_id($spojeni);
        //echo "pridano do obsazenosti radku: ".$pocet." Poskedni obsazenosti id: ".$posledni;
        //echo "<br>";
        mysqli_close($spojeni);
        }
?>