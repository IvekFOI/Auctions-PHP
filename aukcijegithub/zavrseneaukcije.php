<?php
	include ('meni1.php');
	$bp=spojiSeNaBazu();
?>
<?php

	if(isset($_REQUEST['od'])){
		$vrijemeod=$_REQUEST['od'];
		$vrijemeod=date("Y-m-d H:i:s",strtotime($vrijemeod));
		$vrijemedo=$_REQUEST['do'];
		$vrijemedo=date("Y-m-d H:i:s",strtotime($vrijemedo));
	
		header("Location:prikazikupce.php?od=$vrijemeod&do=$vrijemedo");
	}
?>
<br>

<form method="POST" action="zavrseneaukcije.php">
	<table>
	<caption> 
		Evidencija kupaca i prodavača po završenim aukcijama
	</caption>
	<tbody>
			<tr>
				<td>
					<label for="od"><strong>Odaberite početni datum:</strong></label>
				</td>
				<td>
					<input type="text" id="od" name="od" placeholder="13.06.2019 12:30:00">
					</input>
				</td>
				</td>
			</tr>
			<tr>
				<td>
					<label for="do"><strong>Odaberite završni datum:</strong></label>
				</td>
				<td>
					<input type="text" id="do" name="do" placeholder="13.06.2019 12:30:00">
					</input>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;">
					<input class="button1" name="submit" type="submit" value="Prikaži kupce i prodavače"/>
				</td>
			</tr>
		</tbody>
	</table>
</form>
