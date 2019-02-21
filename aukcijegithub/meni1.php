<?php
	include("baza.php");
	if(session_id()=="")session_start();
	$trenutna=basename($_SERVER["PHP_SELF"]);
	$aktivni_korisnik=0;
	$aktivni_korisnik_tip=-1;

	if(isset($_SESSION['aktivni_korisnik'])){
		$aktivni_korisnik=$_SESSION['aktivni_korisnik'];
		$aktivni_korisnik_ime=$_SESSION['aktivni_korisnik_ime'];
		$aktivni_korisnik_tip=$_SESSION['aktivni_korisnik_tip'];
		$aktivni_korisnik_id=$_SESSION['aktivni_korisnik_id'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Aukcije</title>
		<meta name="autor" content="Ivan Platužić"/>
		<meta name="datum" content="15.12.2018."/>
		<meta charset="utf-8"/>
		<link href="css.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<header>
			<span>
				<h1 style="font-size:170%">AUKCIJE</h1>
				<?php
					if($aktivni_korisnik===0){
						echo "<span><strong>Status: </strong>Neprijavljeni korisnik</span><br/>";
						echo "<a class='class1' href='prijava.php' >PRIJAVA</a><br/>";
					}
					else{
						echo "<span><strong>Status: </strong>Dobrodošli, $aktivni_korisnik_ime</span><br/>";
						echo "<a class='class1' href='prijava.php?logout=1' >Odjava</a><br/>";
					}
				?>
			</span>
		</header>
		<nav id="navigacija" class="meni">
			<?php
						if($aktivni_korisnik_tip==0) {
								echo '<div class="class1"><a href="index.php"';
								echo ">POČETNA </a>";
								echo '<a href="korisnici.php"';
								echo ">KORISNICI </a>";
								echo '<a href="zatvoreneaukcije.php"';
								echo ">PRODANI PREDMETI </a>";
								echo '<a href="ponude.php" ';
								echo ">VAŠE PONUDE </a>";
								echo '<a href="zavrseneaukcije.php"';								
								echo ">ZAVRŠENE AUKCIJE</a>";
								echo '<a href="sveaukcije.php"';								
								echo ">SVE AUKCIJE</a></div>";
						}
						else if($aktivni_korisnik_tip==1) {
								echo '<div class="class1"><a href="index.php"';
								echo ">POČETNA </a>";
								echo '<a href="zatvoreneaukcije.php"';
								echo ">PRODANI PREDMETI </a>";
								echo '<a href="ponude.php"';
								echo ">VAŠE PONUDE </a>";
								echo '<a href="aukcijemoderatora.php"';
								echo ">AŽURIRAJ AUKCIJE</a></div>";
						}
						else if($aktivni_korisnik_tip==2) {
								echo '<div class="class1"><a href="index.php"';
								echo ">POČETNA </a>";
								echo '<a href="zatvoreneaukcije.php"';
								echo ">PRODANI PREDMETI </a>";
								echo '<a href="ponude.php"';
								echo ">VAŠE PONUDE</a></div>";
						}
						else{
								echo '<div class="class1"><a href="index.php"';
								echo ">POČETNA</a></div>";
						}
			?>
		</nav>
	</body>
</html>
