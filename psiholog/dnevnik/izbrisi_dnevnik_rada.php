
<html>
<head>
<title>Brisanje dnevnika rada</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
<link rel=stylesheet href="admin_css.css" type="text/css" />
</head>
<body>
<div class="sve">
<h2> Brisanje dnevnika rada</h2>

<?php
    mysql_connect("localhost", "root", "");
    mysql_select_db("dnevnik_rada_psiholog");
    $rezultat = mysql_query("DELETE FROM dnevnik_rada WHERE id_dr={$_GET['id_dr']} LIMIT 1");

if (mysql_affected_rows() == 1) 
{ 
	print "Promjene su unijete u tablicu.<br />";
}
else
{
	print "Niste ništa mijenjali.<br />";
}

?>


<br>
</div>
</body>
</html>

