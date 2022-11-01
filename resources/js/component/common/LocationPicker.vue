<template>
    <div>
        <div class="d-flex justify-content-center">
            <div @click="showMap" class="location-picker-icon">
                <i class="fa fa-map-marker"></i>
            </div>

            <input hidden v-model="userLng" :name="lat_input">
            <input hidden v-model="userLng" :name="lng_input">
            <input hidden v-model="userAddress" :name="address_input">
        </div>
        <!--<div  v-else class="text-center">
            <span>({{userLat}}, {{userLng}})</span><br>
            <span>{{userAddress}}</span><br>
            <a @click.prevent="showMap" href="#">Change</a>
            <input hidden v-model="userLng" :name="lat_input">
            <input hidden v-model="userLng" :name="lng_input">
            <input hidden v-model="userAddress" :name="address_input">
        </div>-->


    </div>

</template>

<script>

    import Swal from "sweetalert2";
    export default {
        name: "LocationPicker",
        props: [
            "lat_input", "lng_input", "address_input", "is_required", "parent_modal"
        ],
        mixins: [

        ],

        data() {
            return {
                markers: [],
                original_marker : null,
                marker_searched : null,
                dragged_marker : null,
                btn_loc: "Yes use this location",
                districts: [],
                selected_district: "",
                userLat: "",
                userLng: "",
                userAddress: "",
                selectedBusinessName: "",
                anyAddress: "",
                anyLat: "",
                anyLng: "",
                nearByPlaces: [
                ],
            }
        },
        mounted() {
            let app = this;
            console.log(app.$props);
            console.log(app.$props.parent_modal);

            $("#modal-location").modal("show")
        },
        methods: {
            showMap(){
                let app = this;
                let loader = Swal;
                loader.showLoading();
                $("#pac-input").val("");
                let lat = "0.3483964" , lng = "32.5780513";
                if (navigator.geolocation){


                    navigator.geolocation.getCurrentPosition(function(position) {

                            lat = position.coords.latitude;
                            lng = position.coords.longitude;
                            app.drawMap(lat, lng, true);
                            loader.close();

                        },
                        function (error) {
                            if (error.code === error.PERMISSION_DENIED){
                                //location permission denied by user
                                app.drawMap(lat, lng);
                                loader.close();
                            }
                        });
                }
            },
            drawMap(lat, lng, autoloc){

                let app = this;
                var lat = parseFloat(lat);
                var lng = parseFloat(lng);
                let zoom = 13;
                let map = null;

                //user allowed location access
                if(autoloc){
                    zoom = 18
                }

                let promise = new Promise(resolve => {
                    if(app.$props.parent_modal != null) {
                        $("#"+app.$props.parent_modal).modal("hide");
                    }

                    /*setTimeout(() => {
                        $("#modal-location").modal('show');
                    }, 300);*/

                    resolve("done")
                }).then((result) => {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: {lat: lat, lng: lng},
                        zoom: zoom
                    });

                    app.original_marker = new google.maps.Marker({
                        position: new google.maps.LatLng(lat, lng),
                        draggable: true,
                        // animation: google.maps.Animation.DROP,
                        map: map
                    });

                    app.markers.push(app.original_marker);

                    //geo decode maker
                    app.onGeodecode(app.original_marker, map);


                    let input = (document.getElementById('pac-input'));
                    // let searchBox = new google.maps.places.SearchBox((input));
                    let autoComplete = new google.maps.places.Autocomplete((input));
                    
                    autoComplete.setComponentRestrictions({
                        country: ["ug", "mw"],
                    });
                    //using autoComplete
                    autoComplete.addListener('place_changed', function() {
                        let place = autoComplete.getPlace();
                        if (!place.geometry) {
                            // User entered the name of a Place that was not suggested and
                            // pressed the Enter key, or the Place Details request failed.
                            window.alert("No details available for input: '" + place.name + "'");
                            return;
                        }


                        //clear markers from map
                        app.clearMarkers(null, app.markers);

                        // Create a marker for each place.
                        app.marker_search = new google.maps.Marker({
                            map: map,
                            position: place.geometry.location,
                            draggable: true,
                        });

                        app.dragged_marker = null
                        app.original_marker = null
                        app.markers.push(app.marker_search);




                        // If the place has a geometry, then present it on a map.
                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(17);  // Why 17? Because it looks good.
                        }

                        app.onGeodecode(app.marker_search, map)

                        /*marker.setPosition(place.geometry.location);
                        marker.setVisible(true)*/;

                        app.onMarkerDrag(app.marker_search,map);
                        map.panTo(app.marker_search.getPosition());

                    });

                    app.onMarkerDrag(app.original_marker,map);

                    // blank screen issues
                    google.maps.event.trigger(map, 'resize');
                    map.panTo(app.original_marker.getPosition());
                });

            },
            onMarkerDrag(marker, map){
                let app = this;
                app.dragged_marker = null
                google.maps.event.addListener(marker, 'dragend', function (event) {
                    app.marker_search = null
                    app.dragged_marker = marker
                    app.onGeodecode(marker, map)
                    app.btn_loc = "Yes use this location"


                });
                google.maps.event.addListener(marker, 'dragstart', function (event) {
                    // change loading notification
                    app.btn_loc = "Loading....."
                });

                map.panTo(marker.getPosition());
                map.setZoom(17);

                // blank screen issues
                google.maps.event.trigger(map, 'resize');
            },
            clearMarkers(map, markers) {
                for (let i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                }
            },
            onGeodecode(mymarker, map){
                let app = this;
                let position = mymarker.getPosition();

                app.userLat = position.lat();
                app.userLng = position.lng();
                app.userAddress = "Testing address....."

                //TODO Uncomment On Production
                /*let geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                        latLng: position
                    },
                    function(results, status)
                    {
                        if (status === google.maps.GeocoderStatus.OK) {

                            //update cordinates
                            app.userLat = position.lat();
                            app.userLng = position.lng();
                            app.userAddress = results[0].formatted_address;

                            app.anyAddress = app.userAddress;
                            app.anyLat = app.userLat;
                            app.anyLng = app.userLng;
                           // app.nearByPlaces = [ {"name": "Pauuz"}, {"name": "Paule"}, {"name": "Sayrunjah"} ];
                            //app.userAddress = (data.street != null) ? data.street : "" +" ,"+(data.city != null) ? data.city : "" +" "+(data.district != null) ? data.district : ""

                            if(map){
                                map.setCenter(new google.maps.LatLng(position.lat(), position.lng()));
                                map.setZoom(15);
                            }

                        }
                        else {
                        }
                    }
                );*/
            },
            dismissLocation(){
                this.userAddress = "";
                this.userLat = "";
                this.userLng = "";
            },
            getNearbyPlaces(position, map) {
                console.log(position);
                let app = this;
                let request = {
                    location: position,
                    rankBy: google.maps.places.RankBy.DISTANCE,
                    keyword: 'business'
                };

                let service = new google.maps.places.PlacesService(map);
                service.nearbySearch(request, (results, status) => {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        console.log(results);
                        app.nearByPlaces = results;
                    }
                });
            },
            onUseLocation() {
                let app = this;
                $("#modal-location").modal('hide');
                app.$parent.$emit("location-modal-close");
                app.$parent.$emit("on-location-picked", {
                    lat: app.userLat,
                    lng: app.userLng,
                    address: app.userAddress,
                })
            },
            closeModal() {
                let app = this;
                $("#modal-location").modal("hide");

                setTimeout(() => {
                    if(app.$props.parent_modal != null) {
                        $("#"+app.$props.parent_modal).modal("show");
                    }
                }, 300);

            }
        }

    }
</script>

<style scoped>

</style>
