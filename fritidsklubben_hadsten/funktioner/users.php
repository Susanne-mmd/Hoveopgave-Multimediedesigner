<?php

function change_password($email, $kodeord) {

	$id 	= (int)$id; 			// Definerer det som et helt tal.
	$kodeord 	= ($kodeord);	// Krypterer det password, som er posted.	

	mysql_query("UPDATE `fk_voksen` SET `KODEORD` = '$KODEORD' WHERE `EMAIL` = $email"); // Skift kodeordet i databasen.
}

function change_password_barn($nummer, $kodeord){

	$nummer 	= (int)$nnummer; 	// Definerer det som et helt tal.
	$kodeord 	=($kodeord);	// Krypterer det password, som er posted.	

	mysql_query("UPDATE `fk_barn` SET `KODEORD` = '$KODEORD' WHERE `NUMMER` = $nummer"); // Skift kodeordet i databasen.
}

function user_count() {

	$query = mysql_query("SELECT COUNT('EMAIL') FROM `fk_voksen`");	// Går ind i databasen og tæller, hvor mange "records" der er.
	return mysql_result($query, 0);									// Returnerer ovenstående værdi.
	
	$query = mysql_query("SELECT COUNT('NUMMER') FROM `fk_barn`");	// Går ind i databasen og tæller, hvor mange "records" der er.
	return mysql_result($query, 0);
}

function user_data_admin($id) {

	$data = array();			// Opret array til dataen.
	$id = (int)$id; 			// int = Man kan ikke lave en SQL injection.

	$func_num_args = func_num_args();	// Angiver hvor mange numre der er i et array.
	$func_get_args = func_get_args();	// Laver et array ud fra en liste.

	if ($func_num_args > 1) {
		unset($func_get_args[0]); // Fjerner første streng i arrayet.
	}

	$fields = "`" . implode('`, `', $func_get_args) . "`"; // Laver array-elementerne om til strenge.
	
	$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `fk_voksen` RIGHT JOIN `fk_adminitrator` WHERE fk_administrator.id = fk_voksen.id AND fk_administrator.id = '$id'")); // Henter alle data fra databasen.

	return $data;	// Returnerer det fundene data.
}

function user_data_for($id) {

	$data = array();			// Opret array til dataen.
	$id = (int)$id; 			// int = Man kan ikke lave en SQL injection.

	$func_num_args = func_num_args();	// Angiver hvor mange numre der er i et array.
	$func_get_args = func_get_args();	// Laver et array ud fra en liste.

	if ($func_num_args > 1) {
		unset($func_get_args[0]); // Fjerner første streng i arrayet.
	}

	$fields = "`" . implode('`, `', $func_get_args) . "`"; // Laver array-elementerne om til strenge.
	
	$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `fk_voksen` RIGHT JOIN `fk_foraelder` WHERE fk_voksen.id  = fk_foraeldre.id AND fk_voksen.id = '$id'")); // Henter alle data fra databasen.

	return $data;	// Returnerer det fundene data.
}

function user_data_barn($nummer) {

	$data = array();			// Opret array til dataen.
	$nummer = (int)$nummer; 	// int = Man kan ikke lave en SQL injection.

	$func_num_args = func_num_args();	// Angiver hvor mange numre der er i et array.
	$func_get_args = func_get_args();	// Laver et array ud fra en liste.

	if ($func_num_args > 1) {
		unset($func_get_args[0]); // Fjerner første streng i arrayet.
	}

	$fields = "`" . implode('`, `', $func_get_args) . "`"; // Laver array-elementerne om til strenge.
	
	$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `fk_barn` WHERE `NUMMER` = '$nummer'")); // Henter alle data fra databasen.

	return $data;	// Returnerer det fundene data.
}

function logged_in() {
	return (isset($_SESSION['ID'])) ? true : false;	// Tjek om brugeren er logget ind.
}

function logged_in_barn() {	
	return (isset($_SESSION['NUMMER'])) ? true : false;	// Tjek om brugeren er logget ind.
}

function email_exists($email) {

	$email = sanitize($email); // "Rens" dataen for sikkerhedsmæssige årsager.
// test om det er et nummer eller en email
   
    if (!strpos($email,"@")){
		$query = mysql_query("SELECT COUNT('NUMMER') FROM `fk_barn` WHERE `NUMMER` ='$email'"); // Tjekker i databasen om nummeret findes.
		return (mysql_result($query, 0) == 1) ? "barn" : "ukendt"; 	// Returner "true" hvis emailen findes. Ellers returner "false".
		
	} else {
		$query = mysql_query("SELECT COUNT('ID') FROM `fk_voksen` WHERE `EMAIL` ='$email'"); // Tjekker i databasen om emailen findes.
		if (!$query){
			die(mysql_error());	
			
		}
		return (mysql_result($query, 0) == 1) ? "voksen" : "ukendt"; 	// Returner "true" hvis emailen findes. Ellers returner "false".	
	}
	
}

function admin_test($email){
	$query = mysql_query("SELECT COUNT('ID') FROM `fk_voksen`, `fk_administrator` WHERE fk_administrator.ID = fk_voksen.ID AND `EMAIL` ='$email'"); // Tjekker i databasen om emailen findes.
		if (!$query){
			die(mysql_error());	
			
		}
		return (mysql_result($query, 0) == 1) ? "administrator" : "voksen"; //registrere om det er en administrator der er logget ind..
	}

function login($email, $kodeord) {

	$email = sanitize($email); 	// "Rens" e-mail.
	$kodeord =($kodeord);			// Krypter kodeordet så det stemmer med det i databasen.

	// Tjekker om brugernavnet og kodeord matcher.
	$query = mysql_query("SELECT COUNT(`EMAIL`) FROM `fk_voksen` WHERE `EMAIL` = '$email' AND `KODEORD` = '$kodeord'");

	return (mysql_result($query, 0) == 1) ? $email : false; // Returner $user_id hvis ovenstående passer
}

function login_nummer($nummer, $kodeord) {

	$nummer = sanitize($nummer); 	// "Rens" e-mail.
	$kodeord =($kodeord);			// Krypter kodeordet så det stemmer med det i databasen.

	// Tjekker om brugernavnet og kodeord matcher.
	$query = mysql_query("SELECT COUNT(`NUMMER`) FROM `fk_barn` WHERE `NUMMER` = '$nummer' AND `KODEORD` = '$kodeord'");

	return (mysql_result($query, 0) == 1) ? $nummmer : false; // Returner $user_id hvis ovenstående passer
}

function registrer_voksen($register_data) {

	array_walk($register_data, 'array_sanitize'); // Tag alle værdier som er posted og "rens" disse (sikkerhedsmæssigt).
	$register_data['KODEORD'] =($register_data['KODEORD']);
	
	$fields 		= "`" . implode('`, `', array_keys($register_data)) . "`"; // Tager værdierne i $register_data arrayet og laver til strenge
	$data  			= '\'' . implode('\', \'', $register_data) . '\''; // Smame som ovenstående, bare med ' i stedet for `.

	print_r($register_data);

	mysql_query("INSERT INTO `fk_voksen` ($fields) VALUES ($data)"); // Indsæt indtastede data til databasen.
	
}

function registrer_admin($register_data) {

	array_walk($register_data, 'array_sanitize'); // Tag alle værdier som er posted og "rens" disse (sikkerhedsmæssigt).
	
	$fields 		= "`" . implode('`, `', array_keys($register_data)) . "`"; // Tager værdierne i $register_data arrayet og laver til strenge
	$data  			= '\'' . implode('\', \'', $register_data) . '\''; // Smame som ovenstående, bare med ' i stedet for `.
	
	print_r($register_data);
	
	mysql_query("INSERT INTO `fk_administrator` ($fields) VALUES ($data)"); // Indsæt indtastede data til databasen.
	
}

function registrer_for($register_data) {

	array_walk($register_data, 'array_sanitize'); // Tag alle værdier som er posted og "rens" disse (sikkerhedsmæssigt).
	
	$fields 		= "`" . implode('`, `', array_keys($register_data)) . "`"; // Tager værdierne i $register_data arrayet og laver til strenge
	$data  			= '\'' . implode('\', \'', $register_data) . '\''; // Smame som ovenstående, bare med ' i stedet for `.

	mysql_query("INSERT INTO `fk_foraelder` ($fields) VALUES ($data)"); // Indsæt indtastede data til databasen.				
	}


function registrer_barn($register_data) {
	
	array_walk($register_data, 'array_sanitize'); // Tag alle værdier som er posted og "rens" disse (sikkerhedsmæssigt).
	$register_data['KODEORD'] =($register_data['KODEORD']);
	
	$fields 		= "`" . implode('`, `', array_keys($register_data)) . "`"; // Tager værdierne i $register_data arrayet og laver til strenge
	$data  			= '\'' . implode('\', \'', $register_data) . '\''; // Smame som ovenstående, bare med ' i stedet for `.

	mysql_query("INSERT INTO `fk_barn` ($fields) VALUES ($data)"); // Indsæt indtastede data til databasen.
	
}

function update_admin($update_data) {

	$update = array();
	array_walk($update_data, 'array_sanitize'); // Tag alle værdier som er posted og "rens" disse (sikkerhedsmæssigt).

	foreach($update_data as $field=>$data) {
		$update[] = "`" . $field . "` = \"" . $data . "\""; // Laver de postede værdier til array værdier.
	}

	mysql_query("UPDATE `fk_voksen` SET " . implode(', ', $update) . " RIGHT JOIN `fk_administrator` WHERE `ID` = " . $_SESSION['ID'] . "");// Indsæt indtastede data til databasen.
}
	
function update_for($update_data) {
	
	$update = array();
	array_walk($update_data, 'array_sanitize'); // Tag alle værdier som er posted og "rens" disse (sikkerhedsmæssigt).

	foreach($update_data as $field=>$data) {
		$update[] = "`" . $field . "` = \"" . $data . "\""; // Laver de postede værdier til array værdier.
	}

	mysql_query("UPDATE `fk_voksen` SET " . implode(', ', $update) . " RIGHT JOIN `fk_foraelder` WHERE `ID` = " . $_SESSION['ID'] . "");// Indsæt indtastede data til databasen.
}
	
function update_barn($update_data) {
	
	$update = array();
	array_walk($update_data, 'array_sanitize'); // Tag alle værdier som er posted og "rens" disse (sikkerhedsmæssigt).

	foreach($update_data as $field=>$data) {
		$update[] = "`" . $field . "` = \"" . $data . "\""; // Laver de postede værdier til array værdier.
	}

	mysql_query("UPDATE `fk_barn` SET " . implode(', ', $update) . " WHERE `NUMMER` = " . $_SESSION['NUMMER'] . "");// Indsæt indtastede data til databasen.
}

function check_voksen_profile($email) {

	$session_id 	= $_SESSION['ID'];	// Sætter en variabel til det user_id, som den loggede ind bruger har.

	// Vælg hvad data der skal tilknyttes $user_data arrayet.	
	$user_data 			= user_data($session_id, 'EMAIL');
	$email 			= $user_data['EMAIL'];

	return ($email === $_GET['EMAIL']) ? true : false;	// Checker om hvad der står efter profile.php?username=[] = brugernavnet. Svært at forklare.
	
}

function check_barn_profile($email) {
	
	$session_nummer 	= $_SESSION['NUMMER'];	// Sætter en variabel til det user_id, som den loggede ind bruger har.

	// Vælg hvad data der skal tilknyttes $user_data arrayet.	
	$user_data 			= user_data($session_admin_id, 'NUMMER');
	$nummer 			= $user_data['NUMMER'];

	return ($nummer === $_GET['NUMMER']) ? true : false;	// Checker om hvad der står efter profile.php?username=[] = brugernavnet. Svært at forklare.
}


function registrer_aktivitet($register_data){
	array_walk($register_data, 'array_sanitize'); // Tag alle værdier som er posted og "rens" disse (sikkerhedsmæssigt).
	
	$fields 		= "`" . implode('`, `', array_keys($register_data)) . "`"; // Tager værdierne i $registrer aktivitet arrayet og laver til strenge
	$data  			= '\'' . implode('\', \'', $register_data) . '\''; // Smame som ovenstående, bare med ' i stedet for `.

	mysql_query("INSERT INTO `fk_events` ($fields) VALUES ($data)");
	}
	
function registrer_nyhedsbrev($register_data){
	array_walk($register_data, 'array_sanitize'); // Tag alle værdier som er posted og "rens" disse (sikkerhedsmæssigt).
	
	$fields 		= "`" . implode('`, `', array_keys($register_data)) . "`"; // Tager værdierne i $registrer aktivitet arrayet og laver til strenge
	$data  			= '\'' . implode('\', \'', $register_data) . '\''; // Smame som ovenstående, bare med ' i stedet for `.

	mysql_query("INSERT INTO `fk_nyhedsbrev` ($fields) VALUES ($data)");
	}
	
function tilmeld_barn($register_data){
	array_walk($register_data, 'array_sanitize'); // Tag alle værdier som er posted og "rens" disse (sikkerhedsmæssigt).
	
	$fields 		= "`" . implode('`, `', array_keys($register_data)) . "`"; // Tager værdierne i $registrer aktivitet arrayet og laver til strenge
	$data  			= '\'' . implode('\', \'', $register_data) . '\''; // Smame som ovenstående, bare med ' i stedet for `.

	mysql_query("INSERT INTO `fk_tilmeld` ($fields) VALUES ($data)");
	}

?>