<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="hr" lang="hr">
<head>
<<<<<<< HEAD
    <title>Spremanje učenika</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="admin_css.css" type="text/css" />
=======
<title>Spremanje u�enika</title>
<meta http-equiv="Content-Type" content="text/html" charset=utf-8" />
<link rel=stylesheet href="admin_css.css" type="text/css" />
>>>>>>> 0f8075654e489a628ab6e9790bbf3a9c70167598
</head>
<body>
<div class="sve">
    <h2>Dodavanje učenika</h2>

    <?php
    $connection = mysqli_connect("localhost", "root", "", "dnevnik_rada_psiholog");

<<<<<<< HEAD
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $ime_ucenika = $_POST['ime_ucenika'];
    $prezime_ucenika = $_POST['prezime_ucenika'];
    $oib_ucenika = $_POST['oib_ucenika'];
    $datum_rodenja = $_POST['datum_rodenja'];
    $adresa_ucenika = $_POST['adresa_ucenika'];
    $grad_ucenika = $_POST['grad_ucenika'];
    $spol_ucenika = $_POST['spol_ucenika'];
    $rjesenje_ucenika = $_POST['rjesenje_ucenika'];
    $klasa_ucenika = $_POST['klasa_ucenika'];
    $ime_oca = $_POST['ime_oca'];
    $mob_oca = $_POST['mob_oca'];
    $ime_majke = $_POST['ime_majke'];
    $mob_majke = $_POST['mob_majke'];
    $id_razreda = $_POST['id_razreda'];
    $id_sk_god = $_POST['id_sk_god'];
=======
<?php
$con = mysqli_connect("localhost", "root", "", "dnevnik_rada_psiholog");


$result_ucenik = mysqli_query($con,"
INSERT INTO ucenik (ime, prezime, oib, datum_rodenja, adresa, grad, spol,rjesenje, klasa) values 
('$_POST[ime_ucenika]','$_POST[prezime_ucenika]','$_POST[oib_ucenika]','$_POST[datum_rodenja]','$_POST[adresa_ucenika]','$_POST[grad_ucenika]','$_POST[spol_ucenika]','$_POST[rjesenje_ucenika]','$_POST[klasa_ucenika]')
");
$id_ucenika = mysqli_insert_id($con);
>>>>>>> 0f8075654e489a628ab6e9790bbf3a9c70167598

    // Insert data into the respective tables using prepared statements
    $stmt_ucenik = $connection->prepare("INSERT INTO ucenik (ime, prezime, oib, datum_rodenja, adresa, grad, spol, rjesenje, klasa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_ucenik->bind_param("sssssssss", $ime_ucenika, $prezime_ucenika, $oib_ucenika, $datum_rodenja, $adresa_ucenika, $grad_ucenika, $spol_ucenika, $rjesenje_ucenika, $klasa_ucenika);

    $stmt_otac = $connection->prepare("INSERT INTO roditelj (ime, telefon) VALUES (?, ?)");
    $stmt_otac->bind_param("ss", $ime_oca, $mob_oca);

    $stmt_majka = $connection->prepare("INSERT INTO roditelj (ime, telefon) VALUES (?, ?)");
    $stmt_majka->bind_param("ss", $ime_majke, $mob_majke);

<<<<<<< HEAD
    if ($stmt_ucenik->execute() && $stmt_otac->execute() && $stmt_majka->execute()) {
        $id_ucenika = $connection->insert_id;
        $id_oca = $connection->insert_id;
        $id_majke = $connection->insert_id;
=======
$result_otac = mysqli_query($con ,"
INSERT INTO roditelj (ime, telefon) values 
('$_POST[ime_oca]','$_POST[mob_oca]')
");
$id_oca = mysqli_insert_id($con);
>>>>>>> 0f8075654e489a628ab6e9790bbf3a9c70167598

        // Insert data into roditelj_dijete and ucenik_razred tables
        $stmt_roditelji = $connection->prepare("INSERT INTO roditelj_dijete (id_ro, id_uc) VALUES (?, ?), (?, ?)");
        $stmt_roditelji->bind_param("iiii", $id_oca, $id_ucenika, $id_majke, $id_ucenika);

<<<<<<< HEAD
        $stmt_ucenik_razred = $connection->prepare("INSERT INTO ucenik_razred (id_ra, id_uc, id_skgod) VALUES (?, ?, ?)");
        $stmt_ucenik_razred->bind_param("iis", $id_razreda, $id_ucenika, $id_sk_god);

        if ($stmt_roditelji->execute() && $stmt_ucenik_razred->execute()) {
            echo "Uspješno uneseno!<br /><br />";
        } else {
            echo "Nije uneseno!<br /><br />";
        }
    } else {
        echo "Nije uneseno!<br /><br />";
    }

    $stmt_ucenik->close();
    $stmt_otac->close();
    $stmt_majka->close();
    $stmt_roditelji->close();
    $stmt_ucenik_razred->close();
    $connection->close();
    ?>
=======
$result_majka = mysqli_query($con,"
INSERT INTO roditelj (ime, telefon) values 
('$_POST[ime_majke]','$_POST[mob_majke]')
");
$id_majke= mysqli_insert_id($con);

$result_roditelji = mysqli_query($con, "
INSERT INTO roditelj_dijete (id_ro, id_uc) values 
(".$id_oca.",".$id_ucenika."),(".$id_majke.",".$id_ucenika.")
");

$ucenik_razred = mysqli_query($con, "
INSERT INTO ucenik_razred (id_ra, id_uc, id_skgod) values 
('$_POST[id_razreda]',".$id_ucenika.",'$_POST[id_sk_god]');
");

if (mysqli_affected_rows() != 1) {
?>
Uspje�no une�eno! <br /><br />
<?php
}
else{
	?>
Nije unijeto!<br /><br />
<?php
}
?>
<br>
>>>>>>> 0f8075654e489a628ab6e9790bbf3a9c70167598
</div>
</body>
</html>
