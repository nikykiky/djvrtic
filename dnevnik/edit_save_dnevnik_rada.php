
<html>
<head>
	<title>Promjena dnevnika rada</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
	<link rel=stylesheet href="admin_css.css" type="text/css" />
</head>
<body>
	<div class="sve">
		<h2>Promjena dnevnika rada</h2>

		<?php
			$con = mysqli_connect("localhost", "root", "","dnevnik_rada_psiholog");
			$result = "UPDATE dnevnik_rada SET opis='$_POST[opis_dnevnik_rada]' where id_dr='$_POST[id_dr]'";
			$sql = mysqli_query($con,$result);
			if (mysqli_affected_rows($con) == 1) { 
				echo "Promijene unesene.";
			}
			else {
				echo "Niste ništa mijenjali.";
			}
		?>
		<br/>
	</div>
</body>

