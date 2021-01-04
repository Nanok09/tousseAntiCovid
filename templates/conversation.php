<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=conversation");
    die("");
}
?>

<main>
    <h2>Envoyer un nouveau message</h2>
    
    <form action="controleur.php" method="POST">
    	<input type="hidden" name="idConv" <?php echo "value=".$_GET['idConv']; ?> />

        <label for="contenu">Votre message :</label>
        <input type="text" name="contenu" id="contenu"/>

        <input name="action" type="submit" value="Envoyer"/>
    </form>

    <div id="affichageMessage">
        <?php
        $messages = listerMessages($_GET['idConv']);
        if ($messages != false)
    	    foreach ($messages as $data) 
    	    { ?>
                <p class="dateMessage"><?php echo $data['date_envoi']; ?></p>
                <?php
                if ($_SESSION['pseudo']==$data['pseudo'])
                    echo "<div class=\"message\" id=\"auteurMessage\">";
                else 
                    echo "<div class=\"message\">"; ?>
                <p><?php echo $data['pseudo']." : ".$data['contenu']; ?></p>
                </div>
    	    <?php }
        ?>
    </div>
</main>