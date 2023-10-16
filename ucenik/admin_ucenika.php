<!DOCTYPE html>
<html>
<head>
<title>Administracija ucenika</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
<link rel="stylesheet" type="text/css" href="../admin_css.css" />
</head>
<body>
<div class="sve">
<h2>Administracija ucenika</h2>
<?php
$con = mysqli_connect("localhost", "root", "", "dnevnik_rada_psiholog");
 
$razredi = "SELECT oznaka_raz FROM razred";
$sql = mysqli_query($con, $razredi);
echo "
<form action='" . $_SERVER['PHP_SELF'] . "' method='GET'>
<select name='razred'>
<option value='--'>--</option>";
while ($raz = mysqli_fetch_array($sql)) {
    echo "<option value='" . $raz['oznaka_raz'] . "'>" . $raz['oznaka_raz'] . "</option>";
}
echo "</select>
<input type='submit' value='Pregledaj'/>
</form>";
 
if (isset($_GET['razred'])) {
    // Use prepared statements to prevent SQL injection
    $razred = $_GET['razred'];
    $stmt = $con->prepare("SELECT * FROM ucenik_razred
        INNER JOIN ucenik ON ucenik_razred.id_uc = ucenik.id_uc 
        INNER JOIN razred ON ucenik_razred.id_ra = razred.id_raz 
        WHERE razred.oznaka_raz = ?");
    $stmt->bind_param("s", $razred);
    $stmt->execute();
    $rezultat = $stmt->get_result();
 
    echo "<table border='1'>
<tr valign='top'>
<td><b>Ime</b></td>
<td><b>Prezime</b></td>
<td><b>Razred</b></td>
<td><b>Pregled</b></td>
</tr>";
 
    while ($redak = mysqli_fetch_assoc($rezultat)) {
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
    $stmt->close();
}
 
mysqli_close($con);
?>
</div>
</body>
</html>