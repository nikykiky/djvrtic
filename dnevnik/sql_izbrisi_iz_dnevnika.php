<?php
    $con = mysqli_connect("localhost", "root", "", "dnevnik_rada_psiholog");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    if (isset($_POST['id_unosa_za_brisanje'])) {
        $id_b = $_POST['id_unosa_za_brisanje'];
    
        $brisanje = "DELETE FROM dnevnik_rada WHERE id_dr = $id_b";
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

?>
        