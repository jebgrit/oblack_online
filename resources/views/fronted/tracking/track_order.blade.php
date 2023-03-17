@extends('fronted.master')

@section('main')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp
    
@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />



<style type="text/css">
    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #3BB77E
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #3BB77E;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }
</style>

<br>

<div class="container">

    <div class="breadcrumb mb-80">
        <a href="{{ route('home') }}">Accueil</a>
        <span></span> <a href="{{ route('user.track.order') }}">Suivre commande</a>
        <span></span> {{ $track->invoice_no }}
    </div>

    <article class="card">
        <div class="card-body">
            <h6>Numéro de commande : {{ $track->invoice_no }} </h6>

            <article class="card mt-4">
                <div class="card-body row">
                    <div class="col"> <strong>Date de commande:</strong> <br>{{ $track->order_date }}
                    </div>

                    <div class="col"> <strong>Envoyer à:</strong>
                        <br>
                        {{ $track->name }}
                    </div>

                    <div class="col"> <strong>Adresse livraison:</strong>
                        <br>{{ $track->address }}, {{ $track->zip_code }}, {{ $track->city }}
                    </div>

                    <div class="col"> <strong>Montant total #:</strong> <br>{{ $track->amount }}€
                    </div>
                </div>
            </article>
            <div class="track">

                @if ($track->status == 'En attente')
                    <div class="step active"> <span class="icon"> <i class="fa fa-user"></i>
                        </span><span class="text">Commande en attente</span>
                    </div>

                    <div class="step"> <span class="icon"> <i class="fa fa-check"></i>
                        </span><span class="text">Commande validé</span>
                    </div>

                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i>
                        </span> <span class="text">Commande en cours </span>
                    </div>

                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i>
                        </span> <span class="text">Livré </span>
                    </div>
                @elseif ($track->status == 'Validé')
                    <div class="step active"> <span class="icon"> <i class="fa fa-user"></i>
                        </span><span class="text">Commande en attente</span>
                    </div>

                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i>
                        </span><span class="text">Commande validé</span>
                    </div>

                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i>
                        </span> <span class="text">Commande en cours </span>
                    </div>

                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i>
                        </span> <span class="text">Livré </span>
                    </div>
                @elseif ($track->status == 'En cours')
                    <div class="step active"> <span class="icon"> <i class="fa fa-user"></i>
                        </span><span class="text">Commande en attente</span>
                    </div>

                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i>
                        </span><span class="text">Commande validé</span>
                    </div>

                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i>
                        </span> <span class="text">Commande en cours </span>
                    </div>

                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i>
                        </span> <span class="text">Livré </span>
                    </div>
                @elseif ($track->status == 'Livré')
                    <div class="step active"> <span class="icon"> <i class="fa fa-user"></i>
                        </span><span class="text">Commande en attente</span>
                    </div>

                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i>
                        </span><span class="text">Commande validé</span>
                    </div>

                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i>
                        </span> <span class="text">Commande en cours </span>
                    </div>

                    <div class="step active"> <span class="icon"> <i class="fa fa-box"></i>
                        </span> <span class="text">Livré </span>
                    </div>
                @endif

            </div>

            <hr>
            <a href="{{ route('user.track.order') }}" class="underline-on-hover"> Retour</a>
        </div>
    </article>
</div>


<br>


@endsection
