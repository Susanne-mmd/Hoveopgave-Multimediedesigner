<?php 

if (empty($_POST) === false) {

	// Tildel de postede data til variabler
	$email			= $_POST['EMAIL'];
	$kodeord		= $_POST['KODEORD'];
	$navn			= $_POST['NAVN'];
	$efternavn		= $_POST['EFTERNAVN'];
	$mobil			= $_POST['MOBIL'];
	$uddannelse		= $_POST['UDDANNELSE'];
	$status			= $_POST['STATUS'];
	$arbejdstlf		= $_POST['ARBEJDSTLF'];
	$adresse		= $_POST['ADRESSE'];
		
	// Start fejltjek.
	if (empty($errors) === true) {
		if (email_exists($email) === true) { // Tjekker om mail-adressen allerede er i databasen.
			$errors[] = "Emailen er desværre allerede i brug.";
		}
		if (preg_match("/\\s/", $email) == true) { // Hvis der er et mellemrum i brugernavnet (returnerer værdien 1).
			$errors[] = "Der må ikke indeholde mellemrum i brugernavnet.";
		}
		if (strlen($password > 6)) { // Check om det indtastede kodeord er længere  6
			$errors[] = "Dit kodeord skal være længere end 6 tegn.";
		}
	}
}

?>