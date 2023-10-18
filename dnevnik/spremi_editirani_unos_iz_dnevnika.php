<?php
    $con = mysqli_connect("localhost", "root", "","dnevnik_rada_psiholog");
    $result = "UPDATE dnevnik_rada SET opis='$_POST[opis_dnevnik_rada]' where id_dr='$_POST[id_unosa_za_edit]'";
    $sql = mysqli_query($con,$result);
    if (mysqli_affected_rows($con) == 1) { 
        echo "Promijene unesene.";
    }
    else {
        echo "Niste ništa mijenjali.";
    }
?>