<?php
include_once "libs/libUse.php";
include_once "libs/libRequest.php";
include_once "libs/libSecurity.php"; 
include_once "libs/libModele.php"; 

	
if($valueToSearch = valider('search','POST'))
{
	$query = "SELECT * FROM `users` WHERE CONCAT(`id`, `nom`, `prenom`, `age`) LIKE '%".$valueToSearch;
	$connect = mysqli_connect("localhost", "root", "", "tousse");
    $search_result = mysqli_query($connect, $query);
}
 else {
    $query = "SELECT * FROM patients";
    $search_result = SQLSelect($query);
}
var_dump($search_result);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>test 2</title>
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
            <form action="testderoulant2.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <input type="submit" name="search" value="Filter"><br><br>
            <?php print_r(parcoursRs($search_result));?>
			</form>
		    
        </div>
        
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
