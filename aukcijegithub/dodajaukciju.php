<?php
	include('meni1.php');
	$bp=spojiSeNaBazu();
?>
<?php
	if(isset($_REQUEST['naziv'])){
	$naziv=$_REQUEST['naziv'];
	$moderator=$_REQUEST['moderator'];
	$opis=$_REQUEST['opis'];
	$datumpocetka=$_REQUEST['datumpocetka'];
	$datumpocetka= date("Y-m-d H:i:s",strtotime($datumpocetka));
	$datumzavrsetka=$_REQUEST['datumzavrsetka'];
	$datumzavrsetka= date("Y-m-d H:i:s",strtotime($datumzavrsetka));
	$sql="INSERT INTO aukcija
		(aukcija_id,moderator_id, naziv, opis, datum_vrijeme_pocetka, datum_vrijeme_zavrsetka) VALUES
		('','$moderator','$naziv','$opis','$datumpocetka','$datumzavrsetka');
		";
	izvrsiUpit($bp,$sql);
	header("Location:index.php");
	}
?>

<br>

<form method="POST" action="dodajaukciju.php">
	<table>
		<tbody>
			<tr>
				<td>
					<label for="naziv"><strong>Naziv aukcije:</strong></label>
				</td>
				<td>
					<input type="text" id="naziv" name="naziv">
					</input>
				</td>
			</tr>
			<tr>
				<td>
					<label for="moderator"><strong>Odaberite moderatora:</strong></label>
				</td>
				<td>
					<select id="moderator" name="moderator">
					<?php
							$sql="SELECT korisnik_id,ime
									FROM korisnik WHERE tip_id=1";
							$rs=izvrsiUpit($bp,$sql);
							while(list($id,$ime)=mysqli_fetch_array($rs))print_r ("<option value='$id'>$ime</option>");
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<label for="opis"><strong>Opis aukcije:</strong></label>
				</td>
				<td>
					<textarea type="text" id="opis" name="opis">
					</textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label for="datumpocetka"><strong>Unesite datum i vrijeme početka aukcije:</strong></label>
				</td>
				<td>
					<input type="text" id="datumpocetka" name="datumpocetka" placeholder="13.06.2019 12:30:00">
					</input>
				</td>
			</tr>
			<tr>
				<td>
					<label for="datumzavrsetka"><strong>Unesite datum i vrijeme završetka aukcije:</strong></label>
				</td>
				<td>
					<input type="text" id="datumzavrsetka" name="datumzavrsetka" placeholder="13.07.2019 12:30:00">
					</input>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;">
					<input class="button1" name="submit" type="submit" value="Dodaj aukciju"/>
				</td>
			</tr>
		</tbody>
	</table>
</form>
