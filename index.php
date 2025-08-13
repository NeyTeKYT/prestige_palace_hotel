<!DOCTYPE html>
<html>
<head>
    <title>Prestige Palace Hotel</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
    
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-indigo.css"> <!-- Pourquoi Indigo ? Car cela évoque le luxe pour une expérience haut de gamme -->
    
    <!-- Police d'écriture via Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="style.css"> <!-- Fichier CSS -->
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> <!-- Lien Google Icon -->
</head>
<body>
	
	<!-- Header -->
    <header class="w3-container w3-theme-l3 w3-padding-16">

        <h1 class="w3-center w3-text-theme titre">Prestige Palace Hotel</h1>
        <blockquote class="w3-center w3-text-white accroche">" Où le luxe rencontre l'histoire "</blockquote>
        
        <!-- Menu latéral déroulant -->
        <div class="menu-lateral-deroulant">
			<div id="mySidenav" class="sidenav w3-theme-l4 w3-text-theme">
			  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			  <?php 
				$tabpages = array("Présentation Prestige Palace Hotel"=>"init.php", "Liste des Réservations"=>"reservations.php", "Faire une Réservation"=>"modifresa.php");
				foreach ($tabpages as $nomPage => $lienPage) {
					echo "<a href=\"index.php?page=$lienPage\" title=\"$nomPage\">$nomPage</a>";
				}
			  ?>
			</div>
			
			<span id="menu-lateral-deroulant-span" style="font-size:30px;cursor:pointer" onclick="openNav()" class="w3-text-theme">&#9776</span>
        </div>
		
    </header>
    
    <!-- Main -->
    <main class="w3-container w3-center w3-padding-16">
		<?php 
			if(isset($_GET['page'])) include($_GET['page']);
			else include('init.php');
		?>
    </main>
    
    <!-- Footer -->
    <footer class="w3-container w3-theme-l4 w3-padding-16 w3-center">
		<h3>Prestige Palace Hotel</h3>
		<p><i class="material-icons">home</i> 123 Avenue des Champs-Élysées, 84000 Avignon, France</p>
		<p><i class="material-icons">phone</i> +33 1 23 45 67 89</p>
		<p><i class="material-icons">mail</i> info@prestigepalacehotel.com</p>
		<p>© 2024 Prestige Palace Hotel. Tous droits réservés.</p>
	</footer>

    <script src="script.js"></script> <!-- Fichier JS -->
    
</body>
</html>
