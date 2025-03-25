
<?php
function zobrazeni_rezervaci1($fden_stamp){
//pripojeni k databazi
$spojeni=mysqli_connect("mysql.saunaklubslany.cz", "mysql-saunaklub", "4luggFcG8BaM", "mysql-saunaklub");
//if($spojeni ==false) echo "Chyba"; else echo "Spojeni OK";
//echo "<br>";

//pocet radek zobrazene tabulky rezervaci
$pocet_radek_value=$_POST["pocet_radek"];
//pokud neni zvolena zadna hodnota nastavi se pocet radek 10 a informativne se vypise if
if (strlen($_POST["pocet_radek"])==0) {$pocet_radek_value=10;}

//sekce podklad
echo "<div class='sec'>";
    echo "<div class='asi'>";
        $pocet_radek=$_POST["pocet_radek"];
        if (strlen($_POST["pocet_radek"])==0) $pocet_radek=10;
        //tabulka nazvu dni a datumu
        echo "<table border width='100%' class='velikost_pisma_zobrazeni'>";
        $stamp=$fden_stamp;
        echo "<tr><td colspan='2'>&nbsp</td></tr>";
        for($k=1;$k<$pocet_radek;$k++){
            $datumobednavky=datum($stamp);
            $datum_cesky=datum_cesky($stamp);
            echo "<tr><td style='white-space:nowrap'>",zkratka_den($stamp),"</td><td style='white-space:nowrap'>",$datum_cesky,"</td>";
            $stamp=$stamp+86400;
        }
        echo "</table></td>";
    echo "</div>";
    echo "<div class='art'>";
        
        //rezervacni tabulka
        //sirka tabulky 96 x sirka bunek
        echo "<table border class='velikost_pisma_zobrazeni sirka_tabulky'>";
            echo "<tr>";
                for($i=0;$i<24;$i++){
                    echo "<td class='sirka_bunek' align='left' bgcolor='lightyellow'><b>",$i,"</b></td>";
                    echo "<td class='sirka_bunek' align='left' valign='bottom' bgcolor='lightblue'><small>15</small></td>";
                    echo "<td class='sirka_bunek' align='left' valign='bottom' bgcolor='lightblue'><small>30</small></td>";
                    echo "<td class='sirka_bunek' align='left' valign='bottom' bgcolor='lightblue'><small>45</small></td>";
        
                }
            echo "</tr>";
            $stamp=$fden_stamp;
            for($k=1;$k<$pocet_radek;$k++){
                $datumobednavky=datum($stamp);
                echo "<tr>";

                $sql3="SELECT * FROM obsazenost where datum='$datumobednavky'";
                $vysl=mysqli_query($spojeni,$sql3);
                $pocet=mysqli_num_rows($vysl);
                $pocet_sloupcu=mysqli_num_fields($vysl);
                if($pocet>0){
                    for ($i=1;$i<$pocet+1;$i++){
                        $sumpolerezzaloha=mysqli_fetch_array($vysl);

                    }
                }
                else{
                    //vynulovani sumpolerezzaloha
                    for($m=0;$m<96;$m++){
                        $sumpolerezzaloha[$m]='0';
                    }
                }
                for($j=0;$j<96;$j++){
                    if($sumpolerezzaloha[$j]=='0'){
                        echo "<td bgcolor='green'>&nbsp</td>"; 
                    }
                    else{
                        //echo "<td bgcolor=$sumpolerezzaloha[$j]>&nbsp</td>";
                        echo "<td bgcolor=$sumpolerezzaloha[$j]><details><summary></summary>Obsazeno jdete jinam</details></td>";
                    }
                }
                echo "</tr>";
            $stamp=$stamp+86400;
            }
        echo "</table>";
    echo "</div>";
echo "</div>";

//ukonceni spojeni s databazi
mysqli_close($spojeni);
}
?>