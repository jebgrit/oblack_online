@extends('vendor.vendor_dashboard')

@section('vendor')
    @php
        $id = Auth::user()->id;
        $vendorId = App\Models\User::find($id);
        $status = $vendorId->status;

        $setting = App\Models\SiteSetting::find(1);

    @endphp
    

    @php
        $vendor = auth()->user()->id;
        
        $stock = App\Models\Product::where('vendor_id', $vendor)->sum('product_quantity');
        
        $qty = App\Models\OrderItem::where('vendor_id', $vendor)->sum('qty');
        
        $amount = App\Models\Product::where('vendor_id', $vendor)->sum('product_price');
        
    @endphp

    <div class="page-content">

        @if ($status === 'active')
            <h4 class="d-flex align-items-center text-success"> <i
                    class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                <span>Actif</span>
            </h4>

        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">

            <!-- Today sell -->
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Stock total de produit restant</p>
                                <h4 class="my-1">{{ $stock }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-package'></i>
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
                                <p class="mb-0 text-secondary">Quantité total de produit vendu</p>
                                <h4 class="my-1">{{ $qty }}</h4>
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
                                <p class="mb-0 text-secondary">Montant total des produits mis en vente</p>
                                <h4 class="my-1">{{ $amount }}€</h4>
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
        </div>

        @else
            <h4 class="d-flex align-items-center text-danger"> <i
                    class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                <span>Inactif</span>
            </h4>
            <p class="text-danger"><b>Nous vous prions d'attendre que l'administrateur vérifie et approuve votre compte</b>
            </p>

        @endif

        <br>
        <div class="shadow-none p-4 rounded text-center">
            <img src="{{ asset($setting->company_logo ) }}" class="logo-icon" alt="logo icon" style="width: 350px; ">
            {{-- <h1 class="text-muted" style="font-style: revert;">{{ $setting->company_name}}.fr</h1> --}}
        </div>

    </div>
@endsection
