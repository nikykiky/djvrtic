<?php
    $conn = new mysqli("localhost", "root", "", "dnevnik_rada_psiholog");
    $sql = "SELECT * FROM dnevnik_rada WHERE datum_unosa LIKE '%$_POST[datum]%' ORDER BY datum_unosa";
    $rez = $conn->query($sql);
    
    $data = array(); // Inicijalizirajte prazan niz za spremanje podataka
    
    if ($rez->num_rows > 0) {
        while($row = $rez->fetch_assoc()) {
            // Dodajte redak u niz
            $data[] = array(
                'opis' => $row["opis"],
                'datum_unosa' => $row["datum_unosa"]
            );
        }
    } else {
        $data = "Ne postoji ni jedan zapis";
    }

    // Pretvorite niz u JSON format i šaljite natrag kao odgovor
    echo json_encode($data);
?>