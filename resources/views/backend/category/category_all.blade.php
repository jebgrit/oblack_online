@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Catégories</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Toutes les catégories <span
                            class="badge rounded-pill bg-danger"> {{ count($categories) }}</span></li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.category') }}" type="button" class="btn btn-success">Nouvelle catégorie</a>
                </div>
            </div>
        </div>
        
        <hr />
        <div class="card">
            <div class="card-body">

                @if ($categories->isEmpty())
                    <p>Vous n'avez pas encore ajouté de catégorie.</p>
                @else
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Catégorie</th>
                                    <th>Nombre de produit reférencé</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ count($category->products) }}</td>
                                        <td>
                                            <div class="d-flex order-actions">	
                                                <a href="{{ route('edit.category', $category->id) }}" class=""><i class="bx bx-edit btn btn-info"></i></a>
                                                <span class="px-2"></span>
                                                <a href="{{ route('delete.category', $category->id) }}" class="" id="delete"><i class="bx bx-trash-alt btn btn-danger"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>





@endsection
