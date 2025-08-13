<div>
	<h1>Liste des Réservations</h1>
	
	<script>
	
		// Filtrage des réservations
		function filtre() {
		
			var taille = document.querySelector('input[name="taille"]:checked').value;  // Bouton coché
			var reservations = document.querySelectorAll('.card');  // Réservations 

			reservations.forEach(function(card) {
			if(taille === 'all') card.style.display = 'block';  // Si le filtre est "Toutes les tailles", on affiche toutes les réservations
			else {
				if(!card.classList.contains(taille)) card.style.display = 'none'; 
				else card.style.display = 'block';
				} 
			}

		)};

	</script>
	
	<!-- Filtre des réservations -->
	<div class="filtre">
		
		<form method="POST" class="w3-container w3-theme-l2">
			
			<p>
				<span class="w3-show-block">Taille des chambres</span>
				
				<span class="w3-show-block" id="personne">
					
					<input type="radio" name="taille" value="all" id="all" class="w3-radio" checked />
					<label for="all">Toutes les tailles</label>

					<input type="radio" name="taille" value="1" id="1" class="w3-radio" />
					<label for="1">1 personne</label>

					<input type="radio" name="taille" value="2" id="2" class="w3-radio" />
					<label for="2">2 personnes</label>

					<input type="radio" name="taille" value="3" id="3" class="w3-radio" />
					<label for="3">3 personnes</label>

					<input type="radio" name="taille" value="4" id="4" class="w3-radio" />
					<label for="4">4 personnes</label>
					
				</span>
				<p>
					
					<button type="button" class="w3-btn w3-theme" onclick="filtre()">Filtrer</button>
					
				</p>
			</p>
			
		</form>
		
	</div>
	
	<!-- Affichage des réservations -->
	<div class="cards">
	
		<?php
		
			$fichier = fopen("data.txt", "r");
			$index = 0; // identifiant unique (index entier)

			while(!feof($fichier)) {	// Tant que le fichier n'est pas terminé

				$donnees = fgets($fichier);
				$index = $index + 1;	// identifiant unique (index entier)
				$reservation = explode("|", $donnees);	// stockage de la réservation dans une variable
				
				if(count($reservation) == 4) {	// On regarde si la ligne contient bien 4 informations 
					
					list($nom, $date, $taille, $duree) = $reservation;	// Création des 4 variables pour les 4 informations de la réservation

					// Format de l'affichage de la réservation
					echo "<div class='card w3-card-4 w3-theme-l4 $taille' id='reservation_$index'>";
						echo "<div class='w3-container w3-center'>";
							echo "<h3>Réservation n°$index</h3>";
							echo '<img src="img/chambre.png" alt="Image de la chambre" style="width:50%">';
							echo "<h4>Réservation au nom de <strong id='nom'><em>$nom</em></strong><br>
							Effectuée le <strong>$date</strong><br>
							Chambre pour <strong id='taille'>$taille personne(s) </strong><br>
							Pour une durée de <strong id='duree'>$duree jour(s)</strong></h4>";
							echo "<button class='w3-button w3-orange'>Modifier</button>";
							echo "<button class='w3-button w3-red'>Supprimer</button>";
						echo "</div>";
					echo "</div>";

				} 

				else break;

			}
			
			fclose($fichier);

		?>
	
	</div>
	
	<!-- Fin de l'affichage des réservations -->
	
</div>
