<?php
	include("meni1.php");
	$bp=spojiSeNaBazu();
?>
<?php
	
	$sql="SELECT * FROM aukcija WHERE datum_vrijeme_zavrsetka > NOW()
		 GROUP BY naziv ORDER BY datum_vrijeme_zavrsetka DESC";
	$rs=izvrsiUpit($bp,$sql);
	echo"<br>";
	echo "<table class='table'>";
		echo "<caption style=\"font-size:25px;\">Popis otvorenih aukcija</caption>";
		echo "<thead><tr>
		<th>Naziv aukcije</th>
		<th>Opis aukcije</th>
		<th>Ukupno predmeta</th>
		<th>Završetak aukcije</th>
		</tr></thead>";
	date_default_timezone_set("Europe/Zagreb");

	echo "<tbody>";
	while(list($id,$moderatorid,$naziv,$opis,$vrijemepocetka,$vrijemezavrsetka)=mysqli_fetch_array($rs)){
		$count = Countpredmeti($id);
		$vrijemezavrsetka=date("d.m.Y. H:i:s",strtotime ($vrijemezavrsetka));
		if($aktivni_korisnik_tip==0)$azuriraj="<a href='azuriraj.php?id=$id&naziv=$naziv' class='button'>AZURIRAJ AUKCIJU</a>";
		if($aktivni_korisnik_tip==0)$zatvoriaukciju="<a href='zatvoriaukciju.php?id=$id' class='button'>ZATVORI AUKCIJU</a>";
		echo "<tr>
			<td span style='font-weight:bolder'><a href='aukcija.php?aukcija=$id'>$naziv</a></td>
			<td>$opis</td>
			<td align=center>$count</td>
			<td>$vrijemezavrsetka</td>";
			if($aktivni_korisnik_tip==0)echo "<td class='bezcelija'>$azuriraj</td>";
			if($aktivni_korisnik_tip==0)echo "<td class='bezcelija'>$zatvoriaukciju</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table><br>";
	
	if($aktivni_korisnik_tip==0) echo "<a href='dodajaukciju.php' class='button1' </a>DODAJ AUKCIJU";
	
	function Countpredmeti($idaukcija){
			$bp=spojiSeNaBazu();
			$sql = "SELECT COUNT(*) as 'brojpredmeta' FROM predmet WHERE aukcija_id = ".$idaukcija;
			
			$rs=izvrsiUpit($bp,$sql);
			
			list($countpredmeti)=mysqli_fetch_array($rs);
			
			return $countpredmeti;
   }
?>
<?php
	zatvoriVezuNaBazu($bp);
?>
