<?php
	include 'C:\wamp64\www\ProjetWeb\GestionFormation\config.php';
	include_once 'C:\wamp64\www\ProjetWeb\GestionFormation\Model\Ressource.php';

	class RessourcesC {


		function ListeRessources(){
			$sql="SELECT * FROM fressource";

			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}


		function SupprimerRessource($IDR){
			$sql="DELETE FROM fressource WHERE IDR=:IDR";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':IDR', $IDR);   
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}



		function AjouterRessource($id,$VID,$img,$type,$dateAjout){
			$sql="INSERT INTO fressource (IDR,VID,IMG,Type,DateAjout) 
			VALUES (:IDR,:VID,:IMG,:Type,:DateAjout)";
			
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'IDR' => $id,
					'VID' =>$VID,
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
			$sql="SELECT * from fressource where IDR=$IDR";
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
		function ModifierRessource($fressource,$IDR){
			try {
				$db = config::getConnexion();
				$query = $db->prepare('UPDATE fressource SET VID = :VID, IMG = :IMG, Type = :Type, DateAjout = :DateAjout WHERE IDR= :IDR');
				$query->execute([
					'IDR' => $fressource->getIDR(),
					'VID' => $fressource->getVID(),
					'IMG' => $fressource->getIMG(),
					'Type' => $fressource->getType(),
					'DateAjout' => $fressource->getDateAjout()
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

	} 
?>