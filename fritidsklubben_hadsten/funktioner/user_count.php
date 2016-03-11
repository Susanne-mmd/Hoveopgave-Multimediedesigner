<?php 

// Retter slutbogstaver i ord, hvis de er forskellige fra diverse.
$user_count 	= user_count();
$suffix1		= ($user_count) != 1 ? 'rede' : 'ret';
$suffix2		= ($user_count) != 1 ? 'e' : '';

?>
	
<p>Vi har netop <?php echo user_count(); ?> registreret<?php echo $suffix1 ?> bruger<?php echo $suffix2 ?>.</p>
