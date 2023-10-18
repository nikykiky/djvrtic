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

<<<<<<< HEAD
    <?php
    $connection = mysqli_connect("localhost", "root", "", "dnevnik_rada_psiholog");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
=======
<?php
    $con = mysqli_connect("localhost", "root", "", "dnevnik_rada_psiholog");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    if (isset($_GET['id_dr'])) {
        $id_b = $_GET['id_dr'];
    
        $brisanje = "DELETE FROM dnevnik_Rada WHERE id_dr = $id_b";
        $querry = mysqli_query($con, $brisanje);
    
        if ($querry && mysqli_affected_rows($con) > 0) {
            print "Promjene su unesene u tablicu.";
        } else {
            print "Niste ništa mijenjali ili se dogodila greška pri brisanju.";
        }
    } else {
        print "Niste naveli id_b za brisanje.";
    }
    
    $con->close();
>>>>>>> 0f8075654e489a628ab6e9790bbf3a9c70167598

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
