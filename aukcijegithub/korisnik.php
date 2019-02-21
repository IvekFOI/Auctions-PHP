<?php
	include('meni1.php');
	$bp=spojiSeNaBazu();
?>
<?php
	$greska="";
	if(isset($_POST['submit'])){
		foreach ($_POST as $key => $value)if(strlen($value)==0)$greska="Sva polja za unos su obavezna";
		if(empty($greska)){
			$id=$_POST['novi'];
			$tip=$_POST['tip'];
			$kor_ime=$_POST['kor_ime'];
			$lozinka=$_POST['lozinka'];
			$ime=$_POST['ime'];
			$prezime=$_POST['prezime'];
			$email=$_POST['email'];
			$slika=$_POST['slika'];

			if($id==0){
				$sql="INSERT INTO korisnik
				(tip_id,korisnicko_ime,lozinka,ime,prezime,email,slika)
				VALUES
				($tip,'$kor_ime','$lozinka','$ime','$prezime','$email','$slika');
				";
			}
			else{
				$sql="UPDATE korisnik SET
					tip_id='$tip',
					ime='$ime',
					prezime='$prezime',
					lozinka='$lozinka',
					email='$email',
					slika='$slika'
					WHERE korisnik_id='$id'
				";
			}
			izvrsiUpit($bp,$sql);
			header("Location:korisnici.php");
		}
	}
	if(isset($_GET['korisnik'])){
		$id=$_GET['korisnik'];
		if($aktivni_korisnik_tip==2)$id=$_SESSION["aktivni_korisnik_id"]; 
		$sql="SELECT * FROM korisnik WHERE korisnik_id='$id'";
		$rs=izvrsiUpit($bp,$sql);
		list($id,$tip,$kor_ime,$lozinka,$ime,$prezime,$email,$slika)=mysqli_fetch_array($rs);
	}
	else{
		$tip=2;
		$kor_ime="";
		$lozinka="";
		$ime="";
		$prezime="";
		$email="";
		$slika="";
	}
?>
<form method="POST" action="<?php if(isset($_GET['korisnik']))echo "korisnik.php?korisnik=$id";else echo "korisnik.php";?>">
	<table>
		<caption>
			<?php
				if(isset($id)&&$aktivni_korisnik_id==$id)echo "Uredi moje podatke";
				else if(!empty($id))echo "Uredi korisnika";
				else echo "Dodaj korisnika";
			?>
		</caption>
		<tbody>
			<tr>
				<td colspan="2">
					<input type="hidden" name="novi" value="<?php if(!empty($id))echo $id;else echo 0;?>"/>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align:center;">
					<label class="greska"><?php if($greska!="")echo $greska; ?></label>
				</td>
			</tr>
			<tr>
				<td class="lijevi">
					<label for="kor_ime"><strong>Korisničko ime:</strong></label>
				</td>
				<td>
					<input type="text" name="kor_ime" id="kor_ime"
						<?php
							if(isset($id))echo "readonly='readonly'";
						?>
						value="<?php if(!isset($_POST['kor_ime']))echo $kor_ime; else echo $_POST['kor_ime'];?>" size="100" minlength="10" maxlength="50"
						placeholder="Korisničko ime ne smije sadržavati praznine, treba uključiti minimalno 10 znakova i započeti malim početnim slovom"
						required="required"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="ime"><strong>Ime:</strong></label>
				</td>
				<td>
					<input type="text" name="ime" id="ime" value="<?php if(!isset($_POST['ime']))echo $ime; else echo $_POST['ime'];?>"
						size="100" minlength="1" maxlength="50" placeholder="Ime treba započeti velikim početnim slovom" required="required"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="prezime"><strong>Prezime:</strong></label>
				</td>
				<td>
					<input type="text" name="prezime" id="prezime" value="<?php if(!isset($_POST['prezime']))echo $prezime; else echo $_POST['prezime'];?>"
						size="100" minlength="1" maxlength="50" placeholder="Prezime treba započeti velikim početnim slovom" required="required"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="lozinka"><strong>Lozinka:</strong></label>
				</td>
				<td>
					<input <?php if(!empty($lozinka))echo "type='text'"; else echo "type='password'";?>
						name="lozinka" id="lozinka" value="<?php if(!isset($_POST['lozinka']))echo $lozinka; else echo $_POST['lozinka'];?>"
						size="100" minlength="8" maxlength="50"
						placeholder="Lozinka treba sadržati minimalno 8 znakova uključujući jedno veliko i jedno malo slovo, jedan broj i jedan posebni znak"
						required="required"/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="email"><strong>E-mail:</strong></label>
				</td>
				<td>
					<input type="email" name="email" id="email" value="<?php if(!isset($_POST['email']))echo $email; else echo $_POST['email'];?>"
						size="100" minlength="5" maxlength="50" placeholder="Ispravan oblik elektroničke pošte je nesto@nesto.nesto" required="required"/>
				</td>
			</tr>
			<?php
				if($_SESSION['aktivni_korisnik_tip']==0){
			?>
			<tr>
				<td><label for="tip"><strong>Tip korisnika:</strong></label></td>
				<td>
					<select align="left" id="tip" name="tip">
						<?php
							if(isset($_POST['tip'])){
								echo '<option value="0"';if($_POST['tip']==0)echo " selected='selected'";echo'>Administrator</option>';
								echo '<option value="1"';if($_POST['tip']==1)echo " selected='selected'";echo'>Zaposlenik</option>';
								echo '<option value="2"';if($_POST['tip']==2)echo " selected='selected'";echo'>Korisnik</option>';
							}
							else{
								echo '<option value="0"';if($tip==0)echo " selected='selected'";echo'>Administrator</option>';
								echo '<option value="1"';if($tip==1)echo " selected='selected'";echo'>Zaposlenik</option>';
								echo '<option value="2"';if($tip==2)echo " selected='selected'";echo'>Korisnik</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<?php
				}
			?>
			<tr>
			<td>
				<label for="slika"><strong>Priložite URL slike:</strong></label>
			</td>
			<td>
				<input size="100" type="url" name="slika" id="slika">
			</td>
			</tr>
			<tr>
			<td colspan="2" style="text-align:center;">
				<input class="button1"type="submit" name="submit" value="Pošalji"/>
			</td>
			</tr>
		</tbody>
	</table>
</form>

