@extends('vendor.vendor_dashboard')

@section('vendor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Commandes</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">toutes les commandes</li>
                    </ol>
                </nav>
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    @if ($order_item->isEmpty())
                        <p>Vous n'avez pas encore reçu de commande. </p>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Numéro de commande</th>
                                    <th>Commandé le</th>
                                    <th>Montant de l'achat</th>
                                    <th>Statut commande</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_item as $key => $item)
                                    <tr>
                                        <td><a href="{{ route('vendor.order.details', $item->order->id) }}" class="underline-on-hover">{{ $item['order']['invoice_no'] }}</a> </td>
                                        <td>{{ Carbon\Carbon::parse($item['order']['order_date'])->translatedFormat('d F Y') }}</td>
                                        <td>{{ $item['order']['amount'] }}€</td>
                                        <td>
                                            @if ($item->order->status == 'En attente')
                                                <span class="badge rounded-pill bg-warning">En attente</span>
                                            @elseif ($item->order->status == 'Validé')
                                                <span class="badge rounded-pill bg-info">Validé</span>
                                            @elseif ($item->order->status == 'En cours')
                                                <span class="badge rounded-pill bg-secondary">En cours</span>
                                            @elseif ($item->order->status == 'Livré')
                                                <span class="badge rounded-pill bg-success">Livré</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex order-actions">	
                                                <a href="{{ route('vendor.order.details', $item->order->id) }}" class=""><i class="bx bx-show-alt btn btn-info"></i></a>
                                                <span class="px-2"></span>
                                                <a href="{{ route('vendor.invoice.download', $item->order->id) }}" class=""><i class="bx bx-download btn btn-success"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
