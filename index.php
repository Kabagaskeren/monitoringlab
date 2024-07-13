<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="templatemo">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <title>Monitoring Website</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-liberty-market.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
</head>

<body>
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">
                            <img src="assets/images/logo.png" alt="">
                            <span class="logo-text">BBMKG IV - MAKASSAR</span>
                        </a>
                        <!-- ***** Logo End ***** -->

                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="index.php" class="active">Home</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg align-self-center">
                    <div class="header-text">
                        <h6>Selamat Datang</h6>
                        <h2>Monitoring<br />Ruang Lab Kalibrasi Suhu</h2>
                        <p>Balai Besar Meteorologi Klimatologi Dan Geofisika Wilayah IV - Makassar</p>
                        <div class="buttons">
                            <div class="col">
                                <div class="main-button">
                                    <a href="#" id="download-csv">Download .csv Data</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col align-self-center" style="border:0px solid white;margin-top:50px;">
                    <div class="row">
                        <div class="grid-item">
                            <h6>Suhu</h6>
                            <h1 id="suhu">Loading... <span style="font-size:25px;">°C</span></h1>
                        </div>
                        <div class="grid-item">
                            <h6>Kelembaban</h6>
                            <h1 id="kelembaban">Loading... <span style="font-size:25px;">%rh</span></h1>
                        </div>
                    </div>
                    <div class="section-heading2" id="alert-section">
                        <div class="line-dec"></div>
                        <h3>Alert!</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <div class="create-nft">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2><a href="https://bbmkg4.com/" style="color:white;">Balai Besar Meteorologi Klimatologi Dan
                                Geofisika Wilayah IV</a></h2>
                    </div>
                </div>
                <div class="col-lg-4">

                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © 2024 <a href="#">Kabagas Keren</a> . All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/popup.js"></script>
    <script src="assets/js/custom.js"></script>

    <script>
    function fetchData() {
        // Ganti URL ini dengan URL API ThingSpeak yang sesuai
        var apiURL = 'https://api.thingspeak.com/channels/2598293/feeds.json?api_key=PK3HOBKZL1TIAQRP&results=1';

        fetch(apiURL)
            .then(response => response.json())
            .then(data => {
                // Ambil data suhu dan kelembaban dari hasil API
                var feeds = data.feeds;
                if (feeds.length > 0) {
                    var latestFeed = feeds[0];
                    var suhu = parseFloat(latestFeed.field1) || 0;
                    var kelembaban = parseFloat(latestFeed.field2) || 0;

                    // Update elemen dengan data dari ThingSpeak
                    document.getElementById('suhu').innerHTML = suhu + ' <span style="font-size:25px;">°C</span>';
                    document.getElementById('kelembaban').innerHTML = kelembaban +
                        ' <span style="font-size:25px;">%rh</span>';

                    // Menginisialisasi kondisi untuk normal
                    var suhuNormal = suhu >= 20 && suhu <= 40;
                    var kelembabanNormal = kelembaban >= 40 && kelembaban <= 70;

                    // Logika untuk alert
                    var alertSection = document.getElementById('alert-section');
                    var alertText = alertSection.querySelector('h3');

                    if (!suhuNormal && !kelembabanNormal) {
                        alertSection.style.display = 'block';
                        alertSection.classList.remove('normal');
                        alertSection.classList.add('alert');
                        alertText.innerHTML = 'Suhu & Kelembaban tidak normal!';
                    } else if (!suhuNormal) {
                        alertSection.style.display = 'block';
                        alertSection.classList.remove('normal');
                        alertSection.classList.add('alert');
                        alertText.innerHTML = 'Suhu tidak normal!';
                    } else if (!kelembabanNormal) {
                        alertSection.style.display = 'block';
                        alertSection.classList.remove('normal');
                        alertSection.classList.add('alert');
                        alertText.innerHTML = 'Kelembaban tidak normal!';
                    } else {
                        alertSection.style.display = 'block';
                        alertSection.classList.remove('alert');
                        alertSection.classList.add('normal');
                        alertText.innerHTML = 'Suhu dan kelembaban normal';
                    }
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    function downloadCSV() {
        // URL untuk mengunduh data CSV dari ThingSpeak
        var csvURL = 'https://api.thingspeak.com/channels/2598293/feeds.csv?api_key=PK3HOBKZL1TIAQRP';

        // Membuat elemen <a> dan mengatur atributnya untuk mengunduh CSV
        var link = document.createElement('a');
        link.href = csvURL;
        link.download = 'thingSpeakData.csv'; // Nama file yang akan diunduh
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    // Panggil fungsi fetchData setiap 15 detik (15000 milidetik)
    setInterval(fetchData, 15000);

    // Panggil fetchData sekali ketika halaman dimuat
    fetchData();

    // Tambahkan event listener untuk tombol unduh CSV
    document.getElementById('download-csv').addEventListener('click', function(event) {
        event.preventDefault();
        downloadCSV();
    });
    </script>
</body>

</html>