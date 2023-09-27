<?php

$conn = new mysqli("localhost", "root", "", "dnevnik_rada_psiholog");
$sql = "SELECT * FROM dnevnik_rada WHERE datum_unosa LIKE '%$_POST[datum]%' ORDER BY datum_unosa";
$rez = $conn->query($sql);
$data = "";
if ($rez->num_rows > 0) {
    while($row = $rez->fetch_assoc()) {
        $data .= $row["opis"]. " " . $row["datum_unosa"]. "<br>";
    }
} else {
    $data = "Ne postoji ni jedan zapis";
}
echo $data; 
?>