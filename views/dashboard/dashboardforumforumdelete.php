<?PHP
include "../../controller/forum.php";
$forumC=new forumC();
if (isset($_GET["id"])){
    $forumC->supprimerforum($_GET["id"]);
    header('Location: dashboardform.php');
}

?>