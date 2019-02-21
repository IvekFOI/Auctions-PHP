<?php
	include("meni1.php");
	$bp=spojiSeNaBazu();
?>
<?php
	if(!isset($_SESSION['aktivni_korisnik']))header("Location:index.php");

	if(isset($_REQUEST['predmet'])){
		$predmet=$_REQUEST['predmet'];
		$iznosponude=$_REQUEST['vrijednost'];
		$sql="SELECT pocetna_cijena 
			FROM   predmet 
			WHERE  predmet_id = $predmet;";
		$rs=izvrsiUpit($bp,$sql);
		list($pocetnacijena)=mysqli_fetch_array($rs);

		if ($iznosponude >= $pocetnacijena) {
			$sql="INSERT INTO ponuda
			(ponuda_id, predmet_id, korisnik_id,datum_vrijeme_ponude, iznos_ponude) VALUES
			('',$predmet,$aktivni_korisnik_id,now(),$iznosponude);";
			izvrsiUpit($bp,$sql);
			header("Location:ponude.php");
		}
		else {
			echo '<h1>Iznos ponude premali!</h1>';
		}
	}
?>
<br>
<form method="POST" action="ponuda.php">
	<table>
		<tbody>
			<tr>
				<td>
					<label for="predmet"><strong>Naziv predmeta:</strong></label>
				</td>
				<td>
					<select id="predmet" name="predmet">
						<?php
							$sql="SELECT predmet_id,naziv
									FROM predmet";
							$rs=izvrsiUpit($bp,$sql);
							while(list($id,$naziv)=mysqli_fetch_array($rs))echo "<option value='$id'>$naziv</option>";
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<label for="vrijednost"><strong>Iznos ponude:</strong></label>
				</td>
				<td>
					<input type="number" id="vrijednost" name="vrijednost">
					</input>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;">
					<input class="button1" name="submit" type="submit" value="Dodaj ponudu"/>
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
	zatvoriVezuNaBazu($bp);
?>
