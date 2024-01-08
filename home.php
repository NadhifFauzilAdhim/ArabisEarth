<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" a href="css/bootstrap.min.css" />
    <title>Informasi Gempa - Arabis Group</title>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col m-auto">
                <div class="card mt-5">
                    <a class="navbar-brand text-center" href="home">
                        <img src="source/Arabisgroup.png" width="200px">
                    </a>
                    <h3 class="text-center">Informasi Gempa Dan Prakiraan Cuaca- <span id="currentDateTime"></span></h3>
                    <h5 class="text-center">Data Source : BMKG</h5>
                    <p class="text-center">Your Location: <span id="location"></span></p>
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#">Menu</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" onclick="showSection('gempaTerkini')">Gempa Terkini</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" onclick="showSection('gempaDirasakan')">Gempa Dirasakan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" onclick="showSection('prakiraancuaca')">Prakiraan Cuaca</a>
                                    </li>


                                </ul>
                            </div>
                        </div>
                    </nav>

                    <div id="gempaTerkini" class="content-section">
                        <?php
                        // Kode Baris PHP untuk Mengolah Data gempaterkini.xml
                        $dataDirasakan = simplexml_load_file("https://data.bmkg.go.id/DataMKG/TEWS/autogempa.xml") or die("Gagal mengakses!");

                        echo "<div class='table-responsive'>";
                        echo "<table class='table table-bordered table-warning'>";
                        echo "<thead>
                    <tr>
                        <th scope='col'>Tanggal</th>
                        <th scope='col'>Jam</th>
                        <th scope='col'>DateTime</th>
                        <th scope='col'>Magnitudo</th>
                        <th scope='col'>Kedalaman</th>
                        <th scope='col'>Koordinat</th>
                        <th scope='col'>Lintang</th>
                        <th scope='col'>Bujur</th>
                        <th scope='col'>Lokasi</th>
                        <th scope='col'>Potensi</th>
                        <th scope='col'>Dirasakan</th>
                        </tr>
                         </thead>";
                        echo "<tbody>";
                        if ($dataDirasakan->gempa->Magnitude < 4.0) {
                            $gempadirasakan = "table-success";
                        } else if ($dataDirasakan->gempa->Magnitude < 6.0) {
                            $gempadirasakan = "table-primary";
                        } else if ($dataDirasakan->gempa->Magnitude < 7.0) {
                            $gempadirasakan = "table-warning";
                        } else if ($dataDirasakan->gempa->Magnitude < 8.0) {
                            $gempadirasakan = "table-danger";
                        }
                        echo "<tr class='{$gempadirasakan}'>
                    <td>{$dataDirasakan->gempa->Tanggal}</td>
                    <td>{$dataDirasakan->gempa->Jam}</td>
                    <td>{$dataDirasakan->gempa->DateTime}</td>
                    <td>{$dataDirasakan->gempa->Magnitude}</td>
                    <td>{$dataDirasakan->gempa->Kedalaman}</td>
                    <td>{$dataDirasakan->gempa->point->coordinates}</td>
                    <td>{$dataDirasakan->gempa->Lintang}</td>
                    <td>{$dataDirasakan->gempa->Bujur}</td>
                    <td>{$dataDirasakan->gempa->Wilayah}</td>
                    <td>{$dataDirasakan->gempa->Potensi}</td>
                    <td>{$dataDirasakan->gempa->Dirasakan}</td>
                </tr>";
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";

                        echo "<div class='text-center'>";
                        echo "Shakemap: <br><img src='https://data.bmkg.go.id/DataMKG/TEWS/{$dataDirasakan->gempa->Shakemap}' alt='Gempabumi Terbaru' class='img-fluid'>";
                        echo "</div>";
                        ?>
                    </div>

                    <div id="gempaDirasakan" class="content-section">
                        <?php
                        // Kode Baris PHP untuk Mengolah Data gempaterkini.xml
                        $dataTerkini = simplexml_load_file("https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.xml") or die("Gagal ambil!");
                        echo "<h2 class='text-center'>Daftar 15 Gempabumi Terkini</h2>";

                        echo "<div class='table-responsive'>";
                        echo "<table class='table table-bordered'>";
                        echo "<thead>
                            <tr>
                                <th scope='col'>No</th>
                                <th scope='col'>Tanggal</th>
                                <th scope='col'>Jam</th>
                                <th scope='col'>DateTime</th>
                                <th scope='col'>Magnitudo</th>
                                <th scope='col'>Kedalaman</th>
                                <th scope='col'>Koordinat</th>
                                <th scope='col'>Lintang</th>
                                <th scope='col'>Bujur</th>
                                <th scope='col'>Lokasi</th>
                                <th scope='col'>Potensi</th>
                            </tr>
                        </thead>";

                        echo "<tbody>";
                        $i = 1;
                        foreach ($dataTerkini->gempa as $gempaTerkini) {
                            if ($gempaTerkini->Magnitude < 4.0) {
                                $potensiClass = "table-success";
                            } else if ($gempaTerkini->Magnitude < 6.0) {
                                $potensiClass = "table-primary";
                            } else if ($gempaTerkini->Magnitude < 7.0) {
                                $potensiClass = "table-warning";
                            } else if ($gempaTerkini->Magnitude < 8.0) {
                                $potensiClass = "table-danger";
                            } else {
                                $potensiClass = "";
                            }

                            echo "<tr class='{$potensiClass}'>";
                            echo "<td>{$i}</td>";
                            echo "<td>{$gempaTerkini->Tanggal}</td>";
                            echo "<td>{$gempaTerkini->Jam}</td>";
                            echo "<td>{$gempaTerkini->DateTime}</td>";
                            echo "<td>{$gempaTerkini->Magnitude}</td>";
                            echo "<td>{$gempaTerkini->Kedalaman}</td>";
                            echo "<td>{$gempaTerkini->point->coordinates}</td>";
                            echo "<td>{$gempaTerkini->Lintang}</td>";
                            echo "<td>{$gempaTerkini->Bujur}</td>";
                            echo "<td>{$gempaTerkini->Wilayah}</td>";
                            echo "<td>{$gempaTerkini->Potensi}</td>";
                            echo "</tr>";
                            $i++;
                        }
                        echo "</tbody>";

                        echo "</table>";
                        echo "</div>";
                        ?>
                    </div>

                    <script>
                        function showSection(sectionId) {
                            var sections = document.getElementsByClassName('content-section');
                            for (var i = 0; i < sections.length; i++) {
                                sections[i].style.display = 'none';
                            }

                            var selectedSection = document.getElementById(sectionId);
                            if (selectedSection) {
                                selectedSection.style.display = 'block';
                            }
                        }
                    </script>
                    <div id="prakiraancuaca" class="content-section">
                        <h1 class="text-center">Perkiraan Cuaca</h1>
                        <div class="card">
                            <div class="card-header text-center" id="judulTerdekat">
                                Jarak terdekat dari ?
                            </div>
                            <ul class="list-group" id="wilayahTerdekat">
                            </ul>
                        </div>
                        <hr>
                        <h4 class="text-center" id="judulCuaca"></h4>

                        <div class="container" id="cuaca">
                            <div class="row">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
        <div class="container text-center">
            <small>Copyright &copy; Arabis Group | Nadhif Fauzil A</small>
        </div>
    </footer>




    <!-- JavaScript to update the current date and time every second -->
    <script>
        function updateDateTime() {
            var currentDateTimeElement = document.getElementById('currentDateTime');
            var currentDate = new Date();
            var formattedDateTime = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate() +
                ' ' + currentDate.getHours() + ':' + currentDate.getMinutes() + ':' + currentDate.getSeconds();
            currentDateTimeElement.innerHTML = formattedDateTime;
        }

        setInterval(updateDateTime, 1000);

        // Initial call to set the initial value
        updateDateTime();
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showLocation);
            } else {
                $('#location').html('Geolocation is not supported by this browser.');
            }
        });

        function showLocation(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            $.ajax({
                type: 'POST',
                url: 'getlocation.php',
                data: 'latitude=' + latitude + '&longitude=' + longitude,
                success: function(msg) {
                    if (msg) {
                        $("#location").html(msg);
                    } else {
                        $("#location").html('Not Available');
                    }
                }
            });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        var lat = -7.80045677;
        var lon = 110.39128023;


        function getWilayah() {
            $.getJSON('https://ibnux.github.io/BMKG-importer/cuaca/wilayah.json', function(data) {
                var items = [];
                var jml = data.length;

                //hitung jarak
                for (n = 0; n < jml; n++) {
                    data[n].jarak = distance(lat, lon, data[n].lat, data[n].lon, 'K');
                }

                //urutkan berdasarkan jarak
                data.sort(urutkanJarak);

                //setelah dapat jarak,  ambil 5 terdekat
                for (n = 0; n < jml; n++) {
                    items.push('<li class="list-group-item d-flex justify-content-between align-items-center">' + data[n].propinsi +
                        ', ' + data[n].kota + ', ' + data[n].kecamatan + '<span class="badge badge-primary badge-pill">' + data[n].jarak.toFixed(2) + ' km</span></li>');
                    if (n > 4) break
                };
                $('#judulTerdekat').html("Jarak terdekat dari " + lat + "," + lon);
                $('#wilayahTerdekat').html(items.join(""));
                $('#judulCuaca').html(data[0].propinsi +
                    ', ' + data[0].kota + ', ' + data[0].kecamatan + ' ' + data[0].jarak.toFixed(2) + " km");
                getCuaca(data[0].id);
            });
        }


        function getCuaca(idWilayah) {
            $.getJSON('https://ibnux.github.io/BMKG-importer/cuaca/' + idWilayah + '.json', function(data) {
                var items = [];
                var jml = data.length;

                // setelah dapat jarak, ambil 5 terdekat
                for (n = 0; n < jml; n++) {
                    items.push(
                        '<div class="col-md-2 mb-2">' +
                        '<div class="card text-center">' +
                        '<img src="images/wheather/' +
                        data[n].kodeCuaca +
                        '.png" class="card-img-top">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title">' +
                        data[n].cuaca +
                        '</h5>' +
                        '<p class="card-text">' +
                        data[n].jamCuaca +
                        '</p>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    );
                    if (n > 4) break;
                }

                // Clear the existing content and add the new content to the row
                $('#cuaca .row').html(items.join(""));
            });
        }

        // https://www.htmlgoodies.com/beyond/javascript/calculate-the-distance-between-two-points-in-your-web-apps.html
        function distance(lat1, lon1, lat2, lon2) {
            var radlat1 = Math.PI * lat1 / 180
            var radlat2 = Math.PI * lat2 / 180
            var theta = lon1 - lon2
            var radtheta = Math.PI * theta / 180
            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
            dist = Math.acos(dist)
            dist = dist * 180 / Math.PI
            dist = dist * 60 * 1.1515
            return Math.round((dist * 1.609344) * 1000) / 1000;
        }

        function urutkanJarak(a, b) {
            if (a['jarak'] === b['jarak']) {
                return 0;
            } else {
                return (a['jarak'] < b['jarak']) ? -1 : 1;
            }
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, onErrorGPS);
            } else {
                //ga bisa dapat GPS, pake default aja
                getWilayah();
            }
        }

        function showPosition(position) {
            lat = position.coords.latitude;
            lon = position.coords.longitude;
            getWilayah();
        }

        function onErrorGPS(error) {
            //ake default aja
            getWilayah();
        }

        getLocation();
    </script>

</body>

</html>