
<?php


echo "<div class='zaklad'>";
    //blok s formularem pro vyber mesice
    echo"<div>";
        $pocet_radek_value=$_POST["pocet_radek"];
        vyber_mesice();
    echo"</div>";
    //blok tabulka nazvu dni
    echo "<div class='tabulka_nazvu_dni'>";

        $fden_stamp=$_POST["fden_stamp"];
        if($fden_stamp==0)$fden_stamp=time();
        $prvniden_stamp=create_frst_day_stamp($fden_stamp);
        //melo by probehnout jen pri prvnim macteni stranky

        echo "<table border width='100%' class='velikost_pisma_nazvydni'>";
            echo "<tr><td colspan='7'>";
                //zobrazeni zvoleneho mesice
                $mesic=datum_mesic($prvniden_stamp);
                echo$mesic;
                echo "&nbsp";
                $poledatum=getdate($fden_stamp);
                echo" ".$poledatum["mday"].".".$poledatum["mon"].".".$poledatum["year"];
            echo"</td></tr>";
        echo"<tr align='center'><td>NE</td><td>PO</td><td>ÚT</td><td>ST</td><td>ČT</td><td>PÁ</td><td>SO</td></tr></table>";
    echo "</div>";
    //blok tabulka cisel dni
    echo "<div class='tabulka_cisel_dni'>";
        echo"<table border width='100%' >";
        $denvtydnu=datum_den($prvniden_stamp);
            echo "<tr align='center'>";
        for($k=0;$k<7;$k++){ 
            if ($k==$denvtydnu) {
                echo "<td width='30'>";
                    $denvmesici=datum_mesic_den($prvniden_stamp);
                    echo"<form method='POST' action='kalendar.php'>";
                    echo"<input type='hidden' name='fden_stamp' value=$prvniden_stamp>";
                    echo"<input type='hidden' name='pocet_radek' size='2' value=$pocet_radek_value>";
                    echo"<input type='submit' value=$denvmesici class='tlacitka_dni'>";
                    echo"</form>";
                    echo "</td>";
                for ($m=$k;$m<6;$m++){
                    $prvniden_stamp=$prvniden_stamp+86400; 
                    echo "<td width='30'>";
                    $denvmesici=datum_mesic_den($prvniden_stamp);
                    echo"<form method='POST' action='kalendar.php'>";
                    echo"<input type='hidden' name='fden_stamp' value=$prvniden_stamp>";
                    echo"<input type='hidden' name='pocet_radek' size='2' value=$pocet_radek_value>";
                    echo"<input type='submit' value=$denvmesici class='tlacitka_dni'>";
                    echo"</form>";
                    echo "</td>";
                }
                break;
            }
            else {
               echo"<td width='30'>&nbsp</td>"; 
            }
        }
        echo "</tr>";
     $d=0;   
    for ($n=0;$n<5;$n++){   
        echo "<tr align='center'>";
        for ($j=0;$j<7;$j++){
            $minulydenvmesici=$denvmesici;
            $prvniden_stamp=$prvniden_stamp+86400; 
            echo "<td width='30'>";
            $denvmesici=datum_mesic_den($prvniden_stamp);
                    echo"<form method='POST' action='kalendar.php'>";
                    echo"<input type='hidden' name='fden_stamp' value=$prvniden_stamp>";
                    echo"<input type='hidden' name='pocet_radek' size='2' value=$pocet_radek_value>";
                    if ($denvmesici==1){
                        $d=1;
                    }
                    if($d==1){
                        echo"<input type='submit' value=$denvmesici class='tlacitka_dni_novy_mesic'>";
                        }
                    
                    else {
                        echo"<input type='submit' value=$denvmesici class='tlacitka_dni'>";
                    }
                    echo"</form>";
            echo "</td>";
        }
        echo "</tr>";
        } 
        echo "</table>";
    echo "</div>";
echo "</div>";



function vyber_mesice(){
       echo"<table border width='100%'>";
                $kal_promena=date_create();
                $m=0;
                for($i=0;$i<4;$i++){
                   echo"<tr align='center'>";
                        for($j=0;$j<3;$j++){ 
                            //prevedeni kalendarni promene na casove razitko
                            $razitko=date_format($kal_promena,"U"); 
                            //do promene mesic ulozi nazev mesice
                            $mesic=datum_mesic(create_frst_day_stamp($razitko));
                            //hodnota odesilana formularem
                            $pocet_radek_value=$_POST["pocet_radek"];
                            $fden_stamp=create_frst_day_stamp($razitko);
                            echo"<form method='POST' action='kalendar.php'>";
                            echo"<input type='hidden' name='fden_stamp' value=$fden_stamp>";
                            echo"<input type='hidden' name='pocet_radek' size='2' value=$pocet_radek_value>";
                            echo"<td><input type='submit' value=$mesic class='tlacitka_mesicu'></td>";
                            echo"</form>";
                            //tvorba intervalo posunuti o 1 mesic
                            $interval=date_interval_create_from_date_string("1 months");
                            //posunuti hodnoty kalendarni promene o jeden mesic
                            $kal_promena=date_add($kal_promena,$interval);
                            $m++;
                        }
                    echo"</tr>";
                }
            echo"</table>";
       }
 //vytvori casove razitko prvniho dne mesice   
function create_frst_day_stamp($stamp){
     $pole=getdate($stamp);
     //sestaveni pole kalendarnich promenych prvnich dni mesice
     $prvnidenmesice_stamp=($pole['year']."-".$pole['mon']."-01");
    return date_format(date_create($prvnidenmesice_stamp),"U");
}
?>