<!DOCTYPE html>
<html>
    
    <head>
	<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Evento php</title>

        <meta name="description" content="An interactive getting started guide for Brackets.">
        <meta name="keywords">        
    </head>
    <body>

<?php
        try {

$db = new PDO('pgsql:host=localhost;dbname=evento','postgres','evento');
        
        } catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
       ?>
        
        <?php
       $reponse =  $db->query('SELECT *
	FROM public."Client"');

            while ($donnees = $reponse->fetch())

                {
                ?>
                E mail :
                <?php
                echo $donnees['email'];
                ?>
                <br>
                Mot de passe :
                <?php
                echo $donnees['mdp'];
                ?>
                <br>
                Nom :
                <?php
                echo $donnees['nom'];
                ?>
                <br>
                Prenom :
                <?php
                echo $donnees['prenom'];
                ?>
                <br>
                ------------------------
                <br>
                <?php
            }
        
?>
        
        
         <br>
      --------------------------------------------------------------------------------------------  
        <h1>User Pierre</h1>
        
              
         <?php
   $user = 'Pierre@test';


       
       $lucas =  $db->query('SELECT *
	FROM public."ListeAmis" where email_c like \''.$user.'\';');
       
            while ($donnees2 = $lucas->fetch() )

                {
                ?>
                Amis :
                <?php
                echo $donnees2['email_a'];
                ?>
                <br>
                ------------------------
                <br>
                <?php
            }
         $lucas2 =  $db->query('select titre from public."Evenement" inner join public."Participant" on id_e = id_evenement where email_c like \''.$user.'\' ;');


            while ($donnees3 = $lucas2->fetch() )

                    {
                    ?>
                    Titre evenement :
                    <?php
                    echo $donnees3['titre'];
                    ?>
                    <br>
                    ------------------------
                    <br>
                    <?php
            }
    
        ?>
        <br>
----------------------------------------------------------------------        
      <h1>Connection </h1> 

<form action="testphp.php" method='post'>
<table align="center" border="0">
  <tr>
    <td>Mail :</td>
    <td><input type="email" name="login" maxlength="250"></td>
  </tr>
  <tr>
    <td>Mot de passe :</td>
    <td><input type="password"name="pass" maxlength="10"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" value="log in"></td>
  </tr>
</table>
</form> 
      

  <?php  

   	      if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['pass'])) {
  extract($_POST);

	$monLog = $_POST['login']; 
	echo $pass;
	echo $login;
  $testMdp = $db->query('SELECT *
	FROM public."Client" where email = \''.$login.'\';');   

  $data = $testMdp->fetch();
	

  if($data['mdp'] != $pass) {
echo $data['email'];	

    echo '<p>Mauvais login / password. Merci de recommencer</p>';
    
  
  }
  else {
    echo '<p>Vous avez été logé.</p>';
    header('Location: http://10.0.29.51/acceuil.php');
    }   
}
else {
  echo '<p>Vous avez oublié de remplir un champ.</p>';
   
   
}
    ?>
        
-----------------------------------------------------------------------------------------------

<h1>Enregistrement</h1>

<form action="testphp.php" method='post'>
<table align="center" border="0">
  <tr>
    <td>Mail :</td>
    <td><input type="email" name="email" maxlength="250"></td>
  </tr>
  <tr>
    <td>Nom :</td>
    <td><input type="text"name="Nom" maxlength="10"></td>
  </tr>
<tr>
    <td>Prenom :</td>
    <td><input type="text"name="Prenom" maxlength="10"></td>
  </tr>
<tr>
    <td>Mot de passe :</td>
    <td><input type="password"name="MotDePasse" maxlength="15"></td>
  </tr>
<tr>
    <td>Confirmer mot de passe :</td>
    <td><input type="password"name="MotDePasse2" maxlength="15"></td>
  </tr>



  <tr>
    <td colspan="2" align="center"><input type="submit" value="Termine"></td>
  </tr>
</table>
</form> 

<?php
if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['pass'])) {

extract($_POST);


$testEmail = $db->query('SELECT email
	FROM public."Client"');
$test = 0;
$test2 = 0;
$test3 = 0;
$test4 = 0;
$test5 = 0;
		while ($data4 = $testEmail->fetch()){

		if($data4['email'] == $_POST['email'] || $_POST['email'] == ''){

			
			$test = 2;

		}
		}

		if($test == 2){
			echo 'Entrer une adresse mail non utilisée';		
		}else{
		$test = 1;
		}
			   
                if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $_POST['MotDePasse'])) {
       		$test2 = 1;

		}else {
		echo 'Le mot de passe doit etre d au moin 6 car et avoir une maj et un chiffre';
		$test2 = 0;
		}

		if($test2 == 1){
			if($_POST['MotDePasse'] == $_POST['MotDePasse2']){
			$test3 = 1;

			}else{
			echo 'pas le meme mdp';
			}
		}   

		if($_POST['Nom'] != ''){
		$test4 = 1;
		}else{
		echo 'Rentrer un nom';
		}

		if($_POST['Prenom'] != ''){
		$test5 = 1;
		}else{
		echo 'Rentrer un prenom';
		}

		if($test != 1 || $test2 != 1 || $test3 != 1 || $test4 != 1 || $test5 != 1 ){
		if(mail == ''){
echo '   pas reload';

}else{
		echo '  reload';
}
		}else{
		
				echo ' tout ok';
		}
}
?>

<br>
-----------------------------------------------------------------------------------------------

<h1>Recherche</h1>


     

<form action="testphp.php" method='post'>
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
		$recherche = $_POST['recherche'];
	}else{
		echo 'wesh alors';
	}
    ?> 

<?php	
	$recherche = strtoupper($recherche); 
	if(strpos($recherche, ' ') == false){
		$reponse =  $db->query('SELECT *
			FROM public."Client" where UPPER(nom) like \''.$recherche.'\' 
			OR UPPER(prenom) like \''.$recherche.'\'
			OR UPPER(email) like \''.$recherche.'\';'
			);

       		while ($donnees = $reponse->fetch()){
                	?>
                		E mail :
               	 	<?php
                		echo $donnees['email'];
                	?>
                	<br>
                		Mot de passe :
                	<?php
                		echo $donnees['mdp'];
                	?>
                	<br>
                		Nom :
                	<?php
                		echo $donnees['nom'];
               		?>
                	<br>
                		Prenom :
                	<?php
                		echo $donnees['prenom'];
                	?>
			<br>
			<form>
    			<input type="submit" name="envoyer" value="ajouter en amis" onclick="afficher();">
			</form>                	
			<br>
			------------------------
                	<br>
                	<?php
            	}
	}else{
		$rch1 = strtok($recherche, ' ');
		while($rch1 !== false){						
			$reponse =  $db->query('SELECT *
			FROM public."Client" where UPPER(nom) like \''.$rch1.'\' 
			OR UPPER(prenom) like \''.$rch1.'\'
			OR UPPER(email) like \''.$rch1.'\';'
			);

			echo 'SELECT *
			FROM public."Client" where UPPER(nom) like \''.$rch1.'\' 
			OR UPPER(prenom) like \''.$rch1.'\'
			OR UPPER(email) like \''.$rch1.'\';' ;

       			while ($donnees = $reponse->fetch()){
                	?>
                		E mail :
               	 	<?php
                		echo $donnees['email'];
                	?>

                	<br>
                		Mot de passe :
                	<?php
                		echo $donnees['mdp'];
                	?>
                	<br>
                		Nom :
                	<?php
                		echo $donnees['nom'];
               		?>
                	<br>
                		Prenom :
                	<?php
                		echo $donnees['prenom'];
                	?>
			<form>
			<br>
    			<input type="submit" name="envoyer" value="ajouter en amis" onclick="afficher();">
			</form>                 	
			<br>
                	------------------------
                	<br>
                	<?php
            		}
		$rch1 = strtok(' ');
		}
	}
	
  
?>

        
<br>
-----------------------------------------------------------------------------------------------

<h1>Changer mdp</h1>
<form action="testphp.php" method='post'>
<table align="center" border="0">
  <tr>
    <td>Ancien mot de passe :</td>
    <td><input type="password" name="oldmdp" maxlength="15"></td>
  </tr>
  <tr>
    <td>Nouveau mot de passe :</td>
    <td><input type="password"name="newmdp" maxlength="15"></td>
  </tr>
  <tr>
<td>Confirmer nouveau mot de passe :</td>
    <td><input type="password"name="newmdp2" maxlength="15"></td>
  </tr>
  <tr>

    <td colspan="2" align="center"><input type="submit" value="log in"></td>
  </tr>
</table>
</form> 



 <?php  

   	      if(isset($_POST) && !empty($_POST['oldmdp']) && !empty($_POST['newmdp']) && !empty($_POST['newmdp2'])) {
  extract($_POST);

$user = 'Pierre@test';


$testMdp = $db->query('SELECT *
	FROM public."Client" where email = \''.$user.'\';');


$test6 = 0;
$test7 = 0;
$test8 = 0;



	while ($data10 = $testMdp->fetch()){

		if($data10['mdp'] == $oldmdp){		
			$test7 = 1;
		}
	}


        if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $_POST['newmdp2'])) {
       		$test6 = 1;

		}else {
		echo 'Le mot de passe doit etre d au moin 6 car et avoir une maj et un chiffre';
		$test6 = 0;
	}

	if ($newmdp == $newmdp2){
		$test8 = 1;
	}

	if($test6 != 1 || $test7 != 1 || $test8 != 1 ){

	}else {

echo 'ok';

$requete9 = $db->query('
UPDATE public."Client"
SET mdp = \''.$newmdp2.'\'
WHERE email = \''.$user.'\';');

}

echo $test6;
echo $test7;
echo $test8;

}else{

echo 'Il manque des données';


}

?>



<br>
-----------------------------------------------------------------------------------------------

<h1>Changer id</h1>


<form action="testphp.php" method='post'>
<table align="center" border="0">
  <tr>
    <td>Nom :</td>
    <td><input type="text" name="newNom" maxlength="15"></td>
  </tr>
  <tr>
    <td>Prenom :</td>
    <td><input type="text"name="newPre" maxlength="15"></td>
  </tr>
  <tr>

    <td colspan="2" align="center"><input type="submit" value="log in"></td>
  </tr>
</table>
</form> 


<?php  

   	      if(isset($_POST) && !empty($_POST['newNom']) && !empty($_POST['newPre'])) {
  extract($_POST);

$user = 'Pierre@test';


$testMdp = $db->query('SELECT *
	FROM public."Client" where email = \''.$user.'\';');


$test9 = 0;


	if($newNom == ' ' || $newPre == ' ' ){
	
	echo 'pas bon';
	}else{
	$test9 = 1;
	}

	if($test9 = 1){
	$requete9 = $db->query('
UPDATE public."Client"
SET nom = \''.$newNom.'\' WHERE email = \''.$user.'\';');


$requete9 = $db->query('
UPDATE public."Client"
SET prenom = \''.$newPre.'\' WHERE email = \''.$user.'\';');


	}





}else{
echo 'les deux champs sont vide';
}






if(isset($_POST) && empty($_POST['newNom']) && !empty($_POST['newPre'])) {
  extract($_POST);

$test9 = 0;


if($newNom == ' ' || $newPre == ' '){
	

echo 'pas bon';
	}else{
	$test9 = 1;
	}

	if($test9 = 1){
	$requete9 = $db->query('
UPDATE public."Client"
SET prenom = \''.$newPre.'\'
WHERE email = \''.$user.'\';');
	}



}





if(isset($_POST) && !empty($_POST['newNom']) && empty($_POST['newPre'])) {
  extract($_POST);

$test9 = 0;


if($newNom == ' ' || $newPre == ' '){
	

echo 'pas bon';
	}else{
	$test9 = 1;
	}

	if($test9 = 1){
	$requete9 = $db->query('
UPDATE public."Client"
SET nom = \''.$newNom.'\'
WHERE email = \''.$user.'\';');
	}



}


?>
        
</body>
</html>
