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

<!doctype html>
<html>
<head class="ui-mobile ">
    <title>Evento</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
   integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
   crossorigin=""></script>

    <link rel="stylesheet" href="css/index.css"/>
    <link rel="stylesheet" href="css/themes/Evento.min.css"/>
    <link rel="stylesheet" href="css/themes/jquery.mobile.icons.min.css"/>
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body class="ui-mobile-viewport">
<div data-role="page" class=" ui-page ui-page-activ" data-theme="b" id="main">

    <div data-role="panel" id="panel-reveal" class="ui-panel ui-panel-position-left ui-panel-display-reveal ui-body-inherit ui-panel-animate ui-panel-open">
        <div class="ui-panel-inner">
            <ul data-role="listview" class="ui-listview">
                <li data-icon="delete" class="ui-first-child"><a href="#" data-rel="close" class="ui-btn ui-btn-icon-right ui-icon-delete lang" key="fermer">Fermer</a></li>
                <li><input type="search" name="search-mini" id="search-Event" value="" data-theme="a" data-mini="true" /></li>
                <li><a href="#param" class="ui-shadow ui-btn ui-btn-icon-right ui-icon-gear lang" data-transition="flip" key="param">Paramètres</a></li>
		        <li data-role="list-divider" role="heading" class="ui-li-divider ui-bar-inherit lang" key="myEvent">Mes événements</li>
                <?php
                $even =  $db->query('select titre,id_evenement from public."Evenement" inner join public."Participant" on id_e = id_evenement where email_c like \''.$_SESSION['email'].'\';');
                    while ($donnees3 = $even->fetch() )
                            {
                $valeur = $donnees3['id_evenement'];
                            ?>
                            <li><a href="infoEv.php?param=<?php echo $valeur;?>" class="ui-btn ui-btn-icon-right ui-icon-carat-r">
                            <?php echo $donnees3['titre'];
                            ?>
                            </a></li><?php
                    }
       	 	    ?>
                <li data-role="list-divider" role="heading" class="ui-li-divider ui-bar-inherit lang" key="categorie" >Categories</li>
                <li><a href="#sport-page" class="ui-btn ui-btn-icon-right ui-icon-carat-r lang" key="sport" >Sport</a></li>
                <li><a href="#soiree-page" class="ui-btn ui-btn-icon-right ui-icon-carat-r lang"  key="soiree" >Soirée</a></li>
                <li class="ui-last-child"><a href="#culturel-page" class="ui-btn ui-btn-icon-right ui-icon-carat-r lang" key="culturel">Culturel</a></li>
            </ul>
            <br>
            <br>
        </div>
    </div>

    <div data-role="header" class="ui-header ui-bar-inherit" role="banner">
        <a href="#panel-reveal" class="ui-btn ui-icon-bars ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-notext ui-mini">::after</a>
        <h1>Evento</h1>
        <a href="#friend" class="ui-btn ui-icon-user ui-btn-icon-notext ui-mini ui-shadow ui-corner-all">::after</a>
    </div>

    <div role="main" class="ui-content">
        <div id="map"></div>
    </div>


    <div data-role="panel" data-position="right" id="friend" class="ui-panel ui-panel-position-right ui-panel-display-reveal ui-body-inherit ui-panel-animate ui-panel-open">
        <div class="ui-panel-inner">
            <ul data-role="listview" class="ui-listview">
                <li data-icon="delete" class="ui-first-child"><a href="#" data-rel="close" class="ui-btn ui-btn-icon-left ui-icon-delete lang" key="fermer">Fermer</a></li>
                <li><a href="profil.php" class="ui-shadow ui-btn ui-btn-icon-left ui-icon-star" rel="external" data-transition="flip"><?php $nomPrenom =  $db->query('select * from public."Client" where email = \''.$_SESSION['email'].'\';');
                        $dataU = $nomPrenom->fetch();
                        echo $dataU['prenom'];
                        echo ' ';
                        echo $dataU['nom'];
                        ?>
                    </a>
                </li>
                <li data-role="list-divider" role="heading" class="ui-li-divider ui-bar-inherit"><span class="lang" key="askfriend">Demandes d'amis</span>
                    <?php //recuperer les demandes d'amis
                        $nb =  $db->query('select demande_ami from public."Client" where email = \''.$_SESSION['email'].'\';');
                        $nba = $nb->fetch();
                        $tab0 = strtok($nba[0], '{');
                        $tab1 = strtok($tab0, '}');
                        $tab2 = strtok($tab1, ',');
                        echo substr_count($tab1, ',')+1;
                    ?>
                </li>
                <?php   //aficher les demandes d'amis
                    while($tab2 !== false){
                        echo $tab2.'<br/>';
                        $tab2 = strtok(',');
                    }
                ?>
                <li data-role="list-divider" role="heading" class="ui-li-divider ui-bar-inherit lang" key="amis">Amis</li>
                <form action="recherche.php" method='post'>
                    <li>
                        <input type="search" name="recherche" id="search-Ami" data-theme="a" data-mini="true" />
                        <button type="submit" class="lang" key="chercher">Rechercher</button>
                    </li>
                </form>
                    <?php
                        $rep =  $db->query('SELECT email_a
                            FROM public."ListeAmis" where email_c like \''.$_SESSION['email'].'\';'
                            );
                        while ($don = $rep->fetch()){
                            $rep2 =  $db->query('SELECT nom, prenom
                                FROM public."Client" where email like \''.$don['email_a'].'\';'
                            );
                            while ($don2 = $rep2->fetch()){ ?>
                                <li><a href="#friend-page" class="ui-btn ui-btn-icon-left ui-icon-carat-l">
                                <?php echo $don2['nom'].' '.$don2['prenom']; ?>
                                </a></li><?php
                            }
                                }
                    ?>
		    </ul>
            <br>
            <br>
        </div>
    </div>

    <div data-role="panel" data-position="right" id="friend-page" class="ui-panel ui-panel-position-right ui-panel-display-reveal ui-body-inherit ui-panel-animate ui-panel-open">
        <ul data-role="listview" class="ui-listview">
            <li data-icon="delete" class="ui-first-child"><a href="#friend" data-rel="close" class="ui-btn ui-btn-icon-left ui-icon-delete lang" key="fermer">Fermer</a></li>
        </ul>
    </div>

     <div data-role="panel" data-position="left" id="sport-page" class="ui-panel ui-panel-position-left ui-panel-display-reveal ui-body-inherit ui-panel-animate ui-panel-open">
        <ul data-role="listview" class="ui-listview">
            <li data-icon="delete" class="ui-first-child"><a href="#panel-reveal" data-rel="close" class="ui-btn ui-btn-icon-left ui-icon-delete lang" key="fermer">Fermer</a></li>
            <?php
            $even =  $db->query('select titre,id_evenement from public."Evenement" where categorie = \'sport\';');
            while ($donnees3 = $even->fetch() ) {
                ?>
                <li><a href="infoEv.php?param=<?php echo $donnees3['id_evenement'];?>" rel="external" class="ui-btn ui-btn-icon-right ui-icon-carat-r">
                <?php echo $donnees3['titre']; ?>
                </a></li>
                <?php
            }
            ?>
        </ul>
    </div>


     <div data-role="panel" data-position="left" id="soiree-page" class="ui-panel ui-panel-position-left ui-panel-display-reveal ui-body-inherit ui-panel-animate ui-panel-open">
        <ul data-role="listview" class="ui-listview">
            <li data-icon="delete" class="ui-first-child"><a href="#panel-reveal" data-rel="close" class="ui-btn ui-btn-icon-left ui-icon-delete lang" key="fermer">Fermer</a></li>
            <?php
            $even =  $db->query('select titre,id_evenement from public."Evenement" where categorie = \'soiree\';');
	        while ($donnees3 = $even->fetch() ) {
                ?>
                <li><a href="infoEv.php?param=<?php echo $donnees3['id_evenement'];?>" rel="external" class="ui-btn ui-btn-icon-right ui-icon-carat-r">
                <?php echo $donnees3['titre']; ?>
                </a></li><?php
            }
            ?>
        </ul>
    </div>

    <div data-role="panel" data-position="left" id="culturel-page" class="ui-panel ui-panel-position-left ui-panel-display-reveal ui-body-inherit ui-panel-animate ui-panel-open">
        <ul data-role="listview" class="ui-listview">
            <li data-icon="delete" class="ui-first-child"><a href="#panel-reveal" data-rel="close" class="ui-btn ui-btn-icon-left ui-icon-delete lang" key="fermer">Fermer</a></li>
            <?php
            $even =  $db->query('select titre, id_evenement from public."Evenement" where categorie = \'Culturel\';');
            while ($donnees3 = $even->fetch() ) {
                ?>
                <li><a href="infoEv.php?param=<?php echo $donnees3['id_evenement'];?>" rel="external" class="ui-btn ui-btn-icon-right ui-icon-carat-r">
                <?php echo $donnees3['titre']; ?>
                </a></li><?php
                }
            ?>
        </ul>
    </div>

    <div data-role="footer" data-position="fixed">
        <a href="evenement.html"  rel="external" id="event" class="ui-btn lang" key="event" data-transition="slideup">Créer un évènement</a>
    </div>
</div>





<div data-role="page" id="param" data-external-page="true" tabindex="0" data-theme="b" class="ui-page">
    <div role="dialog" class="ui-dialog-contain ui-overlay-shadow ui-corner-all">
        <div data-role="header" role="banner" class="ui-header ui-bar-b">
            <a href="#main" class="ui-btn ui-corner-all ui-icon-delete ui-btn-icon-notext ui-btn-left lang" key="fermer" data-rel="back">Fermer</a>
            <h1 class="ui-title lang" key="param" role="heading" aria-level="1">Paramètres</h1>
        </div>
        <div role="main" class="ui-content">
            <a href="#" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a translation lang" id="fr" key="fr">Français</a>
            <a href="#" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a translation lang" id="en" key="en">Anglais</a>
            <a href="#" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a translation lang" id="es" key="es">Espagnol</a>
            <a href="conditions.html" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a">Condition</a>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src="js/lang.js"></script>
</body>

</html>