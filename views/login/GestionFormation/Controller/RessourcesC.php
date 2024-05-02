<?php
	include '../configR.php';
	include_once '../Model/Ressource.php';

	class RessourcesC {


		function ListeRessources(){
			$sql="SELECT * FROM ressources";

			$db = configR::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}


		function SupprimerRessource($IDR){
			$sql="DELETE FROM ressources WHERE IDR=:IDR";
			$db = configR::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':IDR', $IDR);   
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}



		function AjouterRessource($id,$lien,$img,$type,$dateAjout){
			$sql="INSERT INTO ressources (IDR,Lien,IMG,Type,DateAjout) 
			VALUES (:IDR,:Lien,:IMG,:Type,:DateAjout)";
			
			$db = configR::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'IDR' => $id,
					'Lien' =>$lien,
					'IMG' => $img,
					'Type' => $type,
					'DateAjout' => $dateAjout
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}

		function RecupererRessource($IDR){
			$sql="SELECT * from ressources where IDR=$IDR";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$ressource=$query->fetch();
				return $ressource;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		function ModifierRessource($ressource,$IDR){
			try {
				$db = configR::getConnexion();
				$query = $db->prepare('UPDATE ressources SET Lien = :Lien, IMG = :IMG, Type = :Type, DateAjout = :DateAjout WHERE IDR= :IDR');
				$query->execute([
					'IDR' => $ressource->getIDR(),
					'Lien' => $ressource->getLien(),
					'IMG' => $ressource->getIMG(),
					'Type' => $ressource->getType(),
					'DateAjout' => $ressource->getDateAjout()
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

	} 
?>