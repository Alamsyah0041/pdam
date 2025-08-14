    @extends('pelaporan.master')

    @section('content')
    <div class="container mt-4">
        <h4 class="mb-4">Peta Lokasi Instalasi Pengolahan Air</h4>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah Lokasi Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('lokasi.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Instalasi</label>
                            <input type="text" name="nama_instalasi" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Jalan</label>
                            <input type="text" name="nama_jalan" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="number" step="0.000001" name="latitude" id="latitude" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="number" step="0.000001" name="longitude" id="longitude" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <button type="button" id="btn-get-location" class="btn btn-info btn-block mt-4">
                                <i class="fas fa-map-marker-alt"></i> Dapatkan Lokasi Saya
                            </button>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-success" type="submit">
                                <i class="fas fa-save"></i> Simpan Lokasi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Map Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Peta Lokasi</h5>
            </div>
            <div class="card-body p-0">
                <h4>Koordinat</h4>
                <span>Gerakkan mouse di atas peta</span>
                <div id="map"></div>
                <div id="map-coordinates" class="info-coordinate">
                </div>
            </div>
        </div>

        <!-- Locations Table -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Lokasi Tersimpan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Instalasi</th>
                                <th>Alamat</th>
                                <th>Koordinat</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lokasi as $index => $l)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $l->nama_instalasi }}</td>
                                    <td>{{ $l->nama_jalan }}</td>
                                    <td>{{ $l->latitude }}, {{ $l->longitude }}</td>
                                    <td>{{ $l->keterangan ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('lokasi.destroy', $l->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection

  @push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<style>
    /* Critical CSS fixes */
    #map {
        height: 500px;
        width: 100%;
        position: relative;
        z-index: 0;
        background: #f8f9fa; /* Fallback color */
    }
    .leaflet-container {
        background: transparent !important;
    }
    .card-body.p-0 {
        position: relative;
        min-height: 500px; /* Prevents collapse */
    }
    /* [Rest of your existing styles] */
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fix Leaflet marker images
    delete L.Icon.Default.prototype._getIconUrl;
    L.Icon.Default.mergeOptions({
        iconRetinaUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-icon-2x.png',
        iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-icon.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png'
    });

    // Safe DOM selector
    function $(selector) {
        const el = document.querySelector(selector);
        if (!el) console.warn(`Element not found: ${selector}`);
        return el;
    }

    // 1. Map Initialization
    const mapContainer = $('#map');
    if (!mapContainer) return;

    const defaultLocation = [-0.5048, 117.1537];
    const map = L.map('map', {  // ← Comma is crucial here
        center: defaultLocation,
        zoom: 13,
        preferCanvas: true
    });

    // 2. Tile Layer with Fallback
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // 3. Marker Management
    let currentMarker = null;
    
    // Add existing markers
    @foreach($lokasi as $l)
        @if(is_numeric($l->latitude) && is_numeric($l->longitude))
            L.marker([{{ $l->latitude }}, {{ $l->longitude }}])
                .addTo(map)
                .bindPopup("<b>{{ $l->nama_instalasi }}</b><br>{{ $l->nama_jalan }}");
        @endif
    @endforeach

    // 4. Map Interactions
    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);
        
        $('#latitude').value = lat;
        $('#longitude').value = lng;
        
        if (currentMarker) map.removeLayer(currentMarker);
        currentMarker = L.marker([lat, lng]).addTo(map);
    });

    // 5. Current Location Button
    $('#btn-get-location')?.addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude.toFixed(6);
                const lng = position.coords.longitude.toFixed(6);
                
                $('#latitude').value = lat;
                $('#longitude').value = lng;
                
                if (currentMarker) map.removeLayer(currentMarker);
                currentMarker = L.marker([lat, lng]).addTo(map);
                map.setView([lat, lng], 15);
            });
        } else {
            alert('Geolocation tidak didukung di browser ini');
        }
    });

    // Fix map rendering
    setTimeout(() => map.invalidateSize(), 100);
});
</script>
@endpush