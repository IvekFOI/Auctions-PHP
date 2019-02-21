<?php
	include("meni1.php");
	$bp=spojiSeNaBazu();
?>

<?php
	$sql="SELECT COUNT(*) FROM korisnik";
	$rs=izvrsiUpit($bp,$sql);
	$red=mysqli_fetch_array($rs);
	$el_na_str=4;
	$redovi=$red[0];
	$broj_stranica=ceil($redovi/$el_na_str);


	$sql="SELECT * FROM korisnik ORDER BY korisnik_id LIMIT ".$el_na_str;
	if(isset($_GET['stranica'])){
		$sql=$sql." OFFSET ".(($_GET['stranica']-1)*$el_na_str);
		$trenutna=$_GET['stranica'];
	}
	else $trenutna = 1;

	$rs=izvrsiUpit($bp,$sql);
	echo '<br><a class="button1" href="korisnik.php">DODAJ KORISNIKA</a>';
	if(isset($_SESSION["aktivni_korisnik_id"]))echo '<a class="button1" href="korisnik.php?korisnik='.$_SESSION["aktivni_korisnik_id"].'">UREDI MOJE PODATKE</a>';
	echo "<table>";
	echo "<caption style=\"font-size:25px;\">Popis korisnika sustava</caption>";
	echo "<thead><tr>
		<th>Korisničko ime</th>
		<th>Lozinka</th>
		<th>Ime</th>
		<th>Prezime</th>
		<th>E-mail</th>
		<th>Slika</th>
	    </tr></thead>";

	echo "<tbody>";
	while(list($id,$tip,$kor_ime,$lozinka,$ime,$prezime,$email,$slika)=mysqli_fetch_array($rs)){
		if($aktivni_korisnik_tip==0)$uredi="<a href='korisnik.php?korisnik=$id' class='button'>UREDI</a>";
		echo "<tr>
			<td>$kor_ime</td>
			<td>$lozinka</td>
			<td>$ime</td>
			<td>$prezime</td>
			<td>$email</td>
			<td><figure><img src='$slika' width='70' height='100' alt='Slika korisnika $ime $prezime'/></figure></td>";
			if($aktivni_korisnik_tip==0)echo "<td class='bezcelija'>$uredi</td>";
		echo"</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	echo"<br>";

	echo '<div id="meni" align="center">';

	if($trenutna!=1){
		$prethodna=$trenutna-1;
		echo "<a class='stranice' href=\"korisnici.php?stranica=".$prethodna."\">&lt;</a>";
	}
	for($i=1;$i<=$broj_stranica;$i++){
		echo "<a class='stranice";
		if($trenutna==$i)echo " trenutna"; 
		echo "' href=\"korisnici.php?stranica=".$i."\">$i</a>";
	}

	if($trenutna<$broj_stranica){
		$sljedeca=$trenutna+1;
		echo "<a class='stranice' href=\"korisnici.php?stranica=".$sljedeca."\">&gt;</a>";
	}
	echo '</div>';
?>

<?php
	zatvoriVezuNaBazu($bp);
?>
