<?php include('funktioner/init.php'); // Inkluder vores init.php som inkluderer alle andre nødvendige filer.

$title = "Skift kodeord";		// Titlen på siden.
protect_page();					// Beskyt siden fra folk som ikke er logget ind.

if (empty($_POST) === false) {	// Hvis der er udfyldt noget i vores form.
	
	if (trim(md5($_POST['current_password'])) === trim($user_data['KODEORD'])) { 	// Hvis det indtastede kodeord stemmer med det i databasen.
																					// Trim = fjerner mellemrum til højre og venstre + diverse tegn.
		if ($_POST['KODEORD'] !== $_POST['GENTAG_KODEORD']) { 						// Hvis de to indtastede kodeord ikke stemmer overens.
			$errors[] = "De to nye indtastede kodeord stemmer ikke overens.";		// Tilføj fejl til vores $error array.

		} else if (strlen($_POST['KODEORD']) < 6) {								// .. eller hvis kodeordet er under 6 bogstaver.
			$errors[] = "Dit nye kodeord skal være mindst 6 bogstaver.";			// Tilføj fejl til vores $error array.
		}
	} else {																		// ellers..
		$errors[] = "Det indtastede nuværende kodeord er forkert";					// Tilføj fejl til vores $error array.

	}
}

include('header.php'); // Inkluder vores header.php til front-end.
?>

<div class="content">

<h1>Skift kodeord</h1>

	<?php

	if (isset($_GET['success']) && empty($_GET['success'])) { // Hvis brugeren har lykkedes at ændre kodeordet.
		echo "Dit kodeord er blevet ændret.";
		// exit(); (Kan ikke huske, hvorfor jeg har indsat dette?)
	} else {
		if (empty($_POST) === false and empty($errors) === true) { 	// Tjek om formen er blevet postet og om der er nogle fejl.
			change_password($session_nummer, $session_email, $_POST['KODEORD']);	// Vi kalder change_password() funktionen. Her bruger vi brugerens user_id til
																	// at definere, hvor vi skal ændre kodeordet.
			header('Location: skift_kodeord.php?success');			// Videresender..
			exit();													// Dræber scriptet, hvis videresendelsen mislykkedes.

		} else if (empty($errors) === false) {	// .. ellers hvis der er data i vores $errors array = fejl i processen
			echo output_errors($errors); 		// Vi kalder output_errors og Udskriver fejl med parametren $errors.
		}
	?>

	<!-- Formen som vi indsætter vores kodeord i -->
	<form action="" method="post">
		<ul class="register">
			<li>
				Nuværende kodeord: <br>
				<input type="password" name="current_password" autocomplete="off" required>
			</li>
			<li>
				Nyt kodeord: <br>
				<input type="password" name="password" autocomplete="off" required>
			</li>
			<li>
				Gentag nye kodeord: <br>
				<input type="password" name="password_again" autocomplete="off" required>
			</li>
			<li>
				<input type="submit" value="Skift kodeord">
			</li>
		</ul>
	</form>

	<?php }	// Slutter vores if.
?>

</div>

<?php include('footer.php'); ?>