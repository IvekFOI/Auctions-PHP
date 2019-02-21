<?php
	include("meni1.php");
	$bp=spojiSeNaBazu();
?>
<?php

if(isset($_GET['id'])){
	$id=$_GET['id'];
	date_format("d.m.Y. H:i:s");
	$sql="UPDATE aukcija SET datum_vrijeme_zavrsetka=now() WHERE aukcija_id='$id'";
	izvrsiUpit($bp,$sql);
	header ("Location:index.php");
}
?>