<div>

	<?php 

		// Vérifie si nous souhaitons faire ou modifier une réservation
		if(isset($_GET['index'])) {	// Modification d'une réservation

			echo "<h1>Modifier une Réservation</h1>";

			$reservation_index = $_GET['index'];
			$fichier = fopen("data.txt", "r");	// Ouverture du fichier pour récupérer les informations de la réservation

			$index = 1;
			$data = null;

			while(!feof($fichier)) {
				$ligne = fgets($fichier);
				if($index == $reservation_index) {
					$data = $ligne;
					break;
				}
				$index++;
			}
			fclose($fichier);

			if($data) {
				$reservation = explode("|", $data);	// stockage de la réservation dans une variable
				if(count($reservation) == 4) list($nom, $date, $taille, $duree) = $reservation;	// Création des 4 variables pour les 4 informations de la réservation
			}

			// Format de l'affichage de la réservation
			echo "<div class='w3-container w3-card-4 w3-theme-l4'>";
				echo "<h3>Réservation n°$index</h3>";
				echo '<img src="img/chambre.png" alt="Image de la chambre" style="width:20%">';
				echo "<h4>Réservation au nom de <strong id='nom'><em>$nom</em></strong><br>
				Effectuée le <strong>$date</strong><br>
				Chambre pour <strong id='taille'>$taille personne(s) </strong><br>
				Pour une durée de <strong id='duree'>$duree jour(s)</strong></h4>";
			echo "</div>";
		}
		else {	// Ajout d'une réservation
			// Variables contenant les valeurs entrées par l'utilisateur
			echo "<h1>Faire une Réservation</h1>";
			$nom = isset($_POST["nom"]) ? $_POST["nom"] : '';
			$taille = isset($_POST["taille"]) ? $_POST["taille"] : '';
			$duree = isset($_POST["duree"]) ? $_POST["duree"] : '';
		}
		
		$errors = []; // Tableau contenant les messages d'erreurs
		
		$emptyNom = $emptyTaille = $emptyDuree = false;

		if($_SERVER["REQUEST_METHOD"] == "POST") {

			if(empty($nom)) {
				$emptyNom = true;
				$errors[] = "Vous n'avez pas rempli le champ 'Nom du client' !";
			}

			if($taille === 'home') {
				$emptyTaille = true;
				$errors[] = "Vous n'avez pas rempli le champ 'Taille de la chambre' !";
			}

			if(empty($duree)) {
				$emptyDuree = true;
				$errors[] = "Vous n'avez pas rempli le champ 'Durée du séjour' !";
			}

			if(!empty($errors)) {
				echo "<div class='w3-container w3-red w3-center'>";
				foreach ($errors as $error) echo "<p>$error</p>";
				echo "</div>";
			} 

			else { // Tous les champs ont une valeur
				if(($duree >= 1) && ($duree <= 15)) {
					if((($nom >= 'A') && ($nom <= 'Z'))) {	// Un nom commence toujours par une majuscule
						$fichier = fopen("data.txt", "a");
						$reservation = $nom."|".date("d-m-Y")."|".$taille."|".$duree."\n";
						fwrite($fichier, $reservation);
						fclose($fichier);
						
						echo "<div class='w3-container w3-green w3-center'>";
						echo "<p>La réservation a bien été effectuée ! <br>
						Vous avez réservé une chambre pour $taille personnes au nom de $nom pour $duree jours. <br>
						Pour consulter votre réservation, aller dans l'onglet 'Liste des Réservations' via le menu latéral déroulant.";
						echo "</div>";
					}
					else {
						echo "<div class='w3-container w3-orange w3-center'>";
						$nomError = true;
						echo "<p>Le nom que vous avez renseigné n'est pas correct.</p>";
						echo "</div>";
					}
				} 
				else {
					echo "<div class='w3-container w3-orange w3-center'>";
					$dureeError = true;
					if ($duree < 1) echo "<p>Vous avez renseigné un nombre de jours inférieur à 1.</p>";
					else echo "<p>Vous avez renseigné un nombre de jours supérieur à 15.</p>";
					echo "</div>";
				}
			}
		} 
	?>
	
	<form method="POST" class="w3-container">

		<!-- Nom du client -->
		<p>
			<label for="nom" class="w3-text-theme">Nom du client</label>
			<input type="text" name="nom" id="nom" class="w3-input w3-center <?php if($emptyNom) echo 'w3-red'; ?> <?php if($nomError) echo 'w3-text-orange'; ?>" value="<?php echo $nom ?>"/>
		</p>
		
		<!-- Taille de la chambre -->
		<p>
			<label for="taille" class="w3-text-theme">Taille de la chambre</label>
			<select name="taille" id="taille" class="w3-select w3-center <?php if($emptyTaille) echo 'w3-red'; ?>">
				<option value="home" <?php if($taille == 'home') echo 'selected'; ?>>-- Choisissez le nombre de personne --</option>
				<option value="1" <?php if($taille == 1) echo 'selected';?>>1 personne</option>
				<option value="2" <?php if($taille == 2) echo 'selected';?>>2 personnes</option>
				<option value="3" <?php if($taille == 3) echo 'selected';?>>3 personnes</option>
				<option value="4" <?php if($taille == 4) echo 'selected';?>>4 personnes</option>
			</select>
		</p>
		
		<!-- Durée du séjour -->
		<p>
			<label for="duree" class="w3-text-theme">Durée du séjour</label>
			<input type="text" name="duree" id="duree" class="w3-input w3-center <?php if($emptyDuree) echo 'w3-red'; ?> <?php if($dureeError) echo 'w3-text-orange'; ?>" value="<?php echo $duree ?>" />
		</p> 
		
		<!-- Bouton de soumission -->
		<p>
			<button type="submit" class="w3-btn w3-theme">Soumettre</button>
		</p>

	</form>

</div>
