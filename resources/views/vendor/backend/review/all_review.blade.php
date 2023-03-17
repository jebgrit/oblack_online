@extends('vendor.vendor_dashboard')

@section('vendor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Avis des clients</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Avis en attente</li>
                    </ol>
                </nav>
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    @if ($review->isEmpty())
                        <p>Vous n'avez pas encore reçu de commentaire sur vos produits. </p>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Produit commenté</th>
                                    <th>Commentaire</th>
                                    <th>Note donnée</th>
                                    <th>Commenté le</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($review as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="recent-product-img">
                                                    <img src="{{ asset($item->product->product_thumbnail) }}" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">{{ Str::limit($item['product']['product_name'], 25) }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ Str::limit($item->comment, 25) }}</td>
                                        <td>
                                            <div class="cursor-pointer">
                                                @if ($item->rating == null)
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($item->rating == 1)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($item->rating == 2)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($item->rating == 3)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($item->rating == 4)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-secondary"></i>
                                                @elseif ($item->rating == 5)
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $item->created_at->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <div class="d-flex order-actions">	
                                                <a href="{{ route('vendor.show.review', $item->id) }}">
                                                    <i class="bx bx-show btn btn-info"></i>
                                                </a>
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
