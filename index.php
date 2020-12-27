<?php
	session_start();
	$_SESSION['url'] = $_SERVER['REQUEST_URI'];
	$_SESSION['email'];
?>
<html lang="fr">
<head class="ui-mobile">
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script type="text/javascript" src="inscription.js"></script>

    <title>Connexion Evento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="css/index.css">
    </head>

<body class="ui-mobile-viewport">

<div data-role="page" class="iu-page background" data-theme="b">
    <div role="main" id="main_page" class="ui-content ui-shadow">
        <h1 id="logoCo">Evento</h1>

        <a href="#popupInscription" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a centre2" id="centre2" data-transition="pop" >Inscription </a>
        <div data-role="popup" id="popupInscription" data-theme="b" class="ui-corner-all ui-content">
        <div>
                    <form action="index.php" method='post'>
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
    <td>Mot de passe :<br></td>

    <td><input type="password"name="MotDePasse" maxlength="15"></td>
  </tr>
<tr>
    <td>Confirmer mot de passe :</td>
    <td><input type="password"name="MotDePasse2" maxlength="15"></td>
  </tr>
<tr>
    <td>Condition d'utilisation :</td>
    <td><input type="radio" "name="radio"></td>
  </tr>

  <tr>
      <td>Le mot de passe doit etre compose de 6 caracteres minimum et contenir une majuscule et un chiffre</td><br/><br/>
      <td><a href="conditions.html">Conditions ?</a></td>
  </tr>
	<tr>
    <td colspan="2" align="center"><input type="submit" value="Termine" onload="refresh();"></td>
  </tr>
</table>
</form> 
<?php
try {
$db = new PDO('pgsql:host=localhost;dbname=evento','postgres','evento');
} catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
} 


if(isset($_POST) && !empty($_POST['email']) && !empty($_POST['Nom']) && !empty($_POST['Prenom']) && !empty($_POST['MotDePasse']) && !empty($_POST['MotDePasse2'])) {

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
?><br><?php		
}else{
$test = 1;
}			   
if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $_POST['MotDePasse'])) {
$test2 = 1;
}else {		

?><br><?php
$test2 = 0;
}
if($test2 == 1){
if($_POST['MotDePasse'] == $_POST['MotDePasse2']){
$test3 = 1;
}else{
echo 'pas le meme mdp';
?><br><?php
}
}   
if($_POST['Nom'] != ''){
$test4 = 1;
}else{
echo 'Rentrer un nom';
?><br><?php
}
if($_POST['Prenom'] != ''){
$test5 = 1;
}else{

echo 'Rentrer un prenom';
?><br><?php
}

if($test != 1 || $test2 != 1 || $test3 != 1 || $test4 != 1 || $test5 != 1 && $mdp != ''){

	
header('Location: 10.0.29.51/index.php');  

}else{	

	
$requete9 = $db->query('INSERT INTO public."Client"(
email, mdp, nom, prenom)
VALUES (\''.$email.'\', \''.$MotDePasse2.'\', \''.$Nom.'\', \''.$Prenom.'\')')or die(mysql_error());

?>		
<script type="text/javascript">
window.location.href = "acceuil.php";
</script>
<?php

}
}else{
}
?>
 
 <a href="#main" data-rel="back" class="ui-btn ui-shadow ui-corner-all">Retour</a>

                </div>           
        </div>

        <a href="#popupConnexion" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a centre2" id="centre2" data-transition="pop" >Connexion </a>
        <div data-role="popup" id="popupConnexion" data-theme="b" class="ui-corner-all ui-content">

           <form action="index.php" method='post'>
		<table align="center" border="0">
  		<tr>
    			<td>Mail :</td>
    			<td><input type="email" name="login" maxlength="250"></td>
  		</tr>
  		<tr>
    			<td>Mot de passe :</td>
   		 	<td><input type="password"name="pass" maxlength="15"></td>
  		</tr>
  		<tr>
    			<td colspan="2" align="center"><input type="submit" value="Connexion"></td>


  		</tr>
		</table>
	</form> 
<?php
try {
$db = new PDO('pgsql:host=localhost;dbname=evento','postgres','evento');
} catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}  
if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['pass'])) {
extract($_POST);
$testMdp = $db->query('SELECT * FROM public."Client" where email = \''.$login.'\';');   
$data = $testMdp->fetch();
if($data['mdp'] != $pass) {
header('Location: 10.0.29.51/index.php');  
}
else {
$_SESSION['email'] = $_POST['login'];

?>

<script type="text/javascript">

window.location.href = "acceuil.php";

</script>

<?php
exit(); 
} 
}
?>

         </div>
    </div>
</div>    

</body>
</html>