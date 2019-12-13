<!DOCTYPE html>
<html>
<head>
	<title>Agenti</title>
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
			echo "<p class='pretabele'>Lista naših zaposlenih:</p>";
			if(isset($_POST['pretrazi'])){
				if($_POST['pretrazivac']==''){
			echo "<table border=1px class='tabela'>
				<th>Sifra Agenta</th> 
				<th>Ime</th>
				<th>Prezime</th>
				<th>Email</th>";
			$sql="SELECT * FROM agenti";
			$rez=mysqli_query($konekcija, $sql);
			while ( $red=mysqli_fetch_assoc($rez) ) {
				
				$a1=$red['SifraA'];
				$a2=$red['Ime'];
				$a3=$red['Prezime'];
				$a4=$red['Email'];
				
				echo "<tr>
				 <td>$a1</td>
				 <td>$a2</td>
				 <td>$a3</td>
				 <td>$a4</td>
				 </tr>";
				
			}
			echo "</table>";
			}
				else{
				 $pretrazivac=$_POST['pretrazivac'];
				 $sql2="SELECT * FROM agenti WHERE Ime LIKE '%{$pretrazivac}%' OR Prezime LIKE '%{$pretrazivac}%'";
				 $rez2=mysqli_query($konekcija,$sql2);
				 if (mysqli_num_rows($rez2)>0) {
				 while ($red2=mysqli_fetch_assoc($rez2)) {
				  echo "<table border=1px class='tabela'>
				<th>Sifra Agenta</th> 
				<th>Ime</th>
				<th>Prezime</th>
				<th>Email</th>
				 <tr><td>".$red2['SifraA']."</td><td>".$red2['Ime']."</td><td>".$red2['Prezime']."</td><td>".$red2['Email']."</td></tr>";
				  }
				  echo "</table>"; 
				}
			}
			}
			
			else{
			echo "<table border=1px class='tabela'>
				<th>Sifra Agenta</th> 
				<th>Ime</th>
				<th>Prezime</th>
				<th>Email</th>";
			$sql="SELECT * FROM agenti";
			$rez=mysqli_query($konekcija, $sql);
			while ( $red=mysqli_fetch_assoc($rez) ) {
				
				$a1=$red['SifraA'];
				$a2=$red['Ime'];
				$a3=$red['Prezime'];
				$a4=$red['Email'];
				
				echo "<tr>
				 <td>$a1</td>
				 <td>$a2</td>
				 <td>$a3</td>
				 <td>$a4</td>
				 </tr>";
				
			}
			echo "</table>";
		}
			echo "<form id='pretrazivac' action='agenti.php' method='post'>
					<input type='text' name='pretrazivac' placeholder='Pretraži agenta'>
						<button type='submit' name='pretrazi'>Pretražiti</button>
				  </form>";
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