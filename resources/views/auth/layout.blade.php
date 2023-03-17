<!DOCTYPE html>
<html class="no-js" lang="fr">

<head>
    @php
        $setting = App\Models\SiteSetting::find(1);
        $seo = App\Models\Seo::find(1);
    @endphp

    <meta charset="utf-8" />
    <title>{{ $setting->company_name }} - {{ $setting->slogan }}</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    <meta name="title" content="{{ $seo->meta_title }}" />
    <meta name="author" content="{{ $seo->meta_author }}" />
    <meta name="keyword" content="{{ $seo->meta_keyword }}" />
    <meta name="description" content="{{ $seo->meta_description }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset($setting->favicon) }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('fronted/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('fronted/assets/css/main.css?v=5.3') }}" />

    <!-- Toaster -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
    
    <style>
        body {
            position: relative;
            min-height: 100vh;
        }
    
        main {
            padding-bottom: 2.5rem;
        }
    
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 2.5rem;        
        }
    </style>

    <style>
        
        .card {

            width: 400px;
            border: none;

        }

        .btr {

            border-top-right-radius: 5px !important;
        }


        .btl {

            border-top-left-radius: 5px !important;
        }

        .btn-dark {
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }


        .btn-dark:hover {
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }


        .nav-pills {

            display: table !important;
            width: 100%;
        }

        .nav-pills .nav-link {
            border-radius: 0px;
            border-bottom: 1px solid #0d6efd40;

        }

        .nav-item {
            display: table-cell;
            background: #0d6efd2e;
        }


        .form {

            padding: 10px;
            height: 300px;
        }

        .form input {

            margin-bottom: 12px;
            border-radius: 3px;
        }


        .form input:focus {

            box-shadow: none;
        }


        .form button {

            margin-top: 20px;
        }
    </style>


    <main class="main pages" style="background-color: #FAFAFA">

        <div class="page-header breadcrumb-wrap" style="background-color: #112c3f">
            <div class="container">
                <div class="breadcrumb">
    
                    <a href="{{ '/' }}" rel="nofollow">
                        <img src="{{ asset($setting->company_logo) }}" alt="logo" />
                    </a>
                </div>
            </div>
        </div>

        @yield('main')
        
    </main>


    
    <footer class="main ">

        <div class="container pb-30 " data-wow-delay="0">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-6">
                    <p class="font-sm mb-0">
                        {{ $setting->copyright }}, <strong class="text-brand">{{ $setting->company_name }}</strong>
                    </p>
                </div>

                <style>
                    .underline-on-hover:hover {
                        text-decoration: underline;
                    }
                </style>

                <div class="col-xl-8 col-lg-6 text-center d-none d-xl-block">

                    <div class="d-lg-inline-flex">
                        <a href="{{ route('contact') }}" class="p-2 text-secondary underline-on-hover">Contact</a>
                        <a href="{{ route('legal') }}" class="p-2 text-secondary underline-on-hover">Mentions légales</a>
                        <a href="{{ route('term') }}" class="p-2 text-secondary underline-on-hover">Conditions d'utilisations</a>
                        <a href="{{ route('cgv') }}" class="p-2 text-secondary underline-on-hover">CGV</a>
                        <a href="{{ route('home.blog') }}" class="p-2 text-secondary underline-on-hover">Blog</a>
                        <a href="{{ route('faq') }}" class="p-2 text-secondary underline-on-hover">FAQ</a>
                        <a href="{{ route('become.vendor') }}" class="p-2 text-secondary underline-on-hover">Business</a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-6 col-md-6 text-end d-none d-md-block">
                    <div class="mobile-social-icon">
                        <a href="{{ $setting->facebook }}"><img
                                src="{{ asset('fronted/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                                alt="" /></a>
                        <a href="{{ $setting->twitter }}"><img
                                src="{{ asset('fronted/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                                alt="" /></a>
                        <a href="{{ $setting->youtube }}"><img
                                src="{{ asset('fronted/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                                alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


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

    <!--Toaster-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

</body>

</html>
