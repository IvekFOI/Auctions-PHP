<?php
	include ('meni1.php');
	$bp=spojiSeNaBazu();
?>
<?php
	if(isset($_POST['submit'])){
		$id=$_POST['id'];
		$vrijemezavrsetka=$_POST['datumvrijeme'];
		$vrijemezavrsetka=date("Y-m-d H:i:s",strtotime($vrijemezavrsetka));
		$sql="UPDATE aukcija SET datum_vrijeme_zavrsetka='$vrijemezavrsetka' WHERE aukcija_id=".$id;
		izvrsiUpit($bp,$sql);
		header ("Location:index.php");
	}
	
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$naziv=$_GET['naziv'];
		$sql="SELECT * FROM aukcija where aukcija_id=".$id;
		$rs=izvrsiUpit($bp,$sql);
		
		list($aukcijaid,$moderatorid,$naziv,$opis,$vrijemepocetka,$vrijemezavrsetka)=mysqli_fetch_row($rs);
		$vrijemezavrsetka=date("d.m.Y H:i:s",strtotime($vrijemezavrsetka));
	}
?>
<br>

<form method="POST" action="azuriraj.php">
	<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
	<table>
		<tbody>
			<tr>
				<td>
					<label for="naziv"><strong>Naziv aukcije:</strong></label>
				</td>
				<td>
					<input id="naziv" name="naziv" value="<?php echo $naziv; ?>">
					</input>
				</td>
			</tr>
			<tr>
				<td>
					<label for="datumvrijeme"><strong>Unesite datum i vrijeme završetka aukcije:</strong></label>
				</td>
				<td>
					<input type="text" id="datumvrijeme" name="datumvrijeme" value="<?php echo $vrijemezavrsetka; ?>" placeholder="13.06.2019 12:30:00">
					</input>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;">
					<input class="button1" name="submit" type="submit" value="Ažuriraj aukciju"/>
				</td>
			</tr>
		</tbody>
	</table>
</form>
