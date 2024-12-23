<?php
include('template/header.php');
include('template/navbar.php');
include 'koneksi.php';
session_start();

// Proses Tambah Data
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $warna = $_POST['warna'];
    $poligon = $_POST['poligon'];

    $queryResult = $conn->query("INSERT INTO fakultas (nama, warna, poligon) VALUES ('$nama', '$warna', '$poligon')");
    if ($queryResult) {
        $_SESSION['pesan'] = 'Data berhasil ditambahkan';
    }
}
?>

<div class="page-content p-5" id="content">
    <div class="data-pesan" data-pesan="<?php if (isset($_SESSION['pesan'])) { echo $_SESSION['pesan']; unset($_SESSION['pesan']); } ?>"></div>
    <button id="sidebarCollapse" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i
            class="fa fa-bars mr-2"></i></button>

    <!-- Row for Map and Form -->
    <div class="row">
        <!-- Map Section -->
        <div class="col-lg-7">
            <div id="map" style="height: 500px;"></div>
        </div>

        <!-- Form Section -->
        <div class="col-lg-5">
            <form action="" method="POST">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Warna</label>
                    <div class="col-sm-8">
                        <input type="color" class="form-control" name="warna" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Koordinat Poligon</label>
                    <textarea name="poligon" id="poligon" rows="3" class="form-control"></textarea>
                </div>
                <button class="btn btn-info" type="submit" name="simpan">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Table Section -->
    <div class="col-lg-12 mt-2">
        <div class="card">
            <div class="card-header">Data Fakultas</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Fakultas</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = $conn->query("SELECT * FROM fakultas");
                        $no = 1;
                        while ($row = $query->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td>
                                    <a href="edit_fakultas.php?id=<?= $row['id']; ?>" class="btn btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="delete_fakultas.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-hapus-fakultas">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet Map Script -->
<script>
    var map = L.map('map').setView([-0.8365483562098096, 119.89375323356296], 13);

    // Add Tile Layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Initialize Draw Layer
    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    var drawControl = new L.Control.Draw({
        draw: {
            polyline: false,
            rectangle: false,
            circle: false,
            marker: false,
            circlemarker: false
        },
        edit: {
            featureGroup: drawnItems
        }
    });
    map.addControl(drawControl);

    // Capture Draw Created Event
    map.on('draw:created', function(event) {
        var layer = event.layer;
        drawnItems.addLayer(layer);

        // Save GeoJSON to Textarea
        var geoJsonData = JSON.stringify(drawnItems.toGeoJSON());
        document.getElementById('poligon').value = geoJsonData;
    });

    // Show Success Message
    let pesan = $('.data-pesan').data('pesan');
    if (pesan) {
        Swal.fire({
            icon: 'success',
            title: pesan,
            showConfirmButton: false,
            timer: 1500
        });
    }

    // Confirmation for Deletion
    $('.btn-hapus-fakultas').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus Data!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        });
    });
</script>

<?php include('template/footer.php'); ?>
