<!DOCTYPE html>
<html>
<head>
<title>Administracija ucenika</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
<link href="./admin_css.css" rel="stylesheet" type="text/css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<style>
    
</style>
</head>
<body>
<div class="sve">
<h2>Administracija ucenika</h2>
<div>
	<a href="./dodaj_dosje.php" id="AmdinA">Dosje </a>			
</div>
<div>
	<a href="./dodaj_dosje_ucenika.php" id="AmdinA"> Dodaj Dosje </a>			
</div>
<?php

$con = new mysqli("localhost", "root", "", "dnevnik_rada_psiholog");


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


$razredi_query = "SELECT oznaka_raz FROM razred";
$razredi_result = $con->query($razredi_query);

echo "
    <form action='".$_SERVER['PHP_SELF']."' method='GET'>
        <select name='razred'>
            <option value='--'>--</option>";
while ($raz = $razredi_result->fetch_assoc()) {
    echo "<option value='".$raz['oznaka_raz']."'>".$raz['oznaka_raz']."</option>";
}
echo "</select>
      <input type='submit' value='Pregledaj'/>
  </form>";  

if (isset($_GET['razred'])) { 
    $selected_razred = $_GET['razred'];


    $stmt = $con->prepare("SELECT * FROM ucenik_razred 
                           INNER JOIN ucenik ON ucenik_razred.id_uc = ucenik.id_uc 
                           INNER JOIN razred ON ucenik_razred.id_ra = razred.id_raz 
                           WHERE razred.oznaka_raz = ?
                           ORDER BY oznaka_raz DESC");
    $stmt->bind_param("s", $selected_razred);
    $stmt->execute();
    $rezultat = $stmt->get_result();

    if($rezultat->num_rows > 0) {  
        echo "<table id='tablica_dnevnika_rada' border='1'>
                <tr  id='plava' valign='top'>
                    <td><b>Ime</b></td>
                    <td><b>Prezime</b></td>
                    <td><b>Razred</b></td>
                    <td><b>Pregled</b></td>
                </tr>";
        while($redak = $rezultat->fetch_assoc()) { 
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
    } else {
        echo "Nema rezultata za odabrani razred."; 
    }


    $stmt->close();
}


$con->close();
?>

</div>
</body>
</html>