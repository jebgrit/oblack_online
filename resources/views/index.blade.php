@extends('dashboard')

@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

@section('title')
    {{ $setting->company_name }}.fr: Dashboard
@endsection

@section('user')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    
    <div class="page-content pt-30 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="row">

                        <!-- Menu -->
                        @include('fronted.body.dashboard_sidebar_menu')
                        <!-- End menu -->


                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">

                                <!-- photo profil -->
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center">
                                                <div class="recent-product-img">
                                                    <img src="{{ !empty($userData->photo) ? url('upload/user_images/' . $userData->photo) : url('upload/user_images/no_image.jpg') }}" class="rounded-circle" alt="" style="width: 70px; height: 70px">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Bonjour {{ ucfirst(Auth::user()->name) }}!</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                Depuis le tableau de bord de votre compte. vous pouvez facilement
                                                afficher <a href="{{ route('user.order.page') }}">vos commandes </a>récentes,<br />
                                                les<a href="{{ route('user.track.order') }}"> suivres </a> et modifier votre <a href="{{ route('user.change.password') }}">mot de
                                                passe</a>.
                                            </p>
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
