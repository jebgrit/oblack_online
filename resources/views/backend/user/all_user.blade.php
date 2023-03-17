@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Utilisateurs</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Toutes les utilisateurs
                            @if ($users->isEmpty())
                                <span class="badge rounded-pill bg-danger">0</span>
                            @else
                                <span class="badge rounded-pill bg-danger"> {{ count($users) }}</span>
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

                    @if ($users->isEmpty())
                        <p>Aucune inscription pour le moment.</p>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Photo de profil</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Activité</th>
                                    <th>Produit commandé</th>
                                    <th>Inscrit le</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $item)
                                    <tr>
                                        <td>
                                            <img src="{{ !empty($item->photo) ? url('upload/user_images/' . $item->photo) : url('upload/user_images/no_image.jpg') }}"
                                            width="60" height="60">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>
                                            @if ($item->UserOnline())
                                                <span class="badge rounded-pill bg-success">
                                                    En ligne
                                                </span>
                                            @else
                                                <span class="badge rounded-pill bg-secondary">
                                                    En ligne {{ Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ count($item->orders) }}</td>
                                        <td>{{ $item->created_at->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <div class="d-flex order-actions">	
                                                <a href="{{ route('delete.user', $item->id) }}" class="" id="delete"><i class="bx bx-trash-alt btn btn-danger"></i></a>
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
