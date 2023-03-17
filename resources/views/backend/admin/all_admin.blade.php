@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Administrateur</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tous les administrateurs</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.admin') }}" type="button" class="btn btn-success">Ajouter un admin</a>
                </div>
            </div>
        </div>
        

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    @if ($all_admin->isEmpty())
                        <p>Vous n'avez pas encore ajouter des administrateurs.</p>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_admin as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="recent-product-img">
                                                    <img src="{{ !empty($item->photo) ? url('upload/admin_images/' . $item->photo) : url('upload/admin_images/no_image.jpg') }}" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">{{ $item->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->role }}</td>
                                        
                                        <td>
                                            @php
                                                $id = $user = Auth::user()->id;
                                            @endphp
                                            <div class="d-flex order-actions">	
                                                <a href="{{ route('edit.admin', $item->id) }}" class=""><i class="bx bx-edit btn btn-info"></i></a>
                                                <span class="px-2"></span>
                                                @if ($id == $item->id)
                                                    <!-- hidde delete button -->
                                                @else
                                                    <a href="{{ route('delete.admin', $item->id) }}" class="" id="delete"><i class="bx bx-trash-alt btn btn-danger"></i></a>
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
