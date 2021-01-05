<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=medecin");
    die("");
}

if(isset($_GET['search']))
{
    $valueToSearch = $_GET['search'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `patients` WHERE nom LIKE '".$valueToSearch."%' OR prenom LIKE '".$valueToSearch."%'";
    $search_result = filterTable($query);
}
 else {
    $query = "SELECT * FROM `patients`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "tousse");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Vue Médecin</title>
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
	
	
    <body>
        <br>
        <div class="container">
            <form action="controleur.php" method="get">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="action" value="Filter"><br><br>
            </form>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
					<th>Sexe</th>
					<th>Naissance</th>
					<th>Adresse Mail</th>
					<th>Téléphone</th>
					<th>Fiche</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>	
					<tr>
						<td><?php echo $row['id'];?></td>
						<td><?php echo $row['nom'];?></td>
						<td><?php echo $row['prenom'];?></td>
						<td><?php echo $row['sexe'];?></td>
						<td><?php echo $row['naissance'];?></td>
						<td><?php echo $row['mail'];?></td>
						<td><?php echo $row['tel'];?></td>
						<td>
							<form action="controleur.php" method="get">
								<input type="text" name="id" value=<?php echo $row['id']; ?> style="display:none">
								<input type="submit" name="action" value="Afficher">
							</form>
						</td>
					</tr>
				
                <?php endwhile;?>
            </table>
        
        </div>
        
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
