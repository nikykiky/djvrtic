<?php

$conn = new mysqli("localhost", "root", "", "dnevnik_rada_psiholog");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['datum'])) {

    $datum = $conn->real_escape_string($_POST['datum']);


    $sql = "SELECT opis, datum_unosa FROM dnevnik_rada WHERE datum_unosa LIKE ? ORDER BY datum_unosa";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $datum);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array(); 

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
         
            $data[] = array(
                'opis' => $row["opis"],
                'datum_unosa' => $row["datum_unosa"]
            );
        }
    } else {
        $data = "Nista nije uneseno taj dan"; 
    }


    echo json_encode($data);


    $stmt->close();
} else {

    echo json_encode("Invalid input");
}

$conn->close();

?>
