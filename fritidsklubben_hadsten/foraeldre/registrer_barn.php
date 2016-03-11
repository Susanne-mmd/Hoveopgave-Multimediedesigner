<?php include('../funktioner/init.php'); 		// Henter de vigtigste filer og variabler.

$title = "Registrer barn";				// Titlen på siden.

include('header_foraelder.php');	// Inkluder header.php til front-end'en.
//include('../funktioner/opret_voksen_bruger.php');		// Inkluder hele scriptet til oprettelsen af brugeren.
if (empty($_POST) === false) {

	if (empty($_POST) === false) {

	// Tildel de postede data til variabler
	$email						= $_POST['email'];
	$kodeord					= $_POST['kodeord'];
	$navn						= $_POST['navn'];
	$efternavn					= $_POST['efternavn'];
	$mobil						= $_POST['mobil'];
	$nummer						= $_POST['nummer'];
	$klasse						= $_POST['klasse'];
	$fotograferes				= $_POST['fotograferes'];
	$adresse					= $_POST['adresse'];
	$laege_adresse				= $_POST['laege_adresse'];
	$laege_tfl					= $_POST['laege_tlf'];
	$oevrige_bemaerkninger		= $_POST['oevrige_bemaerkninger'];
	$oevrige_kontaktpersoner	= $_POST['oevrige_kontaktpersoner'];
		
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
}
?>

<div class="content">

    <div class="reg_form">
        <p>Opret dit barn her!!</p>
        
        <?php
        if (isset($_GET['success']) && empty($_GET['success'])) { 					// Hvis brugeren har oprettet sig korrekt, da skriv:
            echo "Brugeren er blevet oprettet.";	// Udskriv at vedkommende er oprettet.
        
        } else {
        
            if (empty($_POST) === false and empty($errors) === true) { // Tjek om formen er blevet postet og om der er nogle fejl.
                
                $register_data = array( 				// Opretter et array til senere indsættelse af data i databasen og tilføjer navne til variabler.
                
                        'EMAIL' 					=> $email,	
                        'KODEORD' 					=> $kodeord,
                        'NAVN'						=> $navn,
                        'EFTERNAVN' 				=> $efternavn,
                        'MOBIL' 					=> $mobil,
                        'NUMMER'					=> $nummer,
                        'KLASSE'					=> $klasse,
                        'ADRESSE'					=> $adresse,
                        'FOTOGRAFERES'				=> $fotograferes,
                        'LAEGE_ADRESSE'				=> $laege_adresse,
                        'LAEGE_TLF'					=> $laege_tfl,
                        'OEVRIGE_BEMAERKNINGER'		=> $oevrige_bemaerkninger,
                        'OEVRIGE_KONTAKTPERSONER'	=> $oevrige_kontaktpersoner
                    );
                    
        
                registrer_barn($register_data);				// Udfører register_user funktionen med værdierne fra det ovenstående array.
                header('Location: registrer_barn.php?success');	// Viderestillet brugeren til register.php?success, hvor der vises en meddelelse
        
            } else if(empty($errors) === false) {			// Hvis $errors arrayet ikke er tomt..
                echo output_errors($errors);				// Udskriv fejl med out_errors funktionen			
        }
        }
        ?>
        
        <!-- Der vil blive brugt $_POST['(værdi)'] længere nede i value. Dette bevarer det udfyldte, hvis der skulle være en fejlmeddelelse -->
        <form action="" method="post">
            <ul class="register">
                <li>
                    Barnets nummer: <br>
                    <input type="text" name="nummer" required autocomplete="off">
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
                    <input type="text" name="mobil" required autocomplete="off">
                </li>
                <li>
                    E-mail: <br>
                    <input type="email" name="email" required autocomplete="off">
                </li>
                <li>
                    Klasse: <br>
                    <input type="text" name="klasse" required autocomplete="off">
                </li>
                <li>
                    Adressen på barnets læge: <br>
                    <input type="text" name="laege_adresse" required autocomplete="off">
                </li>
                <li>
                    Telefon-nummer til barnets læge: <br>
                    <input type="text" name="laege_tlf" required autocomplete="off">
                </li>
                
                <li>
                    øvrige bemærkninger: <br>
                    <textarea name="oevrige_bemaerkninger" cols="21" rows="5"></textarea>
                </li>
                <li>
                    øvrige kontaktpersoner: <br>
                    <textarea name="oevrige_kontaktpersoner" cols="21" rows="3"></textarea>
                </li>
                <li>
                    Klubben må gerne uploade billeder på fritidsklubbens hjemmeside af mit barn: <br>
                    <input name="Fotograferes" type="checkbox" value="Ja" checked> <br>
                </li>
                <br>
                <li>
                    <input type="submit" value="Opret barn!">
                </li>
            </ul>
        </form>
    
    </div>
</div>

<?php
include('../root_folder/footer.php'); // Footer til layout.
?>