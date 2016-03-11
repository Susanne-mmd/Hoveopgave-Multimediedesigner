<?php
session_start(); 	// Start en session f.eks. hvis brugeren er logget ind.
ob_start();			// Funktion som bruges til at fjerne alle de header locations, som er sendt i forvejen.
error_reporting(0);

include('../database/connect.php');
include('users.php');
include('general.php');

$current_file = explode('/', $_SERVER['SCRIPT_NAME']);	// Gør alle elementer i arrayet til strenge og sæt et "/" mellem disse (link).
$current_file = end($current_file);						// Vælger sidste element i $current_file.

if (logged_in() === true) {						// Hvis man er logget ind.
	$session_email 	= $_SESSION['EMAIL']; // Tilknytter det user_id som man er logget ind med til variablen.
	$session_nummer = $_SESSION['NUMMER'];

	// Vælg hvad data der sker tilknyttes $user_data arrayet.	
	$user_data_admin = user_data_admin($session_administrator, 'ID', 'NAVN', 'EFTERNAVN', 'EMAIL', 'MOBIL', 'KODEORD', 'ARBEJDSTLF', 'ADRESSE');
	
	$user_data_for = user_data_for($session_foraelder, 'ID', 'NAVN', 'EFTERNAVN', 'EMAIL', 'MOBIL', 'KODEORD', 'STATUS', 'UDDANNELSE', 'PROFILBILLED');
	
	$user_data_barn = user_data_barn($session_nummer, 'NAVN', 'NUMMER', 'EFTERNAVN', 'E-MAIL', 'ADRESSE', 'LAEGE_ADERSSE', 'LAEGE_TLF', 'MOBIL', 'KLASSE', 'KODEORD', 'OEVRIGE_BEMAERKNINGER', 'OEVRIGE_KONTAKTPERSONER');
}

$errors = array(); 		// Laver et array som kan indeholde fejlmeddelelserne. Vi bruger et array, da vi nemmere kan udskrive
						// flere fejlmeddelseser efter hinanden.
?>