<?php require_once("../sigurnost/sigurnosniKod.php");?>

<!DOCTYPE html>
<html>
<head>
    <title>Dnevnik rada</title>
    <meta http-equiv="Content-Type" content="text/html"/>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <link href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="sve">

<?php 
require_once("../izbornik.php"); 
//print_r($_SESSION); 
?> 

<h2>Dnevnik rada</h2>
<p>Datum:
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<input type="text" id="datepicker" ></p>
<input type="submit" value="Dohvati" name="sbmt_date" id="sbmt_date" />

<p id="demo"></p>
<div class="unos_dnevnika">
    <form action="dodaj_dnevnik_rada.php" method="POST"> 
        <input type="text" name="id_korisnika" value="<?=$_SESSION['user_id']?>" style="display:none"/>
        Opis: <br />
        <textarea rows="4" cols="50" name="opis_dnevnik_rada"></textarea><br />
        <input type="submit" value="Dodaj dnevnik rada" name="sbmt_dnevnik_rad"/>
    </form>
</div>

<h2>Pregled dnevnika rada za današnji datum</h2>

<?php
$mysqli = new mysqli("localhost", "root", "", "dnevnik_rada_psiholog");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

if (!isset($_POST['sbmt_date'])) {
    $danasnji_datum = date("Y-m-d");
    
    $stmt = $mysqli->prepare("
        SELECT * FROM dnevnik_rada
        INNER JOIN korisnik ON korisnik.id_ko = dnevnik_rada.id_ko
        WHERE datum_unosa LIKE ?");

    $stmt->bind_param("s", $danasnji_datum_like);
    $danasnji_datum_like = $danasnji_datum . '%';

    $stmt->execute();

    $result = $stmt->get_result();

    echo "<table border='1'>
        <tr valign='top'>
        <td><b>Dnevnik rada</b></td>
        <td><b>Upisao</b></td>
        <td><b>Izmjeni</b></td>
        <td><b>Obrisi</b></td>
        </tr>";

    while ($redak = $result->fetch_assoc()) {
        $id = $redak['id_dr'];
        $dt = new DateTime($redak['datum_unosa']);
        $vrijeme = $dt->format('H:i');

        echo "<tr valign='top'><td>";
        echo $redak['opis'];
        echo "</td><td>";
        echo $redak['ime']." ".$vrijeme;
        echo "</td><td>";
        echo "<a onclick='uredi_unos_iz_dnevnika(this)' style='text-decoration: underline; cursor: pointer' data-dr_opis='{$redak['opis']}' data-dr_id='$id'>Uredi</a>";
        echo "</td><td>";
        echo "<a onclick='izbrisi_unos_iz_dnevnika(this)' style='text-decoration: underline; cursor: pointer' data-dr_id='$id'>Izbrisi</a>";
        echo "</td></tr>";
    }

    echo "</table>";
    $stmt->close();
}

$mysqli->close();
?>
</div>

<div id="dialog" title="Uredivanje unosa"  style="display: none;">
    <textarea id="uredi_unos" style="height:100%;padding:5px; font-family:Sans-serif; font-size:1.2em;"></textarea>
    <input type="text" style="display: none" />
</div>

<script>
function izbrisi_unos_iz_dnevnika(obj) {
    var id_delete_dnevnika_rada = obj.getAttribute('data-dr_id');

    if (confirm("Jesi siguran/a?")) {
        $.ajax({
            type: "POST",
            url: "sql_izbrisi_iz_dnevnika.php",
            data: {"id_unosa_za_brisanje" : id_delete_dnevnika_rada},
            success: function (rez) {
                location.reload(); 
            }
        });
    }
}

$("#dialog").dialog({
    autoOpen: false,
    height: 300,
    width: 350,
    modal: true,
    resizable: true,
    buttons: {
        "Unesi": function() {
            var unos = $('#dialog').find("textarea").val();
            var id_unosa_za_edit = $('#dialog').find("input").val();
            $.ajax({
                type: "POST",
                url: "sql_spremi_editirani_unos_iz_dnevnika.php",
                data: {"opis_dnevnik_rada" : unos, "id_unosa_za_edit" : id_unosa_za_edit },
                success: function (rez) {
                    location.reload(); 
                }
            });
            $(this).dialog("close");
        },
        "Odustani": function() {
            $(this).dialog("close");
        }
    }
});

function uredi_unos_iz_dnevnika(obj) {
    var opis_dnevnika_rada = obj.getAttribute('data-dr_opis');
    var id_unosa_za_edit = obj.getAttribute('data-dr_id');
    $('#dialog').find("textarea").val(opis_dnevnika_rada);
    $('#dialog').find("input").val(id_unosa_za_edit);
    $('#dialog').dialog('open');
}

$( "#datepicker" ).datepicker();

$( "#sbmt_date" ).click(function (e) {
    e.preventDefault();
    var odabrani_datum  = new Date($("#datepicker").val());
    var datum = odabrani_datum.getFullYear() + '-' + ((odabrani_datum.getMonth() + 1) < 10 ? '0' : '') + (odabrani_datum.getMonth() + 1) + '-' + ((odabrani_datum.getDate() + 1) < 10 ? '0' : '') + (odabrani_datum.getDate());
    
    $.ajax({
        type: "POST",
        url: "sql_dohvati_po_datumu.php",
        data: {"datum"
