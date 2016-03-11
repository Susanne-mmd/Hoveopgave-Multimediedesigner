<?php

// Funktion som udfører, at hvis man er logget ind, og gerne vil til en side, som f.eks. register.php, da man ikke skal se denne side,
// hvis man er logget ind, da videresend brugeren tilbage til forsiden. Hvis ikke videresendelse lykkedes, da dræb scriptet.
function logged_in_redirect() {
	if (logged_in() === true) {
		header('Location: index.php');
		exit();
	}
}

// Funktion som sender brugeren videre til protected.php, hvis de går ind på en side, som de ikke skal have adgang til, medmindre de
// er logget ind.
function protect_page() {
	if (logged_in() === false) {
		header('Location: protected.php');
		exit();
	}
}

// Funktion som man indsatte data i, som returnerer rensen data pga. injection og "hærværk".
function sanitize($data) { // "Rens" dataen (kan bruges senere)
	return mysql_real_escape_string($data); // Fjerner specialbogstaver
}

function array_sanitize(&$item) {
	$item = mysql_real_escape_string($item);
}

// Funktion som udskriver alle fejlmeddelelser, hvis der er nogle i $errors arrayet. Dette gøres i form at af liste, hvor array'et bliver
// kørt gennem af foreach() funktionen og bliver udskrevet en for en.
function output_errors($errors) {

	echo "<ul>";

	foreach($errors as $error) { // Udskriver alle fejl i en liste.
		echo "<li>- " . $error . "</li>";
		echo "<br>";
	}

	echo "</ul>";
}

?>