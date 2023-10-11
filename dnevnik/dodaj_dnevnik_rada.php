<html>
<body>

<?php
$con = mysqli_connect("localhost","root","","dnevnik_rada_psiholog");
$korisnik = $_POST["id_korisnika"];
$opis = $_POST["opis_dnevnik_rada"];

$rezultat ="INSERT INTO dnevnik_rada (id_ko, opis) values('$korisnik','$opis')";
if (mysqli_query($con, $rezultat)) {
	echo "New record created successfully";
  } else {
	echo "Error: " . $rezultat . "<br>" . mysqli_error($con);
  }


?>

</body>
</html>