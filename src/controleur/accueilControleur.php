<?php
function accueilControleur($twig){
    echo $twig->render('accueil.html.twig', array());
}

function contactControleur(){
    echo 'Contact';
   }

   function inscrireControleur($twig, $db){
    $form = array();
    if (isset($_POST['valide'])){
        $inputEmail = $_POST['email'];
        $inputPassword = $_POST['motdepasse'];
        $inputPassword2 =$_POST['confirmation'];
        $nom = $_POST['nom'];
        $prenom =$_POST['prenom'];
        $role = $_POST['role'];
        $form['valide'] = true;
        if ($inputPassword!=$inputPassword2){
            $form['valide'] = false;
            $form['message'] = 'Les mots de passe sont différents';
        }
        else{
            $Utilisateur = new Utilisateur($db);
            $exec = $Utilisateur->insert($nom,$prenom,$inputEmail,$role, password_hash($inputPassword,PASSWORD_DEFAULT));
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
        }
        $form['email'] = $inputEmail;
        $form['role'] = $role;
    }
    
}
echo $twig->render('inscrire.html.twig', array('form'=>$form));
}

function connexionControleur($twig, $db){
    $form = array();
   
    if (isset($_POST['btConnecter'])){
    $form['valide'] = true;
    $inputEmail = $_POST['inputEmail'];
    $inputPassword = $_POST['inputPassword'];
    $utilisateur = new Utilisateur($db);
    
    $unUtilisateur = $utilisateur->connect($inputEmail);
    
    if ($unUtilisateur!=null){
    if(!password_verify($inputPassword,$unUtilisateur['mdp'])){
        $form['valide'] = false;
        $form['message'] = 'Login ou mot de passe incorrect';
        
        
    }
    else{

        $_SESSION['login'] = $inputEmail;
        $_SESSION['role'] = $unUtilisateur['idRole'];
        header("Location:index.php");
        }
    }
    else{
    $form['valide'] = false;
    $form['message'] = 'Login ou mot de passe incorrect';
    

    }
 }
 echo $twig->render('connecter.html.twig', array('form'=>$form));
}

Function maintenanceControleur($twig){
    var_dump($_POST);
    echo $twig->render('maintenance.html.twig',array());
}

function deconnexionControleur($twig, $db){
    session_unset();
    session_destroy();
    header("Location:index.php");
   }

   function utilisateurControleur($twig, $db){
    $form = array();
    $utilisateur = new Utilisateur($db);
    $liste = $utilisateur->select();
    echo $twig->render('utilisateur.html.twig', array('form'=>$form,'liste'=>$liste));
   }

   function ajoutMangaControleur($twig, $db){
    $form = array();
    if (isset($_POST['btAjout'])){
        $nomManga = $_POST['nomManga'];
        $genre = $_POST['genre'];
        $resume =$_POST['resume'];
        $form['valide'] = true;
        
            $Ajout = new Ajout($db);
            $exec = $Ajout->insert($nomManga,$genre,$resume);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table manga ';
        }
        $form['nomManga'] = $nomManga;
        $form['genre'] = $genre;
        $form['resume'] = $resume;
    
}
echo $twig->render('ajoutManga.html.twig', array('form'=>$form));
}

function mangaControleur($twig, $db){
    $form = array();
    $ajout = new Ajout($db);
    $liste2 = $ajout->select();
    echo $twig->render('manga.html.twig', array('form'=>$form,'liste2'=>$liste2));
   }
   
   


   
?>