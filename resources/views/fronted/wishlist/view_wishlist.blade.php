@extends('fronted.master')

@section('main')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection
    

    
    <div class="container mb-30 mt-30">
        <div class="breadcrumb mb-80">
            <a href="{{ route('home') }}">Accueil</a>
            <span></span> favoris
        </div>

        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="mb-50">
                    <h4 class="heading-2 mb-10">Vos produits favoris</h4>
                </div>
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        
                        <tbody id="wishlist">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
