<!DOCTYPE html>
<html class="no-js" lang="fr">

@php
    $seo = App\Models\Seo::find(1);
    $setting = App\Models\SiteSetting::find(1);
@endphp

<head>
    <meta charset="utf-8" />

    <title>{{ $setting->company_name }}.fr: Page non trouvée</title>

    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    <meta name="title" content="{{ $seo->meta_title }}" />
    <meta name="author" content="{{ $seo->meta_author }}" />
    <meta name="keyword" content="{{ $seo->meta_keyword }}" />
    <meta name="description" content="{{ $seo->meta_description }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('fronted/assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('fronted/assets/css/main.css?v=5.3') }}" />
</head>

<body>

    <main class="main page-404">
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto text-center">
                        <p class="mb-20"><img src="{{ asset('fronted/assets/imgs/page/page-404.png') }}" alt="" class="hover-up" />
                        </p>
                        <h1 class="display-2 mb-30">Désolé cette page n’existe pas (plus).</h1>
                        <p class="font-lg text-grey-700 mb-30">
                            Le lien sur lequel vous avez cliqué est peut-être cassé ou la page a peut-être été supprimée.
                            visitez la page d'<a href="{{ route('home') }}"> <span>accueil</span></a> ou <a
                            href="{{ route('contact') }}"><span>contactez-nous</span></a> à propos du problème.
                        </p>
                        <a class="btn btn-default submit-auto-width font-xs hover-up mt-30" href="{{ route('home') }}"><i
                                class="fi-rs-home mr-5"></i> Retour à la page d'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Vendor JS-->
    <script src="{{ asset('fronted/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('fronted/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('fronted/assets/js/shop.js?v=5.3') }}"></script>
</body>

</html>
