<!DOCTYPE html>
<html>
<head>
<title>Administracija ucenika</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
<link href="../admin_css.css" rel="stylesheet" type="text/css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>
<body>
<div class="sve">
<h2>Administracija ucenika</h2>
<?php
	$con = mysqli_connect("localhost", "root", "", "dnevnik_rada_psiholog");
	
	$razredi = "SELECT oznaka_raz FROM razred";
	$sql = mysqli_query($con, $razredi);
	echo "
	<form action='".$_SERVER['PHP_SELF']."' method='POST'>
		<select name='razred' id='drop'>
		<option value='--'>--</option>";
		while($raz = mysqli_fetch_array($sql))
		{
			echo "<option value='".$raz['oznaka_raz']."'>".$raz['oznaka_raz']."</option>";
		}
		echo "</select>
		<input type='submit' value='Pregledaj'/>
	</form>";
	
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['razred']))
	{

		$rezultat = mysqli_query($con,"
		SELECT *
		FROM ucenik_razred
		INNER JOIN ucenik ON ucenik_razred.id_uc = ucenik.id_uc 
		INNER JOIN razred ON ucenik_razred.id_ra = razred.id_raz 
		WHERE razred.oznaka_raz LIKE '".$_POST['razred']."'
		ORDER BY oznaka_raz DESC;");
    
		echo "<table border='1' id='tablica_pregled'>
			<tr valign='top'>
			<td><b>Ime</b></td>
			<td><b>Prezime</b></td>
			<td><b>Razred</b></td>
			<td><b>Pregled</b></td>
			</tr>";
		
		while($redak = mysqli_fetch_array($rezultat))
		{
		  $id = $redak['id_uc'];
		  echo "<tr valign='top'><td>";
		  echo $redak['ime'];
		  echo "</td><td>";
		  echo $redak['prezime'];
		  echo "</td><td>";
		  echo $redak['oznaka_raz'];
		  echo "</td><td>";
		  echo "<a href='pregled_ucenika.php?id_ucenika=$id'>Pregled</a>";
		  echo "</td></tr>";
		  }
		echo "</table>";
	}
?>
</div>
</body>
</html>