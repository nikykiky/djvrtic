<?php
mysql_connect("localhost", "root", "");
mysql_select_db("dnevnik_rada_psiholog");
mysql_query("DELETE FROM dnevnik_rada WHERE id_dr= '$_POST[id_unosa_za_brisanje]' LIMIT 1");
?>