<?php 

if (empty($_POST) === false) {

	// Tildel de postede data til variabler
	$email						= $_POST['EMAIL'];
	$kodeord					= $_POST['KODEORD'];
	$navn						= $_POST['NAVN'];
	$efternavn					= $_POST['EFTERNAVN'];
	$mobil						= $_POST['MOBIL'];
	$nummer						= $_POST['NUMMER'];
	$klasse						= $_POST['KLASSE'];
	$fotograferes				= $_POST['FOTOGRAFERES'];
	$adresse					= $_POST['ADRESSE'];
	$laege_adresse				= $_POST['LAEGE_ADRESSE'];
	$laege_tfl					= $_POST['LAEGE_TLF'];
	$oevrige_bemaerkninger		= $_POST['OEVRIGE_BEMAERKNINGER'];
	$oevrige_kontaktpersoner	= $_POST['OEVRIGE_KONTAKTPERSONER'];
		
	// Start fejltjek.
	if (empty($errors) === true) {
		if (email_exists($email) === true) { // Tjekker om mail-adressen allerede er i databasen.
			$errors[] = "Emailen er desværre allerede i brug.";
		}
		if (preg_match("/\\s/", $email) == true) { // Hvis der er et mellemrum i brugernavnet (returnerer værdien 1).
			$errors[] = "Der må ikke indeholde mellemrum i brugernavnet.";
		}
		if (strlen($password > 6)) { // Check om det indtastede kodeord er længere  6
			$errors[] = "Dit kodeord skal være længere end 6 bogstaver.";
		}
	}
}

?>