@extends('fronted.master')

@section('main')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection


<div class="page-content mb-50 mt-30" style="transform: none;">
    <div class="container">
        <div class="breadcrumb mb-80">
            <a href="{{ route('home') }}">Accueil</a>
            <span></span> <a href="{{ route('home.blog') }}">Blog</a> 
            <span></span> {{ $blog_details->post_title }}
        </div>
    </div>

    <div class="container" style="transform: none;">
        <div class="row" style="transform: none;">
            <div class="col-xl-12 col-lg-12 m-auto " style="transform: none;">
                <div class="row justify-content-md-center" style="transform: none;">
                    
                    <div class="col-lg-9">
                        <div class="single-page pt-50 pr-30" style="background-color: #fff">
                            <div class="single-header style-2">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-12 m-auto">
                                        <h2 class="mb-10">{{ $blog_details->post_title }}
                                        </h2>
                                        <div class="single-header-meta">
                                            <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                                <span class="post-by">Posté par {{ $setting->company_name }}</span>
                                                <span class="post-on has-dot">
                                                    {{ Carbon\Carbon::parse($blog_details->created_at)->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-content">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-12 m-auto" >
                                        <img class="border-radius-15" src="{{ asset($blog_details->post_image) }}" alt=""
                                            style="width: 790px; height:368px;">
                                    </div>
                                </div>
                            </div>

                            <div class="single-content mt-30">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-12 m-auto" style="word-wrap: break-word;">
                                        {!! $blog_details->post_long_description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
