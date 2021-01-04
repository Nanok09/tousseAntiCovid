<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=modification_de_compte");
    die("");
}

$info_perso = infoUser($_SESSION['id']);
?>

<main>
	<h2>Vous pouvez modifiez vos informations personnelles en remplissant les champs ci-dessous :</h2>
    <!-- on rentre dans le formulaire pour modifier ses informations personnelles -->
	<form method="POST" action="controleur.php" id="formulaire">
        <!-- on fixe la valeur par défaut sur l'élément déjà renseigné dans la base de données : -->
        <label for="pseudo">Votre pseudo :</label>
        <input type="text" required name="pseudo" id="pseudo" value=<?php echo $info_perso['pseudo']; ?> /><br>

        <label for="pass_1">Votre mot de passe actuel :</label>
        <input type="password" name="pass_1" id="pass_1" required/><br>

        <label for="pass_2">Votre nouveau mot de passe :</label>
        <input type="password" name="pass_2" id="pass_2"/><br>

        <label for="pass_3">Confirmez votre nouveau mot de passe :</label>
        <input type="password" name="pass_3" id="pass_3"/><br>

        <label for="email">Votre email :</label>
        <input type="email" name="email" id="email" size="40" value=<?php echo $info_perso['email']; ?> /><br>

        <label for="date_naissance">Votre date d'anniversaire :</label>
        <input type="date" name="date_naissance" id="date_naissance" value=<?php echo $info_perso['date_naissance']; ?> /><br>

        <label for="pays">Votre origine :</label>
        <select name="pays" id="pays">
            <option value=<?php echo $info_perso['pays']; ?> selected><?php echo $info_perso['pays']; ?></option>
            <optgroup label="Europe">
                <option value="france">France</option>                       
                <option value="espagne">Espagne</option>
                <option value="italie">Italie</option>
                <option value="grece">Grèce</option>
                <option value="royaume_uni">Royaume-uni</option>
            </optgroup>
            <optgroup label="Asie">
                <option value="chine">Chine</option>
                <option value="japon">Japon</option>
                <option value="inde">Inde</option>
                <option value="cambodge">Cambodge</option>
                <option value="singapour">Singapour</option>
            </optgroup>
            <optgroup label="Amérique">
                <option value="mexique">Mexique</option>
                <option value="etats_unis">Etats-Unis</option>
                <option value="canada">Canada</option>
                <option value="brezil">Brésil</option>
                <option value="costa_rica">Costa Rica</option>
            </optgroup>
        </select><br>

        <label for="bio">Votre bio :</label> 
        <textarea name="bio" id="bio" rows="8" cols="45"><?php echo $info_perso['bio']; ?></textarea><br>

        <?php
        if (isset($info_perso['photo']))
            echo "<img src=\"".$info_perso['photo']."\" alt=\"photodeprofil\"";
        ?>
        <label for="photo">Changez votre photo de profil (inférieure à 5 Mo) :</label>
        <input type="file" name="photo"/><br>

		<input type="submit" name="action" value="Modifier"/>
	</form>
</main>