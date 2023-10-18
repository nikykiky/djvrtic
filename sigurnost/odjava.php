<!DOCTYPE html>
<html>
<head>
<title>Odjava</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div class="sve">
<h2>Odjava</h2>
<?php 
    session_start();
    session_unset();
    session_destroy();
    header("Location:../index.php");
    exit();
?>
</div>
</body>
</html>