<?php
	include("../funktioner/init.php");
	
	$title = "Barnets oplysninger";
	
	include("header_admin.php");
	
?>
<div class="admin_tabel">
<?php

if (!$_POST)  {
	
	$display_block = "<p>Find oplysninger på et barn her!!</p>";

	//Her henter jeg alle nummerne til select formlen..
	$get_list_sql = "SELECT NUMMER AS display_name
	                 FROM fk_barn ORDER BY NUMMER";
	$get_list_res = mysql_query($get_list_sql) or die(mysql_error());

	if (mysql_num_rows($get_list_res) < 1) {
		//Denne statement kommer frem hvis der ingen numre er i systemet..
		$display_block .= "<p><em>Sorry, no records to select!</em></p>";

	} else {
		//Denne form bliver brugt hvis der er numre i databasen.
		$display_block .= "
		<form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
		<h2><label for=\"sel_id\">Vælg et nummer:</label><br/>
		<select id=\"sel_id\" name=\"sel_id\" required=\"required\">
		<option value=\"\">-- Select One --</option>";

		while ($recs = mysql_fetch_array($get_list_res)) {
			$nummer = $recs['NUMMER'];
			$display_name = stripslashes($recs['display_name']);
			$display_block .= "<option value=\"".$nummer."\">".$display_name."</option>";
		}

		$display_block .= "
		</select></p>
		<button type=\"submit\" name=\"submit\" value=\"view\">View Selected Entry</button>
		</form>";
	}
	//free result
	mysqli_free_result($get_list_res);

} else if ($_POST) {
	//check for required fields
	if ($_POST['sel_id'] == "")  {
		header("Location: se_oplysninger.php?");
		exit;
	}

	//create safe version of ID
	$safe_id = mysql_real_escape_string($_POST['sel_id']);

	//Dette er den samme kode som øverst, som hender nummeret fra dataabasen.. hvorfor de skal hentes to gange må jeg ærligt erkende jeg ikke ved..
	$get_master_sql = "SELECT NUMMER as display_name
	                   FROM fk_barn WHERE NUMMER = '".$safe_id."'";
					   
	$get_res = mysql_query($get_sql) or die(mysql_error());

	while ($name_info = mysql_fetch_array($get_res)) {
		$display_name = stripslashes($name_info['display_name']);
	}

	$display_block = "<p>Showing Record for ".$display_name."</p>";

	//free result
	mysql_free_result($get_res);

	//Denne kode går ind og henter alle oplysninger på det valgte nummer..
	$get_oplysning_sql = "SELECT NUMMER, NAVN, EFTERNAVN, EMAIL, MOBIL, KLASSE, ADRESSE, LAEGE_ADRESSE, LAEGE_TLF, FOTOGRAFERES, OEVRIGE_BEMAERKNINGER, OEVRIGE_KONTAKTPERSONER
	                      FROM fk_barn WHERE NUMMER = '".$safe_id."'";
	$get_oplysning_res = mysql_query($get_oplysning_sql) or die(mysql_error());

 	if (mysql_num_rows($get_oplysning_res) > 0) {

		$display_block .= "<p>Barnets oplysninger:<br/>
		<ul>";
		//Her giver jeg alle tabeller et navn som nedenunder vil blivve kaldt ind i en liste..
		while ($add_info = mysqli_fetch_array($get_oplysning_res)) {
			$nummer = stripslashes($add_info['NUMMER']);
			$navn = stripslashes($add_info['NAVN']);
			$efternavn = stripslashes($add_info['EFTERNAVN']);
			$email = stripslashes($add_info['EMAIL']);
			$mobil = stripslashes($add_info['MOBIL']);
			$klasse = stripslashes($add_info['KLASSE']);
			$adresse = stripslashes($add_info['ADRESSE']);
			$laege_adresse = stripslashes($add_info['LAEGE_ADRESSE']);
			$laege_tlf = stripslashes($add_info['LAEGE_TLF']);
			$fotograferes = stripslashes($add_info['FOTOGRAFERES']);
			$oevrige_bemaerkninger = stripslashes($add_info['OEVRIGE_BEMAERKNINGER']);
			$oevrige_kontaktpersoner = stripslashes($add_info['OEVRINGE_KONTAKTPERSONER']);
			

			$display_block .= "	<li>$nummer,</li> 
								<li>$navn,</li> 
								<li>$efternavn,</li> 
								<li>$email,</li>
								<li>$mobil,</li> 
								<li>$klasse,</li> 
								<li>$adresse,</li> 
								<li>$laege_adresse,</li> 
								<li>$laege_tlf,</li> 
								<li>$fotograferes,</li> 
								<li>$oevrige_bemaerkninger,</li> 
								<li>$oevrige_konpaktpersoner</li>";
		}

		$display_block .= "</ul>";
	}

	//free result
	mysqli_free_result($get_addresses_res);
	
}
?>
	<!-- Display Block er blivet brugt hele koden igennem, da det er den der viser alle dataerne på hjemmesiden.. -->
	<?php echo $display_block; ?>
</div>

<?php

	include("../root_folder/footer.php");
	
?>