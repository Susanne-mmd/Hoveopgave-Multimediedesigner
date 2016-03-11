<?php
	include("../funktioner/init.php");
	
	$title = "Månedsplan";
	
	include("header_barn.php");
	
?>

<?php
$get_events_sql = "SELECT DATO, NAVN, TEXT FROM fk_events ORDER BY DATO ASC";

	$get_events_res = mysql_query($get_events_sql) or die(mysql_error($mysql));

 	if (mysql_num_rows($get_events_res) > 0) {

		$display_block .= "<p>Måneds Plan:<br/>
		<table>";

		while ($add_info = mysql_fetch_array($get_events_res)) {
			$navn = stripslashes($add_info['NAVN']);
			$dato = stripslashes($add_info['DATO']);
			$text = stripslashes($add_info['TEXT']);

			$display_block .= "<tr><th>$dato</th></tr>";
			$display_block .= "<tr><td>$navn</td></tr>";
			$display_block .= "<tr><td>$text</td></tr>";
		}

		$display_block .= "</table>";
	}
?>

<?php echo $display_block; ?>



<?php

	include("../root_folder/footer.php");
	
?>