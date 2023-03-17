@extends('fronted.master')

@section('main')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection


    <div class="page-content mb-50 mt-30">
        <div class="container">
            <div class="breadcrumb mb-80">
                <a href="{{ route('home') }}">Accueil</a>
                <span></span> Blog
            </div>
            
        </div>

        <div class="container" >
            <div class="row">


                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">

                    <div class="loop-grid loop-big">

                        @foreach ($blog_post as $post)
                            <div class="row">

                                <article class="first-post mb-30 hover-up animated" style="visibility: visible">
                                    <div class="position-relative overflow-hidden">
                                        <div class="post-thumb border-radius-15">
                                            <a href="{{ url('post/details/' . $post->id . '/' .$post->post_slug) }}">
                                                <img class="border-radius-15" src="{{ asset($post->post_image) }}" alt="" style="width: 858px; height:417px;"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="entry-content">
                                        <h2 class="post-title mb-20">
                                            <a href="{{ url('post/details/' . $post->id . '/' .$post->post_slug) }}">{{ $post->post_title, 140 }} </a>
                                        </h2>

                                        <div class="style="word-wrap: break-word;>
                                            {!! Str::limit($post->post_long_description, 255) !!}
                                        </div>
                                        

                                        <div class="mb-20 entry-meta meta-2">
                                            <div class="entry-meta meta-1 mb-30 mt-30">
                                                <div class="font-sm">
                                                    <span><span class="mr-10 text-muted"><i class="fi-rs-clock"></i></span>{{ $post->created_at->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                            <a href="{{ url('post/details/' . $post->id . '/' .$post->post_slug) }}" class="btn btn-sm">Lire la suite<i class="fi-rs-arrow-right ml-10"></i></a>
                                        </div>
                                    </div>
                                </article>
                                
                            </div>
                        @endforeach
                    </div>

                    <!-- pagination -->
                    <div class="pagination-area mt-20 mb-20">
                        {{ $blog_post->links('fronted.vendor.paginate') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
