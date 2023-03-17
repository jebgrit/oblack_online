@extends('fronted.master')

@section('main')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp
    
@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection



<div class="container mb-30 mt-30">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span></span> <a href="{{ route('vendor.all') }}">Vendeur</a> 
        <span></span> {{ $vendor->name }}
    </div>

    <div class="archive-header-2 text-center pt-80 pb-50">
        <h5 class="mb-50">({{ count($vendor_product) }}) résultat pour "{{ $vendor->name }}"</h5>
    </div>
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">

            <!--product card-->
            <div class="row product-grid">
                @foreach ($vendor_product as $product)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">

                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                        <img class="default-img" src="{{ asset($product->product_thumbnail) }}"
                                            alt="" />
                                    </a>
                                </div>
     

                                @php
                                    $amount = $product->product_price - $product->discount_price;
                                    $discount = ($amount / $product->product_price) * 100;
                                @endphp
                                <div class="product-badges product-badges-position product-badges-mrg">

                                    @if ($product->discount_price == null)
                                        <!-- -->
                                    @else
                                        <span class="hot">-{{ round($discount) }}%</span>
                                    @endif
                                </div>
                            </div>

                            <div class="product-content-wrap">
                                <!-- categorie name -->
                                <div class="product-category">
                                   <a href="{{ url('product/category/' . $product->category->id . '/' . $product->category->category_slug) }}">
                                        {{ $product['category']['category_name'] }}
                                    </a>
                                </div>

                                <!-- product name -->
                                <h2>
                                    <a
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                        {{ Str::limit($product->product_name, 25) }}
                                    </a>
                                </h2>
                                
                                <!-- product rating -->
                                <div class="product-rate-cover">
                                    @php
                                        $avarage = App\Models\Review::where('product_id', $product->id)
                                            ->where('status', 1)
                                            ->avg('rating');
                                        
                                        $review_count = App\Models\Review::where('product_id', $product->id)
                                            ->where('status', 1)
                                            ->latest()
                                            ->get();
                                    @endphp
                                    <div class="product-rate d-inline-block">
                                        @if ($avarage == 0)
                                            <!--  -->
                                        @elseif ($avarage == 1 || $avarage < 2)
                                            <div class="product-rating" style="width: 20%"></div>
                                        @elseif ($avarage == 2 || $avarage < 3)
                                            <div class="product-rating" style="width: 40%"></div>
                                        @elseif ($avarage == 3 || $avarage < 4)
                                            <div class="product-rating" style="width: 60%"></div>
                                        @elseif ($avarage == 4 || $avarage < 5)
                                            <div class="product-rating" style="width: 80%"></div>
                                        @elseif ($avarage == 5 || $avarage < 5)
                                            <div class="product-rating" style="width: 100%"></div>
                                        @endif

                                    </div>
                                    <span class="font-small ml-5 text-muted"> 
                                        ({{ count($review_count) }})
                                    </span>
                                </div>




                                <!-- product vendor -->
                                <div>
                                    @if ($product->vendor_id == null)
                                        <span>vendu par {{ $setting->company_name }}</p>
                                    @else
                                        <span class="font-small text-muted">vendur par 
                                            <a href="{{ route('vendor.details', $product->vendor->id) }}">
                                                {{ $product['vendor']['name'] }}
                                            </a>
                                        </span>
                                    @endif
                                </div>




                                <!-- product price -->
                                <div class="product-card">
                                    @if ($product->discount_price == null)
                                        <div class="product-price">
                                            <span>{{ $product->product_price }}€</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>{{ $product->discount_price }}€</span>
                                            <span class="old-price">${{ $product->product_price }}€</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        

        <!-- Vendor left short info -->
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                <div class="vendor-logo mb-30">
                    <img src="{{ !empty($vendor->photo) ? url('upload/vendor_images/' . $vendor->photo) : url('upload/vendor_images/no_image.jpg') }}"
                        alt="Logo vendeur" class="rounded-circle"/>
                </div>
                <div class="vendor-info">

                    @if ($vendor->vendor_join == null)
                        
                    @else
                        <div class="product-category">
                            <span class="text-muted">Dépuis {{ $vendor->vendor_join }}</span>
                        </div>
                    @endif
                    

                    <h4 class="mb-5">
                        <a href="{{ route('vendor.details', $vendor->id) }}" class="text-heading">
                            {{ $vendor->name }}
                        </a>
                    </h4>


                    <!-- product rating -->
                    @php
                    $avarage = App\Models\Review::where('vendor_id', $vendor->id)
                        ->where('status', 1)
                        ->avg('rating');
                    
                    $review_count = App\Models\Review::where('vendor_id', $vendor->id)
                        ->where('status', 1)
                        ->latest()
                        ->get();
                    @endphp
                    
                    <div class="product-rate d-inline-block">
                        @if ($avarage == 0)
                            <!--  -->
                        @elseif ($avarage == 1 || $avarage < 2)
                            <div class="product-rating" style="width: 20%"></div>
                        @elseif ($avarage == 2 || $avarage < 3)
                            <div class="product-rating" style="width: 40%"></div>
                        @elseif ($avarage == 3 || $avarage < 4)
                            <div class="product-rating" style="width: 60%"></div>
                        @elseif ($avarage == 4 || $avarage < 5)
                            <div class="product-rating" style="width: 80%"></div>
                        @elseif ($avarage == 5 || $avarage < 5)
                            <div class="product-rating" style="width: 100%"></div>
                        @endif

                    </div>
                    <span class="font-small ml-5 text-muted">
                        ({{ count($review_count)}})
                    </span>





                    <div class="vendor-des mb-30">
                        <p class="font-sm text-heading">{{ $vendor->vendor_short_info }}</p>
                    </div>
                    {{-- <hr>
                    <div class="vendor-info">
                        <ul class="font-sm mb-20">
                            <li>
                                <img class="mr-5" src="{{ asset('fronted/assets/imgs/theme/icons/icon-location.svg') }}" alt="" />
                                <strong>Adresse: </strong> <span>{{ $vendor->address }}</span>
                            </li>
                            <li>
                                <img class="mr-5" src="{{ asset('fronted/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" />
                                <strong>Téléphone: </strong><span>{{ $vendor->phone }}</span>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
