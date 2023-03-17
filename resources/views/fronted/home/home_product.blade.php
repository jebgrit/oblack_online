@php
    $vendor_status = App\Models\User::where('status', 'active')->get();
    
    $products = App\Models\Product::where('status', 1)
        ->orderBy('id', 'ASC')
        ->get();

    // dd($products);

        
    $categories = App\Models\Category::orderBy('category_name', 'ASC')
        ->limit(10)
        ->get();
@endphp

<section class="product-tabs section-padding position-relative">
    <div class="container">
        
        <!--End nav-tabs-->

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">

                <!--Product card-->
                <div class="row product-grid-4">
                    @foreach ($products as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            <img class="default-img" src="{{ asset($product->product_thumbnail) }}"
                                                alt="" />
                                        </a>
                                    </div>


                                    <!-- product badge -->
                                    @php
                                        $amount = (int) $product->product_price - (int) $product->discount_price;
                                        $discount = ($amount / (int) $product->product_price) * 100;
                                    @endphp
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @if ($product->discount_price == null)
                                            <!-- display nothing -->
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
                                            <p>vendu par {{ $setting->company_name }}</p>
                                        @else
                                            <span class="font-small text-muted">vendu par
                                                <a
                                                    href="{{ route('vendor.details', $product->vendor->id) }}">{{ $product['vendor']['name'] }}</a>
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
                                                <span class="old-price">{{ $product->product_price }}€</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>
</section>
