<!DOCTYPE html>
<html>
<head>
<title>Spremanje dosjea</title>
<meta http-equiv="Content-Type" content="text/html" charset=utf-8" />
<link rel=stylesheet href="admin_css.css" type="text/css" />
</head>
<body>
<div class="sve">

<h2> Dodavanje dosjea</h2>

<?php

mysql_connect("localhost", "root", "");
mysql_select_db("dnevnik_rada_psiholog");

$result = mysql_query("
INSERT INTO dosje_ucenika (id_uc, id_ko, opis, datum_unosa) 
values('$_POST[id_ucenika]','$_POST[id_korisnika]', '$_POST[dosje_opis]','$_POST[datum_unosa_dosjea]')");

if (mysql_affected_rows() == 1) {
?>
Uspje�no une�eno! <br /><br />
<?php
}
else
{
?>
Nije unijeto!<br /><br />
<?php
}
?>
<br>
</div>
</body>
</html>