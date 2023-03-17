@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Produits</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Toutes les produits 
                            @if ($products->isEmpty())
                                <span class="badge rounded-pill bg-danger">0</span>
                            @else
                                <span class="badge rounded-pill bg-danger"> {{ count($products) }}</span>
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.product') }}" type="button" class="btn btn-success">Nouveau produit</a>
                </div>
            </div>
        </div>
        
        
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    @if ($products->isEmpty())
                        <p>Vous n'avez pas encore ajouté de produits.</p>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Produit</th>
                                    <th>Prix</th>
                                    <th>Stock</th>
                                    <th>Remise</th>
                                    <th>Statut</th>
                                    <th>Catégorie</th>
                                    <th>Date d'ajout</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $pdct)
                                    <tr>
                                        <td>{{ $pdct->product_code }}</td>
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
                                        <td>{{ $pdct->product_price }} €</td>
                                        <td>{{ $pdct->product_quantity }}</td>
                                        <td>

                                            @if ($pdct->discount_price == null)
                                                <span class="badge rounded-pill bg-info">Aucune remise</span>
                                            @else
                                                @php
                                                    $amount = ((int)$pdct->product_price - (int)$pdct->discount_price); //: formule calcule du prix après remise;
                                                    $discount = ($amount / (int)$pdct->product_price) * 100;
                                                @endphp
                                                <span class="badge rounded-pill bg-danger">-{{ round($discount) }}%</span>
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
                                        <td>{{ $pdct->created_at->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="{{ route('edit.product', $pdct->id) }}" class=""><i class="bx bx-edit btn btn-info"></i></a>
                                                <span class="px-2"></span>

                                                <a href="{{ route('delete.product', $pdct->id) }}" id="delete"><i class="bx bx-trash-alt btn btn-danger"></i></a>
                                                <span class="px-2"></span>

                                                @if ($pdct->status == 1)
                                                    <a href="{{ route('product.inactive', $pdct->id) }}" class=""><i class="bx bx-like btn btn-primary"></i></a>
                                                @else
                                                    <a href="{{ route('product.active', $pdct->id) }}" class=""><i class="bx bx-dislike btn btn-secondary"></i></a>
                                                @endif
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
