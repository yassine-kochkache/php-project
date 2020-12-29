<?PHP
include "../../controller/regimeC.php";
$regime_dC=new regime_dC();
if (isset($_GET["id"])){
    $regime_dC->supprimerregime($_GET["id"]);
    header('Location: dashboardform.php');
}

?>