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




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Evento - Profil</title>
    <link rel="stylesheet" href="css/index.css"/>
    <link rel="stylesheet" href="css/themes/Evento.min.css"/>
    <link rel="stylesheet" href="css/themes/jquery.mobile.icons.min.css"/>
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body class="ui-mobile-viewport">
    <div data-role="page" class="ui-page" data-theme="b">
        <div data-role="header" role="banner" class="ui-header ui-bar-b">
            <a href="acceuil.php"  data-external-page="true" rel="external" class="ui-btn ui-corner-all ui-icon-delete ui-btn-icon-notext ui-btn-left">Fermer</a>
            <h1 class="ui-title lang" role="heading" aria-level="1" key="profil">Profil</h1>
        </div>
        <div role="main" class="ui-content">
            <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a username lang" key="changeId">Changer mes identifiants</a>
            <div id="user">
                <form action="profil.php" method='post'>
                    <table align="center" border="0">
                        <tr>
                            <td class="lang" key="name">Nom :</td>
                            <td><input type="text" name="newNom" maxlength="15" value= <?php $nomPrenom =  $db->query('select * from public."Client" where email = \''.$_SESSION['email'].'\';');
                                $dataU = $nomPrenom->fetch();
                                echo $dataU['nom'];
                                ?> >
                            </td>
                        </tr>
                        <tr>
                            <td class="lang" key="surname">Prenom :</td>
                            <td><input type="text" name="newPre" maxlength="15" value = <?php $nomPrenom =  $db->query('select * from public."Client" where email = \''.$_SESSION['email'].'\';');
                                $dataU = $nomPrenom->fetch();
                                echo $dataU['prenom'];
                                ?>>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><button type="submit" class="lang" key="valid">Valider</button></td>
                        </tr>
                    </table>
                </form>
            </div>
            <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a mdp lang" key="changeMDP">Changer mon mot de passe</a>
            <div id="mdpi">
                <form action="profil.php" method='post'>
                    <table align="center" border="0">
                        <tr>
                            <td class="lang" key="oldMDP">Ancien mot de passe :</td>
                            <td><input type="password" name="oldmdp" maxlength="15"></td>
                        </tr>
                        <tr>
                            <td class="lang" key="newMDP">Nouveau mot de passe :</td>
                            <td><input type="password" name="newmdp" maxlength="15"></td>
                        </tr>
                        <tr>
                            <td class="lang" key="confMDP">Confirmer nouveau mot de passe :</td>
                            <td><input type="password" name="newmdp2" maxlength="15"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><button type="submit" class="lang" key="valid">Valider</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div id="bloc2">
            <a href="#popupSuppr" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b lang" key="supprCompte">Supprimer mon compte...</a>
            <div data-role="popup" id="popupSuppr" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
                <div class="ui-content">
                    <h3 class="ui-title lang" key="surSupprCompte">Êtes-vous sûr de vouloir supprimer votre compte ?</h3>
                    <p class="lang" key="irreversible">Cette action est irréversible</p>
                    <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b lang" data-rel="back" key="annuler">Annuler</a>
                    <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b lang" data-rel="back" data-transition="flow" key="supprimer">Supprimer</a>
                </div>
            </div>
            <a href="#popupDeco" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b lang" key="decoCompte">Se déconnecter</a>
            <div data-role="popup" id="popupDeco" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
                <div class="ui-content">
                    <h3 class="ui-title lang" key="surDecoCompte">Êtes-vous sûr de vouloir vous déconnecter ?</h3>
                    <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b lang" data-rel="back" key="annuler">Annuler</a>
                    <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b lang" data-rel="back" data-transition="flow" key="decoCompte">Se déconnecter</a>
                </div>
            </div>
        </div>
    </div>

<?php  

   	      if(isset($_POST) && !empty($_POST['oldmdp']) && !empty($_POST['newmdp']) && !empty($_POST['newmdp2'])) {
  extract($_POST);



?>		
<script type="text/javascript">


</script>
<?php

$testMdp = $db->query('SELECT *
	FROM public."Client" where email = \''.$_SESSION['email'].'\';');


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

header('Location: 10.0.29.51/index.php'); 

	}else {

echo 'ok';

$requete9 = $db->query('
UPDATE public."Client"
SET mdp = \''.$newmdp2.'\'
WHERE email = \''.$_SESSION['email'].'\';');
?>
				<script type="text/javascript">
			window.location.href = "acceuil.php";			
						
			
		</script>

		<?php 
exit(); 



}


}else{

echo 'Il manque des donn�es';


}

?>
        
<?php  

   	      if(isset($_POST) && !empty($_POST['newNom']) && !empty($_POST['newPre'])) {
  extract($_POST);




$testMdp = $db->query('SELECT *
	FROM public."Client" where email = \''.$_SESSION['email'].'\';');


$test9 = 0;


	if($newNom == ' ' || $newPre == ' ' ){
	
	echo 'pas bon';
	}else{
	$test9 = 1;
	}

	if($test9 = 1){
	$requete9 = $db->query('
UPDATE public."Client"
SET nom = \''.$newNom.'\' WHERE email = \''.$_SESSION['email'].'\';');


$requete9 = $db->query('
UPDATE public."Client"
SET prenom = \''.$newPre.'\' WHERE email = \''.$_SESSION['email'].'\';');

?>

<script type="text/javascript">

window.location.reload();

</script>

<?php
exit();
	}else{
header('Location: 10.0.29.51/index.php'); 
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
WHERE email = \''.$_SESSION['email'].'\';');

?>
		
		<script type="text/javascript">
			console.log('ok');
			window.location.href = "acceuil.php";			
				console.log('ok');		
			
		</script>

		<?php 
exit();
	}else{
header('Location: 10.0.29.51/index.php'); 
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
WHERE email = \''.$_SESSION['email'].'\';');

?>

<script type="text/javascript">

window.location.reload();

</script>

<?php
exit();
	}else{
header('Location: 10.0.29.51/index.php'); 
}



}


?>

    <script type="text/javascript" src="js/profil.js"></script>
    <script type="text/javascript" src="js/lang.js"></script>
</body>
</html>