<?php
		session_start();

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
		}
		?>


<!DOCTYPE html>
<html>
<head>
<title>Novi Stan</title>
<link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
</head>
	<body>
		<h1>Ubaci Stan</h1>
			<form class="novstan" method="post" action="novstan.php">
				Zgrade:
					<select name="zgrade">
						<?php
					$sql="SELECT * FROM zgrade";
					$rez=mysqli_query($konekcija,$sql);
					while ($red=mysqli_fetch_assoc($rez)) {
					  $adresa=$red['Ulica'].".".$red['Broj'];
					  echo "<option value='".$red['Ulica'].".".$red['Broj']."'>".$adresa."</option>";
					  }  
					?>
					</select>
				Struktura:
				<select name="struktura">
						<option value="Garsonjera">Garsonjera</option>
						<option value="Jednosoban">Jednosoban</option>
						<option value="Jednoiposban">Jednoiposban</option>
						<option value="Dvosoban">Dvosoban</option>
						<option value="Dvoiposoban">Dvoiposoban</option>
						<option value="Trosoban">Trosoban</option>
						<option value="Troiposoban">Troiposoban</option>
				</select>
				<input type="text" name="m2" placeholder="Kvadratura">
				<input type="text" name="cena" placeholder="Cena">
				<select name="agenti[]" multiple>
					<?php
					$sql="SELECT * FROM agenti";
					$rez=mysqli_query($konekcija,$sql);
					while ($red=mysqli_fetch_assoc($rez)) {
					  $imeAgenta=$red['Ime']." ".$red['Prezime'];
					  echo "<option value='".$red['Ime'].".".$red['Prezime']."'>".$imeAgenta."</option>";
					  }  
					?>
				</select>
					<button type="submit" name="ubaceno">Pošalji</button>
			</form>
			<?php

				if (isset($_POST['ubaceno'])) {
					$adresa=explode('.',$_POST['zgrade']);
					$kvadratura=$_POST['m2'];
					$struktura=$_POST['struktura'];
					$cena=$_POST['cena'];
					$i=0;
					$agenti=[];
					foreach ($_POST['agenti'] as $agent) {
						$agenti[$i]=explode('.' ,$agent);
						$i++;
					}
					if ( empty($kvadratura) || empty($cena) ) {
						echo "<script>alert('Popunite sva polja')</script>";
						exit();
					}
					else{
						$ulica=$adresa[0];
						$broj=$adresa[1];
						$sql="SELECT SifraZ FROM zgrade WHERE Ulica=? AND Broj=?";
						$stmt = mysqli_stmt_init($konekcija);
			
						if(!mysqli_stmt_prepare($stmt,$sql)){
							echo "<script>alert('Greska u bazi podataka');</script>";
						}
						else{
							mysqli_stmt_bind_param($stmt, "si",$ulica,$broj);
							mysqli_stmt_execute($stmt);
			
							$rez=mysqli_stmt_get_result($stmt);
							if ($red= mysqli_fetch_assoc($rez)) {
								$SifraZ=$red['SifraZ'];
								$sql="INSERT INTO stanovi(m2,Struktura,Cena,SifraZ) VALUES (?,?,?,?)";
								$stmt = mysqli_stmt_init($konekcija);
								if(!mysqli_stmt_prepare($stmt,$sql)){
									echo "<script>alert('Greska u bazi podataka');</script>";
								}
								else{
										mysqli_stmt_bind_param($stmt, "isii",$kvadratura,$struktura,$cena,$SifraZ);
										mysqli_stmt_execute($stmt);
										$brojAgenata=count($agenti);
										$sifreAgenata=[];
										for($i=0;$i<$brojAgenata;$i++){
											$imeA=$agenti[$i][0];
											$prezA=$agenti[$i][1];
											$sql="SELECT SifraA FROM agenti WHERE Ime='$imeA' AND Prezime='$prezA'";
											$rez=mysqli_query($konekcija,$sql);
											$red=mysqli_fetch_assoc($rez);
											$sifreAgenata[$i]=$red['SifraA'];
										}
											$sql="SELECT SifraS FROM stanovi WHERE m2='$kvadratura' AND Struktura='$struktura' AND Cena='$cena' AND SifraZ='$SifraZ'";
											$rez=mysqli_query($konekcija,$sql);
											$red=mysqli_fetch_assoc($rez);
											$SifraS=$red['SifraS'];
											$datum=date('Y-m-d H:i:s', time());
											for($i=0;$i<$brojAgenata;$i++){
												$sifraA=$sifreAgenata[$i];
												$sql="INSERT INTO prodaja (SifraS,SifraA,datum) VALUES('$SifraS','$sifraA','$datum')";
												mysqli_query($konekcija,$sql);
												
											header("Location: upload.php?SifraS=$SifraS");
											}
										}
										
							}

						}
					}
					
			
		
			}
			?>

		</body>
</html>