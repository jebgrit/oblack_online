@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Marques</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Toutes les marques
                            @if ($brands->isEmpty())
                                <span class="badge rounded-pill bg-danger">0</span>
                            @else
                                <span class="badge rounded-pill bg-danger"> {{ count($brands) }}</span>
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.brand') }}" type="button" class="btn btn-success">Nouvelle marque</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        {{-- <h6 class="mb-0 text-uppercase">DataTable Example</h6> --}}
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    @if ($brands->isEmpty())
                        <p>Vous n'avez pas encore ajouté de marque.</p>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Marque</th>
                                    <th>Logo</th>
                                    <th>Nombre de produit reférencé</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $key => $brand)
                                    <tr>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td> <img src="{{ asset($brand->brand_image) }}" style="width: 70px; height: 70px"> </td>
                                        <td>{{ count($brand->products) }}</td>
                                        <td>
                                            <div class="d-flex order-actions">	
                                                <a href="{{ route('edit.brand', $brand->id) }}" class=""><i class="bx bx-edit btn btn-info"></i></a>
                                                <span class="px-2"></span>
                                                <a href="{{ route('delete.brand', $brand->id) }}" class="" id="delete"><i class="bx bx-trash-alt btn btn-danger"></i></a>
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
