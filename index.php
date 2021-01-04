<?php
session_start();

/*
Cette page génère les différentes vues de l'application en utilisant des templates situés dans le répertoire "templates". Un template ou 'gabarit' est un fichier php qui génère une partie de la structure XHTML d'une page. 

La vue à afficher dans la page index est définie par le paramètre "view" qui doit être placé dans la chaîne de requête. En fonction de la valeur de ce paramètre, on doit vérifier que l'on a suffisamment de données pour inclure le template nécessaire, puis on appelle le template à l'aide de la fonction include

Les formulaires de toutes les vues générées enverront leurs données vers la page data.php pour traitement. La page data.php redirigera alors vers la page index pour réafficher la vue pertinente, généralement la vue dans laquelle se trouvait le formulaire. 
*/
include("libs/libModele.php");
include("libs/libUse.php");
include("libs/libSecurity.php");

// Dans tous les cas, on affiche l'entete, 
// qui contient les balises de structure de la page, le logo, etc. 
// Le formulaire de recherche ainsi que le lien de connexion 
// si l'utilisateur n'est pas connecté 

// on récupère le paramètre view éventuel 
$view = valider("view"); 

// S'il est vide, on charge la vue accueil par défaut
if (!$view) 
	$view = "accueil"; 

// En fonction de la vue à afficher, on appelle tel ou tel template
switch($view)
{		
	// on prévoit les vues accessibles par tous
	case "accueil" : 
		include("templates/header.php");

		include("templates/accueil.php");
		include("templates/footer.php");

	break;

	case "jouer" : 
		include("templates/header.php");

		include("templates/jouer.php");
		include("templates/footer.php");

	break; 

	case "apprendre" : 
		include("templates/header.php");

		include("templates/apprendre.php");
		include("templates/footer.php");

	break;

	case "exercices" :
		include("templates/header.php");

		include("templates/exercices.php");
		include("templates/footer.php");

	break;

	case "decouverte" :

		include("templates/header.php");
		include("templates/decouverte.php");
		include("templates/footer.php");

	break;	

	case "inscription" :
		include("templates/header.php");

		include("templates/inscription.php");
		include("templates/footer.php");

	break;		

	case "connexion" :
		include("templates/header.php");

		include("templates/connexion.php");
		include("templates/footer.php");

	break;

	case "forgotten_password" :
		include("templates/header.php");

		include("templates/forgotten_password.php");
		include("templates/footer.php");

	break;

	case "Admnistrateur" :
		include("templates/header.php");

		securiserAdmin("connexion");
		include("templates/administrate.php");
		include("templates/footer.php");

	break;

	case "random" :
		include("templates/random.php");

	break;

	case "bootstrapTutorial" :
		include("templates/bootstrapTutorial.php");

	break;

	default : // si le template correspondant à l'argument existe, on l'affiche
		if (file_exists("templates/$view.php"))
		{
			// en théorie il ne reste que les vues réservées aux utilisateurs connectés
			securiser("connexion");
			include("templates/header.php");

			include("templates/$view.php");
			include("templates/footer.php");

		}
}

// Dans tous les cas, on affiche le pied de page
// Qui contient les coordonnées de la personne si elle est connectée
?>
