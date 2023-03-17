@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Support</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active " aria-current="page">Faq
                            @if ($faq->isEmpty())
                                <span class="badge rounded-pill bg-danger">0</span>
                            @else
                                <span class="badge rounded-pill bg-danger"> {{ count($faq) }}</span>
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
            
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('faq.new') }}" type="button" class="btn btn-success">Créer une faq</a>
                </div>
            </div>
        </div>
        <hr />

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    @if ($faq->isEmpty())
                        <p>Pas encore ajouté des faq.</p>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Réponse</th>
                                    <th>Date d'ajout</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faq as $item)
                                    <tr>
                                        <td>{{ Str::limit($item->question, 25) }}</td>
                                        <td>{{ Str::limit($item->answer, 25) }}</td>
                                        <td>{{ $item->created_at->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <a href="{{ route('faq.delete', $item->id) }}" class="" id="close"><i class="lni lni-lock btn btn-danger"></i></a>
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
