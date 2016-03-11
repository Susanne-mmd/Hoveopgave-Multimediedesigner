<?php

session_start();				// Starter den session vi skal dræbe.
session_destroy();				// Dræber vores $_SESSION['user_id'] (den session der er brugt til at holde brugeren logget ind.)

header('Location: login.php');	// Viderestiller brugeren til forsiden efter at vedkommende er blevet logget ud.

?>