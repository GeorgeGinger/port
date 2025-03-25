<?php
//return nazev dne
function datum_mesic_den($stamp){
    $mesice=array("leden","únor","březen","duben","květen","červen","červenec","srpen","září","říjen","listopad","prosinec");
    $dny=array("Ne","Po","Út","St","Čt","Pá","So");
    $pole=getdate($stamp);
    $mesic=$pole["mon"];
    $den=$pole["wday"];
    return $pole["mday"];
}  

//return nazev mesice
function datum_mesic($stamp){
    $mesice=array("leden","únor","březen","duben","květen","červen","červenec","srpen","září","říjen","listopad","prosinec");
    $dny=array("Ne","Po","Út","St","Čt","Pá","So");
    $pole=getdate($stamp);
    $mesic=$pole["mon"];
    $den=$pole["wday"];
    return $mesice[$mesic - 1];
}  

//retun cislo dne v mesici
function datum_den($stamp){
     $mesice=array("leden","únor","březen","duben","květen","červen","červenec","srpen","září","říjen","listopad","prosinec");
    $dny=array("Ne","Po","Út","St","Čt","Pá","So");
    $pole=getdate($stamp);
    $mesic=$pole["mon"];
    $den=$pole["wday"];
    return $den;
}

function datum($stamp){
    $mesice=array("leden","ůnor","březen","duben","květen","červen","červenec","srpen","září","říjen","listopad","prosinec");
    $dny=array("Ne","Po","Út","St","Čt","Pá","So");
    $pole=getdate($stamp);
    $mesic=$pole["mon"];
    $den=$pole["wday"];
    return $pole["year"]."-".$mesic."-".$pole["mday"];
}  

function datum_cesky($stamp){
    $mesice=array("leden","ůnor","březen","duben","květen","červen","červenec","srpen","září","říjen","listopad","prosinec");
    $dny=array("Ne","Po","Út","St","Čt","Pá","So");
    $pole=getdate($stamp);
    $mesic=$pole["mon"];
    $den=$pole["wday"];
    return $pole["mday"].".".$mesic.".";
    //return $pole["year"]."-".$mesic."-".$pole["mday"];
}  

function zkratka_den($stamp){
     $mesice=array("leden","ůnor","březen","duben","květen","červen","červenec","srpen","září","říjen","listopad","prosinec");
    $dny=array("Ne","Po","Út","St","Čt","Pá","So");
    $pole=getdate($stamp);
    $mesic=$pole["mon"];
    $den=$pole["wday"];
    return $dny[$den];
}

//vyplneni pole rez
//zacatek ve tvrthodinach, daba ve ctvrthodinach; hodnota kterou chci vyplnit
function vypln_pole($zacatek,$doba,$sluzba){
    //echo"vypln pole bezi<br>";
    //zobrazeni vztupnich hodnot
        for($m=0;$m<96;$m++){
            $polerez[$m]='0';   
        }
        //sauna klubova modra
        if ($sluzba==1){
            for($z=$zacatek;$z<($zacatek+$doba);$z++){
            $polerez[$z]='#add8e6';     
            }
        }
        //sauna privat cervena
        elseif ($sluzba==2){
            for($z=$zacatek;$z<($zacatek+$doba);$z++){
            $polerez[$z]='#ff0000';    
            }
        }
        //azyl plum
        elseif ($sluzba==3){
            for($z=$zacatek;$z<($zacatek+$doba);$z++){
            $polerez[$z]='#dda0dd';     
            }
        }
        //azyl se saunou oranzova
        elseif ($sluzba==4){
            for($z=$zacatek;$z<($zacatek+$doba);$z++){
            $polerez[$z]='#ffa500';    
            }
        }
        //opakovana akce
        else {
            for($z=$zacatek;$z<($zacatek+$doba);$z++){
                $polerez[$z]=$sluzba;    
            }
        }
    return $polerez;
    }

    //fce pocita pocet ctvrthodin od casu 00:00 do zacatku akce zadava se datum a cas zacetku
function zacatek_akce_ctvrthodiny($datum,$cas){
    //datum obednavky plus cas obednavky minus datum obednavky = pocet ctvrthodin od casu 0:0
    $datum1=$datum." ".$cas;
    $datum2=$datum;
    //prevedeni casu na casove rezitko
    $razitko1=date_format(date_create($datum1),"U");
    $razitko2=date_format(date_create($datum2),"U");
    //vypocet poctu ctvrthodin od casu 0:0 do zacatku rezervace
    return $rozdildat=($razitko1-$razitko2)/(15*60);
}
?>