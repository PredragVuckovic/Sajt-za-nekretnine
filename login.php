<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>
		<?php 
			//error_reporting( E_ALL & ~E_NOTICE ^ E_DEPRECATED );
		?>

		<center>
			<div class="forma">
			<img src="Images/login.png" id="userslika">
			<form  method="POST" action="login.php">
				<input type="text" name="username" placeholder="Username"><br>
				<input type="password" name="pass" placeholder="Šifra"><br>
				<input type="checkbox" name="kolac" id='label'>
				<label for='label'>Zapamti me</label>
				<button type="submit" name="login" id="go">Prijavi se</button>
				<button type="reset" id="reset">Odustani</button><br>
				<a href="reg.php">Registruj se</a>
			</form> 
			</div>
		</center>
		<?php
			if (isset($_POST["login"])) {
			$server="localhost";
			$sqlusername="root";
			$sifra="";
			$imeBaze="nekretnine";

			$konekcija=mysqli_connect($server,$sqlusername,$sifra,$imeBaze);
			
			if (!$konekcija) {
				die("Konekcija nije uspela!".mysqli_connect_error());
			}
			else{
				$sql="SELECT * FROM korisnik WHERE username=? OR mail=?";
				$username=$_POST["username"];
				$pass=$_POST["pass"];
				$stmt = mysqli_stmt_init($konekcija);
			
				if(!mysqli_stmt_prepare($stmt,$sql)){
					echo "<script>alert('Greska u bazi podataka');</script>";
				}
				else{
				mysqli_stmt_bind_param($stmt, "ss",$username,$username);
				mysqli_stmt_execute($stmt);
			
			$rez=mysqli_stmt_get_result($stmt);
			if ($red= mysqli_fetch_assoc($rez)) {
				$proverapass=password_verify($pass, $red['pass']);
				if ($proverapass==false) {
					echo "<script>alert('Uneli ste pogresnu sifru!');</script>'";
				}
				else if ($proverapass)  {
					session_start();
					$_SESSION['username']=$red['username'];
					$_SESSION['SifraK']=$red['SifraK'];
					if (isset($_POST['kolac'])) {
					$sifraK=$red["SifraK"];
					setcookie('zapamti',$sifraK.".".$username,time()+60*60*24*30,'/');
				}
					header("Location: home.php");
				}
				else{
					echo "<script>alert('Uneli ste pogresnu sifru!')</script>'";
					}
			}
		
			else{
				echo "<script>alert('Korisnik ne postoji')</script>";
			}
		}
	}
}


			?>
          
</body>
</html>