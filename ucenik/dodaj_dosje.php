<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Dodaj učenika</title>
    <meta http-equiv="Content-Type" content="text/html" />
    <meta charset="utf-8">
    <link href="../admin_css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="sve">
    <h2>Dodaj učenika</h2>

    <form action="dodaj_pohrani_ucenika.php" method="POST">
    <br />
    <br />
        Ime: <input type="text" name="ime_ucenika" required/><br /><br />
        Prezime: <input type="text" name="prezime_ucenika" required>
        OIB: <br><input type="number" name="oib_ucenika" required/><br /><br />
        Datum rođenja: <br><input type="date" name="datum_rodenja" required/><br /><br />
        Adresa: <input type="text" name="adresa_ucenika" required/><br />
        Grad: <input type="text" name="grad_ucenika" required/><br />
        Spol: 
        <label><input type="radio" name="spol_ucenika" value="musko" required/>M</label>
        <label><input type="radio" name="spol_ucenika" value="zensko" required/>Ž</label>   <br />
        <br />
        Rješenje: <input type="text" name="rjesenje_ucenika" required/><br />
        Klasa: <input type="text" name="klasa_ucenika" required/><br />

        Ime oca: <input type="text" name="ime_oca" required/><br />
        Mob oca: <br /><br /><input type="number" name="mob_oca" required/><br /><br />
        Ime majke: <input type="text" name="ime_majke" required/><br />
        Mob majke: <br /><br /><input type="number" name="mob_majke" required/><br /><br />

        Id sk. godine: <br /><br /><input type="number" name="id_sk_god" required/><br /><br />
        ID razreda: <br /><br /><input type="number" name="id_razreda" required/><br /><br /><br />

        <input type="submit" value="Dodaj učenika" />
    </form>
</div>
</body>
</html>
