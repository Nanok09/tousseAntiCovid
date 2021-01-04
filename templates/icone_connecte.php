<div id="connecte">
    <p>
    <?php 
    if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
    {
    ?>
        Bonjour <?php echo $_SESSION['pseudo']; ?>,
    <?php
    }
    else
    {
        $_SESSION['statut_connexion'] = "Vous n'êtes pas connecté";
    }
    if (isset($_SESSION['statut_connexion']))
    {
        echo $_SESSION['statut_connexion'];
    } 
    if (isset($_SESSION['statut_erreur']))
    {
        echo $_SESSION['statut_erreur'];
    }          
    ?>
    </p>
</div>