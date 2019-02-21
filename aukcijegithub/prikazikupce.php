<?php
	include('meni1.php');
	$bp=spojiSeNaBazu();
?>

<?php
	if(isset($_GET['od'])){
		$vrijemeod=$_GET['od'];
		$vrijemedo=$_GET['do'];

	$sql="SELECT COUNT(*) AS broj_kupaca, a.`naziv` FROM `korisnik` k, `ponuda` po, `predmet` pr, `aukcija` a 
			WHERE a.`aukcija_id` = pr.`aukcija_id` 
			AND pr.`predmet_id` = po.`predmet_id` 
			AND k.`korisnik_id` = po.`korisnik_id` 
			AND a.`datum_vrijeme_zavrsetka` < NOW() 
			AND a.`datum_vrijeme_pocetka` BETWEEN '$vrijemeod' AND '$vrijemedo' 
			GROUP BY a.`naziv`";
			
	$result=izvrsiUpit($bp,$sql);
	
	echo "<table>";
		echo "<caption style=\"font-size:25px;\">Prikaz broja kupaca po aukciji</caption>";
		echo "<thead><tr>
		<th>Broj kupaca</th>
		<th>Naziv</th>
		
	</tr></thead>";

	echo "<tbody>";
	while(list($brojkupaca,$naziv)=mysqli_fetch_array($result)){
		echo "<tr>
			<td>$brojkupaca</td>
			<td>$naziv</td>
		</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	
	echo "<br><br>";
	
	$sql="SELECT COUNT(*) AS broj_prodavaca, a.`naziv` FROM `korisnik` k, `predmet` pr, `aukcija` a
			WHERE a.`aukcija_id` = pr.`aukcija_id` AND k.`korisnik_id` = pr.`korisnik_id` 
			AND a.`datum_vrijeme_zavrsetka` < NOW() 
			AND a.`datum_vrijeme_pocetka` BETWEEN '$vrijemeod' AND '$vrijemedo'
			GROUP BY a.`naziv`
			";
			
	$result1=izvrsiUpit($bp,$sql);
	
	echo "<table>";
		echo "<caption style=\"font-size:25px;\">Prikaz broja prodavača po aukciji</caption>";
		echo "<thead><tr>
		<th>Broj prodavača</th>
		<th>Naziv</th>
		
	</tr></thead>";

	echo "<tbody>";
	while(list($brojprodavača,$naziv)=mysqli_fetch_array($result1)){
		echo "<tr>
			<td>$brojprodavača</td>
			<td>$naziv</td>
		</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	}
?>