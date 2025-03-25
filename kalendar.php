<!--konkretni data a oteviraci hodiny-->
<html>
  <head>
<meta http-equiv="Content-Language" content="cs" /> <!-- jazyk stránky -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <!-- kódování stránky -->
    <title>sauna klub slany home</title>

	<link rel="stylesheet" href="styly.css">
    <link rel="stylesheet" href="knihovna/styly_kalendar_obsazenost.css">

  </head> 

  <body>
	<table border="1" width="100%" align="center">
		<tr> 
			<td height="200" style="background-image: url('foto/pozadi-Sauna-Klub-Slany.gif')" > 
				<p><h1><span style="font-size:80px;">Sauna Klub Slany</span></h1></p>
				<p><b>Kynskeho 122, Slany</b></p> 
			</td>
		    <td width="355">
				<img src="foto\uvodnifoto.gif" width="355" height="200" alt="strom">
			</td> 
		</tr>
		<tr>
			<td colspan="2">
				<table>
					<td height="150">
						<a  href="index.html"><p class="tlacitko"><span class="sizeodkazu">Home</span></p></a>
					</td>
					<td>
						<a class="tlacitko" href="kalendar_obsazenost/kalendar_obsazenost.php"><p class="tlacitko_obsazenost"><span class="sizeodkazu">Obsazenost</span></p></a>
					</td>
					<td>
						<a class="tlacitko" href="saunaklubslany_foto.html"><p class="tlacitko"><span class="sizeodkazu">Foto</span></p></a>
					</td>
					<td>&nbsp</td>
				</table>
			</td>
			
		</tr>
    </table> 

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
	<table border="1" width="100%" align="center">
		<tr>
			<td align="center" colspan="4">
				<p class="pismopatickanadpis"><b>KONTAKTY pro objednání:</b></p>
				<p class="pismopaticka"><b>Tel.:776 740 434</b></p>
				<p class="pismopaticka"><b>Adresa:Kynskeho 122, Slany</b><p>
				<p class="pismopaticka"><b>e-mail.: saunaslany@seznam.cz</b></p>
				<p class="pismopaticka"><b>FB.: <a href="https://www.facebook.com/profile.php?id=100083707954063">Saunaklub Slaný</a></b></p>
				<p class="pismopaticka"><b>Instagram: <a href="https://instagram.com/saunaklubslany?igshid=NTc4MTIwNjQ2YQ==">Saunaklub Slaný</a></b><p>
				
			</td> 
		</tr>
	</table>
    
 
  </body>
</html>