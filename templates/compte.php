<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=compte");
    die("");
}

$info_perso = infoUser($_SESSION['id']);
?>

<main>
	<h2>Bienvenue sur votre espace personnel avec votre compte Awale !</h2>                
    
    <div id="info_compte">
        <span>Voici vos informations personnels :</span><br>

        <div>
            <span>Pseudo : </span><?php echo $info_perso['pseudo']; ?>
        </div>
        
        <div>
            <span>Email : </span><?php echo $info_perso['email']; ?>
        </div>

        <div>
            <span>Anniversaire : </span><?php echo $info_perso['date_naissance']; ?>
        </div>

        <div>
            <span>Origine : </span><?php echo $info_perso['pays']; ?>
        </div>

        <div>
            <span>Bio : </span><?php echo $info_perso['bio']; ?>
        </div>

        <div>
            <span>Photo de profil : </span><img <?php if (isset($info_perso['photo'])) echo "src=uploads/".$info_perso['photo']; ?> alt="photodeprofil" id="photo"> 
        </div>
    </div>       

    <div id="bouton_modification">
        <a href="index.php?view=modification_de_compte">Modifier mes informations</a>
    </div>       
</main>