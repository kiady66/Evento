console.log("js load");
var app = {
    // Application Constructor
    initialize: function() {
        document.addEventListener('deviceready', this.onDeviceReady.bind(this), false);
    },

    // deviceready Event Handler
    //
    // Bind any cordova events here. Common events are:
    // 'pause', 'resume', etc.
    onDeviceReady: function() {
        this.receivedEvent('deviceready');
    },

    // Update DOM on a Received Event
    receivedEvent: function(id) {
        var parentElement = document.getElementById(id);
        var listeningElement = parentElement.querySelector('.listening');
        var receivedElement = parentElement.querySelector('.received');

        listeningElement.setAttribute('style', 'display:none;');
        receivedElement.setAttribute('style', 'display:block;');

        console.log('Received Event: ' + id);
    }
};


window.onload=function () {

    app.initialize();


    //definir une coordonne pour pouvoir l'ajouter aï¿½ l'evenement
    var ny=[43.7245864, 7.285301599999999];



//instancier la variable pour la carte
    var map = L.map('map').setView(ny, 6);
    var CurrentLatitude;
    var CurrentLongitude;

//ajouter image de la carte
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 15,
        minZoom: 5
    }).addTo(map);

//initialisation des icons
    var logo= L.icon({
        iconUrl: 'image/logo.png',
        iconSize: [32, 32],
    });

    var event= L.icon({
        iconUrl: 'image/evenement.png',
        iconSize: [32,32]
    });

    //affichage des données de l'api sur la carte
    var callBackGetSuccess = function(data) {
        for(var i=0; i<data.records.length; i++){
            afficherEvenement(data.records[i].fields.title, data.records[i].fields.description, data.records[i].fields.latlon[0], data.records[i].fields.latlon[1]);
            console.log(data.records[i].fields.title);
        }

    }

    lol();

//Ajout d'un marqueur lors d'un clic
    map.on('click', addMarker);

    var newMarker;
    var existing=false;
    function addMarker(e){
        // Add marker to map at click location; add popup window

        if(existing){
            map.removeLayer(newMarker);
        }


        newMarker = new L.marker(e.latlng).addTo(map);
        newMarker.bindPopup("titre: </br>participant:  " );
        existing=true;
        //recuperation des coordonnees du marqueur
        var latitude=e.latlng.lat;
        var longitude=e.latlng.lng;
        console.log(latitude);
        console.log(longitude);

    }

    //recuperation des evenements dans la base de données

    var xhr= new XMLHttpRequest();
    xhr.onreadystatechange =function(){
        if(this.readyState==4){

           var tableau= JSON.parse(this.response);
            for  (var i=0; i<tableau.length; i++){
                    afficherEvenement(tableau[i][0], tableau[i][1], tableau[i][2], tableau[i][3]);

            }
        }
    };

    xhr.open("GET", "js/fichier.php", true);
    xhr.send();


//verification de l'autorisation d'acces à la geolocalisation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }

    var position;
    //affichage de la position sur la carte
    function showPosition(position) {
        // x.innerHTML = "Latitude: " + position.coords.latitude +
        // "<br>Longitude: " + position.coords.longitude;
        CurrentLatitude=(position.coords.latitude);
        CurrentLongitude=(position.coords.longitude);
        console.log("current lattitude: " + CurrentLatitude);
        console.log("current longitude: " + CurrentLongitude);

        position= [CurrentLatitude,CurrentLongitude];

        var marker=L.marker([CurrentLatitude, CurrentLongitude],{
            icon: logo
        }).addTo(map);
        marker.bindPopup("Grosse teuf avec le G3c" );
    }

//transformer un evenement en marker
    function afficherEvenement(nom, description, latitude, longitude){
        var marker=L.marker([latitude, longitude], {
            icon: event
        }).addTo(map);
        marker.bindPopup(nom+"</br>"+description);
    }


//recuperation données api
    function lol(){
        var url="https://public.opendatasoft.com/api/records/1.0/search/?dataset=evenements-publics-cibul&lang=france&refine.updated_at=2019%2F01";

        $.get(url, callBackGetSuccess).done(function(){})
            .fail(function(){
                alert("error");
            })
            .always(function(){
                //ok
            });
    }

}