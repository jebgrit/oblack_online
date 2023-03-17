<style>
    #searchProducts {
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

<header class="header-area header-style-1 header-height-2" >

    <div class="header-middle header-middle-ptb-1 d-none d-lg-block" style="background-color: #112c3f">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ route('home') }}"><img src="{{ asset($setting->company_logo ) }}"
                            alt="logo" /></a>
                </div>
                <div class="header-right">

                    <!-- search -->
                    <div class="search-style-2">
                        <form action="{{ route('product.search') }}" method="POST">
                            @csrf

                            <input onfocus="search_result_show()" onblur="search_result_hide()" name="search"
                                type="search" id="search" placeholder="Que voulez-vous trouver ?" />
                            <div id="searchProducts"></div>
                        </form>
                    </div>


                    <div class="header-action-right">
                        <div class="header-action-2">



                            

                                <!-- Show mini cart -->
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="{{ route('mycart') }}">
                                        <img alt="Nest"
                                            src="{{ asset('fronted/assets/imgs/theme/icons/white-cartt.png') }}" />
                                        <span class="pro-count blue" id="cartQty">0</span>
                                    </a>
                                    <a href="{{ route('mycart') }}"><span class="lable text-white">Panier</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">

                                        <!-- Mini cart start with ajax -->
                                        <div id="miniCart"></div>

                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total à payer:<span>€</span><span id="cartSubTotal"></span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="{{ route('mycart') }}" class="outline">Voir le panier</a>
                                                <a href="{{ route('checkout') }}">Commander</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                            <!-- Login - register or Setting account -->
                            <div class="header-action-icon-2">
                                <a href="{{ route('dashboard') }}">
                                    <img class="svgInject" alt="Nest"
                                        src="{{ asset('fronted/assets/imgs/theme/icons/user.png') }}" />
                                </a>



                                @auth
                                    @php
                                        $id = Auth::user()->id;
                                        $user = App\Models\User::where('id', $id)->first();
                                    @endphp

                                    @if ($user->role == 'admin')
                                        <a href="{{ route('admin.dashboard') }}"><span class="lable ml-0 text-white">Bonjour {{ $user->name }}</span></a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('admin.dashboard') }}"><i class="fi fi-rs-user mr-10"></i>
                                                        Mon compte</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.change.setting') }}"><i
                                                            class="fi fi-rs-settings-sliders mr-10"></i>Paramètres</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.logout') }}"><i
                                                            class="fi fi-rs-sign-out mr-10"></i>Déconnexion</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @elseif ($user->role == 'vendor')
                                        <a href="{{ route('vendor.dashboard') }}"><span class="lable ml-0 text-white">Bonjour {{ $user->name }}</span></a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('vendor.dashboard') }}"><i class="fi fi-rs-user mr-10"></i>
                                                        Mon compte</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('vendor.change.setting') }}"><i
                                                            class="fi fi-rs-settings-sliders mr-10"></i>Paramètres</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('vendor.logout') }}"><i
                                                            class="fi fi-rs-sign-out mr-10"></i>Déconnexion</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @elseif ($user->role == 'user')
                                        <a href="{{ route('dashboard') }}"><span class="lable ml-0 text-white">Bonjour {{ $user->name }}</span></a>
                                        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('dashboard') }}"><i class="fi fi-rs-user mr-10"></i>
                                                        Mon compte</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('user.order.page') }}"><i
                                                            class="fi fi-rs-location-alt mr-10"></i>Commandes </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('user.account.page') }}"><i
                                                            class="fi fi-rs-settings-sliders mr-10"></i>Paramètres</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('user.logout') }}"><i
                                                            class="fi fi-rs-sign-out mr-10"></i>Déconnexion</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"><span class="lable ml-0 text-white">Connexion</span></a>
                                        <span class="lable" style="margin-left: 2px; margin-right: 2px"> | </span>
                                    <a href="{{ route('register') }}"><span class="lable ml-0 text-white">Inscription</span></a>
                                @endauth

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    


    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                

                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{ route('home') }}"><img src="{{ asset($setting->company_logo ) }}" alt="logo"></a>
                </div>


                <div class="header-nav d-none d-lg-flex">

                    @php
                        $categories = App\Models\Category::orderBy('category_name', 'ASC')->limit(20)->get();
                    @endphp

                    <!-- Nav bar -->
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading ">
                        <nav>
                            <ul>

                                
                                <li>
                                    <a href="{{ route('home') }}">Accueil</a>
                                </li>


                                @php
                                    $categories = App\Models\Category::orderBy('category_name', 'ASC')
                                        ->get();
                                @endphp

                                @foreach ($categories as $cat)
                                    <li>
                                        <a href="{{ url('product/category/' . $cat->id . '/' . $cat->category_slug) }}">
                                            {{ $cat->category_name }}
                                            <i class="fi-rs-angle-down"></i>
                                        </a>

                                        @php
                                            $products = App\Models\Product::where('status', 1)
                                                ->where('category_id', $cat->id)
                                                ->orderBy('product_name', 'ASC')
                                                ->get();
                                        @endphp
                                        <ul class="sub-menu">
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

                            </ul>
                        </nav>
                    </div>
                </div>



                <!-- Mobile view -->
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>

                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">


                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('mycart') }}">
                                    <img alt="Nest" src="{{ asset('fronted/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                    <span class="pro-count white" id="cartQty2">0</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">

                                    <!-- Mini cart start with ajax -->
                                    <div id="miniCart2"></div>

                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <p>Total à payer:<span>€</span><span id="cartSubTotal2"></span></p>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('mycart') }}">Panier</a>
                                            <a href="{{ route('checkout') }}">Commander</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<script>
    function search_result_show() {
        $("#searchProducts").slideDown();
    }

    function search_result_hide() {
        $("#searchProducts").slideUp();
    }
</script>
