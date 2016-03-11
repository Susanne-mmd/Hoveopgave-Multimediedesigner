<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fritidsklubben</title>
<link rel="stylesheet" type="text/css" href="../css/main_index.css"/>
<link rel="stylesheet" type="text/css" href="../css/main.css"/>

</head>

<!-- Denne header bliver kun brugt ad administratoren, da de både skal have menuen som er på alle sider, men også administratorpanelet, som ligger i ude i siden. -->

<body>
    <div class="main_container">
    
    	<div class="logo">
          <img src="../images/header.jpg" width="849" height="70" alt="logo" />
        </div>
     
     <div class="navbar">
    <nav>
	<ul>
		<li><a href="index_admin.php">Forside</a></li>
		<li><a href="#">Tilmeldinger</a>
			<ul>
				<li><a href="aktivitetsplan.php">Aktivitetsoversigt</a></li>
				<li><a href="maanedsplan.php">Månedsplan</a></li>
			</ul>
		</li>
        <li><a href="nyhedsbrev.php">Nyhedsbrev</a></li>
        <li><a href="galleri_index.php">Galleri</a></li>
        <li><a href="../root_folder/log_ud.php">Log ud</a></li>
	</ul>
	</nav> 
	</div><!--end to navbar -->
    
    <div class="lodret_menu">

<h6><span style="color:#FFF">AdministratorPanel</span><h6>
	<ul>
    	<li><a href ="opret_aktivitet.php">Opret aktivitet</a></li>
    	<li><a href ="opret_nyhed.php">Opret nyhedsbrev</a></li>
        <li><a href ="se_tilmeldinger.php">Se tilmeldinger</a></li>
        <li><a href ="se_oplysninger.php">Oplysninger på barn</a></li>
        <li><a href ="registrer_admin.php">Opret ny admin</a></li>
    </ul>
</div>