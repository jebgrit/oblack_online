
@php
    $route = Route::current()->getName();
@endphp

<div class="col-md-2">
    <div class="dashboard-menu">
        <ul class="nav flex-column" role="tablist">

            <li class="nav-item">
                <a class="nav-link {{ ($route == 'dashboard')? 'active': '' }} " href="{{ route('dashboard') }}">
                    <i class="fi-rs-user mr-10"></i>Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ ($route == 'user.order.page')? 'active': '' }}" href="{{ route('user.order.page') }}">
                    <i class="fi-rs-shopping-bag mr-10"></i>Commandes
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ ($route == 'user.track.order')? 'active': '' }}" href="{{ route('user.track.order') }}">
                    <i class="fi-rs-shopping-cart-check mr-10"></i>Tracking
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{ ($route == 'user.account.page')? 'active': '' }}" href="{{ route('user.account.page') }}">
                    <i class="fi-rs-marker mr-10"></i>Mon adresse
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ ($route == 'user.change.password')? 'active': '' }}" href="{{ route('user.change.password') }}">
                    <i class="fi-rs-settings mr-10"></i>Mot de passe
                </a>
            </li>

        </ul>
    </div>
</div>
