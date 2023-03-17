@extends('fronted.master')

@section('main')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection



    <div class="container mb-80 mt-30">
        <div class="breadcrumb mb-80">
            <a href="{{ route('home') }}">Accueil</a>
            <span></span> Panier
        </div>
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h4 class="heading-2 mb-10">Votre panier</h4>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive shopping-summery no-border">

                    <style>
                        table{
                            table-layout: fixed;
                        };
                        td{
                            word-wrap:break-word
                        }
                    </style>
                    <table class="table table-wishlist">
                        
                        <tbody id="cartPage">

                            <!-- data will diplay here with ajax -->

                        </tbody>
                    </table>
                </div>





                

                <!-- Coupon -->
                <div class="row mt-50">

                    <div class="col-lg-5">

                            <div class="table-responsive">
                                <table class="table no-border">
                                    <tbody id="couponCalField">
                                        
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('checkout') }}" class="btn mb-20">Retour</a>
                                <a href="{{ route('checkout') }}" class="btn mb-20 text-end">Continuer</a>
                            </div>
                            
                        </div>
                    </div>


                </div>
            </div>

            

        </div>
        
    </div>


</div>
<br>
<br>
<br>
@endsection
