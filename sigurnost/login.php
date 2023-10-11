<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=stylesheet href="../admin_css.css" type="text/css" />
</head>
<body>

<?php
//pozivan formu da mogu upisati podatke
include("loginForma.php");  

if (isset($_POST["sbmt_login"])) {
	$con=mysqli_connect("localhost", "root", "");
    mysqli_select_db($con,"dnevnik_rada_psiholog");
    $rezultat = mysqli_query($con,"SELECT * FROM korisnik WHERE korisnicko_ime='$_POST[korisnik]' LIMIT 1");
	$user_data = mysqli_fetch_array($rezultat);

	$korisnik = $user_data['korisnicko_ime'];
	$zaporka = $user_data['lozinka'];
	$user_id = $user_data['id_ko'];

	if (($_POST['korisnik'] == $korisnik) && ($_POST['zaporka'] == $zaporka)) {
		session_start();
		$_SESSION['user'] = $korisnik;
		$_SESSION['pass'] = $zaporka;
		$_SESSION['user_id'] = $user_id;
		
		$SID = session_id();
		$admin_stranica = "../dnevnik/dnevnik_rada.php";
		header("location:../dnevnik/dnevnik_rada.php");	
	}
	else{ 
		echo "<h3>neispravno korisnicko ime ili lozinka</h3>";
	}	
}
?>
</div>
</body>
</html>