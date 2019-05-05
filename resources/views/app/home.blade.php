@extends('layouts.app') 
@section('content')

<div class="container-fluid">
    <div id="map">
        <script>
            var robotLoc;
    
                function initMap() {
                    var coord = {
                        lat: null,
                        lng: null,
                        status: null
                    };
                    var position = {
                        lat: -7.9537397,
                        lng: 110.30692470000001
                    };
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 10,
                        center: position
                    });
    
                    var markers = [];
    
                    var transitLayer = new google.maps.TransitLayer();
                    transitLayer.setMap(map);
    
                    const dbRefObject = firebase.database().ref().child("data");
                    dbRefObject.on('child_added', snap => {
                        coord = snap.val();
                        var latlng = new google.maps.LatLng(coord.lat, coord.lng);
                        console.log(snap.val());
    
                        if (coord.status == "warning") {
                            var marker = new google.maps.Marker({
                                position: coord,
                                map: map,
                                icon: "{% static 'img/warning.png' %}"
                            });
                        } else {
                            var marker = new google.maps.Marker({
                                position: coord,
                                map: map,
    
                            });
                        }
                        attachSecretMessage(marker, coord.status);
                        markers.push(marker);
                    });
    
                    dbRefObject.on('child_changed', snap => {
                        coord = snap.val();
                        var latlng = new google.maps.LatLng(coord.lat, coord.lng);
                        console.log(snap.val());
    
                        if (coord.status == "warning") {
                            var marker = new google.maps.Marker({
                                position: coord,
                                map: map,
                                icon: "{% static 'img/warning.png' %}"
                            });
                        } else {
                            var marker = new google.maps.Marker({
                                position: coord,
                                map: map
                            });
                        }
                        attachSecretMessage(marker, coord.status);
                    });
                    console.log(coord);
    
                    dbRefObject.on('child_removed', snap => {
                        coord = snap.val();
                        var latlng = new google.maps.LatLng(coord.lat, coord.lng);
                        console.log(snap.val());
    
                        var marker = new google.maps.Marker({
                            position: coord,
                            map: map
                        });
                        attachSecretMessage(marker, coord.status);
                    });
    
                    var robot;
                    const dbRefObjectRobot = firebase.database().ref().child("robot");
                    dbRefObjectRobot.on('child_added', snap => {
                        robotFirebase = snap.val();
                        var robotLoc = new google.maps.LatLng(robotFirebase.lat, robotFirebase.lng);
                        console.log("robot" + snap.val());
    
                        var marker = new google.maps.Marker({
                            position: robotFirebase,
                            map: map,
                            icon: "http://muhadif.com/robot.png"
                        })
                        robot = marker;
                    })
                    console.log(robot);
                    dbRefObjectRobot.on('child_changed', snap => {
                        robotFirebase = snap.val();
                        var robotLoc = new google.maps.LatLng(robotFirebase.lat, robotFirebase.lng);
                        console.log("robot" + snap.val());
                        robot.setMap(null);
                        var marker = new google.maps.Marker({
                            position: robotFirebase,
                            map: map,
                            icon: "{% static 'img/robot.png' %}"
                        })
                        robot = marker;
                    })
    
                }
    
                function attachSecretMessage(marker, secretMessage) {
                    var infowindow = new google.maps.InfoWindow({
                        content: secretMessage
                    });
    
                    marker.addListener('click', function() {
                        infowindow.open(marker.get('map'), marker);
                    });
                }
        </script>

        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlWXTx0E64uXf39i16Yc4ouIS7EwT1WKY&callback=initMap">

        </script>
    </div>
</div>
@endsection