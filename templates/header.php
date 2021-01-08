<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}

include_once "libs/libUse.php";
include_once "libs/libRequest.php";
include_once "libs/libSecurity.php"; 
include_once "libs/libModele.php"; 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- CSS stylesheet for sticky footer -->

    <title>Tousse Anti-Covid</title>

  </head>
  <body>


<!-- Barre de navigation -->
  	  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Tousse Anti-Covid</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php?view=accueil">Accueil <span class="sr-only">(current)</span></a>
      </li>
	  <?php
	  if ($isConnected = valider('isConnected','SESSION'))
	  {	
		if ($isMedecin = valider('isMedecin','SESSION'))
					{
						$id = valider('id','SESSION');
						$link = 'index.php?view=medecin&id='.$id;
						$bloc = '<li class="nav-item">
								<a class="nav-link" href='.$link.'>Vue médecin</a>
								</li>';
						echo $bloc;
					}
					else
					{
						$id = valider('id','SESSION');
						$link = 'index.php?view=fiche_patient&id='.$id;
						$bloc = '<li class="nav-item">
								<a class="nav-link" href='.$link.'>Vue patient</a>
								</li>';
						echo $bloc;
					}
      
	  }
	  ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="index.php?view=statistiques" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Statistiques
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php?view=statistiquesPatient">Statistiques par patient</a>
          <a class="dropdown-item" href="index.php?view=statistiquesGlobales">Statistiques globales</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?view=statistiquesCovid">Stats Covid</a>
        </div>
      </li>

          <?php
    if ($isConnected = valider('isConnected','SESSION'))
    { 
    if ($isMedecin = valider('isMedecin','SESSION'))
          {
            $link = 'index.php?view=chat';
            $bloc = '<li class="nav-item">
                <a class="nav-link disabled" href='.$link.'>Chat</a>
                </li>';
            echo $bloc;
          }
          else
          {
            $link = 'index.php?view=chatPatient';
            $bloc = '<li class="nav-item">
                <a class="nav-link disabled" href='.$link.'>Chat</a>
                </li>';
            echo $bloc;
          }
      
    }
    ?>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Recherche</button>
    </form>
  </div>
</nav>
