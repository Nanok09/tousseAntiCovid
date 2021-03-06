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
include("templates/header.php");

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
		include("templates/accueil.php");
	break;

	case "jouer" : 
		include("templates/jouer.php");
	break; 

	case "apprendre" : 
		include("templates/apprendre.php");
	break;

	case "exercices" :
		include("templates/exercices.php");
	break;

	case "decouverte" :
		include("templates/decouverte.php");
	break;	
	
	case "forum" :
		include("templates/forum.php");
	break;
	
	case "inscription" :
		include("templates/inscription.php");
	break;		

	case "connexion" :
		include("templates/connexion.php");
	break;
	
	case "connexionMedecin" :
		include("templates/connexionMedecin.php");
	break;

	case "forgotten_password" :
		include("templates/forgotten_password.php");
	break;
	
	case "chat" :
		include("templates/chat.php");
	break;
	
	case "chatPatient" :
		include("templates/chatPatient.php");
	break;

	case "header":
		include("templates/header2.php");
	break;

	case 'fiche_patient':
		include("templates/fiche_patient.php");
	break;
	case 'medecin':
		include("templates/medecin.php");
	break;
	case 'statistiquesPatient':
		include("templates/statistiques_patient.php");
		break;

	case "Admnistrateur" :
		securiserAdmin("connexion");
		include("templates/administrate.php");
	break;

	default : // si le template correspondant à l'argument existe, on l'affiche
		if (file_exists("templates/$view.php"))
		{
			// en théorie il ne reste que les vues réservées aux utilisateurs connectés
			securiser("connexion");
			include("templates/$view.php");
		}
}

// Dans tous les cas, on affiche le pied de page
include("templates/footer.php");
// Qui contient les coordonnées de la personne si elle est connectée
?>
