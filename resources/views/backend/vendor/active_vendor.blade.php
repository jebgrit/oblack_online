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
            <div class="breadcrumb-title pe-3">Vendeurs actifs</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Toutes les vendeurs actifs</li>
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
                            @foreach ($active_vendor as $key => $av)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $av->name }}</td>
                                    <td>{{ $av->username }}</td>
                                    <td>{{ Carbon\Carbon::parse($av->vendor_join)->translatedFormat('d F Y') }}</td>
                                    <td>{{ $av->email }}</td>
                                    <td><span class="badge bg-success w-1">{{ convert_to_french($av->status) }}</span></td>
                                    <td>
                                        <div class="d-flex order-actions">	
                                            <a href="{{ route('active.vendor.details', $av->id) }}" class=""><i class="lni lni-cog btn btn-info"></i></a>
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
