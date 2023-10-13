<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="hr" lang="hr">
<html>
<head>
<title>Spremanje ućenika</title>
<meta http-equiv="Content-Type" content="text/html" charset=utf-8" />
<link rel=stylesheet href="admin_css.css" type="text/css" />
</head>
<body>
<div class="sve">

<h2> Dodavanje ucenika </h2>

<?php
$con = mysqli_connect("localhost", "root", "" , "dnevnik_rada_psiholog");


$result_ucenik = mysqli_query($con,"
INSERT INTO ucenik (ime, prezime, oib, datum_rodenja, adresa, grad, spol,rjesenje, klasa) values 
('$_POST[ime_ucenika]','$_POST[prezime_ucenika]','$_POST[oib_ucenika]','$_POST[datum_rodenja]','$_POST[adresa_ucenika]','$_POST[grad_ucenika]','$_POST[spol_ucenika]','$_POST[rjesenje_ucenika]','$_POST[klasa_ucenika]')
");
$id_ucenika = mysqli_insert_id($con);




$result_otac = mysqli_query($con ,"
INSERT INTO roditelj (ime, telefon) values 
('$_POST[ime_oca]','$_POST[mob_oca]')
");
$id_oca = mysqli_insert_id($con);


$result_majka = mysqli_query($con,"
INSERT INTO roditelj (ime, telefon) values 
('$_POST[ime_majke]','$_POST[mob_majke]')
");
$id_majke= mysqli_insert_id($con);

$result_roditelji = mysqli_query($con, "
INSERT INTO roditelj_dijete (id_ro, id_uc) values 
(".$id_oca.",".$id_ucenika."),(".$id_majke.",".$id_ucenika.")
");

$ucenik_razred = mysqli_query($con, "
INSERT INTO ucenik_razred (id_ra, id_uc, id_skgod) values 
('$_POST[id_razreda]',".$id_ucenika.",'$_POST[id_sk_god]');
");

if (mysqli_affected_rows($con) == 1) {
?>
Uspješno unenjeno! <br /><br />
<?php
}
else{
	?>
Nije unijeto!<br /><br />
<?php
}
?>
<br>
</div>
</body>
</html>