<?php
	include("../funktioner/init.php");
	
	$title = "Månedslan";
	
	include("header_admin.php");
	
?>

<div class="admin_tabel">

<?php
//Her Henter jeg oplysninger i event tabellen..
$get_events_sql = "SELECT DATO, NAVN, TEXT FROM fk_events ORDER BY DATO ASC";

	$get_events_res = mysql_query($get_events_sql) or die(mysql_error($mysql));

 	if (mysql_num_rows($get_events_res) > 0) {

		$display_block .= "<p>Måneds Plan:<br/>
		<table>";
		
		//Her giver jeg den enkelte tabell et navn som bagefter bliver brugt i en tabel..
		while ($add_info = mysql_fetch_array($get_events_res)) {
			$navn = stripslashes($add_info['NAVN']);
			$dato = stripslashes($add_info['DATO']);
			$text = stripslashes($add_info['TEXT']);
			
			//Her bliver tabellen lavet med de enkelte aktiviteter..
			$display_block .= "<tr><th>$dato</th></tr>";
			$display_block .= "<tr><td>$navn</td></tr>";
			$display_block .= "<tr><td>$text</td></tr>";
		}

		$display_block .= "</table>";
	}
?>

<!-- Her bliver tabellen, samt overskrift vist på siden ved at hente den med koden Display_block. -->
<?php echo $display_block; ?>

</div>

<?php

	include("../root_folder/footer.php");
	
?>