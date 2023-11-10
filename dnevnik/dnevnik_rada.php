


<?php require_once("../sigurnost/sigurnosniKod.php"); ?>

<!DOCTYPE html>
<html>
<head>
	
    <meta charset="utf-8">
    <title>Dnevnik rada</title>
	<meta charset="UTF-8">
    <link href="dnevnik_radacss.css" rel="stylesheet" type="text/css" />
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
</head>
<body >
	<script>
		
		// Sat u js-u
		window.onload = function() {
			const time = document.querySelector('.time');
			const clock = document.querySelector('.clock');

			function setDate(){
				const today = new Date();
				const second = today.getSeconds().toString().padStart(2, '0');
				const minute = today.getMinutes().toString().padStart(2, '0');
				const hour = today.getHours().toString().padStart(2, '0');
				
				time.innerHTML = '<span>' + hour  + ' : ' + minute + ' : ' + second + '</span>';
			}
			setInterval(setDate, 1000);
		}

	</script>
	
	<div class="obj">
        <div class="objchild">
		<div class="sve">
		<?php 
			//trenutno samo botun odjava
			require_once("../izbornik.php"); 
		?> 

		<!-- Forma za unos -->
		<h2>Dnevnik rada</h2>

		<p id="demo"></p>
		<div class="unos_dnevnika">
			<form action="" method="POST"> 
				<input type="text" name="id_korisnika" value="<?=$_SESSION['user_id']?>" style="display:none"/>
				Opis: <br />
				<textarea rows="3" cols="5" name="opis_dnevnik_rada"></textarea>
				<br />
				<input type="submit" value="Dodaj dnevnik rada" name="sbmt_dnevnik_rad"/>
			</form>

			<div>
				<input type="text" id="datepicker">		
				<div class="time"></div>
			</div>
		</div>
		
		<h2>Pregled dnevnika rada za današnji datum</h2>
<?php
	
	require_once("../sigurnost/sigurnosniKod.php");
	
	// Spajanje na bazu 
	$con = mysqli_connect("localhost", "root", "", "dnevnik_rada_psiholog");
	
	// Provjera konekcije na bazu
	if (mysqli_connect_error()) {
		die("Database connection failed: " . mysqli_connect_error());
	}
	
	//Unos podataka u bazu na submit
	if (isset($_POST['sbmt_dnevnik_rad'])) {
		$korisnik = $_SESSION['user_id'];
		$opis = $_POST["opis_dnevnik_rada"];
	
		// Priprema podataka za unos u bazu
		$stmt = $con->prepare("INSERT INTO dnevnik_rada (id_ko, opis) VALUES (?, ?)");
		$stmt->bind_param("is", $korisnik, $opis);
	
		if ($stmt->execute()) {
			header("Location: " . $_SERVER['PHP_SELF']);
			exit();
		} else {
			echo "Error: " . $stmt->error;
		}
	}
	
	// Hvatanje unosa po datumu
	$danasnji_datum = date("Y-m-d");
	$pdtc_dnevnik_rada = mysqli_query($con, "
		SELECT * FROM dnevnik_rada
		INNER JOIN korisnik ON korisnik.id_ko = dnevnik_rada.id_ko
		WHERE datum_unosa LIKE '$danasnji_datum%'
	");

	//Ispis tablice u kojoj ce bit ispisani podatci iz baze
    echo "<table id='tablica_dnevnika_rada' border='1'>
            <tr id='plava' valign='top'>
            <td width='50%'><b>Dnevnik rada</b></td>
            <td width='20%'><b>Upisao</b></td>
            <td width='15%'><b>Izmjeni</b></td>
            <td width='15%'><b>Obrisi</b></td>
            </tr>";

	//Ispis podataka iz baze		
    while ($redak = mysqli_fetch_array($pdtc_dnevnik_rada)) {
        $id = $redak['id_dr'];
        $dt = new DateTime($redak['datum_unosa']);
        $vrijeme = $dt->format('H:i');

        echo "<tr valign='top'><td>";
        echo $redak['opis'];
        echo "</td><td>";
        echo $redak['ime'] . " " . $vrijeme;
        echo "</td><td>";
        echo "<button class='button1' onclick='uredi_unos_iz_dnevnika(this)' style='text-decoration: underline; cursor: pointer' data-dr_opis='$redak[opis]' data-dr_id='$id'><svg height='36px' width='36px' viewBox='0 0 36 36' xmlns='http://www.w3.org/2000/svg'>
        <rect fill='#fdd835' y='0' x='0' height='36' width='36'></rect>
        <path d='M38.67,42H11.52C11.27,40.62,11,38.57,11,36c0-5,0-11,0-11s1.44-7.39,3.22-9.59 c1.67-2.06,2.76-3.48,6.78-4.41c3-0.7,7.13-0.23,9,1c2.15,1.42,3.37,6.67,3.81,11.29c1.49-0.3,5.21,0.2,5.5,1.28 C40.89,30.29,39.48,38.31,38.67,42z' fill='#e53935'></path>
        <path d='M39.02,42H11.99c-0.22-2.67-0.48-7.05-0.49-12.72c0.83,4.18,1.63,9.59,6.98,9.79 c3.48,0.12,8.27,0.55,9.83-2.45c1.57-3,3.72-8.95,3.51-15.62c-0.19-5.84-1.75-8.2-2.13-8.7c0.59,0.66,3.74,4.49,4.01,11.7 c0.03,0.83,0.06,1.72,0.08,2.66c4.21-0.15,5.93,1.5,6.07,2.35C40.68,33.85,39.8,38.9,39.02,42z' fill='#b71c1c'></path>
        <path d='M35,27.17c0,3.67-0.28,11.2-0.42,14.83h-2C32.72,38.42,33,30.83,33,27.17 c0-5.54-1.46-12.65-3.55-14.02c-1.65-1.08-5.49-1.48-8.23-0.85c-3.62,0.83-4.57,1.99-6.14,3.92L15,16.32 c-1.31,1.6-2.59,6.92-3,8.96v10.8c0,2.58,0.28,4.61,0.54,5.92H10.5c-0.25-1.41-0.5-3.42-0.5-5.92l0.02-11.09 c0.15-0.77,1.55-7.63,3.43-9.94l0.08-0.09c1.65-2.03,2.96-3.63,7.25-4.61c3.28-0.76,7.67-0.25,9.77,1.13 C33.79,13.6,35,22.23,35,27.17z' fill='#212121'></path>
        <path d='M17.165,17.283c5.217-0.055,9.391,0.283,9,6.011c-0.391,5.728-8.478,5.533-9.391,5.337 c-0.913-0.196-7.826-0.043-7.696-5.337C9.209,18,13.645,17.32,17.165,17.283z' fill='#01579b'></path>
        <path d='M40.739,37.38c-0.28,1.99-0.69,3.53-1.22,4.62h-2.43c0.25-0.19,1.13-1.11,1.67-4.9 c0.57-4-0.23-11.79-0.93-12.78c-0.4-0.4-2.63-0.8-4.37-0.89l0.1-1.99c1.04,0.05,4.53,0.31,5.71,1.49 C40.689,24.36,41.289,33.53,40.739,37.38z' fill='#212121'></path>
        <path d='M10.154,20.201c0.261,2.059-0.196,3.351,2.543,3.546s8.076,1.022,9.402-0.554 c1.326-1.576,1.75-4.365-0.891-5.267C19.336,17.287,12.959,16.251,10.154,20.201z' fill='#81d4fa'></path>
        <path d='M17.615,29.677c-0.502,0-0.873-0.03-1.052-0.069c-0.086-0.019-0.236-0.035-0.434-0.06 c-5.344-0.679-8.053-2.784-8.052-6.255c0.001-2.698,1.17-7.238,8.986-7.32l0.181-0.002c3.444-0.038,6.414-0.068,8.272,1.818 c1.173,1.191,1.712,3,1.647,5.53c-0.044,1.688-0.785,3.147-2.144,4.217C22.785,29.296,19.388,29.677,17.615,29.677z M17.086,17.973 c-7.006,0.074-7.008,4.023-7.008,5.321c-0.001,3.109,3.598,3.926,6.305,4.27c0.273,0.035,0.48,0.063,0.601,0.089 c0.563,0.101,4.68,0.035,6.855-1.732c0.865-0.702,1.299-1.57,1.326-2.653c0.051-1.958-0.301-3.291-1.073-4.075 c-1.262-1.281-3.834-1.255-6.825-1.222L17.086,17.973z' fill='#212121'></path>
        <path d='M15.078,19.043c1.957-0.326,5.122-0.529,4.435,1.304c-0.489,1.304-7.185,2.185-7.185,0.652 C12.328,19.467,15.078,19.043,15.078,19.043z' fill='#e1f5fe'></path>
    </svg>
    <span class='now'>Edit</span>
    <span class='play'>Sad</span></button>";
        echo "</td><td>";
        echo "<button class='button' onclick='izbrisi_unos_iz_dnevnika(this)' style='text-decoration: underline; cursor: pointer' data-dr_id='$id'><svg viewBox='0 0 448 512' class='svgIcon'><path d='M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z'></path></svg></button>";
        echo "</td></tr>";
    }
    echo "</table>";

    ?>
</div>

<!-- Dialog za editanje unešenih podataka -->
<div id="dialog" title="Uredivanje unosa" style="display: none;">
    <textarea id="uredi_unos" style="height:100%;padding:5px; font-family:Sans-serif; font-size:1.2em;"></textarea>
    <input type="text" style="display: none" />
</div>

        </div>
    </div>
	


<script>      
	

	//Još jedan sat?
	window.onload = function() {
	
		const hourHand = document.querySelector('.hourHand');
		const minuteHand = document.querySelector('.minuteHand');
		const secondHand = document.querySelector('.secondHand');
		const time = document.querySelector('.time');
		const clock = document.querySelector('.clock');

		function setDate(){
			const today = new Date();
			const second = today.getSeconds();
			const secondDeg = ((second / 60) * 360) + 360; 
			secondHand.style.transform = `rotate(${secondDeg}deg)`;

			const minute = today.getMinutes();
			const minuteDeg = ((minute / 60) * 360); 
			minuteHand.style.transform = `rotate(${minuteDeg}deg)`;

			const hour = today.getHours();
			const hourDeg = ((hour / 12 ) * 360 ); 
			hourHand.style.transform = `rotate(${hourDeg}deg)`;
			
			time.innerHTML = '<span>' + '<strong>' + hour + '</strong>' + ' : ' + minute + ' : ' + '<small>' + second +'</small>'+ '</span>';
		}
		setInterval(setDate, 1000);
	}
 
	//Brianje iz baze podataka
	function izbrisi_unos_iz_dnevnika(obj) {
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


	//JS Otvaranje dialoga za edit
	$("#dialog").dialog({
		autoOpen: false,
		height: 400,
		width: 450,
		modal: true,
		resizable: true,
		buttons: {
			"Unesi": function() {
				var unos = $('#dialog').find("textarea").val();
				var id_unosa_za_edit = $('#dialog').find("input").val();
				$.ajax({
					type: "POST",
					url: "spremi_editirani_unos_iz_dnevnika.php",
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

	//Otvaranje Dialoga za edit
	function uredi_unos_iz_dnevnika(obj) {
		var opis_dnevnika_rada = obj.getAttribute('data-dr_opis');
		var id_unosa_za_edit = obj.getAttribute('data-dr_id');
		$('#dialog').find("textarea").val(opis_dnevnika_rada);
		$('#dialog').find("input").val(id_unosa_za_edit);
		$('#dialog').dialog('open');
	}

	// Hvatanje podataka iz baze po datumu
	$("#datepicker").datepicker({
		dateFormat: "mm-dd-yy", 
		onSelect: function(dateText, inst) {
			var odabrani_datum  = new Date(dateText);
			console.log(dateText)
			console.log(odabrani_datum)
			var datum = odabrani_datum.getFullYear() + '-' + ((odabrani_datum.getMonth() + 1) < 10 ? '0' : '') + (odabrani_datum.getMonth() + 1) + '-' + ((odabrani_datum.getDate() + 1) < 10 ? '0' : '') + (odabrani_datum.getDate());
			
			var url = 'sql_dohvati_po_datumu.php';
			console.log("datum", odabrani_datum)
			$.post(url, { datum: datum}, function(data){      
				$('#demo').append(data);
			});
			console.log(datum);

			$.ajax({
				type: "POST",
				url: "sql_dohvati_po_datumu.php",
				data: {"datum" : datum},
				success: function (podaci) {
					var tbody = $("#tablica_dnevnika_rada tbody");
					var noviRedak;
					podaci = JSON.parse(podaci)
					console.log(podaci)
					// Prolazite kroz dobivene podatke i dodajte ih u tablicu
					for (var i = 0; i < podaci.length; i++) {
						var redak = podaci[i];
						noviRedak += 
						`<tr>
						<td>${redak.opis}</td>
						<td>${redak.datum_unosa}</td> 
						<td><a onclick='uredi_unos_iz_dnevnika(this)' style='text-decoration: underline; cursor: pointer' data-dr_opis='' data-dr_id=''>NERADIII</a></td>
						<td><a onclick='izbrisi_unos_iz_dnevnika(this)' style='text-decoration: underline; cursor: pointer' data-dr_id=''>NERADIII</a></td>"+
						</tr>`;
						console.log(redak)
						tbody.append(noviRedak);
					}
				}
			});
		}
	});

	var danasnjiDatum = new Date();
	var dan = danasnjiDatum.getDate();
	var mjesec = danasnjiDatum.getMonth() + 1; // Mjeseci kreću od 0
	var godina = danasnjiDatum.getFullYear();
	// Formatirajte datum prema vašim željama (npr., "dd.mm.yyyy")
	var formatiraniDatum =  mjesec + '-' + dan + '-' + godina;
	// Postavite vrijednost input polja na današnji datum
	$("#datepicker").val(formatiraniDatum);




</script>
</body>
</html>
