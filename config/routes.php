<?php
function getPage($db){
    


 $lesPages['accueil'] = "accueilControleur";
 $lesPages['contact'] = "contactControleur";
 $lesPages['inscrire'] = "inscrireControleur";
 $lesPages['maintenance'] = "maintenanceControleur";
 $lesPages['connecter'] = "connexionControleur";
 $lesPages['deconnexion'] = "deconnexionControleur";
 $lesPages['utilisateur'] = "utilisateurControleur";
 $lesPages['ajoutManga'] = "ajoutMangaControleur";
 $lesPages['manga'] = "mangaControleur";
 $lesPages['utilisateurModif'] = "utilisateurModifControleur";


 if($db!=null){

 if (isset($_GET['page'])){
    $page = $_GET['page'];
    }
    else{
    $page = 'accueil';
}
if (isset($lesPages[$page])){
$contenu = $lesPages[$page];
}
else{
    $contenu = $lesPages['maintenance'];
   }

return $contenu;
}
}
?>