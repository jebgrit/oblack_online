@extends('admin.admin_dashboard')

@section('admin')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Stock</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Stocks de produits
                        </li>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    @if ($products->isEmpty())
                        <p>Le stock est vide. Commencez par ajouter des produits</p>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Code de référence</th>
                                    <th>Produit</th>
                                    <th>Prix du produit</th>
                                    <th>Quantité en stock</th>
                                    <th>Statut du produit</th>
                                    <th>> Catégorie</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $pdct)
                                    <tr>
                                        <td>#{{ $pdct->product_code }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="recent-product-img">
                                                    <img src="{{ asset($pdct->product_thumbnail) }}" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">{{ Str::limit($pdct->product_name, 25) }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $pdct->product_price }}</td>
                                        <td>
                                            @if ($pdct->product_quantity == 0)
                                                <span class="badge rounded-pill bg-danger">Épuisé</span>
                                            @else
                                                {{ $pdct->product_quantity }}
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if ($pdct->status == 1)
                                                <span class="badge rounded-pill bg-success">Actif</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">Inactif</span>
                                            @endif
                                        </td>
                                        <td>{{ $pdct->category->category_name }}</td>                                    
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
