<?PHP

include "../../config.php";
require_once "../../model/forum.php";

class forumC
{


    function afficherforum(){

        $sql="SELECT * FROM forum";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    function ajouterForum($forum)
    {
        $sql = "INSERT INTO forum (id, nom, prenom, message) 
			VALUES (:id, :nom, :prenom, :message)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);

            $query->execute([
                'id' => $forum->getId(),
                'nom' => $forum->getNom(),
                'prenom' => $forum->getPrenom(),
                'message' => $forum->getMessage(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }
    function recupererforum($id){
        $sql="SELECT * from forum where id=$id";
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


    public function addforum($forum) {
        try {
            $pdo = config::getConnexion();
            $query = $pdo->prepare(
                'INSERT INTO forum (nom, prenom, message ) 
            VALUES (:nom, :prenom, :message )'
            );
            echo $query->queryString;
            $rd = $query->execute([
                'nom' => $forum->getNom(),
                'prenom' => $forum->getPrenom(),
                'message' => $forum->getMessage()
            
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function getnomsname(){

        $sql="SELECT DISTINCT nom as total FROM forum group  by nom";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    function getnomcount(){

        $sql="SELECT nom,count(*) as total FROM forum group  by nom ";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }

function supprimerforum($id){
    $sql="DELETE FROM forum WHERE id= :id";
    $db = config::getConnexion();
    $req=$db->prepare($sql);
    $req->bindValue(':id',$id);
    try{
        $req->execute();
    }
    catch (Exception $e){
        die('Erreur: '.$e->getMessage());
    }} 

    function modifierforum($forum,$id){
        $sql="UPDATE forum SET nom=:nom, prenom=:prenom, message=:message WHERE id=:id";

        $db = config::getConnexion();
        //$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
try{
        $req=$db->prepare($sql);
        $id=$forum->getId();
        $nom=$forum->getNom();
        $prenom=$forum->getPrenom();
        $message=$forum->getMessage();
       
        $datas = array(':id'=>$id,':nom'=>$nom,  ':prenom'=>$prenom,':message'=>$message );
        $req->bindValue(':id',$id);
        $req->bindValue(':nom',$nom);
        $req->bindValue(':prenom',$prenom);
        $req->bindValue(':message',$message);
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