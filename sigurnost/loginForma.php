<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" />
<link href="admin_css.css" rel="stylesheet" type="text/css" />
</head>

<body onload="window.document.loginForma.korisnik.focus()">
<div class="sve">
	<h2> Logiraj se:</h2>
	<form name="loginForma" method="post" action="./login.php">
		<div align="left">
			Unesi: <br />
			korisnicko ime:  
			<input type="text" name="korisnik"><br />
			lozinku:
			<input type="password" name="zaporka"><br />
			<input type="submit" name="sbmt_login" value="Login">
		</div>
	</form>
</div>
</body>
</html>