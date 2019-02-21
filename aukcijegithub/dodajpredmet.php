<?php
	include('meni1.php');
	$bp=spojiSeNaBazu();
?>
<?php
	if(!isset($_SESSION['aktivni_korisnik']))header("Location:index.php");
	if(isset($_REQUEST['aukcija'])){
	$aukcija=$_REQUEST['aukcija'];
	$naziv=$_REQUEST['naziv'];
	$opis=$_REQUEST['opis'];
	$slika=$_REQUEST['slika'];
	$iznos=$_REQUEST['iznos'];
	$slika='"'.$slika.'"';
	$opis='"'.$opis.'"';
	$naziv='"'.$naziv.'"';
	$sql="INSERT INTO predmet
		(aukcija_id, korisnik_id, naziv, opis, slika, pocetna_cijena) VALUES
		($aukcija,$aktivni_korisnik_id,$naziv,$opis,$slika,$iznos);
		";
	izvrsiUpit($bp,$sql);
	$poruka= "Predmet dodan!";
	echo "<script type='text/javascript'>alert('$poruka');</script>";
	}
?>

<br>

<form method="POST" action="dodajpredmet.php">
	<table>
		<tbody>
			<tr>
				<td>
					<label for="aukcija"><strong>Tip aukcije:</strong></label>
				</td>
				<td>
					<select id="aukcija" name="aukcija">
						<?php
							$sql="SELECT aukcija_id,naziv
									FROM aukcija";
							$rs=izvrsiUpit($bp,$sql);
							while(list($id,$naziv)=mysqli_fetch_array($rs))print_r ("<option value='$id'>$naziv</option>");
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<label for="naziv"><strong>Naziv predmeta:</strong></label>
				</td>
				<td>
					<input type="text" id="naziv" name="naziv">
					</input>
				</td>
			</tr>
			<tr>
				<td>
					<label for="opis"><strong>Opis predmeta:</strong></label>
				</td>
				<td>
					<textarea type="text" id="opis" name="opis">
					</textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label for="slika"><strong>Priložite URL slike:</strong></label>
				</td>
				<td>
					<input type="url" name="slika" id="slika">
				</td>
			</tr>
			<tr>
				<td>
					<label for="iznos"><strong>Iznos predmeta:</strong></label>
				</td>
				<td>
					<input type="number" id="iznos" name="iznos">
					</input>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;">
					<input class="button1" name="submit" type="submit" value="Dodaj predmet"/>
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
	zatvoriVezuNaBazu($bp);
?>