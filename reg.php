<!DOCTYPE html>
<html>
<head>
	<title>Registruj se</title>
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>
	<br> 
		<center>
			<div class="forma">
				<img src="Images/reg.png" id="reg">
			<form action='reg.php' method="post">
				<input type="text" name="username" placeholder="Username"><br>
				<input type="email" name="mail" placeholder="E-mail"><br>
				<input type="password" name="pass" placeholder="Šifra"><br>
				<input type="password" name="pass2" placeholder="Ponovite šifru"><br>
				<button type="submit" name="prijava" id="go">Registruj se</button>
				<button type="reset" id="reset">Odustani</button><br>
				<a href="login.php">Log in</a>
			</div>
		</center>
	

		<?php 
		//	error_reporting( E_ALL & ~E_NOTICE ^ E_DEPRECATED );
		?>
		<?php
		
			if(isset($_POST["prijava"])){
			$server="localhost";
			$sqlusername="root";
			$sifra="";
			$imeBaze="nekretnine";

			$konekcija=mysqli_connect($server,$sqlusername,$sifra,$imeBaze);
			if (!$konekcija) {
				die("Konekcija nije uspela!".mysqli_connect_error());
			}
			else{
			$username=$_POST['username'];
			$mail=$_POST['mail'];
			$pass=$_POST['pass'];
			$pass2=$_POST['pass2'];

			if (empty($username) || empty($mail) || empty($pass) || empty($pass2)) {
				echo "<script>alert('Popunite sva polja')</script>";
				exit();
			}
			else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
				echo "<script>alert(E-mail nije dobar)</script>";
				exit();
			}
			else if (!preg_match("/^[a-zA-Z0-9]*$/",$username)){
				echo "<script>alert('Ukucajte ponovo username')</script>";
				exit();
			}
		    else if(strlen($pass)<8){
		    	echo "<script>alert('Šifra mora imati vise od 8 karaktera')</script>";
		    }
			else if (!$pass == $pass2) {
				echo "<script>alert('Šifre nisu iste, molimo pokusajte ponovo')</script>";
				exit();
			}
			
			 	$sql="SELECT SifraK FROM korisnik WHERE username=? OR mail=?";
			 	
				$stmt = mysqli_stmt_init($konekcija);
			
				if(!mysqli_stmt_prepare($stmt,$sql)){
					echo "<script>alert('Greska u bazi podataka');</script>";
				}
				else{
				mysqli_stmt_bind_param($stmt, "ss",$username,$mail);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$provera= mysqli_stmt_num_rows($stmt);
				if ($provera > 0) {
				 	echo "<script>alert('Greska! Korisnik vec postoji')</script>";
				exit();
				}
				else{
					$sql = "INSERT INTO korisnik(username, mail, pass) VALUES (?, ?, ?)";

				$stmt = mysqli_stmt_init($konekcija);
			
					if(!mysqli_stmt_prepare($stmt,$sql)){
						echo "<script>alert('Greska u bazi podataka');</script>";
					}
					else{
						$hpass=password_hash($pass, PASSWORD_DEFAULT); 
						mysqli_stmt_bind_param($stmt, "sss",$username,$mail,$hpass);
						mysqli_stmt_execute($stmt);
	
						}

				mysqli_close($konekcija);
			}
		}
	}
}


		?>
		
</body>
</html>