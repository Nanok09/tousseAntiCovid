<?php
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
    header("Location:../index.php?view=medecin");
    die("");
}
$id_medecin=$_SESSION['id'];
if(isset($_GET['search']))
{
    $valueToSearch = $_GET['search'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `patients` WHERE nom LIKE '".$valueToSearch."%' OR prenom LIKE '".$valueToSearch."%' AND id_medecin=".$id_medecin;
    $search_result = filterTable($query);
}
 else {
    $query = 'SELECT * FROM `patients` WHERE id_medecin='.$id_medecin;
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
        <link rel="stylesheet" type="text/css" href="../css/tableau.css">
    </head>
	
	
    <body>
        <br>
        <div class="container">
            <div class="row">
                <form action="controleur.php" method="get">
                <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
                <input type="submit" name="action" value="Filter"><br><br>
            </form>                
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title m-b-0">Liste des patients de x-y</h5>
                        </div>
                        <div class="table-responsive">
                            
                         <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Sexe</th>
                                    <th scope="col">Naissance</th>
                                    <th scope="col">Adresse Mail</th>
                                    <th scope="col">Téléphone</th>
                                    <th scope="col">Fiche</th>
                                </tr>
                            </thead>
                            <tbody class="customtable">
                                


                           


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
                 </tbody>
            </table>

                        </div>

                    </div>


                </div>
                



            </div>
           
        
        </div>
        

    </body>
</html>
