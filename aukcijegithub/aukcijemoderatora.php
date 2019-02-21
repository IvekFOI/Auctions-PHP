<?php
	include('meni1.php');
	$bp=spojiSeNaBazu();
?>
<?php
	$sql="SELECT * FROM aukcija WHERE moderator_id='$aktivni_korisnik_id'
		GROUP BY naziv ORDER BY datum_vrijeme_zavrsetka DESC ";
	
	$rs=izvrsiUpit($bp,$sql);
	echo"<br>";
	echo "<table class='table'>";
		echo "<caption style=\"font-size:25px;\">Popis aukcija na kojima ste moderator:</caption>";
		echo "<thead><tr>
		<th>Naziv aukcije</th>
		<th>Opis</th>
		<th>Broj predmeta</th>
		<th>Vrijeme završetka</th>";
	echo "</tr></thead>";
	date_default_timezone_set("Europe/Zagreb");

	echo "<tbody>";
	while(list($id,$moderatorid,$naziv,$opis,$vrijemepocetka,$vrijemezavrsetka)=mysqli_fetch_array($rs)){
		$vrijemezavrsetka=date("d.m.Y. H:i:s",strtotime ($vrijemezavrsetka));
		$count = Countpredmeti($id);
		$azuriraj="<a href='azuriraj.php?id=$id&naziv=$naziv' class='button'>AŽURIRAJ AUKCIJU</a>";
		$zatvoriaukciju="<a href='zatvoriaukciju.php?id=$id' class='button'>ZATVORI AUKCIJU</a>";
		echo "<tr>
			<td span style='font-weight:bold'><a href='aukcija.php?aukcija=$id'>$naziv</a></td>
			<td>$opis</td>
			<td align=center>$count</td>
			<td>$vrijemezavrsetka</td>
			<td class='bezcelija'>$azuriraj</td>
			<td class='bezcelija'>$zatvoriaukciju</td>
		</tr>";
	}
	echo "</tbody>";
	if($aktivni_korisnik_tip==0) echo "<a href='dodajaukciju.php' style='font-size:20px' class='meni' </a>DODAJ AUKCIJU";
	echo "</table>";

	function Countpredmeti($idaukcija){
			$bp=spojiSeNaBazu();
			$sql = "SELECT COUNT(*) as 'brojpredmeta' FROM predmet WHERE aukcija_id = ".$idaukcija;
			
			$rs=izvrsiUpit($bp,$sql);
			
			list($countpredmeti)=mysqli_fetch_array($rs);
			
			return $countpredmeti;
   }
?>