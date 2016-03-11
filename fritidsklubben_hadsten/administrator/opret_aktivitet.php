<?php
	include("../funktioner/init.php");

$title = "Opret aktivitet";				// Titlen på siden.

if (empty($_POST) === false) {

	// Tildel de postede data til variabler
	$dato			= $_POST['dato'];
	$navn			= $_POST['aktivitet'];
	$text			= $_POST['beskrivelse'];
}
?>

<?php

if (isset($_GET['success']) && empty($_GET['success'])) { 		// Hvis aktiviteten er oprettet korrekt, da skriv:
	echo "Aktiviteten er blevet oprettet.";						// Udskriv at aktiviteten er oprettet.

} else {

	if (empty($_POST) === false and empty($errors) === true) { 	// Tjek om formen er blevet postet og om der er nogle fejl.
		
		$register_data = array( 								// Opretter et array til senere indsættelse af data i databasen og tilføjer navne til varibler.
				'DATO' 		=> $dato,	
				'NAVN' 		=> $navn,
				'TEXT'		=> $text,
			);

		registrer_aktivitet($register_data);					// Udfører registrer_aktivitet funktionen med værdierne fra det ovenstående array.
		header('Location: opret_aktivitet.php?success');		// Viderestillet brugeren til opret_aktivitet.php?success, hvor der vises en meddelelse

	} else if(empty($errors) === false) {						// Hvis $errors arrayet ikke er tomt..
		echo output_errors($errors);							// Udskriv fejl med out_errors funktionen
}
}

?>


<?php
	include("header_admin.php");
?>

<div class="form">

<p>Opret Aktivitet</p>

<form action="" method="post">
	<ul>
		<li>
        	Dato: <br>
			<input type="date" name="dato" required autocomplete="off">
		</li>
		<li>
			Aktivitet: <br>
			<textarea name="aktivitet" cols="75" rows="1"></textarea>
		</li>
		<li>
			Kort beskrivelse: <br>
			<textarea name="beskrivelse" cols="75" rows="15"></textarea>
		</li>
		<li>
			<input type="submit" value="OK!">
		</li>
	</ul>
</form>

</div>


<?php
	include("../root_folder/footer.php");
?>