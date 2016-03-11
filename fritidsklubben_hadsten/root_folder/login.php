<?php 
include('../funktioner/init.php'); 		// Inkluder vores "main" fil som inkluderer andre vigtige filer.

$title = "Log ind";				// Definer sidens titel.

if (empty($_POST) === false) { 	// Check om der er posted noget igennem formen.

	// Tildel det posterede data variabelnavne.
	$email = $_POST['EMAIL'];
	$kodeord = $_POST['KODEORD'];

	// Check om enten brugernavnet eller kodeordet ikke er udfyldt. Hvis ikke skal en fejlmeddelelse udskrives:
	
	if (empty($email) === true or empty($kodeord) === true) { 	// Hvis enten der ikke er udfyldt et brugernavn eller kodeord.
		$errors[] = "Du skal indtaste et brugernavn og kodeord."; 	// Tilføjer en fejl til vores $error array.	

	} elseif (email_exists($email) == "ukendt") { 					// Kalender user_exists funktionen med parametren $username (posted)
		$errors[] = "Vi kan ikke finde dig i databasen. Har du registreret?"; // Tilføjer en fejl til $error arrayet.

	} else {

		$usertype = email_exists($email);
		if(strlen($kodeord) > 32) {				// Hvis der er indtastet et kodeord som er over 32 bogstaver (md5 funktionen krypterer til 32 tegn)
			$errors[] = "Kodeordet er for langt";	// Tilføjer fejl til $error arrayet.
		}
		if ($usertype =="voksen"){ 
			$login = login($email, $kodeord); // Tjekker gennem funktionen om brugernavn og kodeord matcher og tildeles til en variabel.
	 
			if ($login === false) { 											// Tjekker om dataen matcher korrekt gennem login funktionen.
				$errors[] = "Brugernavn og kodeordet er forkert. Prøv igen. $usertype";	// TIlføj en fejl til $error arrayet.
	
			} else {
				$_SESSION['EMAIL'] = $login; 	// Hvis loginet er lykkedes da set en session kaldet user_id (bruges senere).
					
					$usertype = admin_test($login); //hvis login er administrator..
					
					
					if ($usertype == "administrator"){
                      header('Location: ../administrator/index_admin.php?administrator=' . $_POST['EMAIL']); // Videreesend til forsiden for administratoren
						}
					
					else{ 
                      header('Location: ../foraeldre/index_foraelder.php?foraelder=' . $_POST['EMAIL']);	// Videresend til forsiden til forældrene.
				exit();							// Dræb scriptet hvis det ikke lykkedes at redirecte.
						}
			}
		} else {
			$login = login_nummer($email, $kodeord); // Tjekker gennem funktionen om brugernavn og kodeord matcher og tildeles til en variabel.
	 
			if ($login === false) { 											// Tjekker om dataen matcher korrekt gennem login funktionen.
				$errors[] = "Brugernavn og kodeordet er forkert. Prøv igen.";	// TIlføj en fejl til $error arrayet.
	
			} else {
				$_SESSION['EMAIL'] = $login; 	// Hvis loginet er lykkedes da set en session kaldet user_id (bruges senere).
              header('Location: ../barn/index_barn.php?barn=' . $_POST['EMAIL']);	// Videresend til forsiden til barn..
				exit();							// Dræb scriptet hvis det ikke lykkedes at redirecte.
			}
		}
	}	
}

if (empty($errors) === false) {				// Hvis der er en fejl i vores forsøg på at logge ind:

	echo "<span style='font-size: 1.5em;'> Login fejl</span>";
	echo output_errors($errors);			// Udskriv fejl med output_errors funktionen.
}

?>

<?php include('head_login.php'); 	// Inkluderer vores header.php
?>

            <div class="login_form">
                <form action="login.php" method="post">
                    <table class="login" width="850">
                      <td width="6">
                        <td width="158"><input placeholder="E-mail el. Nummer" type="text" name="EMAIL" autocomplete="off"></td>
                      <td width="5"></td>
                      <td width="5">
                        <td width="158"> <input placeholder="Kodeord" type="password" name="KODEORD" autocomplete="off"></td>
                      <td width="4"></td>
                      <td width="3">
                        <td width="62"><input type="submit" value="Log ind"></td>
                      <td width="10"></td>
                      <td width="284">
                        <td width="88"> <a style="color:#06F;" href="../foraeldre/registrer_foraelder.php">Registrer her!</a></td>
                      <td width="15"></td>
                    </table>
                 </form>                  
        	</div><!--end login_form -->
            
            
      	<div class="content">
        	<h4>
                Velkommen til Fritidsklubbens login og registrerings side. </br>
                For at registrere dit barn, skal du som forælder registrere dig først, af sikkerhedsmæssige årsager.
            <h4>
           
        	<img class="skater" src="../images/skater_bane.png" width="950" height="833" alt="skater" /> 
        
        </div><!--end content -->
    
<?php

include('../root_folder/footer.php');		// Inkluder footer.php til front-end.

?>