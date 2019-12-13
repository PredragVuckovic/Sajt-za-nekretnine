<!DOCTYPE html>
<html>
<head>
	<title>Uplodovanje slike</title>
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

	if (isset($_GET['SifraS'])) {
	$SifraS=$_GET['SifraS'];
	}
	elseif(isset($_POST['SifraS'])) {
	$SifraS=$_POST['SifraS'];
	}
 echo "<h1>Ubaci sliku</h1>";	
 echo "<form action='upload.php' method='POST' enctype='multipart/form-data' id='uploadslike'>
<input type='file' name='slika'>
<input type='hidden' name='SifraS' value='$SifraS'>
<button type='submit' name='upload'>Pošalji</button>
</form>";





if(isset($_POST['upload'])){
$slika = $_FILES['slika'];
$ext=strtolower(pathinfo($slika['name'],PATHINFO_EXTENSION));
						if ($ext=='jpg' || $ext=='jpeg' || $ext=='png') {
							$imeslike=basename($slika['name']);
							$putanja='Uploads/'.$imeslike;
							$provera=getimagesize($slika['tmp_name']);
							if (!$provera==false) {
								if (!file_exists($putanja)) {
									if ($slika['size'] < 5000000) {
										if ($slika['error']===0) {
											move_uploaded_file($_FILES['slika']['tmp_name'], $putanja);
											$sql="INSERT INTO slike_stanova (putanja,SifraS) VALUES('$putanja','$SifraS')";
											mysqli_query($konekcija,$sql);
											header("Location: stanovi.php");
										}
										else{
											echo "<script>alert('Doslo je do greske')</script>";
										}
									}
									else{
										echo "<script>alert('Slika je prevelika')</script>";
									}
								}
								else{
									echo "<script>alert('Slika vec postoji')</script>";
								}
							}
							else{
								echo "<script>alert('Fajl nije slika')</script>";
							}
						}
						else{
							echo "<script>alert('Loš format slike')</script>";
						}
					}
				}	
echo 
"</body>
</html>";