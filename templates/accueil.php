<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}
?>

<link rel="stylesheet" type="text/css" href="../css/accueil.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style type="text/css">
	

a.stylise{
	text-decoration: none;
	color: black;
}

</style>

<div class="container-fluid mb-5">
    <div class="text-center mt-5">
        <h1>Bienvenue sur le site Tousse Anti-Covid</h1>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="box">
            	<?php
	    	if (!isset($_SESSION['isConnected']) OR $_SESSION['isConnected'] != true)
			{
				echo '<a class="stylise" href="index.php?view=connexion">
                <div class="our-services settings">
                    <h4>Connexion</h4>
                    <p>Connectez vous!</p>
                </div>';
			}
			else
			{
				echo '<a class="stylise" href="index.php?view=deconnexion">
                <div class="our-services settings">
                    <h4>Déconnexion</h4>
                    <p>Déconnectez vous!</p>
                </div>';
			}
			?>




            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <a class="stylise" href="index.php?view=inscription">
                <div class="our-services speedup">
                    <h4>Inscription</h4>
                    <p>Inscrivez vous!</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
            	<a class="stylise" href="index.php?view=statistiques">
                <div class="our-services privacy">
                    <h4>Statistiques</h4>
                    <p>Accédez aux différentes statistiques liées aux vetements connectés</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
		<div class="col-md-4">
            <div class="box">
				<?php
				if (!isset($_SESSION['isConnected']) OR $_SESSION['isConnected'] != true)
				{
					echo '<a class="stylise" href="index.php?view=accueil">
						<div class="our-services backups">
						<h4>Vue patient</h4>
						<p>Connectez vous pour accéder á cette partie </p>
						</div>';
				}
				else
				{
					if ($isMedecin = valider('isMedecin','SESSION'))
					{
						$id = valider('id','SESSION');
						$link = 'index.php?view=medecin&id='.$id;
						$bloc = "<a class='stylise' href=".$link.">
							<div class='our-services backups'>
							<h4>Vue médecin</h4>
							<p>Accédez aux données de vos patients</p>
							</div>";
						echo $bloc;
					}
					else
					{
						$id = valider('id','SESSION');
						$link = 'index.php?view=fiche_patient&id='.$id;
						$bloc = "<a class='stylise' href=".$link.">
							<div class='our-services backups'>
							<h4>Vue patient</h4>
							<p>Accédez á vos données personnelles </p>
							</div>";
						echo $bloc;
					}
				}
				?>
            </div>
        </div>
		
		
        <div class="col-md-4">
            <div class="box">
				
				<?php
				if (!isset($_SESSION['isConnected']) OR $_SESSION['isConnected'] != true)
				{
					echo '<a class="stylise" href="index.php">
							<div class="our-services ssl">
								<h4>Chat</h4>
								<p>Connectez vous pour accéder au chat !</p>
							</div>                	
						</a>';
				}
				else
				{
					if ($isMedecin = valider('isMedecin','SESSION'))
					{
						$bloc = '<a class="stylise" href="index.php?view=chat">
							<div class="our-services ssl">
								<h4>Chat</h4>
								<p>Venez répondre à vos patients</p>
							</div>                	
						</a>';
						echo $bloc;
					}
					else
					{
						$bloc = '<a class="stylise" href="index.php?view=chatPatient">
							<div class="our-services ssl">
								<h4>Chat</h4>
								<p>Contactez votre médecin traitant !</p>
							</div>                	
						</a>';
						echo $bloc;
					}
				}
				?>
                

            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <a class="stylise" href="https://www.gouvernement.fr/info-coronavirus/tousanticovid">
                <div class="our-services database">
                    <h4>Informations liées à l'épidémie</h4>
                    <p>Accéder à l'actualité de la Covid</p>
                </div>
            	</a>
            </div>
        </div>
    </div>
</div>


