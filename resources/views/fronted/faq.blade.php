@extends('fronted.master')

@section('main')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection



<div class="page-content pt-30 pb-30">
    <div class="container">
        <div class="breadcrumb mb-80">
            <a href="{{ route('home') }}">Accueil</a>
            <span></span> Faq
        </div>



        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <section class="mb-50">
                    <div class="row">
                        <div class="col-xl-12">

                            <h3 class="text-center pb-2 text-primary fw-bold">FAQ</h3>
                            <p class="text-center mb-4">
                                Trouvez ci-dessous les réponses aux questions les plus fréquemment posées
                            </p>
                            
                            <div class="row">
                                
                                @foreach ($faq as $item)
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <h6 class="mb-3 text-primary"><i class="fas fa-book-open text-primary pe-2"></i>{{ $item->question }}</h6>
                                        {{ $item->answer }}
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>



@endsection
