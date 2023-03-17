@extends('dashboard')

@section('user')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection


<div class="page-content pt-50 pb-50">
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
                                        <h5>Suivez vos commandes</h5>
                                    </div>

                                    <div class="card-body contact-from-area">
                                        <p>Pour suivre votre commande, veuillez entrer votre numéro de commande dans
                                            la case ci-dessous et appuyez sur le bouton "Suivre". Celui-ci vous
                                            a été indiqué sur votre reçu et dans l'e-mail de confirmation que
                                            vous auriez dû recevoir.</p>
                                        <div class="row">
                                            <div class="col-lg-6">

                                                <form class="contact-form-style mt-30 mb-50" action="{{ route('order.tracking') }}" method="POST">
                                                    @csrf

                                                    <div class="input-style mb-20">
                                                        <label>Numéro de commande</label>
                                                        <input name="invoice_no"
                                                            placeholder="Votre numéro de commande"
                                                            type="text" required/>
                                                    </div>
                                                    
                                                    
                                                    <button class="submit submit-auto-width"
                                                        type="submit">Suivre</button>
                                                </form>

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
    </div>
</div>

@endsection
