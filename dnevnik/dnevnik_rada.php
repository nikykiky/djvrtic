<?php require_once("../sigurnost/sigurnosniKod.php");?>

<!DOCTYPE html>
<html>
<head>
<title>Dnevnik rada</title>
<meta http-equiv="Content-Type" content="text/html"/>
<meta charset="utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="../jquery/jquery-ui.min.js"></script>
<link href="../jquery/jquery-ui.min.css" rel="stylesheet" type="text/css" />
<style>
	body, html {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
}


.sve {
    max-width: 1200px;
    margin: 0 auto;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    padding: 20px;
    box-sizing: border-box;
}


header {
    background-color: #007bff;
    color: #fff;
    padding: 20px;
    text-align: center;
    border-radius: 10px 10px 0 0;
}


h2 {
    font-size: 24px;
    margin-bottom: 20px;
}


form {
    margin-bottom: 20px;
}


input[type="text"], textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}


input[type="text"]:focus, textarea:focus {
    border-color: #007bff;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 12px 24px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
}


input[type="submit"]:hover {
    background-color: #0056b3;
}

table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ddd;
}


table th {
    background-color: #007bff;
    color: #fff;
    padding: 15px;
    text-align: left;
    font-size: 18px;
}


table td {
    padding: 15px;
    border-bottom: 1px solid #ddd;
    font-size: 16px;
}


a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}


a:hover {
    text-decoration: underline;
}


.edit-link, .delete-link {
    margin-right: 10px;
}


@media screen and (max-width: 768px) {
    .sve {
        border-radius: 0;
    }
    header {
        border-radius: 0;
    }
}
</style>
</head>
<body>
<script>
          
          $(document).ready(function(){
            setInterval(function() {
             var date = new Date();
             $('#clock-wrapper').html(
            date.getHours() + " Sati " + date.getMinutes() + " Minuta " + date.getSeconds() + " Sekundi "
            );
            }, 500);
            function updateCurrentDate() {
            const now = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = now.toLocaleDateString(undefined, options);
            
            // Display the current date
            document.getElementById('currentDate').innerHTML = formattedDate;
        }

        // Update the current date every second
        setInterval(updateCurrentDate, 1000);

        // Initial update
        updateCurrentDate();
            });
        
        </script>
<div class="sve">

<?php 
require_once("../izbornik.php"); 

?> 

<h2>Dnevnik rada</h2>

<h4>Današnji datum:</h4>
<div id="currentDate"></div>
<p id="clock-wrapper"></p>
<form action="dodaj_dnevnik_rada.php" method="POST">

</p>

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
	$con = mysqli_connect("localhost","root","","dnevnik_rada_psiholog");

	$danasnji_datum = date("Y-m-d");

	
	$pdtc_dnevnik_rada = mysqli_query($con,"
	SELECT * FROM dnevnik_rada
	INNER JOIN korisnik ON korisnik.id_ko = dnevnik_rada.id_ko
	WHERE datum_unosa LIKE '".$danasnji_datum."%'");


	if(!isset($_POST['sbmt_date'])) {
	echo "<table border='1'>
		<tr valign='top'>
		<td><b>Dnevnik rada</b></td>
		<td><b>Upisao</b></td>
 		<td><b>Izmjeni</b></td>
 		<td><b>Obrisi</b></td>
		</tr>";
	
while($redak = mysqli_fetch_array($pdtc_dnevnik_rada))
 	  {
 	  $id = $redak['id_dr'];
	  $dt = new DateTime($redak['datum_unosa']);
	  $vrijeme = $dt->format('H:i');
  
 	  echo "<tr valign='top'><td>";
 	  echo $redak['opis'];
 	  echo "</td><td>";
	  echo $redak['ime']." ".$vrijeme;
	  echo "</td><td>";
	 echo "<a href='edit_dnevnika_rada.php?id_dr=$id'>Edit </a>";
	  echo "<a onclick='uredi_unos_iz_dnevnika(this)' style='text-decoration: underline; cursor: pointer' data-dr_opis='$redak[opis]' data-dr_id='$id'>Uredi</a>";
	  echo "</td><td>";
 echo "<a href='izbrisi_dnevnik_rada.php?id_dr=$id'> Delete </a>";
 	  echo "<a onclick='izbrisi_unos_iz_dnevnika(this)' style='text-decoration: underline; cursor: pointer' data-dr_id='$id'>Izbrisi</a>";
	  echo "</td></tr>";
	  }
	echo "</table>"; return; //return false; a false glumi prevent default
 	}
 ?>
 </div>

 <div id="dialog" title="Uredivanje unosa"  style="display: none;">
 	<textarea id="uredi_unos" style="height:100%;padding:5px; font-family:Sans-serif; font-size:1.2em;"></textarea>
 	<input type="text" style="display: none" />
 </div>

 <script>   
        
        
      
$(document).ready(function() {
// Making 2 variable month and day
var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

// make single object
var newDate = new Date();
// make current time
newDate.setDate(newDate.getDate());
// setting date and time
$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

setInterval( function() {
// Create a newDate() object and extract the seconds of the current time on the visitor's
var seconds = new Date().getSeconds();
// Add a leading zero to seconds value
$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
},1000);

setInterval( function() {
// Create a newDate() object and extract the minutes of the current time on the visitor's
var minutes = new Date().getMinutes();
// Add a leading zero to the minutes value
$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
},1000);

setInterval( function() {
// Create a newDate() object and extract the hours of the current time on the visitor's
var hours = new Date().getHours();
// Add a leading zero to the hours value
$("#hours").html(( hours < 10 ? "0" : "" ) + hours);
}, 1000); 
});
     
function izbrisi_unos_iz_dnevnika(obj) {
	alert("dsfsdf");
    var id_delete_dnevnika_rada = obj.getAttribute('data-dr_id');
    //console.log(id_delete_dnevnika_rada);
	
	//treba mi ajax amsterdam jer ne mogu napisati sql upit koji u sebi sadrzi js varijabli (ne ide nikako klijentski i serverski jezik skupa)
	if (confirm("Jesi sigurna :/") == true) {
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
*/
/*
$( "#datepicker" ).datepicker();
$( "#sbmt_date" ).click(function (e) {
	alert("sadasdas");
var odabrani_datum  = new Date($("#datepicker").val());
 var datum = odabrani_datum.getFullYear() + '-' + ((odabrani_datum.getMonth() + 1) < 10 ? '0' : '') + (odabrani_datum.getMonth() + 1) + '-' + ((odabrani_datum.getDate() + 1) < 10 ? '0' : '') + (odabrani_datum.getDate());
  e.preventDefault();
        var url = 'sql_dohvati_po_datumu.php';
        $.post(url, { datum: datum}, function(data){      // $.get will get the content of the page defined in url and will return it in **data** variable 
            $('#demo').append(data);
       });
	console.log(datum);
	$.ajax({
		type: "POST",
		url: "sql_dohvati_po_datumu.php",
		data: {"datum" : datum},
		success: function (rez) {
			console.log(rez);
			alert(rez);
			//location.reload(); 
		}
	});
return false;
});
// </script>
// </body>
// </html>


