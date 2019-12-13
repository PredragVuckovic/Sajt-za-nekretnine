<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>
	<?php
		session_start();

	?>
	<?php 
		//error_reporting( E_ALL & ~E_NOTICE ^ E_DEPRECATED );
	?>


	<?php
			if (isset($_SESSION['username'])) {
			$server="localhost";
			$sqlusername="root";
			$sifra="";
			$imeBaze="nekretnine";
			$username=$_SESSION['username'];
			$konekcija=mysqli_connect($server,$sqlusername,$sifra,$imeBaze);
			
			if (!$konekcija) {
				die("Konekcija nije uspela!".mysqli_connect_error());
			}

		echo '<div class="navbar"><form action="logout.php" metod="POST"><button type="submit" id="odjava">Odjavi se</button></form><p>'.$username.'</p><div class="nav">
			<ul id="meni">
		<li><a href="home.php">Pocetna</a></li>
		<li><a href="agenti.php">Agenti</a></li>
		<li><a href="stanovi.php">Stanovi</a></li>
		<li><a href="korisnici.php">Korisnici</a></li>
		</ul>
		</div>
		</div>';

		$sql="SELECT stanovi.SifraS,m2,struktura,cena,agenti.Ime,Prezime,Email,zgrade.ulica,broj,naselje.naziv
		FROM prodaja
		INNER JOIN stanovi ON prodaja.SifraS= stanovi.SifraS 
		INNER JOIN agenti ON prodaja.SifraA= agenti.SifraA
		INNER JOIN zgrade ON stanovi.SifraZ= zgrade.SifraZ
		INNER JOIN naselje ON zgrade.SifraN= naselje.SifraN
		LIMIT 3";
		echo "<br>";
		$rez=mysqli_query($konekcija, $sql);
		while ( $red=mysqli_fetch_assoc($rez)) {
			$a1=$red['SifraS'];
			$a2=$red['m2'];
			$a3=$red['struktura'];
			$a4=$red['cena'];
			$a5=$red['Ime'];
			$a6=$red['Prezime'];
			$a7=$red['Email'];
			$a8=$red['ulica'];
			$a9=$red['broj'];
			$a10=$red['naziv'];
			echo "Novi stan u ponudi:
			<div class='kontenjer'>
			<p>Stan:</p>
			<p>Sifra: $a1</p>
			<p>m2: $a2</p>
			<p>Struktura: $a3</p>
			<p>Cena: $a4 &euro;</p>
			<p>Agent:</p>
			<p>$a5</p>
			<p>$a6</p>
			<p>$a7</p>
			<p>Adresa:</p>
			<p>$a8</p>
			<p>$a9</p>
			<p>$a10</p>
			<a href='stanovi.php'>Više informacija...</a>
			</div>";
		}
		mysqli_close($konekcija);
		echo "<div id='svojstan'><a href='novstan.php' >Ubacite svoj stan</a></div>";
		echo "<div class='footer'>
			<p>Predrag Vučković IT66/17</p>
		</div>";
	}
	elseif(isset($_COOKIE['zapamti'])){
			$kolac=explode('.', $_COOKIE['zapamti']);
			$_SESSION['SifraK']=$kolac[0];
			$_SESSION['username']=$kolac[1];
			header("Location: home.php");
		}
	else{
		echo "<div id='provera'><p>Morate biti ulogovani da bi pristupili sajtu!</p>";
		echo "<a href='reg.php'>Registruj se</a>";
		echo "<a href='login.php'>Prijavi se</a>";
		echo "</div>";
		}
	
		
	?>
	
</body>
</html>