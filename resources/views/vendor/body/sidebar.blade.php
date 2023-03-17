@php
    $id = Auth::user()->id;
    $vendorId = App\Models\User::find($id);
    $status = $vendorId->status;

    $setting = App\Models\SiteSetting::find(1);
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset($setting->company_logo ) }}" class="logo-icon" alt="logo icon" style="width: 80px; ">
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>

    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('vendor.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Seller</div>
            </a>
        </li>

        @if ($status === 'active')
            <li class="menu-label">Gestion des produits</li>
            <li>
                <a href="{{ route('vendor.all.product') }}">
                    <div class="parent-icon"><i class="bx bx-cart"></i>
                    </div>
                    <div class="menu-title">Produits</div>
                </a>
            </li>


            <!------------------------------------------------------------------------------------------------------------------------------->

            <li class="menu-label">Gestion des commandes</li>
            <li>
                <a href="{{ route('vendor.order') }}" >
                    <div class="parent-icon"><i class="bx bx-spreadsheet"></i>
                    </div>
                    <div class="menu-title">Vos commandes</div>
                </a>
            </li>

            

            <!------------------------------------------------------------------------------------------------------------------------------->

            <li class="menu-label">FEEDBACK</li>
            <li>
                <a href="{{ route('vendor.all.review') }}" >
                    <div class="parent-icon"><i class="bx bx-comment-check"></i>
                    </div>
                    <div class="menu-title">Avis des utilisateurs</div>
                </a>
            </li>

            <li>
                <a href="{{ route('vendor.all.ticket') }}">
                    <div class="parent-icon"><i class="bx bx-support"></i>
                    </div>
                    <div class="menu-title">Support</div>
                </a>
            </li>

        @else
            <!-- -->
        @endif
        {{-- <li class="menu-label">Autres</li>
        <li>
            <a href="#" target="_blank">
                <div class="parent-icon"><i class="bx bx-help-circle"></i>
                </div>
                <div class="menu-title">À propos</div>
            </a>
        </li> --}}

    </ul>
    <!--end navigation-->
</div>
