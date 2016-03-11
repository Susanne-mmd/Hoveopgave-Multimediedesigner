<?php
	include("../funktioner/init.php");

$title = "Opret nyhedsbrev";				// Titlen på siden.

if (empty($_POST) === false) {

	// Tildel de postede data til variabler
	$dato			= $_POST['dato'];
	$text			= $_POST['beskrivelse'];
	$maaned			= $_POST['maaned'];
}
?>

<?php

if (isset($_GET['success']) && empty($_GET['success'])) { 					// Hvis aktiviteten er oprettet korrekt, da skriv:
	echo "Brevet er blevet oprettet.";									// Udskriv at aktiviteten er oprettet.

} else {

	if (empty($_POST) === false and empty($errors) === true) { 	// Tjek om formen er blevet postet og om der er nogle fejl.
		
		$register_data = array( 							// Opretter et array til senere indsættelse af data i databasen og tilføjer navne til varibler.
				'DATO' 		=> $dato,	
				'TEXT'		=> $text,
				'MAANED'	=> $maaned
			);

		registrer_nyhedsbrev($register_data);				// Udfører registrer_aktivitet funktionen med værdierne fra det ovenstående array.
		header('Location: opret_nyhed.php?success');		// Viderestillet brugeren til opret_aktivitet.php?success, hvor der vises en meddelelse

	} else if(empty($errors) === false) {						// Hvis $errors arrayet ikke er tomt..
		echo output_errors($errors);							// Udskriv fejl med out_errors funktionen
}
}

?>


<?php
	include("header_admin.php");
?>

<div class="form">
    <p>Opret Nyhedsbrev</p>
    
    <form action="" method="post">
        <ul>
            <li>
                Slut dato på nyhedsbrevet <br>
                <input type="date" name="dato" required autocomplete="off">
            </li>
            <li>
                Måned/År: <br>
                <textarea name="maaned" cols="75" rows="1"></textarea>
            </li>
            <li>
                Nyhedsbeskrivelse: <br>
                <textarea name="beskrivelse" cols="75" rows="30"></textarea>
            </li>
            <li>
                <input type="submit" value="OK!">
            </li>
        </ul>
    </form>
    
    <a href="opret_nyhed.php">Tilbage</a>

</div>


<?php
	include("../root_folder/footer.php");
?>