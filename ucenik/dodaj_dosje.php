<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Dodaj učenika</title>
<meta http-equiv="Content-Type" content="text/html"/>
<meta charset="utf-8">
<link href="../admin_css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="sve">

<h2>Dodaj učenika</h2>

<?php 

?>
<form action="dodaj_pohrani_ucenika.php" method="POST">
Ime: <input type="text" name="ime_ucenika" />
Prezime: <input type="text" name="prezime_ucenika">
OIB: <input type="number" name="oib_ucenika" />
Datum rođenja: <input type="date" name="datum_rodenja" />
Adresa: <input type="text" name="adresa_ucenika" />
Grad: <input type="text" name="grad_ucenika" />
Spol: <input type="radio" name="spol_ucenika" value="musko"> 
	<input type="radio" name="spol_ucenika" value="zensko">
Rješenje: <input type="text" name="rjesenje_ucenika" />
Klasa: <input type="text" name="klasa_ucenika" />

Ime oca: <input type="text" name="ime_oca" />
Mob oca: <input type="text" name="mob_oca" />
Ime majke: <input type="text" name="ime_majke" />
Mob majke: <input type="text" name="mob_majke" />

Id sk. godine: <input type="text" name="id_sk_god" />
ID razreda: <input type="text" name="id_razreda" />

<input type="submit" value="Dodaj učenika"/>
</form>


</div>
</body>
</html>