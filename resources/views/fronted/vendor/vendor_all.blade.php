@extends('fronted.master')

@section('main')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection



<div class="page-content pt-30">
    <div class="container">
        <div class="breadcrumb mb-80">
            <a href="{{ route('home') }}">Accueil</a>
            <span></span> Vendeur
        </div>

        <div class="archive-header-2 text-center">
            <h3 class="mb-50">({{ count($vendors) }}) résultat pour "vendeur"</h3>
        </div>

        <!-- Vendors grid-->
        <div class="row vendor-grid">

            @foreach ($vendors as $vendor)
                <div class="col-lg-3 col-md-6 col-12 col-sm-6 justify-content-center">
                    <div class="vendor-wrap mb-40">
                        <div class="vendor-img-action-wrap">
                            <div class="vendor-img">
                                <a href="{{ route('vendor.details', $vendor->id) }}">
                                    <img class="default-img"
                                        src="{{ !empty($vendor->photo) ? url('upload/vendor_images/' . $vendor->photo) : url('upload/vendor_images/no_image.jpg') }}"
                                        alt="Logo vendeur" style="width: 120px; height:120px;" />
                                </a>
                            </div>
                            <div class="product-badges product-badges-position product-badges-mrg">
                                <span class="sale">Vendeur</span>
                            </div>
                        </div>
                        <div class="vendor-content-wrap">
                            <div class="d-flex justify-content-between align-items-end mb-30">
                                <div>
                                    <div class="product-category">
                                        <span class="text-muted">Dépuis {{ $vendor->vendor_join }}</span>
                                    </div>
                                    <h4 class="mb-5"><a
                                            href="{{ route('vendor.details', $vendor->id) }}">{{ $vendor->name }}</a>
                                    </h4>
                                    <div class="product-rate-cover">

                                        @php
                                            $products = App\Models\Product::where('status', 1)
                                                ->where('vendor_id', $vendor->id)
                                                ->get();
                                            
                                            $pd = null;
                                            if (count($products) > 1) {
                                                $pd = 'produits';
                                            } else {
                                                $pd = 'produit';
                                            }
                                        @endphp
                                        <span class="font-small total-product">{{ count($products) }}
                                            {{ $pd }}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="vendor-info mb-30">
                                <ul class="contact-infor text-muted">

                                    <li><img src="{{ asset('fronted/assets/imgs/theme/icons/icon-contact.svg') }}"
                                            alt="" /><strong>Contact:
                                        </strong><span>{{ $vendor->phone }}</span></li>
                                </ul>
                            </div>
                            <a href="{{ route('vendor.details', $vendor->id) }}" class="btn btn-xs">Afficher les
                                produits <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <!--pagination-->
        {{-- <div class="pagination-area mt-20 mb-20">
            {{ $vendors->links('fronted.vendor.paginate') }}
        </div> --}}
    </div>
</div>
@endsection
