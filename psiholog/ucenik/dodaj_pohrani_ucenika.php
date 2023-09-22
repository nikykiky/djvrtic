<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="hr" lang="hr">
<html>
<head>
<title>Spremanje uèenika</title>
<meta http-equiv="Content-Type" content="text/html" charset=utf-8" />
<link rel=stylesheet href="admin_css.css" type="text/css" />
</head>
<body>
<div class="sve">

<h2> Dodavanje ucenika </h2>

<?php
mysql_connect("localhost", "root", "");
mysql_select_db("dnevnik_rada_psiholog");

$result_ucenik = mysql_query("
INSERT INTO ucenik (ime, prezime, oib, datum_rodenja, adresa, grad, spol,rjesenje, klasa) values 
('$_POST[ime_ucenika]','$_POST[prezime_ucenika]','$_POST[oib_ucenika]','$_POST[datum_rodenja]','$_POST[adresa_ucenika]','$_POST[grad_ucenika]','$_POST[spol_ucenika]','$_POST[rjesenje_ucenika]','$_POST[klasa_ucenika]')
");
$id_ucenika = mysql_insert_id();




$result_otac = mysql_query("
INSERT INTO roditelj (ime, telefon) values 
('$_POST[ime_oca]','$_POST[mob_oca]')
");
$id_oca = mysql_insert_id();


$result_majka = mysql_query("
INSERT INTO roditelj (ime, telefon) values 
('$_POST[ime_majke]','$_POST[mob_majke]')
");
$id_majke= mysql_insert_id();

$result_roditelji = mysql_query("
INSERT INTO roditelj_dijete (id_ro, id_uc) values 
(".$id_oca.",".$id_ucenika."),(".$id_majke.",".$id_ucenika.")
");

$ucenik_razred = mysql_query("
INSERT INTO ucenik_razred (id_ra, id_uc, id_skgod) values 
('$_POST[id_razreda]',".$id_ucenika.",'$_POST[id_sk_god]');
");

if (mysql_affected_rows() == 1) {
?>
Uspješno unešeno! <br /><br />
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