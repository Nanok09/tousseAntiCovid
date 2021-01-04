<?php

session_start();

function testPseudoPasDansLaBase($pseudonyme)
{
    // on se connecte à la base de données du site :
    $bdd = new PDO('mysql:host=localhost;dbname=awale;charset=utf8', 'root', '');

    // on protège le site des balises html potentiellement rentrées dans le pseudo :
    $pseudo=htmlspecialchars($pseudonyme);

    // on va chercher dans la base de donnée tous les identifiants qui correspondent à ce pseudo :
    $req = $bdd->prepare('SELECT id FROM membres WHERE pseudo = ?');
    $req->execute(array($pseudo));

    // on vérifie que ce pseudo n'est pas déjà présent dans la base de donnée :
    return $req->fetch() == null ;
}

function testEmailCorrecte($email)
{
    // on vérifie que l'adresse email est valide grâce à une expression régulière :
    return preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email);
}

function testImageCorrecte($image)
{
    // <!-- on test si l'utilisateur a envoyé une image ET si l'envoie s'est fait sans erreur -->
    if (isset($image) AND $image['error']==0)
    {
        // <!-- on test si la taille de la photo est raisonnable -->
        if($image['size']<=5000000) 
        {
            // <!-- on stocke les informations du fichier envoyé dans une variable -->
            $infosfichier = pathinfo($image['name']);
            // <!-- on stocke l'information contenant l'extension du fichier dans une variable -->
            $extension_upload = $infosfichier['extension'];
            // <!-- on stocke les formats pris en charge pour les images dans un tableau -->
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            // <!-- on test si le format du fichier est bien dans le tableau des formats autorisés -->
            if (in_array($extension_upload, $extensions_autorisees))
            {
                return True;
            }
            else
            {
                return "Votre image n'a pas le bon format (jpg, jpeg, gif ou png autorisés)";
            }
        }
        else
        {
            return "Votre fichier est trop volumineux (limite de 5 Mo)";
        }
    }
    else
    {
        return "Vous n'avez pas envoyé d'image ou il y a eu un problème";
    }
}

function uploaderImage($image)
{
    // on se connecte à la base de données du site :
    $bdd = new PDO('mysql:host=localhost;dbname=awale;charset=utf8', 'root', '');

    // <!-- on télécharge le fichier dans le dossier 'uploads' et on récupère le nom de l'image -->
    move_uploaded_file($image['tmp_name'], 'uploads/' . basename($image['name']));
    $_SESSION['statut']="L'envoi a bien été effectué !";

    // on enregistre dans la base le chemin d'accès de la photo de profil :
    $req = $bdd->prepare('UPDATE membres SET photo = :photo WHERE id = :id');
    $req->execute(array('photo' => 'uploads/' . basename($image['name']), 'id' => $_SESSION['id']));
}

function updateDataBase($pseudo, $email, $pass, $pays, $bio, $date_naissance)
{
    // on se connecte à la base de données du site :
    $bdd = new PDO('mysql:host=localhost;dbname=awale;charset=utf8', 'root', '');

    // insertion des informations dans la base de donnée (table membres)
    $req = $bdd->prepare('UPDATE membres SET pseudo = :pseudo, pass = :pass, email = :email, date_naissance = :date_naissance, bio = :bio, pays = :pays WHERE id = :id');
    $req->execute(array(
        'pseudo' => $pseudo, 
        'pass' => $pass_hache, 
        'email' => $email, 
        'date_naissance' => $_POST['date_naissance'], 
        'bio' => $bio,
        'pays' => $_POST['pays'],
        'id' => $_SESSION['id']));
}
?>