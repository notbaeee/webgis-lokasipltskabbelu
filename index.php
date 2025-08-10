<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SIG Kabupaten Belu</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet-minimap/dist/Control.MiniMap.min.css" />
  <link rel="icon" href="gambar/belu.png" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <!-- Leaflet Measure CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-measure/dist/leaflet-measure.css" />

  <style>
  #map {
    height: 570px;
  }

  .navbar {
    background-color: #8c2522;
  }

  .navbar-brand,
  .nav-link {
    color: white;
    font-weight: bold;
  }

  .nav-link:hover {
    color: #f8f9fa;
    text-decoration: underline;
  }

  .navbar-brand img {
    height: 80px;
  }

  .plts-info {
    margin-top: 20px;
  }

  .text-justify {
    text-align: justify;
  }
  </style>
</head>

<body>
  <div class="container border border-1">
    <nav class="navbar navbar-expand-sm">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="gambar/logo.png" alt="Logo Kabupaten Belu" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="admin/index.php">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div id="map"></div>
    <hr />

    <section id="pltsSection" class="container my-4">
      <div class="table-responsive">
        <table class="table table-bordered text-center">
          <thead class="table-light">
            <tr>
              <th style="width: 33.33%">Detail Lokasi</th>
              <th>Gambar Lokasi</th>
            </tr>
          </thead>

          <tbody>
            <?php
            include 'konektor.php';
            $query = "SELECT * FROM lokasi";
            $result = mysqli_query($konektor, $query);
            $index = 1;
            while ($row = mysqli_fetch_assoc($result)) :
              $nama = htmlspecialchars($row['nama']);
              $detail = nl2br(htmlspecialchars($row['detaillokasi']));
              $gambar = htmlspecialchars($row['gambar']);
            ?>

            <tr id="lokasi<?= $index; ?>">

              <td class="align-top" style="width: 33.33%">
                <h6><?= $nama; ?></h6>
                <p><?= $detail; ?></p>
              </td>
              <td>
                <img src="http://localhost/belu/admin/uploads/<?= $gambar; ?>" class="img-fluid rounded shadow-sm"
                  alt="<?= $nama; ?>" style="max-width: 85%; height: auto;" />
              </td>
            </tr>
            <?php $index++;
            endwhile; ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>
  <!-- Leaflet Measure JS -->

  <script src="https://unpkg.com/leaflet-minimap/dist/Control.MiniMap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-minimap/dist/Control.MiniMap.min.js"></script>
  <!-- <script src="https://unpkg.com/leaflet-measure/dist/leaflet-measure.js"></script> -->
  <script src="leaflet.ajax.js"></script>

  <script>
  const map = L.map("map").setView([-9.0902956, 124.9292252], 10);

  const baseLayers = {
    'Satellite': L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    }),
    'Map': L.tileLayer('https://tileserver.memomaps.de/tilegen/{z}/{x}/{y}.png', {
      maxZoom: 18,
      attribution: '&copy; OpenStreetMap contributors'
    })
  };

  baseLayers['Map'].addTo(map);

  const overlayLayers = {
    "Kab Belu": new L.GeoJSON.AJAX("belupolyline.geojson", {
      onEachFeature: (feature, layer) => {
        let popupContent = "<b>Informasi:</b><br>";
        for (const [key, value] of Object.entries(feature.properties)) {
          popupContent += `${key}: ${value}<br>`;
        }
        layer.bindPopup(popupContent);
      },
      style: {
        color: "#8c2522",
        weight: 2,
        fillOpacity: 0.1
      }
    })
  };

  // map.locate({
  //   setView: true,
  //   maxZoom: 16
  // });
  // map.on('locationfound', (e) => {
  //   L.marker(e.latlng).addTo(map).bindPopup("Anda di sini").openPopup();
  // });




  overlayLayers["Kab Belu"].addTo(map);
  L.control.layers(baseLayers, overlayLayers).addTo(map);
  // miniMapLayer.addTo(map); // Aktifkan tile utama
  // L.control.measure({
  //   position: 'topleft',
  //   primaryLengthUnit: 'kilometers',
  //   secondaryLengthUnit: 'meters',
  //   primaryAreaUnit: 'hectares',
  //   secondaryAreaUnit: 'sqmeters',
  //   activeColor: '#db4a29',
  //   completedColor: '#9b2d14'
  // }).addTo(map);

  // const miniMap = new L.Control.MiniMap(miniMapLayer, {
  //   toggleDisplay: true
  // }).addTo(map);

  const smallIcon = L.icon({
    iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
    iconSize: [16, 26],
    iconAnchor: [10, 30],
    popupAnchor: [0, -30]
  });

  const createMarker = (coords, text, targetId) => {
    const marker = L.marker(coords, {
      icon: smallIcon
    }).addTo(map);

    marker.bindTooltip(text, {
      direction: 'top',
      offset: [-1, -20],
      opacity: 0.9
    });

    marker.on('click', () => {
      document.getElementById(targetId)?.scrollIntoView({
        behavior: 'smooth'
      });
    });
  };
  </script>


  <script>
  L.Control.geocoder().addTo(map);
  </script>
  <?php
  include 'konektor.php';
  $query = "SELECT * FROM lokasi";
  $result = mysqli_query($konektor, $query);
  $index = 1;
  echo "<script>\n";
  while ($row = mysqli_fetch_assoc($result)) {
    $lat = floatval($row['latitude']);
    $lng = floatval($row['longitude']);
    if (!$lat || !$lng) continue;

    $nama = addslashes($row['nama']);
    echo "createMarker([$lat, $lng], '<b>$nama</b>', 'lokasi$index');\n";
    $index++;
  }
  echo "</script>\n";
  ?>

</body>

</html>