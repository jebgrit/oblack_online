<style>
    #searchProductsMobile {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #ffffff;
        z-index: 999;
        border-radius: 8px;
        margin-top: 5px;
    }
</style>

@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{ route('home') }}"><img src="{{ asset($setting->company_logo ) }}"
                        alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">

                <form action="{{ route('product.search') }}" method="POST">
                    @csrf

                    <input onfocus="search_mobile_show()" onblur="search_mobile_hide()" name="search" type="search"
                        id="searchmobile" placeholder="Que voulez-vous trouver ?" />
                    <button type="submit"><i class="fi-rs-search"></i></button>
                    <div id="searchProductsMobile"></div>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a class="active" href="{{ route('home') }}">Accueil </a>
                        </li>

                        <!-- Get all data from category table -->
                        @php
                            $categories = App\Models\Category::orderBy('category_name', 'ASC')
                                ->limit(7)
                                ->get();
                        @endphp



                        @foreach ($categories as $cat)
                            <li class="menu-item-has-children">
                                <a href="{{ url('product/category/' . $cat->id . '/' . $cat->category_slug) }}">
                                    {{ $cat->category_name }}
                                </a>

                                @php
                                    $products = App\Models\Product::where('status', 1)
                                        ->where('category_id', $cat->id)
                                        ->orderBy('product_name', 'ASC')
                                        ->get();
                                @endphp
                                <ul class="dropdown">
                                    @foreach ($products as $product)
                                        <li>
                                            <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                                {{ Str::limit($product->product_name, 25) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach

                        <li>
                            <a href="{{ route('home.blog') }}">Blog</a>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                @auth

                    @php
                        $id = Auth::user()->id;
                        $user = App\Models\User::where('id', $id)->first();
                    @endphp

                    @if ($user->role == 'admin')
                        <div class="single-mobile-header-info">
                            <a href="{{ route('admin.dashboard') }}"><i class="fi-rs-marker"></i>Bonjour
                                {{ $user->name }} </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="{{ route('admin.change.setting') }}"><i class="fi-rs-user"></i>Paramètres </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="{{ route('user.logout') }}"><i class="fi-rs-user"></i>Déconnexion </a>
                        </div>
                    @elseif ($user->role == 'vendor')
                        <div class="single-mobile-header-info">
                            <a href="{{ route('vendor.dashboard') }}"><i class="fi-rs-marker"></i>Bonjour
                                {{ $user->name }} </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="{{ route('vendor.change.setting') }}"><i class="fi-rs-user"></i>Paramètres </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="{{ route('user.logout') }}"><i class="fi-rs-user"></i>Déconnexion </a>
                        </div>
                    @elseif($user->role == 'user')
                        <div class="single-mobile-header-info">
                            <a href="{{ route('dashboard') }}"><i class="fi-rs-marker"></i>Bonjour {{ $user->name }}
                            </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="{{ route('user.order.page') }}"><i class="fi-rs-user"></i>Commandes </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="{{ route('user.account.page') }}"><i class="fi-rs-user"></i>Paramètres </a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="{{ route('user.logout') }}"><i class="fi-rs-user"></i>Déconnexion </a>
                        </div>
                    @endif
                @else
                    <div class="single-mobile-header-info">
                        <a href="{{ route('login') }}"><i class="fi-rs-marker"></i>Connexion </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="{{ route('register') }}"><i class="fi-rs-user"></i>Inscription </a>
                    </div>
                @endauth
            </div>
            <div class="mobile-social-icon mb-50">
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

            <style>
                .underline-on-hover:hover {
                    text-decoration: underline;
                }
            </style>

        </div>
    </div>
</div>

<script>
    function search_mobile_show() {
        $("#searchProductsMobile").slideDown();
    }

    function search_mobile_hide() {
        $("#searchProductsMobile").slideUp();
    }
</script>
