<?php
	     try {

$db = new PDO('pgsql:host=localhost;dbname=evento','postgres','evento');
        
        } catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$evenement =  $db->query('SELECT *
	FROM public."Evenement" where id_evenement=4');

            while ($donnees = $evenement->fetch())

                {
	?>

<?php
	$apasser[0] =$donnees['titre'];
?>


<?php
	$apasser[1]= $donnees['description'];
?>

<?php
	$apasser[2]= $donnees['latitude'];
?>

<?php
	$apasser[3]= $donnees['longitude'];
?>


<?php
	echo JSON_encode($apasser);
}

?>
