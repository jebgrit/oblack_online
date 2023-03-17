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
                                            <h4 class="mb-0">Vos commandes</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">

                                                @if ($orders->isEmpty())
                                                    <p>Vous n'avez pas encore commandé de produit. <a href="{{ route('home') }}">Commencez ici</a></p>
                                                @else
                                                    <table class="table" style="background:#F4F6FA;font-weight: 600;">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Commandé le</th>
                                                                <th>Montant payé</th>
                                                                <th>No. de commande</th>
                                                                <th>Statut commande</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $key => $order)
                                                                <tr>
                                                                    <td>{{ $orders->firstItem() + $key }}</td>
                                                                    <td>{{ $order->order_date }}</td>
                                                                    <td>{{ $order->amount }}€</td>
                                                                    <td>{{ $order->invoice_no }}</td>
                                                                    <td>
                                                                        @if ($order->status == 'En attente')
                                                                            <span class="badge rounded-pill bg-warning">En attente</span>
                                                                        @elseif ($order->status == 'Validé')
                                                                            <span class="badge rounded-pill bg-info">Validé</span>
                                                                        @elseif ($order->status == 'En cours')
                                                                            <span class="badge rounded-pill bg-secondary">En cours</span>
                                                                        @elseif ($order->status == 'Livré')
                                                                            <span class="badge rounded-pill bg-success">Livré</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex order-actions">	
                                                                            <a href="{{ url('user/order-details/' . $order->id) }}" class="btn-sm btn-info">
                                                                                détails
                                                                            </a>
                                                                            <span class="px-2"></span>
                                                                            <a href="{{ url('user/invoice-download/' . $order->id) }}" class="btn-sm btn-success">
                                                                                facture
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>


                                                    <div class="d-flex justify-content-end">
                                                        {!! $orders->links() !!}
                                                    </div>

                                                @endif
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
    <br>
    <br>
    <br>
    <br>

@endsection
