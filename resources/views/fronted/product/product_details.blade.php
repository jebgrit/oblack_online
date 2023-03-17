@extends('fronted.master')

@section('main')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>



<div class="container mb-30 mt-30">
    <div class="breadcrumb mb-80">
        <a href="{{ route('home') }}">Accueil</a>
        <span></span> <a href="{{ url('product/category/' . $product->category->id . '/' . $product->category->category_slug) }}">{{ $product['category']['category_name'] }}</a>
        <span></span> {{ $product->product_name }}
    </div>

    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <div class="product-detail accordion-detail">
                <div class="row mb-50 mt-30">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>

                            <!-- Main slides -->
                            <div class="product-image-slider">
                                @foreach ($multi_img as $img)
                                    <figure class="border-radius-10">
                                        <img src="{{ asset($img->photo_name) }}" alt="product image" />
                                    </figure>
                                @endforeach
                            </div>

                            <!-- Thumbnails -->
                            <div class="slider-nav-thumbnails">
                                @foreach ($multi_img as $img)
                                    <div>
                                        <img src="{{ asset($img->photo_name) }}" alt="product image" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12" style="background-color: #fff">
                        <div class="detail-info pr-30 pl-30">

                            @if ($product->product_quantity > 0)
                                <span class="stock-status in-stock">En stock</span>
                            @else
                                <span class="stock-status out-stock">Epuisé</span>
                            @endif

                            <h2 class="title-detail" id="dpname">{{ $product->product_name }}</h2>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">

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
                                    <span class="font-small ml-5 text-muted"> {{ count($review_count) }} avis </span>
                                </div>
                            </div>
                            <div class="clearfix product-price-cover">

                                <!-- Code -->
                                @php
                                    $amount = (int) $product->product_price - (int) $product->discount_price;
                                    $discount = ($amount / (int) $product->product_price) * 100;
                                @endphp
                                <!-- end code -->


                                @if ($product->discount_price == null)
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">{{ $product->product_price }}€</span>
                                    </div>
                                @else
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">{{ $product->discount_price }}€</span>
                                        <span>
                                            <span class="save-price font-md color3 ml-15">{{ round($discount) }}% de
                                                réduction</span>
                                            <span class="old-price font-md ml-15">{{ $product->product_price }}€</span>
                                        </span>
                                    </div>
                                @endif

                            </div>
                            
                            <br>

                            <div class="detail-extralink mb-50">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="quantity" id="dquantity" class="qty-val" value="1"
                                        min="1">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>

                                <div class="product-extra-link2">

                                    <input type="hidden" id="dproduct_id" value="{{ $product->id }}">
                                    <input type="hidden" id="vproduct_id" value="{{ $product->vendor_id }}">

                                    <button type="submit" class="button button-add-to-cart"
                                        onclick="addToCartDetails()">
                                        <i class="fi-rs-shopping-cart"></i>Ajouter au panier
                                    </button>
                                    
                                </div>
            
                            </div>
                            

                            <!-- Report product modal -->
                            <div id="report_product_modal" class="modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Signaler ce produit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="closeModal"></button>

                                        </div>

                                        <form action="{{ route('store.report.product') }}" method="POST">
                                            @csrf

                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                                            <div class="modal-body">

                                                <p>Pour obtenir de l'aide concernant une commande ou votre compte, veuillez contacter le <a href="{{ route('contact') }}">service client</a>.</p>
                                                <br>

                                                <h6 class="modal-title">Quel est le problème ?</h6>
                                                <br>
                                                <div class="form-group">
                                                    
                                                    <select class="form-select" name="product_report_reason" required>
                                                        <option value="" hidden=""hidden>---choisissez</option>
                                                        <optgroup label="Nom du produit">
                                                            <option value="Le nom ne correspond pas à la description">Le nom ne correspond pas à la description</option>                                                 
                                                            <option value="Le nom ne correspond pas à l'image">Le nom ne correspond pas à l'image</option>                                               
                                                        <optgroup label="Prix">
                                                            <option value="Le prix est trop élevé">Le prix est trop élevé</option>
                                                            <option value="Le prix est trop bas">Le prix est trop bas</option>
                                                            <option value="Le prix de référence est inexact ou trompeur">Le prix de référence est inexact ou trompeur</option>
                                                        <optgroup label="Image du produit">
                                                            <option value="L'image ne correspond pas à la description">L'image ne correspond pas à la description</option>
                                                            <option value="Trop peu d'images">Trop peu d'images</option>
                                                            <option value="Image peu claire">Image peu claire</option>
                                                            <option value="Image trompeuse">Image trompeuse</option>
                                                            <option value="Image à caractère pornographique">Image à caractère pornographique</option>
                                                        <optgroup label="Description du produit">
                                                            <option value="Description du produit inexacte ou trompeuse">Description du produit inexacte ou trompeuse</option>
                                                            <option value="Taille ou dimension manquante">Taille ou dimension manquante</option>
                                                        <optgroup label="Produit interdit/offensant">
                                                            <option value="Produit interdit">Produit interdit</option>
                                                            <option value="Produit offensant">Produit offensant</option>
                                                        <optgroup label="Activité illégale présumée">
                                                            <option value="Le produit et/ou l'image porte atteinte à une marque">Le produit et/ou l'image porte atteinte à une marque</option>
                                                            <option value="Le produit et/ou l'image enfreint un droit d'auteur">Le produit et/ou l'image enfreint un droit d'auteur</option>
                                                            <option value="Le produit et/ou l'image porte atteinte à un droit à l'image">Le produit et/ou l'image porte atteinte à un droit à l'image</option>
                                                            <option value="Le produit est contrefait">Le produit est contrefait</option>
                                                        <optgroup label="Problème de propriété intellectuelle">
                                                            <option value="Transaction ou activité suspecte">Transaction ou activité suspecte</option>
                                                            <option value="Activité criminelle suspectée impliquant une menace potentielle pour la vie ou la sécurité des personnes">Activité criminelle suspectée impliquant une menace potentielle pour la vie ou la sécurité des personnes</option>
                                                            <option value="Autre activité illégale présumée">Autre activité illégale présumée</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" >Soumettre</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End report product modal -->




                            @auth
                                <h6>
                                    <i class="fi-rs-flag"></i>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#report_product_modal">Signaler</a>
                                </h6>
                            @else
                                <!-- -->
                            @endauth
                            
                            <hr>

                            <div class="font-s">
                                <ul class="mr-50 float-start">
                                    <li class="mb-5">Marque:
                                        <a href="{{ route('brand.details', $product->brand->id) }}">
                                            <span class="text-brand">{{ $product['brand']['brand_name'] }}</span>
                                        </a>
                                    </li>
                                    <li class="mb-5">SKU:
                                        <span class="text-brand">{{ $product->product_code }}</span>
                                    </li>

                                    @if ($product->product_country == null)
                                        <!--- -->
                                    @else
                                        <li class="mb-5">Pays d'origine:
                                            <span class="text-brand">{{ $product->product_country }}</span>
                                        </li>
                                    @endif

                                    @if ($product->product_color == null)
                                        <!--- -->
                                    @else
                                        <li class="mb-5">Couleur:
                                            <span class="text-brand" id="dcolor">{{ $product->product_color }}</span>
                                        </li>
                                    @endif

                                </ul>
                                <ul class="float-start">
                                    @if ($product->vendor_id == null)
                                        <!--- -->
                                    @else
                                        <li class="mb-5">Vendu par:
                                            <a href="{{ route('vendor.details', $product->vendor->id) }}">
                                                <span class="text-brand">{{ $product['vendor']['name'] }}</span>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($product->product_type == null)
                                        <!--- -->
                                    @else
                                        <li class="mb-5">Type:
                                            <span class="text-brand">{{ $product->product_type }}</span>
                                        </li>
                                    @endif

                                    <li class="mb-5">Date d'ajout:
                                        <span class="text-brand">{{ $product->created_at->translatedFormat('d F Y') }}</span>
                                    </li>

                                    @if ($product->product_size == null)
                                        <!--- -->
                                    @else
                                        <li class="mb-5">Taille:
                                            <span class="text-brand" id="dsize">{{ $product->product_size }}</span>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>




                <!-- menu informations-->
                <div class="product-info" style="background-color: #fff">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs text-uppercase">
                            
                            <li class="nav-item">
                                <a class="nav-link active" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">
                                    Information détaillée
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">
                                    ({{ count($review_count) }}) avis
                                </a>
                            </li>


                        </ul>
                        <div class="tab-content shop_info_tab entry-main-content">

                            <div class="tab-pane show active fade" id="Additional-info">
                                <div class="" style="word-wrap: break-word;">
                                    {!! $product->long_description !!}
                                </div>
                            </div>


                            <!-- Avis -->
                            <div class="tab-pane fade" id="Reviews">

                                @if (count($review_count) == 0)
                                    <h6 class="mb-15 text-danger">Soyez le premier à laisser votre avis.</h6>
                                @else
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">

                                                <h4 class="mb-30">Avis </h4>

                                                <div class="comment-list">

                                                    @php
                                                        $reviews = App\Models\Review::where('product_id', $product->id)
                                                            ->latest()
                                                            ->get();
                                                    @endphp

                                                    @foreach ($reviews as $item)
                                                        {{-- admin must approve comment before display it  --}}
                                                        @if ($item->status == 0)
                                                            <!-- display anything because admin don't approve it -->
                                                        @else
                                                            <div
                                                                class="single-comment justify-content-between d-flex mb-30">
                                                                <div class="user justify-content-between d-flex">
                                                                    <div class="thumb text-center">
                                                                        <img src="{{ !empty($item->user->photo) ? url('upload/user_images/' . $item->user->photo) : url('upload/user_images/no_image.jpg') }}"
                                                                            alt="" />
                                                                        <span
                                                                            class="font-heading text-brand">{{ $item->user->name }}</span>
                                                                    </div>
                                                                    <div class="desc">
                                                                        <div class="mb-10">
                                                                            <div class="product-rate d-inline-block">
                                                                                @if ($item->rating == null)
                                                                                    <!--  -->
                                                                                @elseif ($item->rating == 1)
                                                                                    <div class="product-rating"
                                                                                        style="width: 20%"></div>
                                                                                @elseif ($item->rating == 2)
                                                                                    <div class="product-rating"
                                                                                        style="width: 40%"></div>
                                                                                @elseif ($item->rating == 3)
                                                                                    <div class="product-rating"
                                                                                        style="width: 60%"></div>
                                                                                @elseif ($item->rating == 4)
                                                                                    <div class="product-rating"
                                                                                        style="width: 80%"></div>
                                                                                @elseif ($item->rating == 5)
                                                                                    <div class="product-rating"
                                                                                        style="width: 100%"></div>
                                                                                @endif
                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-between mb-10">
                                                                                <span class="font-xs text-muted">
                                                                                    {{ $item->created_at->translatedFormat('d F Y à H\hi') }}
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="content">
                                                                            <p class="mb-10 text-dark" style="word-break: break-all;">
                                                                                <strong>
                                                                                    {{ $item->title }}
                                                                                </strong>
                                                                            </p>
                                                                            <p class="mb-10" style="word-break: break-all;">
                                                                                {{ $item->comment }}
                                                                                @auth
                                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#report_modal">Signaler</a>
                                                                                @else
                                                                                    <!-- -->
                                                                                @endauth
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <!-- Report comment modal -->
                                                        <div id="report_modal" class="modal" tabindex="-1"
                                                            role="dialog">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Signaler cet avis</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
                                                                    </div>

                                                                    

                                                                    <form action="#" method="POST" id="reportForm">
                                                                        @csrf

                                                                        <input type="hidden" name="review_id"
                                                                            value="{{ $item->id }}">
                                                                        <input type="hidden" name="product_id"
                                                                            value="{{ $product->id }}">

                                                                        <div class="modal-body">

                                                                            <div id="show_success_alert_report"></div>

                                                                            <div class="form-group">
                                                                                <textarea name="report" class="form-control" placeholder="Décrivez le problème" id="report"></textarea>
                                                                                <div class="invalid-feedback"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input type="submit" value="Soumettre" class="bg-info rounded-0 text-white" id="report_btn">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End report comment modal -->
                                                    @endforeach

                                                </div>
                                            </div>







                                            @php
                                                
                                                $id = $product->id;
                                                
                                                $average_rating = 0;
                                                $total_review = 0;
                                                $five_star_review = 0;
                                                $four_star_review = 0;
                                                $three_star_review = 0;
                                                $two_star_review = 0;
                                                $one_star_review = 0;
                                                $total_user_rating = 0;
                                                $review_content = [];
                                                
                                                // le calcul de la moyenne des avis est effectué sur les com ayant été approuvé et acheté

                                                $result = App\Models\Review::where('product_id', $id)
                                                    ->where('status', 1)
                                                    ->get();
                                                
                                                foreach ($result as $value) {
                                                    $review_content[] = [
                                                        'user_id' => $value['user_id'],
                                                        'comment' => $value['comment'],
                                                        'rating' => $value['rating'],
                                                    ];
                                                
                                                    if ($value['rating'] == '5') {
                                                        $five_star_review++;
                                                    }
                                                
                                                    if ($value['rating'] == '4') {
                                                        $four_star_review++;
                                                    }
                                                
                                                    if ($value['rating'] == '3') {
                                                        $three_star_review++;
                                                    }
                                                
                                                    if ($value['rating'] == '2') {
                                                        $two_star_review++;
                                                    }
                                                
                                                    if ($value['rating'] == '1') {
                                                        $one_star_review++;
                                                    }
                                                
                                                    $total_review++;
                                                
                                                    $total_user_rating = $total_user_rating + $value['rating'];
                                                }
                                                
                                                // prevent error division par zero
                                                if ($total_review == 0) {
                                                    $average_rating = 0;
                                                
                                                    $five_star_progress = 0;
                                                    $four_star_progress = 0;
                                                    $three_star_progress = 0;
                                                    $two_star_progress = 0;
                                                    $one_star_progress = 0;
                                                } else {
                                                    $average_rating = $total_user_rating / $total_review;
                                                
                                                    $five_star_progress = ($five_star_review / $total_review) * 100;
                                                    $four_star_progress = ($four_star_review / $total_review) * 100;
                                                    $three_star_progress = ($three_star_review / $total_review) * 100;
                                                    $two_star_progress = ($two_star_review / $total_review) * 100;
                                                    $one_star_progress = ($one_star_review / $total_review) * 100;
                                                }
                                                
                                            @endphp



                                            <div class="col-lg-4">


                                                <h4 class="mb-30">Avis des clients </h4>
                                                <div class="d-flex mb-30">


                                                    <div class="product-rate d-inline-block mr-15">
                                                        @if ($average_rating == 0)
                                                            <!--  -->
                                                        @elseif ($average_rating == 1 || $average_rating < 2)
                                                            <div class="product-rating" style="width: 20%"></div>
                                                        @elseif ($average_rating == 2 || $average_rating < 3)
                                                            <div class="product-rating" style="width: 40%"></div>
                                                        @elseif ($average_rating == 3 || $average_rating < 4)
                                                            <div class="product-rating" style="width: 60%"></div>
                                                        @elseif ($average_rating == 4 || $average_rating < 5)
                                                            <div class="product-rating" style="width: 80%"></div>
                                                        @elseif ($average_rating == 5 || $average_rating < 5)
                                                            <div class="product-rating" style="width: 100%"></div>
                                                        @endif

                                                    </div>

                                                    <h6><span>{{ round($average_rating, 1) }}</span> / 5</h6>
                                                </div>

                                                <div>
                                                    <div class="progress">
                                                        <span>5 <span class="text-warning">★</span></span>
                                                        <span>({{ $five_star_review }})</span>
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ round($five_star_progress) }}%;"
                                                            aria-valuenow="{{ round($five_star_progress) }}"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            {{ round($five_star_progress) }}%</div>

                                                    </div>
                                                    <div class="progress">
                                                        <span>4 <span class="text-warning">★</span></span>
                                                        <span>({{ $four_star_review }})</span>
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ round($four_star_progress) }}%;"
                                                            aria-valuenow="{{ round($four_star_progress) }}"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            {{ round($four_star_progress) }}%</div>
                                                    </div>
                                                    <div class="progress">
                                                        <span>3 <span class="text-warning">★</span></span>
                                                        <span>({{ $three_star_review }})</span>
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ round($three_star_progress) }}%;"
                                                            aria-valuenow="{{ round($three_star_progress) }}"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            {{ round($three_star_progress) }}%</div>

                                                    </div>
                                                    <div class="progress">
                                                        <span>2 <span class="text-warning">★</span></span>
                                                        <span>({{ $two_star_review }})</span>
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ round($two_star_progress) }}%;"
                                                            aria-valuenow="{{ round($two_star_progress) }}"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            {{ round($two_star_progress) }}%</div>

                                                    </div>
                                                    <div class="progress mb-30">
                                                        <span>1 <span class="text-warning">★</span></span>
                                                        <span>({{ $one_star_review }})</span>
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: {{ round($one_star_progress) }}%;"
                                                            aria-valuenow="{{ round($one_star_progress) }}"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            {{ round($one_star_progress) }}%</div>

                                                    </div>
                                                </div>

                                                <a href="#how" data-bs-toggle="collapse" aria-expanded="false"
                                                    aria-controls="how" class="font-xs">
                                                    <small><u>Comment les notes sont-elles calculées ?</u></small>
                                                    <div class="collapse mt-3 text-dark" id="how">
                                                        Les avis clients, y compris le nombre d’étoiles du produit,
                                                        aident les clients à en savoir plus sur le produit et à décider
                                                        s'il leur convient.<br><br>

                                                        Seuls les clients {{ $setting->company_name }} qui ont acheté
                                                        cet
                                                        article peuvent donner
                                                        une note et partager leur avis sans aucune contrepartie. La note
                                                        générale (sur 5 étoiles) est une moyenne de toutes les notes.
                                                        Nous
                                                        publions
                                                        les avis positifs et négatifs après les avoir modérés.
                                                    </div>
                                                </a>


                                            </div>



                                        </div>
                                    </div>
                                @endif






                                <!--comment form-->
                                <div class="comment-form">
                                    <h4 class="mb-15">Laissez votre avis et une note</h4>

                                    @guest
                                        <p>
                                            <b><a href="{{ route('login') }}">Connectez-vous</a> pour ajouter un avis.</b>
                                        </p>
                                    @else
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">

                                                <div id="show_success_alert"></div>

                                                <form class="form-contact comment_form" action="#" id="commentForm" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                    @if ($product->vendor_id == null)
                                                        <input type="hidden" name="hvendor_id" value="">
                                                    @else
                                                        <input type="hidden" name="hvendor_id"
                                                            value="{{ $product->vendor_id }}">
                                                    @endif


                                                    <style>
                                                        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

                                                        .stars input {
                                                            display: none;
                                                        }

                                                        .stars label {
                                                            float: right;
                                                            font-size: 50px;
                                                            color: lightgrey;
                                                            margin: 0 5px;
                                                            margin-bottom: 15px;
                                                            /* text-shadow: 1px 1px #bbb; */
                                                        }

                                                        .stars label:before {
                                                            content: '★';
                                                        }

                                                        .stars input:checked~label {
                                                            color: gold;
                                                            /* text-shadow: 1px 1px #c60; */
                                                        }

                                                        .stars:not(:checked)>label:hover,
                                                        .stars:not(:checked)>label:hover~label {
                                                            color: gold;
                                                        }

                                                        .stars input:checked>label:hover,
                                                        .stars input:checked>label:hover~label {
                                                            color: gold;
                                                            text-shadow: 1px 1px goldenrod;
                                                        }

                                                        .stars input:checked~.result:before {
                                                            display: block;
                                                        }

                                                        .stars #five:checked~.result:before {
                                                            content: "J'adore  😍";
                                                        }

                                                        .stars #four:checked~.result:before {
                                                            content: "J'aime  😎";
                                                        }

                                                        .stars #three:checked~.result:before {
                                                            content: "C'est bien 🙂";
                                                        }

                                                        .stars #two:checked~.result:before {
                                                            content: "je n'aime pas 🙁";
                                                        }

                                                        .stars #one:checked~.result:before {
                                                            content: "Je déteste 😠";
                                                        }
                                                    </style>

                                                    <div class="row">

                                                        <div class="col-12">
                                                            <div class="stars">
                                                                <input type="radio" id="five" name="quality" value="5" class="form-control">
                                                                <label for="five"></label>

                                                                <input type="radio" id="four" name="quality" value="4" class="form-control">
                                                                <label for="four"></label>

                                                                <input type="radio" id="three" name="quality" value="3" class="form-control">
                                                                <label for="three"></label>

                                                                <input type="radio" id="two" name="quality" value="2" class="form-control">
                                                                <label for="two"></label>

                                                                <input type="radio" id="one" name="quality" value="1" class="form-control">
                                                                <label for="one"></label>

                                                                <div class="invalid-feedback"></div>

                                                                <span class="result" style="font-size: 20px;"></span>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input class="form-control" name="title" id="title" type="text" placeholder="Qu'est-ce qui est le plus important à savoir ?">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Qu'est-ce que vous avez aimé ou n'avez pas aimé ?" ></textarea>
                                                                    
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" value="Soumettre" class="bg-info rounded-0 text-white" id="comment_btn">
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    @endguest



                                </div>
                            </div>

                        </div>
                    </div>
                </div>










                <!-- Produits similaires -->

                <section class="section-padding pb-5 mt-60">
                    <div class="container">
                        <div class="section-title wow animate__animated animate__fadeIn">

                            @if (count($related_product) == 0)
                                <!-- -->
                            @else
                                <h5 class="">Vous pourriez aussi aimer</h5>
                            @endif
                            
                        </div>
                        <div class="row">
                
                            <div class="col-lg-12 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                                <div class="tab-content" id="myTabContent-1">
                                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                                        <div class="carausel-4-columns-cover arrow-center position-relative">
                                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                                id="carausel-4-columns-arrows"></div>
                                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                
                                                @foreach ($related_product as $product)
                                                    <div class="product-cart-wrap">
                                                        <div class="product-img-action-wrap">
                                                            <div class="product-img product-img-zoom">
                                                                <a
                                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                                                    <img class="default-img"
                                                                        src="{{ asset($product->product_thumbnail) }}" alt="" />
                                                                </a>
                                                            </div>
                                                            
                                                            
                                                            
                
                                                            <!-- product badge -->
                                                            @php
                                                                $amount = (int) $product->product_price - (int) $product->discount_price;
                                                                $discount = ($amount / (int) $product->product_price) * 100;
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
                
                
                                                            <!-- product price -->
                                                            @if ($product->discount_price == null)
                                                                <div class="product-price mt-10">
                                                                    <span>{{ $product->product_price }}€</span>
                                                                </div>
                                                            @else
                                                                <div class="product-price mt-10">
                                                                    <span>{{ $product->discount_price }}€</span>
                                                                    <span class="old-price">{{ $product->product_price }}€</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!--End product Wrap-->
                                                @endforeach
                
                                            </div>
                                        </div>
                                    </div>
                                    <!--End tab-pane-->
                
                
                                </div>
                                <!--End tab-content-->
                            </div>
                            <!--End Col-lg-9-->
                        </div>
                    </div>
                </section>







            </div>
        </div>
    </div>
</div>



<!-- comment script -->
<script type="text/javascript">
    $(function(){
        $("#commentForm").submit(function(e){
            e.preventDefault();
            $("#comment_btn").val('Traitement...');
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: $(this).serialize(),
                url: "/storeReview",
                success: function(res){
                    // console.log(res);
                    if(res.status == 400){
                        showError('title', res.messages.title);
                        showError('comment', res.messages.comment);
                        $("#comment_btn").val('Soumettre');
                    } else if(res.status == 200) {
                        $("#show_success_alert").html(showMessage('success', res.messages));
                        $("#commentForm")[0].reset();
                        removeValidationClasses("#commentForm");
                        $("#comment_btn").val('Soumettre');
                    }
                }
            })
        });
    });
</script> 


<!-- report script -->
<script type="text/javascript">
    $(function(){
        $("#reportForm").submit(function(e){
            e.preventDefault();
            $("#report_btn").val('Traitement...');
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: $(this).serialize(),
                url: "/storeReport",
                success: function(res){
                    // console.log(res);
                    if(res.status == 400){
                        showError('report', res.messages.report);
                        $("#report_btn").val('Soumettre');
                    } else if(res.status == 200) {
                        $("#show_success_alert_report").html(showMessage('success', res.messages));
                        $("#reportForm")[0].reset();
                        removeValidationClasses("#reportForm");
                        $("#report_btn").val('Soumettre');
                    }
                }
            })
        });
    });
</script> 




@endsection
