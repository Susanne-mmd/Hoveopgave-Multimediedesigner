<?php
	include("../funktioner/init.php");
	
	$title = "Nyhedsbrev";
	
	include("header_admin.php");
	
?>

<div class="admin_tabel">

<?php

//Her henter jeg oplysningerne fra databasen. 
$get_events_sql = "SELECT * FROM fk_nyhedsbrev";

	$get_events_res = mysql_query($get_events_sql) or die(mysql_error($mysql));

 	if (mysql_num_rows($get_events_res) > 0) {

		$display_block .= "<p>Nyhedsbrev:<br/>
		<table>";

		//Her navngiver jeg de enkelte tabeller somm bliver brugt senere..
		while ($add_info = mysql_fetch_array($get_events_res)) {
			$text = stripslashes($add_info['TEXT']);
			$maaned = stripslashes($add_info['MAANED']);

			//Her laver jeg tabellen over nyhedsbrevet, med de elementer jeg henter fra databasen..
			$display_block .= "<p>$maaned</p>";
			$display_block .= "<h2>$text</h2>";
		}

		$display_block .= "</table>";
	}
?>

<!-- Her udskriver jeg tabellen med nyhedsbrevet, via Display_blokc som ses i koden ovenover.. -->
<?php echo $display_block; ?>

</div>

<?php

	include("../root_folder/footer.php");
	
?>