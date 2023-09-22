<?php
session_start();

//A session is a way to store information (in variables) to be used across multiple pages.
//Unlike a cookie, the information is not stored on the users computer.

//ako nista nije upisano tj prvi put dolazim polje je prazno
if((!isset($_SESSION['user'])) || (!isset($_SESSION['pass'])) ) {
	header("location: ./sigurnost/login.php");
	exit;
}

//require_once("tajne_konstante.php");


/*
	OVDJE SE PISE KOD KOJI SE UCITAVA NA SVIM STRANICAMA

	$uri = $_SERVER['REQUEST_URI'];
	//ako se nalazimo na administracija.php drugaciji je link za odjavu
	$trenutni_url = parse_url($uri, PHP_URL_PATH);
	if(strpos($trenutni_url, 'administracija') !== false){
		echo "<a href='./sigurnost/odjava.php'>Odjava</a>";
	}
	else{
		echo "<a href='../administracija.php'>Administracija</a>" ;
		echo " <a href='../sigurnost/odjava.php'>Odjava</a>";
	}
*/
?>
