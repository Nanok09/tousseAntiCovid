<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=forum");
    die("");
}
?>

    <div id="listConversations">
        <h2>Créer une nouvelle conversation</h2>

        <form action="controleur.php" method="POST">
            <label for="theme">Titre de la conversation :</label>
            <input type="text" name="theme" id="theme"/>

            <input name="action" type="submit" value="Créer"/>
        </form>

        <h2>Consulter une conversation</h2>

        <?php
        $conversations = listerConversations();
        if ($conversations == false)
            echo "Il n'y a aucun message pour cette conversation";
        foreach ($conversations as $data) 
        { 
            $user = infoUser($data['id_createur']);
            $messages = compterMessages($data['id_conversation']);
            ?>
            <div id="conversation">
                <a href="index.php?view=conversation&idConv=<?php echo $data['id_conversation']; ?>"><?php echo $data['theme']; ?></a>
                <p>Par <?php echo $user['pseudo']; ?> le <?php echo $data['date_creation']; ?></p>
                <p><?php echo $messages; ?> messages</p>
            </div><hr>
        <?php } ?>
    </div>