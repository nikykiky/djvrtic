<!DOCTYPE html>
<html>
<head>
    <title>Brisanje dnevnika rada</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
    <link rel="stylesheet" href="admin_css.css" type="text/css" />
</head>
<body>
<div class="sve">
    <h2> Brisanje dnevnika rada</h2>

    <?php
    $connection = mysqli_connect("localhost", "root", "", "dnevnik_rada_psiholog");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id_dr = (int)$_GET['id_dr']; // Ensure it's an integer to prevent SQL injection

    $query = "DELETE FROM dnevnik_rada WHERE id_dr = $id_dr LIMIT 1";

    if (mysqli_query($connection, $query)) {
        echo "Promjene su unijete u tablicu.<br />";
    } else {
        echo "Niste ništa mijenjali.<br />";
    }

    mysqli_close($connection);
    ?>

</div>
</body>
</html>
