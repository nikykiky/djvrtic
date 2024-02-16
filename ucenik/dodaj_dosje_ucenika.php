<!DOCTYPE html>
<html>
<head>
<title>Dodaj dosje</title>
<meta http-equiv="Content-Type" content="text/html"/>
<meta charset="utf-8">
<link href="./admin_css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="sve">

<h2>Dodaj dosje</h2>


<form action="dodaj_pohrani_dosje.php" method="POST">
Id_ucenika: <input type="text" name="id_ucenika" /><br />
Id psiholog/pedagog: <input type="text" name="id_korisnika" /><br />
Opis: <br />
<textarea rows="4" cols="50" name="dosje_opis"></textarea><br />
Datum unosa: <input type="date" name="datum_unosa_dosjea" /><br />
<input type="submit" value="Dodaj dosje"/>
</form>
</div>
</body>
</html>