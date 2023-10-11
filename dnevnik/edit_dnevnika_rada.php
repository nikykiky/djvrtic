<!DOCTYPE html>
<html>
<head>
<title>Uredi Dnevnik rada</title>
<meta http-equiv="Content-Type" content="text/html"/>
<meta charset="utf-8">
<link href="admin_css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="sve">

<h2>Uredi Dnevnik rada</h2>


<?php
	$id_dr = $_GET['id_dr'];
 	$con = mysqli_connect("localhost", "root", "");
    mysqli_select_db($con,"dnevnik_rada_psiholog");
    $rezultat ="SELECT * FROM dnevnik_rada where id_dr=$id_dr LIMIT 1";
	$sql = mysqli_query($con,$rezultat);
	while($dnevnik_rada = mysqli_fetch_array($sql))
{
	print "<form action='edit_save_dnevnik_rada.php' method='POST'>";
	print "<textarea rows='4' cols='50' name='opis_dnevnik_rada'>".$dnevnik_rada['opis']."</textarea><br />";
	print "<td><input type='hidden' name='id_dr' value='".$dnevnik_rada['id_dr']."'></td>";
	print "<input type='submit' name='submit' value='Promijeni'>";
}
	
?>
</div>
</body>
</html>


