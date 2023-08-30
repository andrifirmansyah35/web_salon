<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>RCSM Bantul</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('home/assets/favicon.ico') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('home/css/styles.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg text-uppercase fixed-top" id="mainNav"
        style="background-color:rgb(204, 76, 76)">
        <div class="container">
            <a class="navbar-brand" href="#page-top">RCSM Bantul</a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-white text-red rounded" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#portfolio">Layanan Kami</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#about">Tentang Kami</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="#contact">Lokasi</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead text-center" style="color: rgb(204, 76, 76)">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <img class="masthead-avatar mb-5" src="{{ asset('img/logo.png') }}" alt="..." />
            <!-- Masthead Heading-->
            <h4 class="masthead-heading mb-0">Rumah Cantik Salon dan SPA Muslimah Bantul</h4>
            <!-- Icon Divider-->
            {{-- <p class="masthead-subheading font-weight-light mb-0">Rumah Cantik Salon dan SPA Muslimah</p> --}}
        </div>
    </header>
    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="portfolio" style="background-color:rgb(204, 76, 76)">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white mb-0">Layanan Kami</h2>
            <!-- Icon Divider-->
            <br>
            <div class="divider-custom">
                <div class="divider-custom-line bg-white"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <!-- Portfolio Item 1-->
                @foreach ($kategori_layanan_all as $kategori_layanan)
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal"
                            data-bs-target="#portfolio{{ $kategori_layanan->slug }}">
                            <div
                                class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white">
                                    <p class="text-center fs-5">lihat layanan</p>
                                    <p class="center fw-bold">{{ $kategori_layanan->nama }}</p>
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ asset('storage/' . $kategori_layanan->gambar) }}"
                                alt="{{ $kategori_layanan->slug }}" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- About Section-->
    <section class="page-section mb-0" id="about" style="background-color:white">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase" style="color: rgb(204, 76, 76)">
                Tentang Kami</h2>
            <!-- Icon Divider-->
            <br>
            <div class="divider-custom">
                <div class="divider-custom-line" style="background-color: rgb(204, 76, 76)"></div>
            </div>
            <!-- About Section Content-->
            <div class="row">
                <div class="col-lg-6 ms-auto">

                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                                aria-label="Slide 4"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('home/assets/img/tentang_kami/cr-1.png') }}" class="d-block w-100"
                                    alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('home/assets/img/tentang_kami/cr-2.png') }}" class="d-block w-100"
                                    alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('home/assets/img/tentang_kami/cr-3.png') }}" class="d-block w-100"
                                    alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('home/assets/img/tentang_kami/cr-4.png') }}" class="d-block w-100"
                                    alt="...">
                            </div>


                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
                <div class="col-lg-5 me-auto">
                    <p class="lead text-j">Hai sahabat cantik, bagaimana kamu sudah menemukan layanan yang kamu
                        cari. Yuk
                        mulai menjadi member kami kami akan bantu anda memilih layanan yang tepat untuk setiap
                        permasalahan kecantikan anda. Apa kamu juga ingin menemukan perawatan yang tepat supaya
                        kecantikanmu terjaga yuk jadi member kami. kamu biasa menghubungi kami dari kami atau kamu bisa
                        klick whatt-me kami sibawah </p>
                    <a class="btn btn-success" href="https://wa.me/6289510364498" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path
                                d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                        </svg>
                        whattapp</i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section-->
    <section class="page-section" id="contact" style="background-color:rgb(204, 76, 76)">
        <div class="container">
            <!-- Contact Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0 text-white">
                Lokasi</h2>
            <!-- Icon Divider-->
            <br>
            <div class="divider-custom">
                <div class="divider-custom-line" style="background-color: white"></div>
            </div>
            <!-- Contact Section Form-->
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">
                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe width="770" height="510" id="gmap_canvas"
                                src="https://maps.google.com/maps?q=rcsm bantul&t=&z=10&ie=UTF8&iwloc=&output=embed"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                                href="https://2yu.co">2yu</a><br>
                            <style>
                                .mapouter {
                                    position: relative;
                                    text-align: right;
                                    height: 510px;
                                    width: 770px;
                                }
                            </style><a href="https://embedgooglemap.2yu.co">html embed google map</a>
                            <style>
                                .gmap_canvas {
                                    overflow: hidden;
                                    background: none !important;
                                    height: 510px;
                                    width: 770px;
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Location</h4>
                    <p class="lead mb-0">
                        Jl. Bantul No.13, Monggang, Pendowoharjo, Kec. Sewon, Kabupaten Bantul
                        <br> Daerah Istimewa Yogyakarta 55186
                    </p>
                </div>
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Sosial Media</h4>
                    <a class="btn btn-outline-light btn-social mx-1" href="https://www.facebook.com/rscm.bantul"
                        target="_blank"><i class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="https://wa.me/6289510364498"
                        target="_blank"><i class="fab fa-fw fa-whatsapp"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="https://www.instagram.com/rcsm.bantul/"
                        target="_blank"><i class="fab fa-fw fa-instagram"></i></a>
                </div>
                <!-- Footer About Text-->
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">Pesan dari owner</h4>
                    <p class="lead mb-0">
                        Ayok mulai menjadi hubungi kontak kami, kami akan rekomendasikan layanan
                        yang paling cocok untuk anda
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright &copy; RCSM Bantul 2023</small></div>
    </div>
    <!-- Portfolio Modals-->

    @foreach ($kategori_layanan_all as $kategori_layanan)
        <!-- Portfolio Modal 1-->
        <div class="portfolio-modal modal fade" id="portfolio{{ $kategori_layanan->slug }}" tabindex="-1"
            aria-labelledby="portfolioModal1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button"
                            data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">
                                        {{ $kategori_layanan->nama }}</h2>
                                    <br>
                                    <!-- Portfolio Modal - Image-->
                                    <img class="img-fluid rounded mb-5"
                                        src="{{ asset('storage/' . $kategori_layanan->gambar) }}" alt="..." />
                                    <!-- Portfolio Modal - Text-->
                                    {{-- <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Mollitia
                                        neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore
                                        quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur
                                        itaque. Nam.</p> --}}

                                    <div class="cotainer">
                                        <ul class="list-group">
                                            @foreach ($kategori_layanan->layanan as $layanan)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $layanan->nama }}
                                                    <span class="badge bg-primary rounded-pill">
                                                        @if ($layanan->status == true)
                                                            tersedia
                                                        @else
                                                            sedang ditutup
                                                        @endif
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary" data-bs-dismiss="modal">
                                        <i class="fas fa-xmark fa-fw"></i>
                                        tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('home/js/scripts.js') }}></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
