<!DOCTYPE html>
<head>
<title>Pregled ucenika</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
<link rel="stylesheet" type="text/css" href="../admin_css.css" />
</head>
<body>
<div class="sve">

<h2>Pregled ucenika</h2>
<a href="admin_ucenika.php">Administracija ucenika</a><br /><br />
<?php
	$con = mysqli_connect("localhost", "root", "", "dnevnik_rada_psiholog");
	$pdtc_ucenika = mysqli_query($con, "SELECT *
	FROM ucenik 
	WHERE id_uc={$_GET['id_ucenika']}");
	
    $dosje_ucenika = mysqli_query($con, "SELECT opis, DATE_FORMAT(datum_unosa,' %d.%c.%Y %H:%i') AS dan_upisa, korisnik.ime AS korisnik
	FROM ucenik 
	INNER JOIN dosje_ucenika ON ucenik.id_uc = dosje_ucenika.id_uc 
	INNER JOIN korisnik ON korisnik.id_ko = dosje_ucenika.id_ko
	WHERE dosje_ucenika.id_uc={$_GET['id_ucenika']}");
   
	echo "<form action='dodaj_pohrani_ucenika.php' method='POST'>";

	//if(if(isset($_POST['submit'])) != true )
	while ($redak = mysqli_fetch_assoc($pdtc_ucenika)) {

		echo "Ucenik: ".$redak['ime']." ".$redak['prezime']."<br />";
		echo "Oib: ".$redak['oib']."<br />";
		echo "Adresa: <input type='text' name='adresa' value='".$redak['adresa']."'><br />";
		echo "Grad: <input type='text' name='grad' value='".$redak['grad']."'><br />";
		echo "Rjesenje: <input type='text' name='rjesenje' value='".$redak['rjesenje']."'><br />";
		echo "Klasa: <input type='text' name='klasa' value='".$redak['klasa']."'><br />";
		echo "<input type='hidden' name='id_uc' value='".$redak['id_uc']."'>";
	}
	
	echo "<input type='submit' name='submit' value='Azuriraj'></form>";
	
	
	
	// echo "<input type='submit' name='submit' value='Azuriraj'></form>";
	
	echo "<h1>Dosje</h1>";
    while ($redak = mysqli_fetch_assoc($dosje_ucenika)) {
		echo "<br />";
		echo "Upisao: ".$redak['korisnik']."<br />";
		echo "Upisano: ".$redak['dan_upisa']."<br />";
		echo "<textarea  cols='35' name='opis'>".$redak['opis']."</textarea><br />";
	}

?>
</div>
</body>
</html>

