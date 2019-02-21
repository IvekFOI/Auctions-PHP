<?php
	include("meni1.php");
	$bp=spojiSeNaBazu();
?>
<?php

	$sql= "SELECT * FROM
		(SELECT a.`naziv` AS aukcija, pr.`naziv` AS predmet, (SELECT Max(iznos_ponude) 
        FROM   ponuda 
        WHERE  predmet_id = pr.predmet_id) iznos_ponude, k.`korisnicko_ime`, 
		po.`datum_vrijeme_ponude` 
		FROM `aukcija` a, `predmet` pr, `ponuda` po, `korisnik` k 
		WHERE k.`korisnik_id` = po.`korisnik_id` AND a.`aukcija_id` = pr.`aukcija_id` 
		AND pr.`predmet_id` = po.`predmet_id` AND a.`datum_vrijeme_zavrsetka` < NOW() 
		AND pr.`korisnik_id` = '$aktivni_korisnik_id' ORDER BY po.`iznos_ponude` DESC, po.`datum_vrijeme_ponude`) 
		AS SVE_PONUDE GROUP BY aukcija";
		
	$result=izvrsiUpit($bp,$sql);
	echo"<br>";
	echo "<table>";
		echo "<caption style=\"font-size:25px;\">Popis aukcija na kojima ste sudjelovali kao prodavač</caption>";
		echo "<thead><tr>
		<th>Naziv aukcije</th>
		<th>Naziv predmeta</th>
		<th>Iznos ponude</th>
		<th>Kupac</th>
	</tr></thead>";

	echo "<tbody>";
	while(list($aukcija,$predmet,$iznosponude,$korisnickoime,$datumvrijeme)=mysqli_fetch_array($result)){
		echo "<tr>
			<td>$aukcija</td>
			<td>$predmet</td>
			<td>$iznosponude</td>
			<td>$korisnickoime</td>";
		echo "</tr>";
	}
	echo "</tbody>";
?>