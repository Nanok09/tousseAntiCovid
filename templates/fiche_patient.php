<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index

include_once "libs/libUse.php";
include_once "libs/libRequest.php";
include_once "libs/libSecurity.php";
include_once "libs/libModele.php";

$ouinon = array(
	0 => "Oui",
	1 => "Non",
);

if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=fiche_patient");
    die("");
}

if ($id=valider('id', 'GET'))
{
	$queryPatient = "SELECT * FROM `patients` WHERE id=".$id;
	$queryDataPasVetement = "SELECT * FROM `data_pas_vetement` WHERE id_patient=".$id;
	$queryDataVetement = "SELECT * FROM `data_vetement` WHERE id_patient=".$id;
	
	$patientPDO = SQLSelect($queryPatient);
	$patient = parcoursRs($patientPDO)[0];
	$dataVetement = parcoursRs(SQLSelect($queryDataVetement));
	$dataPasVetement = parcoursRs(SQLSelect($queryDataPasVetement))[0];
}
var_dump($dataPasVetement["date_symp"]);

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
    <link rel="stylesheet" type="text/css" href="../css/sticky-footer.css">

    <title>Fiche patient</title>

    <style type="text/css">
    	.titleText{
    		font-size: 2vw;
    	}
    	.container .row h2{
    		font-size: 2.5vw;
    	}
    	.container .row h5{
    		font-size: 1.75vw;
    	}

    	.additionalMargin{
    		margin-top: 2.5%;
    		margin-bottom: 2.5%;
    	}
    	.textIndicVetement{
    		font-size: 1.8vw;
    	}
    	.rightBorder{
    		border-right: none;
    	}

		@media (min-width: 576px) { 
		.rightBorder{
    		border-right: none;
    		} 
   		}

		// Medium devices (tablets, 768px and up)
		@media (min-width: 768px) {
			.rightBorder{
				border-right: 1px solid black;
			}
		}

		// Large devices (desktops, 992px and up)
		@media (min-width: 992px) {
			.rightBorder{
				border-right: 1px solid black;
			}
		}

		// Extra large devices (large desktops, 1200px and up)
		@media (min-width: 1200px) {
			.rightBorder{
				border-right: 1px solid black;
			}
		}

    </style>

  </head>
  <body>


<!-- Barre de navigation -->
  	  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<!-- Header -->

<div class="container">
	<div class="row">
		<div class="col"><h1 class="text-center titleText">Fiche patient</h1></div>
	</div>
</div>

<!-- Fiche patient -->
    <div class="container" style="border: 1px solid black">
    	<div class="row">
    		<div class="col-4"><img class="img-fluid" src="../images/user.png"></div>
    		<div class="col-8 container">
    			<div class="row">
    				<div class="col-6 additionalMargin">Prenom: <?php echo($patient["prenom"])?></div>
    				<div class="col-6 additionalMargin">Nom: <?php echo($patient["nom"])?></div>
    				<div class="col-6 additionalMargin">Date de Naissance: <?php echo($patient["naissance"])?> Age:</div>
    				<div class="col-6 additionalMargin">Mail: <?php echo($patient["mail"])?></div>
    				<div class="col-6 additionalMargin">Sexe: <?php echo($patient["sexe"])?></div>
    				<div class="col-6 additionalMargin">Adresse: <?php echo($patient["adresse"])?></div>
    				<div class="col-6 additionalMargin">Code Postal: <?php echo($patient["code postal"])?></div>
    				<div class="col-6 additionalMargin">Téléphone: <?php echo($patient["tel"])?></div>
    				<div class="col-6 additionalMargin">N°sécurité sociale: </div>
    			</div>
    			
    		</div>
    		
    	</div>
    	<div class="row" style="border-top: 1px solid black">
    		<div class="col"><h2>Médecin traitant: Dr.Pado</h2></div>
    	</div>
    	<div class="row">
    		<div class="col"><h5>Indicateurs vetement</h5></div>
    	</div>

    	<div class="row" style="margin-bottom: 1%">
    		<div class="col-lg-6 col-md-4 container rightBorder">
		    	<div class="row">
		    		<div class="col"><span class="textIndicVetement">Toux seche: Oui</span></div>
		    	</div>
		    	<div class="row">
		    		<div class="col"><span class="textIndicVetement">Taux d'oxygénation: 85%</span></div>
		    	</div>
		    	<div class="row">
		    		<div class="col"><span class="textIndicVetement">Température corporelle: 38.7°C</span></div>
		    	</div>
		    	<div class="row">
		    		<div class="col"><span class="textIndicVetement">Allongement des tissus lors des toux: 3cm</span></div>
		    	</div>
		    	<div class="row">
		    		<div class="col"><span class="textIndicVetement">Rythme respiratoire: 12cycles/min</span></div>
		    	</div>
		    	<div class="row">
		    		<div class="col"><span class="textIndicVetement" style="font-weight: bold;">Risque: </span></div>
		    	</div>

    		</div>
    		<div class="col-lg-6 col-md-8" id="my_dataviz"></div>
    	</div>
    	<div class="row" style="border-top: 1px solid black">
    		<div class="col"><h5>Fiche médicale</h5></div>
    	</div>
    	<div class="row">
    		<div class="container col-6">
    			<div class="row">
		    		<div class="col">Age: </div>
				</div>
				<div class="row">
				    <div class="col">IMC: <?php echo($dataPasVetement["imc"])?></div>
				</div>
				<div class="row">
				    <div class="col">Présence d'antécédents cardio-vasculaires: <?php echo($ouinon[$dataPasVetement["antecedent_cv"]])?></div>
				</div>
				<div class="row">
				    <div class="col">Diabete: <?php echo($ouinon[$dataPasVetement["diabete"]])?></div>
				</div>
				<div class="row">
				    <div class="col">Pathologie respiratoire chronique: <?php echo($ouinon[$dataPasVetement["respiratoire_chronique"]])?></div>
				</div>
				<div class="row">
				    <div class="col">Dialyse: <?php echo($ouinon[$dataPasVetement["dialyse"]])?></div>
				</div>
				<div class="row">
				    <div class="col">Cancer évolutif: <?php echo($ouinon[$dataPasVetement["cancer"]])?></div>
				</div>
    		</div>
    	
    	
    	<div class="container col-6">
			<div class="row">
			    <div class="col">Fievre: <?php echo($ouinon[$dataPasVetement["fievre"]])?>, toux: <?php echo($ouinon[$dataPasVetement["toux"]])?>, perte du gout: <?php echo($ouinon[$dataPasVetement["perte_gout"]])?>, perte de l'odorat: <?php echo($ouinon[$dataPasVetement["perte_odorat"]])?>, <?php echo($ouinon[$dataPasVetement["autre"]])?></div>
			</div>
			<div class="row">
			    <div class="col">Date du début des symptomes: <?php echo($dataPasVetement["date_symp"])?> - Date de fin: <?php echo($dataPasVetement["date_fin"])?></div>
			</div>    		
    	</div>
    	</div>
    </div>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">Place sticky footer content here.</span>
      </div>
    </footer>


    <!-- d3.js (framework for graphs) -->
    <script src="https://d3js.org/d3.v4.js"></script>

    <script>

// set the dimensions and margins of the graph
var margin = {top: 10, right: 30, bottom: 30, left: 50},
    width = 460 - margin.left - margin.right,
    height = 400 - margin.top - margin.bottom;

// append the svg object to the body of the page
var svg = d3.select("#my_dataviz")
  .append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform",
          "translate(" + margin.left + "," + margin.top + ")");

//Read the data
d3.csv("https://raw.githubusercontent.com/holtzy/data_to_viz/master/Example_dataset/3_TwoNumOrdered_comma.csv",

  // When reading the csv, I must format variables:
  function(d){
    return { date : d3.timeParse("%Y-%m-%d")(d.date), value : d.value }
  },

  // Now I can use this dataset:
  function(data) {

    // Keep only the 90 first rows
    data = data.filter(function(d,i){ return i<90})

    // Add X axis --> it is a date format
    var x = d3.scaleTime()
      .domain(d3.extent(data, function(d) { return d.date; }))
      .range([ 0, width ]);
    svg.append("g")
      .attr("transform", "translate(0," + (height+5) + ")")
      .call(d3.axisBottom(x).ticks(5).tickSizeOuter(0));

    // Add Y axis
    var y = d3.scaleLinear()
      .domain( d3.extent(data, function(d) { return +d.value; }) )
      .range([ height, 0 ]);
    svg.append("g")
      .attr("transform", "translate(-5,0)")
      .call(d3.axisLeft(y).tickSizeOuter(0));

    // Add the area
    svg.append("path")
      .datum(data)
      .attr("fill", "#69b3a2")
      .attr("fill-opacity", .3)
      .attr("stroke", "none")
      .attr("d", d3.area()
        .x(function(d) { return x(d.date) })
        .y0( height )
        .y1(function(d) { return y(d.value) })
        )

    // Add the line
    svg.append("path")
      .datum(data)
      .attr("fill", "none")
      .attr("stroke", "#69b3a2")
      .attr("stroke-width", 4)
      .attr("d", d3.line()
        .x(function(d) { return x(d.date) })
        .y(function(d) { return y(d.value) })
        )

    // Add the line
    svg.selectAll("myCircles")
      .data(data)
      .enter()
      .append("circle")
        .attr("fill", "red")
        .attr("stroke", "none")
        .attr("cx", function(d) { return x(d.date) })
        .attr("cy", function(d) { return y(d.value) })
        .attr("r", 3)

})

</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

