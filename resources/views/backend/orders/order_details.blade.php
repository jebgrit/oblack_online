@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Commandes</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Détails commande</li>
                    </ol>
                </nav>
            </div>
        </div>

        <hr />
        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">

            <div class="col">

                <div class="card">

                    <!-- -->
                    <div class="card-header">
                        <h4>Détails de la commande
                            <span class="text-danger">{{ $order->invoice_no }} </span>
                        </h4>
                    </div>
                    <br>
                    <div class="card-body">
                        <table class="table" style="background:#F4F6FA;font-weight: 600;">
                            <tr>
                                <th>Nom:</th>
                                <th>{{ $order->user->name }}</th>
                            </tr>

                            <tr>
                                <th>Téléphone:</th>
                                <th>{{ $order->user->phone }}</th>
                            </tr>

                            <tr>
                                <th>Adresse de livraison:</th>
                                <th>{{ $order->address }} {{ $order->zip_code }} {{ $order->city }}</th>
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
                                <th>Montant:</th>
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

                            <!-- Changement du statut d'une commande -->
                            <tr>
                                <th> </th>
                                <th>
                                    @if ($order->status == 'En attente')
                                        <a href="{{ route('pending-to-confirm', $order->id) }}" class="btn btn-block btn-success" id="confirm">Valider la commande</a>
                                    @elseif ($order->status == 'Validé')
                                        <a href="{{ route('confirm-to-processing', $order->id) }}" class="btn btn-block btn-success" id="processing">Confirmer la commande</a>
                                    @elseif ($order->status == 'En cours')
                                        <a href="{{ route('processing-to-delivered', $order->id) }}" class="btn btn-block btn-success" id="delivered">Commande la livraison</a>
                                    @endif
                                </th>
                            </tr>

                        </table>

                    </div>
                    <!-- -->
                </div>
            </div>
        </div>






        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
            <div class="col">
                <div class="card">


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
                                        <label>SKU</label>
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
                                        
                                        <td class="col-md-2">
                                            <label>{{ $item->product->vendor->name }} </label>
                                        </td>

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
@endsection
