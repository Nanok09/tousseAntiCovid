<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=classement");
	die("");
}

if (isset($_GET['page']))
	$lim = intval($_GET['page']);
else
	$lim = 1;
?>

<main id="classement">
	<div id="ranking">
    	<?php 
    	$ranking = trancheClassement(10*($lim-1)+1,10*$lim);
    	affichageClassement($ranking); 
    	?>
	</div>

	<nav>
    	<ul>
	        <li><a href="index.php?view=classement&page=1">1</a></li>
	        <?php
	        for ($i=$lim-3 ; $i<$lim+4 ; $i++)
	        {
	        	if ($i>1)
	        		echo "<li><a href=\"index.php?view=classement&page=".$i."\">".$i."</a></li>";
	        }
	        ?>
	    </ul>
	</nav>
</main>