<?php require_once("../sigurnost/sigurnosniKod.php");?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="hr" lang="hr">
<html>
<head>
<title>Dodavanje clanaka</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
<link rel=stylesheet href="admin_css.css" type="text/css" />
</head>
<body>
<div class="sve">

<h2> Dodavanje clanaka </h2>
<?php
    mysql_connect("localhost", "root", "");
    mysql_select_db("cms");

$result = mysql_query("INSERT INTO clanci (naziv, opis, multimedija1, multimedija2, id_pod, prom1, prom2) values ('$_GET[naziv]','$_GET[opis]','$_GET[multimedija1]','$_GET[multimedija2]','$_GET[id_pod]','$_GET[prom1]','$_GET[prom2]')");

if (mysql_affected_rows() == 1) {
?>
Uspješno unešeno! <br /><br />
<a href="dodaj.php">Dodaj</a><br /> &nbsp;
<a href="../index.php">Index</a> <br /> &nbsp;
<a href="admin.php">Administracija gl. linkova</a> <br /> &nbsp;
<?php
}
else
{
?>
Nije unijeto!<br /><br />
<a href="dodaj.php">Dodaj</a> <br /> &nbsp;
<a href="../index.php">Index</a> <br /> &nbsp;
<a href="admin.php">Administracija gl. linkova</a> <br /> &nbsp;
<?php
}
?>
<br>
</div>
</body>
</html>