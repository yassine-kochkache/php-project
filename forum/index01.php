<meta charset="utf-8" />
<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_commentaires;charset=utf8','root','');

if(isset($_GET['id']) AND !empty($_GET['id'])) {

     $getid =htmlspecialchars($_GET['id']);

     $article = $bdd->prepare('SELECT *FROM articles WHERE id = ?');
     $article->execute(array($getid));
     $article = $article->fetch();

     
  
     if($_POST['submit_commentaire']) {

        if(isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo'])AND !empty($_POST['commentaire']))
          {
              $pseudo = htmlspecialchars($_POST['pseudo']);
              $commentaire = htmlspecialchars($_POST['commentaire']);
              if(strlen($pseudo) < 25) {
                  $ins = $bdd->prepare('INSERT INTO commentaires (pseudo, commentaire, id_article) VALUES (?,?,?)');
                  $ins->execute(array($pseudo,$commentaire,$getid));
                  $c_msg = "<span styles='color:green'>votre commentaire a bien été posté</span>";

              } else {
                  $c_msg = "Erreur: le pseudo doit faire moins de 25 caractères";

              }
        
        
          }else {
              $c_msg = "Erreur: tous les champs doivent étre complétés";
          }

     }
     $commentaires = $bdd->prepare('SELECT *FROM commentaires WHERE id_article = ?');
     $commentaires->execute(array($getid));  

?>
         
<h2>Article:</h2>
<p><?=$article['contenu'] ?></p>

<br />

<h2>Commentaires:</h2>
<form method="POST">
    <input type="text" name="pseudo" placeholder="votre pseudo" /><br />
    <textarea name"commentaire" placeholder="votre commentaire ..."></textarea><br />
    <input type="submit" value="poster votre commentaire" name="submit_commentaire" />
 </form> 
 <?php if(isset($c_msg)) { echo $c_msg; } ?>  
 <br /><br />
 <?php while($c = $commentaires->fetch()) { ?>
   <b><?= $c['pseudo'] ?>:</b> <?= $c['commentaire'] ?><br />

 <?php } ?>



<?php
}
?>



























