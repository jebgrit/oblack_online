@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Contact</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active " aria-current="page">Toutes les contact <span
                            class="badge rounded-pill bg-danger"> {{ count($contacts) }}</span></li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('export.message') }}" type="button" class="btn btn-success"><i class="fa-solid fa-file-export"></i>Exporter</a>
                    <span class="px-2"></span>
                </div>
            </div>
        </div>
        <hr />

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    @if ($contacts->isEmpty())
                        <p>Il n'y a actuellement aucun message.</p>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Envoyé par</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Object</th>
                                    <th>Message</th>
                                    <th>Envoyé le</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ Str::limit($item->subject, 25)}}</td>
                                        <td>{{ Str::limit($item->message, 25)}}</td>
                                        <td>{{ $item->created_at->translatedFormat('d F Y à H\hi') }}</td>
                                        <td>
                                            <a href="{{ route('show.message', $item->id) }}" class="">
                                                <i class="bx bx-show btn btn-info"></i>
                                            </a>
                                            <span class="px-2"></span>
                                            <a href="{{ route('delete.message', $item->id) }}" class="" id="delete">
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
