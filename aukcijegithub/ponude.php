<?php
	include("meni1.php");
	$bp=spojiSeNaBazu();
?>
<br>
<?php
	if(!isset($_SESSION['aktivni_korisnik']))header("Location:index.php");

	$sql="SELECT a.`naziv` as aukcija, pr.`naziv` as predmet, po.`iznos_ponude` 
		FROM `aukcija` a, `predmet` pr, `ponuda` po 
		WHERE a.`aukcija_id` = pr.`aukcija_id` 
		AND pr.`predmet_id` = po.`predmet_id` 
		AND a.`datum_vrijeme_zavrsetka` > NOW() 
		AND po.`korisnik_id` = $aktivni_korisnik_id 
	";

	$rs=izvrsiUpit($bp,$sql);
	echo "<table>";
	echo "<caption style=\"font-size:25px;\">Vaše sudjelovanje u aukcijama</caption>";
	echo "<thead><tr>";
	echo "<th>Naziv aukcije</th>";
	echo "<th>Predmet</th>";
	echo "<th>Iznos ponude</th>";
	echo "</tr></thead>";

	echo "<tbody>";
	while(list($naziv_aukcije,$predmet,$iznos_ponude)=mysqli_fetch_array($rs)){
		echo "<tr>
			<td>$naziv_aukcije</td>
			<td>$predmet</td>
			<td>$iznos_ponude</td>
		</tr>";
	}
	echo "</tbody>";
	echo "</table>";
?>
<?php
	zatvoriVezuNaBazu($bp);
?>
