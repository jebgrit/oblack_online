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
                        <li class="breadcrumb-item active" aria-current="page">Toutes les commandes
                            @if ($orders->isEmpty())
                                <span class="badge rounded-pill bg-danger">0</span>
                            @else
                                <span class="badge rounded-pill bg-danger"> {{ count($orders) }}</span>
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    @if ($orders->isEmpty())
                        <p>Vous n'avez pas encore reçu de commande.</p>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Numéro de commande</th>
                                    <th>Commandé le</th>
                                    <th>Montant de l'achat</th>
                                    <th>Statut paiement</th>
                                    <th>Statut commande</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $item)
                                    <tr>
                                        <td><a href="{{ route('order.details', $item->id) }}" class="underline-on-hover">{{ $item->invoice_no }}</a> </td>
                                        <td>{{ Carbon\Carbon::parse($item->order_date)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $item->amount }}€</td>
                                        <td>
                                            @if ($item->payment_status == 'unpaid')
                                                <span class="badge rounded-pill bg-danger">Non payé</span>
                                            @elseif ($item->payment_status == 'paid')
                                                <span class="badge rounded-pill bg-success">Payé</span>
                                            @endif 
                                        </td>
                                        <td>
                                            @if ($item->status == 'En attente')
                                                <span class="badge rounded-pill bg-warning">En attente</span>
                                            @elseif ($item->status == 'Validé')
                                                <span class="badge rounded-pill bg-info">Validé</span>
                                            @elseif ($item->status == 'En cours')
                                                <span class="badge rounded-pill bg-secondary">En cours</span>
                                            @elseif ($item->status == 'Livré')
                                                <span class="badge rounded-pill bg-success">Livré</span>
                                            @endif                                    
                                        </td>
                                        <td>
                                            <div class="d-flex order-actions">	
                                                <a href="{{ route('order.details', $item->id) }}" class=""><i class="bx bx-show-alt btn btn-info"></i></a>
                                                <span class="px-2"></span>
                                                <a href="{{ route('invoice.download', $item->id) }}" class=""><i class="bx bx-download btn btn-success"></i></a>
                                                <span class="px-2"></span>
                                                <a href="{{ route('delete.order', $item->id) }}" id="delete"><i class="bx bx-trash-alt btn btn-danger"></i></a>
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
