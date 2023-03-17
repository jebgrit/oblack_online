@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Avis des clients</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Avis en attente
                            @if ($review->isEmpty())
                                <span class="badge rounded-pill bg-danger">0</span>
                            @else
                                <span class="badge rounded-pill bg-danger"> {{ count($review) }}</span>
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

                    @if ($review->isEmpty())
                        <p>Il n y a actuellement aucun commentaire en attente.</p>
                    @else

                        
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Commenté par</th>
                                    <th>Produit commenté</th>
                                    <th>Commentaire</th>
                                    <th>Statut du commentaire</th>
                                    <th>Note donnée</th>
                                    <th>Commenté le</th>
                                    <th>a acheté</th>
                                    <th>acheté le</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($review as $key => $item)
                                    <tr>
                                        <td>{{ $item['user']['name'] }}</td>
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
                                            @if ($item->status == 0)
                                                <span class="badge rounded-pill bg-warning">En attente</span>
                                            @endif 
                                        </td>
                                        <td>
                                            <div class="cursor-pointer">
                                                @if ($item->rating == NULL)
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
                                            @if ($item->user_purchased == 'oui')
                                                <span class="badge rounded-pill bg-success">Oui</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger">Non</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->date_purchased == null)
                                                ...
                                            @else
                                                {{ $item->date_purchased }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex order-actions">	
                                                <a href="{{ route('approve.review', $item->id) }}" id="review"><i class="bx bx-like btn btn-warning"></i></a>
                                                <span class="px-2"></span>
                                                <a href="{{ route('show.review', $item->id) }}">
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
