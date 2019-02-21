<?php
	include("meni1.php");
	$bp=spojiSeNaBazu();
?>
<?php
	if(isset($_GET['aukcija'])){
		$id=$_GET['aukcija'];
	
	$sql="SELECT pr.predmet_id,pr.naziv, 
       pr.slika, 
       (SELECT Max(iznos_ponude) 
        FROM   ponuda 
        WHERE  predmet_id = pr.predmet_id) iznos_ponude 
		FROM   predmet pr
		WHERE aukcija_id = '$id'";
	
	$result=izvrsiUpit($bp,$sql);
	echo "<br>";
	echo "<table>";
		echo "<caption style=\"font-size:25px;\">Popis aukcija</caption>";
		echo "<thead><tr>
		<th>Naziv aukcije</th>
		<th>Slika</th>
		<th>Iznos trenutne ponude</th>
		
	</tr></thead>";

	echo "<tbody>";
	while(list($id,$naslov,$slika,$iznostrenponude)=mysqli_fetch_array($result)){
		echo "<tr class='bezcelija'>
			<td>$naslov</td>
			<td><figure><img src='$slika' width='70' height='100' alt='Slika za automobil $naslov'/></figure></td>
			<td>$iznostrenponude</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	if($aktivni_korisnik_tip==0 || $aktivni_korisnik_tip==1 || $aktivni_korisnik_tip==2)echo "<a href='ponuda.php?korisnik=$aktivni_korisnik_id' class='button1' </a>DODAJ PONUDU";
	if($aktivni_korisnik_tip==0 || $aktivni_korisnik_tip==1 || $aktivni_korisnik_tip==2)echo "<a href='dodajpredmet.php?korisnik=$aktivni_korisnik_id' class='button1' </a>DODAJ PREDMET";
	}
?>
<?php
	zatvoriVezuNaBazu($bp);
?>