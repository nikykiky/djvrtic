<html>
<body>
<?php
mysql_connect("localhost", "root", "");
mysql_select_db("dnevnik_rada_psiholog");

$result = mysql_query("
INSERT INTO dnevnik_rada (id_ko, opis) 
values('$_POST[id_korisnika]','$_POST[opis_dnevnik_rada]')");


if (mysql_affected_rows() == 1)
	header("location:./dnevnik_rada.php");	
	// tocka oznacava da je u istom folderu
else
	echo "Nije unijeto!";

?>

</body>
</html>