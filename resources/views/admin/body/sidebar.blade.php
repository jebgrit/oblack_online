@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

<div class="sidebar-wrapper" data-simplebar="true" >
    <div class="sidebar-header">
        <div>
            <img src="{{ asset($setting->company_logo) }}" class="logo-icon" alt="logo icon" style="width: 80px; ">
        </div>
        {{-- <div>
            <h4 class="logo-text">{{ $setting->company_name  }}</h4>
        </div> --}}
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>



    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Staff</div>
            </a>
        </li>





        <!------------------------------------------------------------------------------------------------------------------------------- -->


        <!--Role & permission manage-->

        <li class="menu-label">Gestion de l'équipe</li>


        <li>
            <a href="{{ route('all.admin') }}">
                <div class="parent-icon"><i class="bx bx-key"></i>
                </div>
                <div class="menu-title">Administrateur</div>
            </a>
        </li>




















        <!------------------------------------------------------------------------------------------------------------------------------- -->


        <li class="menu-label">Gestion des utilisateurs</li>

        <!--Vendor manage-->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-store'></i>
                </div>
                <div class="menu-title">Vendeurs</div>
            </a>
            <ul>
                <li> <a href="{{ route('active.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Vendeur actif</a>
                </li>
                <li> <a href="{{ route('inactive.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Vendeur inactif</a>
                </li>
            </ul>
        </li>

        <!--User manage-->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Comptes</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('all.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Vendeurs</a>
                </li>
                <li>
                    <a href="{{ route('all.user') }}"><i class="bx bx-right-arrow-alt"></i>Utilisateurs</a>
                </li>
            </ul>
        </li>


















        <!------------------------------------------------------------------------------------------------------------------------------- -->

        <li class="menu-label">FEEDBACK</li>

        <!--Contact message-->
        <li>
            <a href="{{ route('contact.message') }}">
                <div class="parent-icon"><i class="bx bx-envelope"></i>
                </div>
                <div class="menu-title">Contact</div>
            </a>
        </li>

        <!--Ticket-->
        <li>
            <a href="{{ route('all.ticket') }}">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>

        <!--Reviews manage-->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-user-voice"></i>
                </div>
                <div class="menu-title">Commentaires</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('pending.review') }}"><i class="bx bx-right-arrow-alt"></i>En attente</a>
                </li>
                <li>
                    <a href="{{ route('publish.review') }}"><i class="bx bx-right-arrow-alt"></i>Publié</a>
                </li>
            </ul>
        </li>

        <!--Reports-->
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-flag"></i>
                </div>
                <div class="menu-title">Signalement</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('all.report') }}"><i class="bx bx-right-arrow-alt"></i>Commentaire</a>
                </li>
                <li>
                    <a href="{{ route('all.report.product') }}"><i class="bx bx-right-arrow-alt"></i>Produit</a>
                </li>
            </ul>
        </li>














        <!------------------------------------------------------------------------------------------------------------------------------- -->


        <li class="menu-label">Gestion des produits</li>
        <!--Brand-->
        <li>
            <a href="{{ route('all.brand') }}">
                <div class="parent-icon"><i class='bx bx-purchase-tag'></i>
                </div>
                <div class="menu-title">Marques</div>
            </a>
        </li>

        <!--Category-->
        <li>
            <a href="{{ route('all.category') }}">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Catégories</div>
            </a>
        </li>

        <!--Product manage-->
        <li>
            <a href="{{ route('all.product') }}">
                <div class="parent-icon"><i class="bx bx-cart"></i>
                </div>
                <div class="menu-title">Produits</div>
            </a>
        </li>

        <!--Stock manage-->
        <li>
            <a href="{{ route('product.stock') }}">
                <div class="parent-icon"><i class="bx bx-package"></i>
                </div>
                <div class="menu-title">Stock</div>
            </a>
        </li>













        <!------------------------------------------------------------------------------------------------------------------------------- -->

        <li class="menu-label">Gestion des commandes</li>

        <!--Order manage-->
        <li>
            <a href="{{ route('all.orders') }}">
                <div class="parent-icon"><i class="bx bx-spreadsheet"></i>
                </div>
                <div class="menu-title">Commandes</div>
            </a>
        </li>










        <!------------------------------------------------------------------------------------------------------------------------------- -->

        <li class="menu-label">Publicité</li>

        <!--Newletter-->
        <li>
            <a href="{{ route('newsletter') }}">
                <div class="parent-icon"><i class="bx bx-news"></i>
                </div>
                <div class="menu-title">Newsletter</div>
            </a>
        </li>

        <!--Slider manage-->
        <li>
            <a href="{{ route('all.slider') }}">
                <div class="parent-icon"><i class="bx bx-carousel"></i>
                </div>
                <div class="menu-title">Slider</div>
            </a>
        </li>






        <!------------------------------------------------------------------------------------------------------------------------------- -->




        <!--Blog manage-->

        <li class="menu-label">Gestion du site</li>

        <li>
            <a href="{{ route('blog.post') }}">
                <div class="parent-icon"><i class="bx bx-book-content"></i>
                </div>
                <div class="menu-title">Blog</div>
            </a>
        </li>


        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-cog"></i>
                </div>
                <div class="menu-title">Réglages</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('site.setting') }}"><i class="bx bx-right-arrow-alt"></i>Site</a>
                </li>
                <li>
                    <a href="{{ route('site.seo') }}"><i class="bx bx-right-arrow-alt"></i>SEO</a>
                </li>
                <li>
                    <a href="{{ route('faq.all') }}"><i class="bx bx-right-arrow-alt"></i>FAQ</a>
                </li>
            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>
