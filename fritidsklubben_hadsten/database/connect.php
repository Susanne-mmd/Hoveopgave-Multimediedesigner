<?php

// Fejlmeddelsen der bliver udskrevet, hvis der ikke kan oprettes forbindelse til databasen.
// Hvis ikke der kan oprettes forbindelse til databasen, da bliver scriptet dræbt og man ser denne meddelelse som det eneste
// på hjemmesiden.
$errorMessage = "Der kunne desværre ikke oprettes forbindelse til databasen. Prøv igen senere.";

mysql_connect('mysql11.unoeuro.com','idgruppen_dk','Adelina1') or die($errorMessage); 			// Opret forbindelse til databaserne.
mysql_select_db('idgruppen_dk_db') or die($errorMessage);			// Vælg hvilken database vi skal bruge.

?>