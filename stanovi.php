<!DOCTYPE html>
<html>
<head>
	<title>Stanovi</title>
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

			$sql="SELECT stanovi.SifraS,m2,Struktura,Cena,SifraK,slike_stanova.putanja,zgrade.SifraZ,ulica,broj,naselje.naziv,agenti.Ime,Prezime,Email
				FROM slike_stanova
				INNER JOIN stanovi ON slike_stanova.SifraS=stanovi.SifraS
				INNER JOIN prodaja ON stanovi.SifraS=prodaja.SifraS
				INNER JOIN agenti ON prodaja.SifraA=agenti.SifraA
				INNER JOIN zgrade ON stanovi.SifraZ=zgrade.SifraZ
				INNER JOIN naselje ON zgrade.SifraN=naselje.SifraN
				WHERE stanovi.SifraK IS NULL";
				$rez=mysqli_query($konekcija,$sql);
				while ($red=mysqli_fetch_assoc($rez)) {
					$a1=$red['SifraS'];
					$a2=$red['m2'];
					$a3=$red['Struktura'];
					$a4=$red['Cena'];
					if($a5=$red['SifraK']==null){
						 $a5="Prodaje se";
					}
					else{
						$a5="Prodato";
					}
					$a6=$red['SifraZ'];
					if($a7=$red['putanja']==null){
						$a7="blank.png";
					}
					else{
					$a7=$red['putanja'];
					}
					$a8=$red['ulica'];
					$a9=$red['broj'];
					$a10=$red['naziv'];
					$a11=$red['Ime'];
					$a12=$red['Prezime'];
					$a13=$red['Email'];
					echo "<div class='prikaz'>
						<img src=$a7 class='slika'>
						Sifra stana: $a1<br>
						m2: $a2<br>
						Struktura: $a3<br>
						Stanje: $a5<br>
						Cena: $a4 &euro;<br>
						Sifra Zgrade: $a6<br>
						Ulica: $a8<br>
						Broj: $a9<br>
						Naselje: $a10<br>
						Agent: $a11 $a12  $a13
						";
						if ($a5=='Prodaje se') {	
					echo" 
						<form action='kupi.php' method='post'>
						<input type='text' name='sifraStana' value='$a1'>
						<button type='submit' name='kupovina'>Kupi</button>
						</form>";}
						echo "</div>";
						
					
				}
	}	
		else{
		if(isset($_COOKIE['zapamti'])){
			$kolac=explode('.', $_COOKIE['zapamti']);
			$_SESSION['SifraK']=$kolac[0];
			$_SESSION['username']=$kolac[1];
			header("Location: home.php");
		}else{
		echo "<div id='provera'><p>Morate biti ulogovani da bi pristupili sajtu!</p>";
		echo "<a href='reg.php'>Registruj se</a>";
		echo "<a href='login.php'>Prijavi se</a>";
		echo "</div>";
		}
	}
		mysqli_close($konekcija);
	?>
		<div class="footer">
			<p>Predrag Vučković IT66/17</p>
		</div>
</body>
</html>
