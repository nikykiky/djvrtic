<html>
<head>
	<link href="../admin_css.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="bg-image"></div>
	<?php
		$con = mysqli_connect("localhost","root","","dnevnik_rada_psiholog");
		$korisnik = $_POST["id_korisnika"];
		$opis = $_POST["opis_dnevnik_rada"];

		$rezultat ="INSERT INTO dnevnik_rada (id_ko, opis) values('$korisnik','$opis')";
		if (mysqli_query($con, $rezultat)) {
			print "<div class='sve' ><form ><p> New record created successfully</p> </form><a href='dnevnik_rada.php' class='button'>Povratak na dodavanje</a></div>";
		} 
		else {
			echo "Error: " . $rezultat . "<br>" . mysqli_error($con);
		}
	?>
</body>
</html>