<?php include('../funktioner/init.php'); 		// Henter de vigtigste filer og variabler.

$title = "Registrer forælder";				// Titlen på siden.

include('../root_folder/head_login.php');	// Inkluder header.php til front-end'en.

if (empty($_POST) === false) {

	// Tildel de postede data til variabler
	$email			= $_POST['email'];
	$kodeord		= $_POST['kodeord'];
	$navn			= $_POST['navn'];
	$efternavn		= $_POST['efternavn'];
	$mobil			= $_POST['mobil'];
	$adresse		= $_POST['adresse'];
	$arbejdstlf		= $_POST['arbejdstlf'];
		
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

<div class="content">

    <div class="reg_form">
        <p>Opret dig her!!<p>
        
        <?php
        
        if (isset($_GET['success']) && empty($_GET['success'])) { 					// Hvis brugeren har oprettet sig korrekt, da skriv:
            echo "Brugeren er blevet oprettet.";	// Udskriv at vedkommende er oprettet.
        
        } else {
        
            if (empty($_POST) === false and empty($errors) === true) { // Tjek om formen er blevet postet og om der er nogle fejl.
                
                $register_data = array( 				// Opretter et array til senere indsættelse af data i databasen og tilføjer navne til varibler.
                        'EMAIL' 		=> $email,	
                        'KODEORD' 		=> $kodeord,
                        'NAVN'			=> $navn,
                        'EFTERNAVN' 	=> $efternavn,
                        'MOBIL' 		=> $mobil,
                    );
        
                registrer_voksen($register_data);				// Udfører register_user funktionen med værdierne fra det ovenstående array.
        
        // hvilken id fik hun
        
        $id = mysql_insert_id(); // det ritige nummer ind her
        
                $register_data = array( 				// Opretter et array til senere indsættelse af data i databasen og tilføjer navne til varibler.
                        'ID'			=> $id,
                        'ADRESSE'		=> $adresse,
                        'ARBEJDSTLF'	=> $arbejdstlf
                    );
        
                registrer_for($register_data);				// Udfører register_user funktionen med værdierne fra det ovenstående array.
                header('Location: registrer_foraelder.php?success');	// Viderestillet brugeren til register.php?success, hvor der vises en meddelelse
        
            } else if(empty($errors) === false) {			// Hvis $errors arrayet ikke er tomt..
                echo output_errors($errors);				// Udskriv fejl med out_errors funktionen
        }
        
        ?>
        
        <!-- Der vil blive brugt $_POST['(værdi)'] længere nede i value. Dette bevarer det udfyldte, hvis der skulle være en fejlmeddelelse -->
        <form action="" method="post">
            <ul class="register">
                <li>
                    E-mail: <br>
                    <input type="email" name="email" required autocomplete="off">
                </li>
                <li>
                    Kodeord: <br>
                    <input type="password" name="kodeord" required autocomplete="off">
                </li>
                <li>
                    Fornavn: <br>
                    <input type="text" name="navn" required autocomplete="off">
                </li>
                <li>
                    Efternavn: <br>
                    <input type="text" name="efternavn" required autocomplete="off">
                </li>
                <li>
                    Adresse: <br>
                    <input type="text" name="adresse" autocomplete="off">
                </li>
                <li>
                    Mobil: <br>
                    <input type="number" name="mobil" required autocomplete="off">
                </li>
                <li>
                    Arbejds-telefon: <br>
                    <input type="text" name="arbejdstlf" required autocomplete="off">
                </li>
                <li>
                    <input type="submit" value="Opret mig!">
                </li>
            </ul>
        </form>
        
        <a href="../root_folder/login.php">Tilbage</a>
        
        <?php } ?>
    
    </div>
</div>

<?php

include('../root_folder/footer.php'); // Footer til layout.

?>