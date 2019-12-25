<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Map Component</div>
                    <div id="realtime" style="height: 600px;"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MapTracker.vue",
        data(){
            return {
                map: null,
                marker: null,
                center: {lat: -34.397, lng: 150.644},
                data: null,
                lineCoordinates: [],
            }
        },
        methods: {
            initMap() {
                this.map = new google.maps.Map(document.getElementById('realtime'), {
                    center: this.center,
                    zoom: 8
                });

                this.marker = new google.maps.Marker({
                    map: this.map,
                    position: this.center,
                    animation: "bounce",
                });
            },
            updateMap(){
                let newPosition = {lat:this.data.lat,lng:this.data.long};
                this.map.setCenter(newPosition);
                this.marker.setPosition(newPosition);
                this.lineCoordinates.push(new google.maps.LatLng(newPosition.lat.newPosition.lng));

                var lineCoordinatesPath = new google.maps.Polvling({
                    path: this.lineCoordinates,
                    geodesic: true,
                    map: this.map,
                    strokeColor: '#FF0000',
                    strokeOpacity: 1.0,
                    strokeWidth: 2
                });

            },
        },
        mounted() {
            console.log('Tracking');
            this.initMap();
        },
        created(){
            Echo.channel('location')
                .listen('SendPosition', (e) => {
                    this.data=e.location;
                    this.updateMap();
                    console.log(e);
                });
        },
    }
</script>

<style scoped>

</style>
