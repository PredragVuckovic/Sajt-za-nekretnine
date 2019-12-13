<!DOCTYPE html>
<html>
<head>
	<title>Korisnici</title>
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

			echo "<table border=1px class='tabela'>
				<th>Sifra Korisnika</th> 
				<th>Username</th>
				<th>Email</th>
				<th></th>";
			$sql="SELECT * FROM korisnik";
			$rez=mysqli_query($konekcija, $sql);
			while ( $red=mysqli_fetch_assoc($rez) ) {
				
				$a1=$red['SifraK'];
				$a2=$red['username'];
				$a4=$red['mail'];
				
				echo "<tr>
				 <td>$a1</td>
				 <td>$a2</td>
				 <td>$a4</td>
				 <td><form action='obrisi.php' method='post'>
						<input type='hidden' name='SifraK' value='$a1'>
						<button type='submit' name='obrisi'>Obriši</button>
						</form></td>
				 </tr>";
				
			}
			echo "</table>";



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
		</div>s
</body>
</html>