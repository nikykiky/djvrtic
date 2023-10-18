<!DOCTYPE html>
<html>
<head>
    <title>Spremanje dosjea</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="admin_css.css" type="text/css" />
</head>
<body>
<div class="sve">
    <h2> Dodavanje dosjea</h2>

    <?php
    $connection = mysqli_connect("localhost", "root", "", "dnevnik_rada_psiholog");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id_ucenika = mysqli_real_escape_string($connection, $_POST['id_ucenika']);
    $id_korisnika = mysqli_real_escape_string($connection, $_POST['id_korisnika']);
    $dosje_opis = mysqli_real_escape_string($connection, $_POST['dosje_opis']);
    $datum_unosa_dosjea = mysqli_real_escape_string($connection, $_POST['datum_unosa_dosjea']);

    $query = "INSERT INTO dosje_ucenika (id_uc, id_ko, opis, datum_unosa) VALUES ('$id_ucenika', '$id_korisnika', '$dosje_opis', '$datum_unosa_dosjea')";

    if (mysqli_query($connection, $query)) {
        echo "Uspješno uneseno!<br /><br />";
    } else {
        echo "Nije uneseno!<br /><br />";
    }

    mysqli_close($connection);
    ?>
    <br>
</div>
</body>
</html>
