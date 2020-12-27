<?php
session_start(); 
if(isset($_SESSION['email'])){
   $url = $_SESSION['url'];
 }
else{
	$url = "index.php";
	header("Location: http://10.0.29.51/$url");}
try {

$db = new PDO('pgsql:host=localhost;dbname=evento','postgres','evento');
        
        } catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
       ?>

<!DOCTYPE html>
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
<div data-role="page" class=" ui-page" data-theme="b">

    <div data-role="header" class="ui-header ui-bar-inherit" role="banner">
        <a href="acceuil.php" rel="external" class="ui-btn ui-icon-home ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-notext ui-mini">::after</a>
        <h1>Evento</h1>
    </div>
    <div role="main" class="ui-content ui-body-inherit">
        <?php
        $even =  $db->query('select * from public."Evenement" where id_evenement = \''.$_GET['param'].'\';');
        $donnees = $even->fetch();
        ?>
        <label><?php echo $donnees['titre']; ?></label>
        <p><?php echo $donnees['date']; ?> </p>
        <p><?php echo $donnees['heure_d']; ?> jusqu'à <?php echo $donnees['heure_f']; ?></p>
        <p><?php echo $donnees['description']; ?></p>
        <p><?php echo $donnees['position']; ?></p>
        <p><?php echo $donnees['prix']; ?> euros</p>
        <p><?php echo $donnees['participants']; ?> participants</p>
        <p><?php echo $donnees['lien_facebook']; ?> euros</p>
        <br/>

	<form action="infoEv.php?param=<?php echo $_GET['param'];?>" method='get'>

<input type="hidden" name="ins_event" value="<?php echo $_GET['param']; ?>">
<input type="submit" value="S'inscrire">

	</form>


        <form action="infoEv.php?param=<?php echo $_GET['param'];?>" method='get'>

<input type="hidden" name="id_event" value="<?php echo $_GET['param']; ?>">
<input type="submit" value="Se desinscrire">

	</form>

	<form action="infoEv.php?param=<?php echo $_GET['param'];?>" method='get'>

<input type="hidden" name="sign_event" value="<?php echo $_GET['param']; ?>">
<input type="submit" value="signaler">

	</form>

    </div>
</div>



<?php if(isset($_GET['ins_event'])){

$requete22 = $db->query('Insert into public."Participant"(
	email_c, id_e) VALUES (\''.$_SESSION['email'].'\', \''.$_GET['param'].'\');');


}
?>





<?php if(isset($_GET['id_event'])){

$requete20 = $db->query('DELETE FROM public."Participant" WHERE email_c = \''.$_SESSION['email'].'\' AND id_e = \''.$_GET['param'].'\';');


}
?>

<?php if(isset($_GET['sign_event'])){


$requete21 = $db->query('INSERT INTO public."Signalement" (id_e_s) VALUES (\''.$_GET['param'].'\');');


}
?>


</body>
</html>




<script type="text/javascript" src="js/lang.js"></script>
</body>
</html>