
	<?php
		session_start();

	
		if(isset($_POST['kupovina'])){
			$server="localhost";
			$sqlusername="root";
			$sifra="";
			$imeBaze="nekretnine";
			$username=$_SESSION['username'];
			$konekcija=mysqli_connect($server,$sqlusername,$sifra,$imeBaze);
			
			if (!$konekcija) {
				die("Konekcija nije uspela!".mysqli_connect_error());
			}
			$sifraStana=$_POST['sifraStana'];
			$SifraK=$_SESSION['SifraK'];
			$sql="UPDATE stanovi SET SifraK='$SifraK' WHERE SifraS='$sifraStana'";
			mysqli_query($konekcija,$sql);
			header("Location: stanovi.php");
			mysqli_close($konekcija);

		}
		else{
			header("Location: stanovi.php");
		}
	?>


