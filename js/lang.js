console.log("Js lang loaded");
var arrLang = {
    "en": {
        "param": "Parameters",
        "categorie": "Categories",
        "soiree": "Party",
        "sport": "Sport",
        "culturel": "Cultural",
        "fermer": "Close",
        "fr": "French",
        "en": "English",
        "es": "Spanish",
        "profil": "Profile",
        "amis": "Friends",
        "event" : "Create an event",
        "name": "Name",
        "lieu": "Place",
        "date": "Date",
        "hdebut": "From :",
        "hfin": "To :",
        "valid": "Submit",
        "changeId": "Change login",
        "surname":"Surname",
        "oldMDP": "Old Password",
        "newMDP":"New Password",
        "confMDP":"Confirm Password",
        "changeMDP":"Change password",
        "supprCommpte":"Delete my account",
        "surSupprCompte":"Are you sure you want to delete your account?",
        "irreversible":"This action cannot be undone",
        "annuler":"Cancel",
        "supprimer":"Delete",
        "decoCompte":"Log out",
        "surDecoCompte":"Are you sure you want to log out?",
        "myEvent":"My Events",
        "chercher":"Search",
        "askfriend":"Friend Request",
        "genre":"Type"
    },

    "fr": {
        "param": "Paramètres",
        "categorie": "Catégories",
        "sport": "Sport",
        "soiree": "Soirée",
        "culturel": "Culturel",
        "fermer": "Fermer",
        "francais": "Francais",
        "anglais": "Anglais",
        "es": "Espagnol",
        "profil": "Profil",
        "amis": "Amis",
        "event": "Crée un évènement",
        "name": "Nom",
        "lieu": "Lieu",
        "date": "Date",
        "hdebut": "Debut :",
        "hfin": "Fin :",
        "valid": "Valider",
        "changeId": "Changer les identifiants",
        "surname":"Prénom",
        "oldMDP": "Ancien mot de passe",
        "newMDP":"Nouveau mot de passe",
        "confMDP":"Confirmer le mot de passe",
        "changeMDP":"Changer le mot de passe",
        "supprCompte":"Supprimer mon compte",
        "surSupprCompte":"Êtes-vous sûr de vouloir supprimer votre compte ?",
        "irreversible":"Cette action est irréversible",
        "annuler":"Annuler",
        "supprimer":"Supprimer",
        "decoCompte":"Se déconnecter",
        "surDecoCompte":"Êtes-vous sûr de vouloir vous déconnecter ?",
        "myEvent":"Mes Evènements",
        "chercher":"Rechercher",
        "askfriend":"Demandes d'Amis",
        "genre":"Genre"
    },

    "es": {
        "param": "Configuraciones",
        "categorie": "Categorias",
        "sport": "Deporte",
        "soiree": "Noches",
        "culturel": "Cultura",
        "fermer": "Cercar",
        "fr": "Frances",
        "en": "Ingles",
        "es": "espanol",
        "profil": "Perfil",
        "amis": "Amigos",
        "event": "Crear un evento",
        "name": "Apellido",
        "lieu": "Lugar",
        "date": "Fecha",
        "hdebut": "Inicio :",
        "hfin": "Fin :",
        "valid": "Validar",
        "changeId": "Changer de login",
        "surname":"Nombre",
        "oldMDP": "Antigua contraseña",
        "newMDP":"Nueva contraseña",
        "confMDP":"Confirmar contraseña",
        "changeMDP":"cambiar de contraseña",
        "supprCompte":"Cancelar mi cuenta",
        "surSupprCompte":"¿Estás seguro de que quieres suprimir tu cuenta?",
        "irreversible":"Esta acción es irreversible",
        "annuler":"Anulador",
        "supprimer":"Suprimir",
        "decoCompte":"Desconectar",
        "surDecoCompte":"¿Estás seguro de que quieres cerrar sesión?",
        "myEvent":"Mi Eventos",
        "chercher":"Buscar",
        "askfriend":"Solicitud de Amigos",
        "genre":"Especie"
    }
};
var lang=(navigator.language.slice(0,2));

console.log(lang);

$(function(){
    $('.translation').click(function(){
        lang = $(this).attr('id');

        $('.lang').each(function(index, element){
            $(this).text(arrLang[lang][$(this).attr('key')]);
        })
    });
});

$(function(){
    $('.lang').each(function(index,element){
        $(this).text(arrLang[lang][$(this).attr('key')]);
    })
});