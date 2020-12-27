<?php
session_start(); 
if(isset($_SESSION['email'])){
   $url = $_SESSION['url'];
}
else{
	$url = "index.php";
	header("Location: http://10.0.29.51/$url");}
  ?>
<?php
        try {

$db = new PDO('pgsql:host=localhost;dbname=evento','postgres','evento');
        
        } catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
       ?>

<!doctype html>
<html>
<head class="ui-mobile ">
    <title>Evento</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
   
    <link rel="stylesheet" href="css/index.css"/>
    <link rel="stylesheet" href="css/themes/Evento.min.css"/>
    <link rel="stylesheet" href="css/themes/jquery.mobile.icons.min.css"/>
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

<body class="ui-mobile-viewport">

<?php   
	if(isset($_POST) && !empty($_POST['recherche'])) {
		extract($_POST);
		$recherche = $_POST['recherche'];
	}else{
		echo 'Aucune correspondence';
	}
    ?> 
<div data-role="page" id="panel-reveal"class="ui-page  ui-body-inherit ">

<?php	
	$recherche = strtoupper($recherche); 
		$buf = array("@.");
		$rch1 = strtok($recherche, ' ');
		while($rch1 !== false){						
			$reponse =  $db->query('SELECT *
			FROM public."Client" where UPPER(nom) like \''.$rch1.'\' 
			OR UPPER(prenom) like \''.$rch1.'\'
			OR UPPER(email) like \''.$rch1.'\';'
			);
			

       			while ($donnees = $reponse->fetch()){	
				if($_SESSION['email'] != $donnees['email']){
					if(!in_array($donnees['email'], $buf)) {
?>
						<div class="ui-panel-inner">
            					<ul data-role="listview" class="ui-listview">
                				<li><?php echo $donnees['email']; ?></li>
						<li><?php echo $donnees['nom']; ?></li>
						<li><?php echo $donnees['prenom']; ?></li>

           					</ul>					
        					
<?php
					$ver1 =  $db->query('select demande_ami from public."Client" where email = \''.$donnees['email'].'\';');					
					$verification1 = $ver1->fetch();					
					if(substr_count($verification1[0], $_SESSION['email'])==0){
						$ver2 =  $db->query('select email_a from public."ListeAmis" where email_c = \''.$_SESSION['email'].'\';');
						$accepter = 0;
						while ($verification2 = $ver2->fetch()){
							if($verification2['email_a'] == $donnees['email']){
								$accepter++;
								?> <p>Cest deja ton poto</p> <?php
							}				
						}
						if($accepter == 0){
?>
							<form action="recherche.php" method='get'>
								<input type="hidden" name="email_d" value="<?php echo $donnees['email'] ?>" >
								<input type="submit" value="Ajouter">
							</form><?php
						}
					}else{
						?> <p>t'a deja envoyer une requette</p> <?php
					}		
					array_push($buf, $donnees['email']);
					?></div>                			
				<?php
				} 	
            		}}
			$rch1 = strtok(' ');
		}




	
?>
<?php
	if(isset($_GET['email_d'])) {
		$demande =  $db->query('UPDATE "Client" SET demande_ami = array_append(demande_ami, \''.$_SESSION['email'].'\')
				where email = \''.$_GET['email_d'].'\';');
?>				<script type="text/javascript">
					window.location.href = "acceuil.php";			
					alert("Votre demande d'ami a \u00e9t\u00e9 envoy\u00e9e");			
				</script><?php
	}
?>
			
</body>

</html>