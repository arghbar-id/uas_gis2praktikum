<?php include('template/header.php') ?>
<?php include('template/navbar.php') ?>
<div class="page-content p-5" id="content">
    <button class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4" id="sidebarCollapse" type="button">
        <i class="fa fa-bars mr-2"></i>
    </button>
    <div class="row">
        <div class="col-lg-10">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Lokasi Awal</label>
                    <select id="lokasi_awal" class="form-control">
                        <option selected>--Silahkan Pilih--</option>
                        <?php
                        include 'koneksi.php';
                        $kec = $conn->query("SELECT * FROM rumah");
                        if ($kec->num_rows > 0) {
                            while ($row = $kec->fetch_assoc()) {
                        ?>
                                <option value="<?= $row['latitude']; ?>, <?= $row['longitude']; ?>"><?= $row['nama']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Lokasi tujuan</label>
                    <select id="lokasi_tujuan" class="form-control">
                        <option selected>--Silahkan Pilih--</option>
                        <?php
                        include 'koneksi.php';
                        $kec = $conn->query("SELECT * FROM rumah");
                        if ($kec->num_rows > 0) {
                            while ($row = $kec->fetch_assoc()) {
                        ?>
                                <option value="<?= $row['latitude']; ?>, <?= $row['longitude']; ?>"><?= $row['nama']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <button class="btn btn-danger" style="margin-top: 32px" id="rute">Rute</button>
        </div>
        <div class="col">
            <div id="map"></div>
        </div>
    </div>
</div>
<script>
    var map = L.map('map').setView([-0.8365483562098096, 119.89375323356296], 14);
    let layerMap = L.tileLayer(
        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmF1ZmFsaGFtYmFsaTY1IiwiYSI6ImNtMnd4eWdlZDBidjYyanBwaHJnZ3FrbHAifQ.mJdw4Ew-5zOyObCXR8akhg', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v12',
        });
    map.addLayer(layerMap);

    <?php
    include 'koneksi.php';

    // Menampilkan marker rumah
    $sql = "SELECT * FROM rumah";
    $hasil = $conn->query($sql);
    if ($hasil->num_rows > 0) {
        while ($row = $hasil->fetch_row()) { ?>
            L.marker([<?= $row[5] ?>, <?= $row[6] ?>]).bindPopup('Nama : <?= $row[1] ?> <br> Nim : <?= $row[2] ?> <br>' +
                "<a href='detail_rumah.php?id=<?= $row[0] ?>' class='btn btn-outline-info btn-sm'>Detail</a>").addTo(map);
    <?php }
    }

    // Menampilkan polygon fakultas dengan informasi popup
    $sql = "SELECT * FROM fakultas";
    $hasil = $conn->query($sql);
    if ($hasil->num_rows > 0) {
        while ($row = $hasil->fetch_assoc()) { ?>
            var drawnItems = L.geoJson(<?= $row['poligon'] ?>, {
                color: "<?= $row['warna'] ?>"
            }).bindPopup("<strong>Nama:</strong> <?= $row['nama'] ?>").addTo(map);
    <?php }
    }
    ?>

    // Event untuk menampilkan rute menggunakan Leaflet Routing Machine
    $('#rute').on('click', function() {
        let awal = $('#lokasi_awal').val();
        let awalLatLng = awal.split(',')
        let tujuan = $('#lokasi_tujuan').val();
        let tujuanLatLng = tujuan.split(',')

        L.Routing.control({
            waypoints: [
                L.latLng(awalLatLng[0], awalLatLng[1]),
                L.latLng(tujuanLatLng[0], tujuanLatLng[1])
            ],
            routeWhileDragging: false
        }).addTo(map);
    });
</script>
<?php include('template/footer.php') ?>
