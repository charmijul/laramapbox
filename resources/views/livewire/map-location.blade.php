<head>
    <h1>INI ADALAH HALAMAN MAP</h1>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    {{-- mapbox api --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        MapBox
                    </div>
                    <div class="card-body">
                        <div wire:ignore id='map' style="width: 100%; height: 75vh;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Titik Kordinat
                    </div>
                    <div class="card-body">
                        <form method="post" action="/getMiles" id="insertForm">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Longtitude</label>
                                        <input wire:model="long" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Lattitude</label>
                                        <input wire:model="lat" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark text-white btn-block" id="submit">Submit
                                    Location</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
@push('scripts')
    <script>
        document.addEventListener('livewire:load', () => {
            const defaultLocation = [117.06848892497732, -0.609395564393381];
            const to =  [117.06901897732246, -0.5984459463408598];
            //console.log('ini value dari livewire', @this.test);

            mapboxgl.accessToken = 'pk.eyJ1Ijoia2FybWlqdWwiLCJhIjoiY2w5dHh0bXFiMDlvMTN1cGM3OHhvZHdpeSJ9.K4DhskQm1imx9QA4r_gRgw';
            var map = new mapboxgl.Map({
                container: 'map',
                center: defaultLocation,
                zoom: 13.50
            });
            const style = "streets-v11"
            //light-v10, outdoors-v11, satellite-v9, streets-v11, dark-v10
            map.setStyle(`mapbox://styles/mapbox/${style}`)
            map.addControl(new mapboxgl.NavigationControl())

            var options = {
                units: 'kilometers'
            }; // units can be degrees, radians, miles, or kilometers, just be sure to change the units in the text box to match. 
            var purpleMarker = new mapboxgl.Marker({
                color: 'purple'
            });

            var greenMarker = new mapboxgl.Marker({
                    color: 'green'
                })
                .setLngLat(to) // marker position using variable 'to'
                .addTo(map);

            map.on('click', (e) => {
                const longtitude = e.lngLat.lng
                const lattitude = e.lngLat.lat
                // @this.long = longtitude;
                // @this.lat = lattitude;
                purpleMarker.remove();
                var from = [longtitude, lattitude]

                purpleMarker.setLngLat(from) // marker position using variable 'from'
                    .addTo(map); //add marker to map

                var distance = turf.distance(from, to, options);
                console.log(from, to, distance);
                @this.jarak = distance;
                console.log('dengan jarak sejauh', @this.jarak);
            });
        });
    </script>
@endpush

<?php 
$coba = 'value baru';
$this->test = $coba;
echo $this->test; 
?>