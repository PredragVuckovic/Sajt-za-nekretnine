<?php
		session_start();

	
		if(isset($_POST['obrisi'])){
			$server="localhost";
			$sqlusername="root";
			$sifra="";
			$imeBaze="nekretnine";
			$username=$_SESSION['username'];
			$konekcija=mysqli_connect($server,$sqlusername,$sifra,$imeBaze);
			
			if (!$konekcija) {
				die("Konekcija nije uspela!".mysqli_connect_error());
			}
			$SifraK=$_POST['SifraK'];
			$sql="DELETE FROM korisnik WHERE SifraK='$SifraK'";
			mysqli_query($konekcija,$sql);
			session_start();
			session_unset();
			session_destroy();
			header("Location:login.php");
			mysqli_close($konekcija);
		}
		else{
			header("Location: korisnici.php");
		}
	?>

