<!DOCTYPE html>
<html>
<head>
<title>Index</title>
<meta charset="utf-8" />
<link rel=stylesheet href="stil.css" type="text/css" />
</head>

<body bgcolor="#FFFFFF" text="#000000">

<div class="kontejner">
<div class="baner"></div>
<div class="index-botun">
<a href="index.php">index</a>| <a href="administracija.php">Admin</a></div> 


<?php
if (isset($_GET['gl']) == true){
	$a=$_GET['gl'];
} 
else{
	$a="";
}
if (isset($_GET['pl']) == true){
	$b=$_GET['pl'];
} 
else{
	$b="";
}
if (isset($_GET['cl']) == true){
	$c=$_GET['cl'];
} 
else{
	$c="";
}


mysql_connect("localhost","root","");
mysql_select_db("cms");


$rezultat=mysql_query("SELECT * FROM glavnilinkovi");
print "<div class='glavnilinkovi'>";
	while($redak = mysql_fetch_array($rezultat))
	{
		print "<a href='index.php?gl=".$redak['id_glavni']."'>".$redak['naziv']."</a>";
		print " | ";
	}
print "</div>";

	
	
	

if (!empty($a) && !empty($b) && !empty($c)) //ako je stisnut gl link->podlink->CLANAK
{
	print "<div class='podlinkovi'>";
	print "<ul>";
	$rezultat=mysql_query("SELECT * FROM podlinkovi where id_glavni = $a");
	while($redak = mysql_fetch_array($rezultat))
	{
		print "<li>";
		print "<a href='index.php?gl=".$redak['id_glavni']."&pl=".$redak['id_pod']."'>".$redak['naziv']."</a>";
		print "</li>";       
	}
	print "</ul>";
	print "</div>";
	
	print "<div class='clanci'>";
	$rezultat=mysql_query("SELECT * FROM clanci where id_clanak = $c");
	while($redak = mysql_fetch_array($rezultat))
	{
		print "<div>".$redak['naziv']."</div>";
		print "<div>";
			print "<p>";
			print "<div class='slika'>";
				print "<img align='center' width='270px' height='190px' src='".$redak['multimedija2']."'/>";
			print "</div>";
			print $redak['opis'];
			print "</p>";
			print "<br><br>";
		print "</div>";	
	}
	print "</div>";
}




elseif (!empty($a) && !empty($b)) //ako je stisnut gl link->PODLINK
{
	print "<div class='podlinkovi'>";
	print "<ul>";
	$rezultat=mysql_query("SELECT * FROM podlinkovi where id_glavni = $a");
	while($redak = mysql_fetch_array($rezultat))
	{
		print "<li>";
		print "<a href='index.php?gl=".$redak['id_glavni']."&pl=".$redak['id_pod']."'>".$redak['naziv']."</a>";
		print "</li>";       
	}
	print "</ul>";
	print "</div>";
	
	print "<div class='clanci'>";
	$rezultat=mysql_query("
	SELECT naziv,id_clanak,clanci.multimedija1,CONCAT(LEFT(opis,300),'...') AS opis FROM clanci where id_pod = $b");
	while($redak = mysql_fetch_array($rezultat))
	{
		print "<div class='clanaknaslov'>";
			print "<a href='index.php?gl=".$a."&pl=".$b."&cl=".$redak['id_clanak']."'>".$redak['naziv']."</a>";
		print "</div>";
		print "<div>";
			print "<p>";
			print "<img align='left' width='100px' height='80px' src='".$redak['multimedija1']."'/>";
			print $redak['opis'];
			print "</p>";
		print "</div>";       
	}
	print "</div>";
}




elseif (!empty($a) && !empty($c)) //stisnut je glavni link i odabran je clanak
{
	print "<div class='podlinkovi'>";
	print "<ul>";
	$rezultat=mysql_query("SELECT * FROM podlinkovi where id_glavni = $a");
	while($redak = mysql_fetch_array($rezultat))
	{
		print "<li>";
			print "<a href='index.php?gl=".$redak['id_glavni']."&pl=".$redak['id_pod']."'>".$redak['naziv']."</a>";
		print "</li>";       
       	}
	print "</ul>";
	print "</div>";
	
	print "<div class='clanci'>";
	$rezultat=mysql_query("SELECT * from clanci where id_clanak = $c;");
	while($redak = mysql_fetch_array($rezultat))
	{
		print "<div class='naslov'>";
			print "<a href='index.php?cl=".$redak['id_clanak']."'>".$redak['naziv']."</a>";
		print "</div>";
		print "<div class='slika_tekst'>";
			print "<p>";
			print "<div class='slika'>";
				print "<img align='center' width='270px' height='190px' src='".$redak['multimedija2']."'/>";
			print "</div>";
			print $redak['opis'];
			print "</p>";
		print "</div>";
	}
	print "</div>";
}



elseif (!empty($a)) //samo glavni link  - prom2 u tablici clanak oznacava da li zelimo da se link istice u toj kategoriji
{
	print "<div class='podlinkovi'>";
	print "<ul>";
	$rezultat=mysql_query("SELECT * FROM podlinkovi where id_glavni = $a");
	while($redak = mysql_fetch_array($rezultat))
	{
		print "<li>";
			print "<a href='index.php?gl=".$redak['id_glavni']."&pl=".$redak['id_pod']."'>".$redak['naziv']."</a>";
		print "</li>";       
	}
	print "</ul>";
	print "</div>";
	
	print "<div class='clanci'>";
	$rezultat=mysql_query("
	SELECT glavnilinkovi.id_glavni, clanci.id_clanak, clanci.naziv, clanci.multimedija1,CONCAT(left(clanci.opis,300),'...') AS opis 
	FROM glavnilinkovi 
	INNER JOIN podlinkovi ON glavnilinkovi.id_glavni=podlinkovi.id_glavni
	INNER JOIN clanci ON podlinkovi.id_pod=clanci.id_pod 
	WHERE glavnilinkovi.id_glavni='$a' && prom2=1;");
	
	while($redak = mysql_fetch_array($rezultat))
	{
		print "<div>";
			print "<a href='index.php?gl=".$redak['id_glavni']."&cl=".$redak['id_clanak']."'>".$redak['naziv']."</a>";
		print "</div>";
		print "<div>";
			print "<p>";
			print "<img align='left' width='100px' height='80px' src='".$redak['multimedija1']."'/>";
			print $redak['opis'];
		print "</p>";
		print "</div>";
	}
	print "</div>";
}



elseif (!empty($c)) //stisnut clanak na pocetnoj, radi se o clanku od 1 glavnog linka
{
	print "<div class='podlinkovi'>";
	print "<ul>";
	$rezultat=mysql_query("SELECT * FROM podlinkovi where id_glavni = 1");
	while($redak = mysql_fetch_array($rezultat))
	{
		print "<li>";
			print "<a href='index.php?gl=" . $redak['id_glavni'] ."&pl=" . $redak['id_pod'] . "'>" .$redak['naziv'] . "</a>";
		print "</li>";       
	}
	print "</ul>";
	print "</div>";
	
	print "<div class='clanci'>";
	$rezultat=mysql_query("	SELECT * from clanci where id_clanak = $c;");
	while($redak = mysql_fetch_array($rezultat))
	{
		print "<div class='naslov'>";
			print "<a href='index.php?cl=".$redak['id_clanak']."'>".$redak['naziv']."</a>";
		print "</div>";
		print "<div class='slika_tekst'>";
				print "<p>";
				print "<div class='slika'>";
					print "<img align='center' width='270px' height='190px' src='".$redak['multimedija2']."'/>";
				print "</div>";
				print $redak['opis'];
				print "</p>";
		print "</div>";
	}
	print "</div>";
}




else //cisti index
{
	print "<div class='podlinkovi'>";
	print "<ul>";
	$rezultat=mysql_query("SELECT * FROM podlinkovi where id_glavni = 1");
	while($redak = mysql_fetch_array($rezultat))
	{
		print "<li>";
			print "<a href='index.php?gl=".$redak['id_glavni']."&pl=".$redak['id_pod']."'>".$redak['naziv']."</a>";
		print "</li>";       
	}
	print "</ul>";
	print "</div>";
	
	print "<div class='clanci'>";
	$rezultat=mysql_query("	
	SELECT glavnilinkovi.id_glavni,clanci.id_clanak,clanci.naziv,clanci.multimedija1,CONCAT(left(clanci.opis,300),'...') AS opis 
	FROM glavnilinkovi 
	INNER JOIN podlinkovi ON glavnilinkovi.id_glavni=podlinkovi.id_glavni
	INNER JOIN clanci ON podlinkovi.id_pod=clanci.id_pod WHERE prom1=1;");
	while($redak = mysql_fetch_array($rezultat))
	{
		print "<div>";
			print "<a href='index.php?cl=".$redak['id_clanak']."'>".$redak['naziv']."</a>";
		print "</div>";
		print "<div>";
			print "<p>";
			print "<img align='left' width='120px' height='80px' src='".$redak['multimedija1']."'/>";
			print $redak['opis'];
			print "</p>";
		print "</div>";
	}
	print "</div>";
}
?>



<div class='footer'></div> <!-- slika na dnu -->

</div>
</body>
</html>