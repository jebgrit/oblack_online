@extends('dashboard')

@section('user')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ '/' }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Accueil</a>
            <span></span> vos commandes
        </div>
    </div>
</div>
<div class="page-content pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">

                    <!-- Menu -->
                    @include('fronted.body.dashboard_sidebar_menu')
                    <!-- End menu -->

                    <div class="col-md-9">

                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    Détails de la commande
                                </h4>
                            </div>
                            <br>
                            <div class="card-body">
                                <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                    <tr>
                                        <th>Nom:</th>
                                        <th>{{ $order->name }}</th>
                                    </tr>

                                    <tr>
                                        <th>Téléphone:</th>
                                        <th>{{ $order->phone }}</th>
                                    </tr>

                                    <tr>
                                        <th>Adresse de livraison:</th>
                                        <th>{{ $order->address }}, {{ $order->zip_code }}, {{ $order->city}}
                                        </th>
                                    </tr>

                                    <tr>
                                        <th>Type de paiement:</th>
                                        <th>{{ $order->payment_method }}</th>
                                    </tr>

                                    <tr>
                                        <th>Date de commande:</th>
                                        <th>{{ $order->order_date }}</th>
                                    </tr>


                                    <tr>
                                        <th>Numéro de commande:</th>
                                        <th class="text-danger">{{ $order->invoice_no }}</th>
                                    </tr>

                                    <tr>
                                        <th>Montant de la commande:</th>
                                        <th>{{ $order->amount }}€</th>
                                    </tr>

                                    <tr>
                                        <th>Statut de la commande:</th>
                                        <th>
                                            @if ($order->status == 'En attente')
                                                <span class="badge rounded-pill bg-warning">En attente</span>
                                            @elseif ($order->status == 'Validé')
                                                <span class="badge rounded-pill bg-info">Validé</span>
                                            @elseif ($order->status == 'En cours')
                                                <span class="badge rounded-pill bg-secondary">En cours</span>
                                            @elseif ($order->status == 'Livré')
                                                <span class="badge rounded-pill bg-success">Livré</span>
                                            @endif
                                        </th>
                                    </tr>

                                </table>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" style="font-weight: 600;">
                                <tbody>
                                    <tr>
                                        <td class="col-md-1">
                                            <label>Aperçu</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label>Produit</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label>Vendeur</label>
                                        </td>
                                        <td class="col-md-2">
                                            <label>Code de référence</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label>Couleur</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label>Taille</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label>Quantité</label>
                                        </td>

                                        <td class="col-md-3">
                                            <label>Prix</label>
                                        </td>

                                    </tr>


                                    @foreach ($order_item as $item)
                                        <tr>
                                            <td class="col-md-1">
                                                <label><img src="{{ asset($item->product->product_thumbnail) }}"
                                                        style="width:50px; height:50px;"> </label>
                                            </td>
                                            <td class="col-md-2">
                                                <label>{{ $item->product->product_name }}</label>
                                            </td>
                                            @if ($item->vendor_id == null)
                                                <td class="col-md-2">
                                                    <label>Vocoursse </label>
                                                </td>
                                            @else
                                                <td class="col-md-2">
                                                    <label>{{ $item->product->vendor->name }} </label>
                                                </td>
                                            @endif

                                            <td class="col-md-2">
                                                <label>{{ $item->product->product_code }} </label>
                                            </td>
                                            @if ($item->color == null)
                                                <td class="col-md-1">
                                                    <label>... </label>
                                                </td>
                                            @else
                                                <td class="col-md-1">
                                                    <label>{{ $item->color }} </label>
                                                </td>
                                            @endif

                                            @if ($item->size == null)
                                                <td class="col-md-1">
                                                    <label>... </label>
                                                </td>
                                            @else
                                                <td class="col-md-1">
                                                    <label>{{ $item->size }} </label>
                                                </td>
                                            @endif
                                            <td class="col-md-1">
                                                <label>{{ $item->qty }} </label>
                                            </td>

                                            <td class="col-md-3">
                                                <label>
                                                    {{ $item->price }}€
                                                </label>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>

            </div>

        </div>

    </div>
</div>
@endsection
