<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Dodaj učenika</title>
<meta http-equiv="Content-Type" content="text/html"/>
<meta charset="utf-8">
<link href="admin_css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="sve">

<h2>Dodaj učenika</h2>


<form action="dodaj_pohrani_ucenika.php" method="POST">
Ime: <input type="text" name="ime_ucenika" /><br />
Prezime: <input type="text" name="prezime_ucenika"><br />
OIB: <input type="number" name="oib_ucenika" /><br />
Datum rođenja: <input type="date" name="datum_rodenja" /><br />
Adresa: <input type="text" name="adresa_ucenika" /><br />
Grad: <input type="text" name="grad_ucenika" /><br />
Spol: <input type="radio" name="spol_ucenika" value="musko"> 
	<input type="radio" name="spol_ucenika" value="zensko">
Rješenje: <input type="text" name="rjesenje_ucenika" /><br />
Klasa: <input type="text" name="klasa_ucenika" /><br />

Ime oca: <input type="text" name="ime_oca" /><br />
Mob oca: <input type="text" name="mob_oca" /><br />
Ime majke: <input type="text" name="ime_majke" /><br />
Mob majke: <input type="text" name="mob_majke" /><br />

Id sk. godine: <input type="text" name="id_sk_god" /><br />
ID razreda: <input type="text" name="id_razreda" /><br />

<input type="submit" value="Dodaj učenika"/>
</form>
</div>
</body>
</html>