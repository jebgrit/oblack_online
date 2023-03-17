@extends('admin.admin_dashboard')

@section('admin')
    @php
        $date = date('d-m-y');
        $today = App\Models\Order::where('order_date', $date)->sum('amount');
        
        $month = date('F');
        $month = App\Models\Order::where('order_month', $month)->sum('amount');
        
        $year = date('Y');
        $year = App\Models\Order::where('order_year', $year)->sum('amount');
        
        $pending = App\Models\Order::where('status', 'En attente')->get();
        
        $vendor = App\Models\User::where('status', 'active')
            ->where('role', 'vendor')
            ->get();
        
        $customer = App\Models\User::where('status', 'active')
            ->where('role', 'user')
            ->get();
    @endphp

    <div class="page-content">

        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">

            <!-- Today sell -->
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Vendu aujourd'hui</p>
                                <h4 class="my-1">{{ $today }}€</h4>
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>

            <!-- Month sell -->
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Vendu ce mois</p>
                                <h4 class="my-1">{{ $month }}€</h4>
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>

            <!-- Year sell -->
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Vendu cette année</p>
                                <h4 class="my-1">{{ $year }}€</h4>
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>

            <!-- Year sell -->
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Commande en attente</p>
                                <h4 class="my-1">{{ count($pending) }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-info text-info ms-auto"><i class='bx bxs-cart'></i>
                            </div>
                        </div>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>

            <!-- vendors -->
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Vendeurs</p>
                                <h4 class="my-1">{{ count($vendor) }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class='bx bxs-store'></i>
                            </div>
                        </div>
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>

            <!-- users -->
            <div class="col-lg-12">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Clients</p>
                                <h4 class="my-1">{{ count($customer) }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-user'></i>
                            </div>
                        </div>
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->


        @php
            $orders = App\Models\Order::where('status', 'En attente')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        @endphp

        <!--end row-->
        @if ($orders->isEmpty())
            <!-- -->
        @else
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Commandes en attente</h5>
                        </div>
                    </div>
                    <hr />
                    <div class="table-responsive">
                        
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Facture</th>
                                    <th>Date</th>
                                    <th>Montant</th>
                                    <th>Paiement</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>#{{ $order->invoice_no }}</td>
                                        <td>{{ Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $order->amount }}€</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>
                                            <div class="d-flex align-items-center text-warning"> <i
                                                    class='bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1'></i>
                                                <span>{{ $order->status }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="d-flex justify-content-center">
                    {!! $orders->links() !!}
                </div>
            </div>
        @endif
    </div>
@endsection
