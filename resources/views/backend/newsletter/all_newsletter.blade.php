@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Newsletter</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active " aria-current="page">Toutes les emails 
                            @if ($newsletter->isEmpty())
                                <span class="badge rounded-pill bg-danger">0</span>
                            @else
                                <span class="badge rounded-pill bg-danger"> {{ count($newsletter) }}</span>
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    @if ($newsletter->isEmpty())
                        <!-- -->
                    @else
                        <a href="{{ route('export.newsletter') }}" type="button" class="btn btn-success"><i class="fa-solid fa-file-export"></i>Exporter</a>
                        <span class="px-2"></span>
                    @endif
                    
                </div>
            </div>
        </div>
        <hr />

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    @if ($newsletter->isEmpty())
                        <p>Il n'y a actuellement aucune newsletter.</p>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Envoyé le</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($newsletter as $item)
                                    <tr>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->created_at->translatedFormat('d F Y à H\hi') }}</td>
                                        <td>
                                            <a href="{{ route('delete.newsletter', $item->id) }}" class="" id="delete">
                                                <i class="bx bx-trash btn btn-danger"></i>
                                            </a>
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
