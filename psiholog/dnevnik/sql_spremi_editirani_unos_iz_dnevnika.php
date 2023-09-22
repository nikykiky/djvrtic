<?php
mysql_connect("localhost", "root", "");
mysql_select_db("dnevnik_rada_psiholog");
mysql_query("UPDATE dnevnik_rada SET opis='$_POST[opis_dnevnik_rada]' where id_dr=$_POST[id_unosa_za_edit] LIMIT 1");
?>

