<?php
$conn = new mysqli("localhost", "root", "", "dnevnik_rada_psiholog");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['datum'])) {
    $datum = $conn->real_escape_string($_POST['datum']);

    $sql = "SELECT opis, DATE_FORMAT(datum_unosa, '%Y-%m-%d %H:%i:%s') AS datum_unosa FROM dnevnik_rada WHERE DATE_FORMAT(datum_unosa, '%Y-%m-%d') = ? ORDER BY datum_unosa";    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $datum);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $entry = array();
            foreach ($row as $key => $value) {
                $entry[$key] = $value;
            }
            $data[] = $entry;
        }
    } else {
        $data = array("message" => "Nista nije uneseno taj dan");
    }

    echo json_encode($data);

    $stmt->close();
} else {
    echo json_encode(array("message" => "Invalid input"));
}

$conn->close();
?>
