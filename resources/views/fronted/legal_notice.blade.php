@extends('fronted.master')

@section('main')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection



<div class="page-content pt-50" style="transform: none;">
    <div class="container" style="transform: none;">
        <div class="breadcrumb mb-80">
            <a href="{{ route('home') }}">Accueil</a>
            <span></span> Mentions légales
        </div>

        <div class="row" style="transform: none;">
            <div class="col-xl-10 col-lg-12 m-auto" style="transform: none;">
                <div class="row" style="transform: none;">
                    <div class="col-lg-12">
                        <div class="single-page pr-30 mb-lg-0 mb-sm-5">
                            
                            <div class="single-content mb-50" style="word-wrap: break-word;">

                                {!! $legal->legal_notice !!}

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
