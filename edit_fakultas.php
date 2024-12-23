<?php include('template/header.php') ?>
<?php include('template/navbar.php') ?>

<?php
include 'koneksi.php';
session_start();
$id = $_GET['id'];
$sql = "SELECT * FROM fakultas WHERE id = $id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $warna = $_POST['warna'];
    $poligon = $_POST['poligon'];

    $queryResult = $conn->query("UPDATE fakultas SET nama='$nama', warna='$warna', poligon='$poligon' WHERE id='$id'");
    if ($queryResult) {
        $_SESSION['pesan'] = 'Data berhasil diperbarui';
        header('Location: fakultas.php');
    }
}
?>

<div class="page-content p-5" id="content">
    <div class="data-pesan" data-pesan="<?php if (isset($_SESSION['pesan'])) { echo $_SESSION['pesan']; } unset($_SESSION['pesan']); ?>"></div>

    <button id="sidebarCollapse" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>

    <div class="row">
        <div class="col-lg-7">
            <div id="map" style="height: 500px;"></div>
        </div>
        <div class="col-lg-5">
            <form action="" method="POST">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="nama" value="<?= $data['nama']; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Warna</label>
                    <div class="col-sm-8">
                        <input type="color" class="form-control" name="warna" value="<?= $data['warna']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Koordinat Poligon</label>
                    <textarea name="poligon" id="poligon" rows="3" class="form-control"><?= $data['poligon']; ?></textarea>
                </div>
                <button class="btn btn-info" type="submit" name="simpan">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    var map = L.map('map').setView([-0.8365483562098096, 119.89375323356296], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    var savedPoligon = <?= $data['poligon'] ? $data['poligon'] : 'null'; ?>;
    if (savedPoligon) {
        L.geoJSON(savedPoligon, {
            style: function (feature) {
                return {
                    color: "<?= $data['warna']; ?>"
                };
            },
            onEachFeature: function (feature, layer) {
                drawnItems.addLayer(layer);
            }
        }).addTo(drawnItems);
    }

    var drawControl = new L.Control.Draw({
        draw: {
            polyline: false,
            rectangle: false,
            circle: false,
            marker: false,
            circlemarker: false,
        },
        edit: {
            featureGroup: drawnItems,
            remove: true
        }
    });
    map.addControl(drawControl);

    // Mendengarkan event ketika gambar selesai dibuat
    map.on('draw:created', function (event) {
        drawnItems.clearLayers();
        var layer = event.layer;
        drawnItems.addLayer(layer);
        document.getElementById('poligon').value = JSON.stringify(drawnItems.toGeoJSON());
    });

    // Mendengarkan event saat poligon diedit
    map.on('draw:edited', function () {
        document.getElementById('poligon').value = JSON.stringify(drawnItems.toGeoJSON());
    });

    // Mendengarkan event saat penggambaran dibatalkan
    map.on('draw:canceled', function (event) {
        // Menghapus popup jika ada
        map.eachLayer(function (layer) {
            if (layer instanceof L.Popup) {
                layer.remove();
            }
        });

        drawnItems.clearLayers();
        document.getElementById('poligon').value = "";
    });

    // Untuk menampilkan pesan sukses dari session
    let pesan = $('.data-pesan').data('pesan');
    if (pesan) {
        Swal.fire({
            icon: 'success',
            title: pesan,
            showConfirmButton: false,
            timer: 1500
        });
    }

</script>

<?php include('template/footer.php') ?>
