<?PHP
	include "../../config.php";
	require_once "../../model/regime.php";

	class regime_dC {
		
		function afficherRegime(){
			
			$sql="SELECT * FROM regime_d";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}	
		}
	
		function ajouterRegime($regime_d){
			$sql="INSERT INTO regime_d (id, type, titre, image, description ) 
			VALUES (:id, :type, :titre, :image, :description )";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
			
				$query->execute([
                    'id' => $regime_d->getId(),
					'type' => $regime_d->getType(),
					'titre' => $regime_d->getTitre(),
					'image' => $regime_d->getImage(),
					'description' => $regime_d->getDescription()
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
		function recupererregime($id){
			$sql="SELECT * from regime_d where id=$id";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$liste=$query->fetch();
				return $liste;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}


		public function addregime($regime_d) {
            try {
                $pdo = config::getConnexion();
                $query = $pdo->prepare(
                    'INSERT INTO regime_d (type, titre, image,description ) 
                VALUES (:type, :titre, :image, :description )'
				);
				echo $query->queryString;
                $rd = $query->execute([
                    'type' => $regime_d->getType(),
					'titre' => $regime_d->getTitre(),
					'image' => $regime_d->getImage(),
					'description' => $regime_d->getDescription()
				]);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        function gettypesname(){

            $sql="SELECT DISTINCT type as total FROM regime_d group  by type";
            $db = config::getConnexion();
            try{
                $liste = $db->query($sql);
                return $liste;
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }
        function gettypecount(){

            $sql="SELECT type,count(*) as total FROM regime_d group  by type ";
            $db = config::getConnexion();
            try{
                $liste = $db->query($sql);
                return $liste;
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }
        }

	function supprimerregime($id){
		$sql="DELETE FROM regime_d WHERE id= :id";
		$db = config::getConnexion();
		$req=$db->prepare($sql);
		$req->bindValue(':id',$id);
		try{
			$req->execute();
		}
		catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}} 

		function modifierRegime($regime_d,$id){
			$sql="UPDATE regime_d SET type=:type, titre=:titre, image=:image, description=:description WHERE id=:id";
	
			$db = config::getConnexion();
			//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
	try{
			$req=$db->prepare($sql);
			$id=$regime_d->getId();
			$type=$regime_d->getType();
			$titre=$regime_d->getTitre();
			$image=$regime_d->getImage();
			$description=$regime_d->getDescription();
			$datas = array(':id'=>$id,':type'=>$type,  ':titre'=>$titre,':image'=>$image,':description'=>$description );
			$req->bindValue(':id',$id);
			$req->bindValue(':type',$type);
			$req->bindValue(':titre',$titre);
			$req->bindValue(':image',$image);
			$req->bindValue(':description',$description);
			$s=$req->execute();
			}
			catch (Exception $e){
				echo " Erreur ! ".$e->getMessage();
	   echo " Les datas : " ;
	  print_r($datas);
			}
	
		}
}
?>