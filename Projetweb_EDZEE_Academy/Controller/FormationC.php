<?php
	include '../config.php';
	include_once '../Model/Formation.php';

	class FormationC {


		function ListeFormations(){
			$sql = "SELECT * FROM formation";
		
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				// Récupérer les données sous forme de tableau associatif
				$formations = $liste->fetchAll(PDO::FETCH_ASSOC);
				return $formations;
			}
			catch(Exception $e){
				die('Erreur: '. $e->getMessage());
			}
		}


		function SupprimerFormation($IDF){
			$sql="DELETE FROM formation WHERE IDF=:IDF";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':IDF', $IDF);   
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}



		function AjouterFormation($id,$titre,$des,$Status,$res,$prix,$Date,$Lieu){
			$sql="INSERT INTO formation (IDF,Titre,Description,Status,Ressource,Prix,Date,Lieu) 
			VALUES (:IDF,:Titre,:Description,:Status,:Ressource,:Prix,:Date,:Lieu)";
			
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'IDF' => $id,
					'Titre' =>$titre,
					'Description' => $des,
					'Status' => $Status,
					'Ressource' => $res,
                    'Prix' => $prix,
					'Date'=> $Date,
					'Lieu'=> $Lieu

			]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}

		function RecupererFormation($IDF){
			$sql="SELECT * from formation where IDF=$IDF";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$formation=$query->fetch();
				return $formation;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		function ModifierFormation($formation,$IDF){
			try {
				$db = config::getConnexion();
		$query = $db->prepare('UPDATE formation SET Titre = :Titre, Description = :Description, Prix = :Prix, Ressource = :Ressource,Status = :Status,Date= :Date,Lieu= :Lieu WHERE IDF= :IDF');
				$query->execute([
					'IDF' => $formation->getIDF(),
					'Titre' => $formation->getTitre(),
					'Description' => $formation->getDescription(),
					'Ressource' => $formation->getRessource(),
                    'Status' => $formation->getStatus(),
					'Prix' => $formation->getPrix(),
					'Date'=> $formation->getDate(),
					'Lieu'=> $formation->getLieu()

				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}
		function rechercherFormationParTitre($titre) {
			$sql = "SELECT * FROM formation WHERE Titre LIKE :Titre";
			$db = config::getConnexion();
	
			try {
				$query = $db->prepare($sql);
				$query->execute(array(':Titre' => "%$titre%")); // Utilise le joker % pour rechercher les correspondances partielles du titre
				$result = $query->fetchAll();
				return $result;
			} catch (PDOException $e) {
				echo 'Erreur: ' . $e->getMessage();
				return array(); // Retourne un tableau vide en cas d'erreur
			}
		}

        } 
	?>
