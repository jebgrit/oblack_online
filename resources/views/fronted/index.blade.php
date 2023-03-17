@extends('fronted.master')

@section('main')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection

<!--Home slider-->
<section class="home-slider position-relative mb-30">
    <div class="container">
        <div class="home-slide-cover mt-30">
            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">

                @foreach ($slider as $item)
                    <div class="single-hero-slider single-animation-wrap" style="background-image: url({{ asset($item->slider_image) }})">
                        <div class="slider-content">
                            <p class="mb-65 text-dark">{{ $item->slider_title }}</p>
                            
                            <form class="form-subcriber d-flex" method="POST" action="{{ route('newsletter.store') }}">
                                @csrf

                                <input type="email" name="email" placeholder="Votre adresse email" required/>
                                <button class="btn" type="submit">Souscrire</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </div>
    </div>
</section>

<!--Tous les produits-->
@include('fronted.home.home_product')


@endsection
