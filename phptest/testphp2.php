<?php
session_start(); 
$_SESSION['email'] = 'Pierre@test';
?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Evento test 2</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <meta name="keywords">        
    </head>
    <body>
		<script type="text/javascript">
        		var aTags = [];
        	</script>


<?php
        try {
		$db = new PDO('pgsql:host=localhost;dbname=evento','postgres','evento');        
        } catch(Exception $e){
       		die('Erreur : '.$e->getMessage());
	}        
?>        

<form action="testphp2.php" method='post'>
<table align="center" border="0">
  <tr>
    <td>Rechercher :</td>
    <td><input type="text" name="recherche" maxlength="50"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" value="Valider"></td>
  </tr>
</table>
</form> 
      
  <?php   
	if(isset($_POST) && !empty($_POST['recherche'])) {
		extract($_POST);
		$recherche = $_POST['recherche'].' ';
	}else{
		echo 'wesh alors';
	}
    ?> 
<div data-role="panel" id="panel-reveal"class="ui-panel ui-panel-position-left ui-panel-display-reveal ui-body-inherit ui-panel-animate ui-panel-open">
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
							?><input type="submit" value="Ajouter"><?php
						}
					}else{
						?> <p>t'a deja envoyer une requette</p> <?php
					}		
					array_push($buf, $donnees['email']);
					?></div>
                			
				<?php
				echo "--------";
				} 	
            		}}
			$rch1 = strtok(' ');
		}



	
?>

<?php 
echo $_SESSION['email'];
$nb =  $db->query('select demande_ami from public."Client" where email = \''.$_SESSION['email'].'\';'); 
$nba = $nb->fetch();

$tab0 = strtok($nba[0], '{');
$tab1 = strtok($tab0, '}');
$tab2 = strtok($tab1, ',');
while($tab2 !== false){
echo $tab2.'<br/>';
$tab2 = strtok(',');
}
?>

</div>
        
</body>
</html>