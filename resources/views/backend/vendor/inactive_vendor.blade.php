@extends('admin.admin_dashboard')

@section('admin')

    @php
        function convert_to_french($english_value)
        {
            if ($english_value === 'inactive') {
                $english_value = 'Inactif';
                return $english_value;
            } elseif ($english_value === 'active') {
                $english_value = 'Actif';
                return $english_value;
            }
        }
    @endphp

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vendeurs inactifs</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Toutes les vendeurs inactifs</li>
                    </ol>
                </nav>
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom de l'enseigne</th>
                                <th>Nom du vendeur</th>
                                <th>Date d'adhésion</th>
                                <th>Email vendeur</th>
                                <th>Statut vendeur</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inactive_vendor as $key => $iv)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $iv->name }}</td>
                                    <td>{{ $iv->username }}</td>
                                    <td>{{ Carbon\Carbon::parse($iv->vendor_join)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $iv->email }}</td>
                                    <td><span class="badge bg-secondary w-1">{{ convert_to_french($iv->status) }}</span></td>
                                    <td>
                                        <div class="d-flex order-actions">	
                                            <a href="{{ route('inactive.vendor.details', $iv->id) }}" class=""><i class="lni lni-cog btn btn-info"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
