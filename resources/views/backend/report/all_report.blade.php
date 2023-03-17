@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Signalement</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Commentaire signalé
                            @if ($report->isEmpty())
                                <span class="badge rounded-pill bg-danger">0</span>
                            @else
                                <span class="badge rounded-pill bg-danger"> {{ count($report) }}</span>
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

                    @if ($report->isEmpty())
                        <p>Il n'y a actuellement aucun commentaire signalé.</p>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Signalé par</th>
                                    <th>Produit concerné</th>
                                    <th>Commentaire signalé</th>
                                    <th>Message de signalement</th>
                                    <th>Signalé le</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($report as $key => $item)
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
                                        <td>{{ Str::limit($item['review']['comment'], 25) }}</td>
                                        <td>{{ Str::limit($item->report, 25) }}</td>
                                        <td>{{ $item->created_at->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="{{ route('show.report', $item->id) }}">
                                                    <i class="bx bx-show btn btn-info"></i>
                                                </a>
                                                <span class="px-2"></span>
                                                <a href="{{ route('delete.report', $item->id) }}" id="delete"><i
                                                    class="bx bx-trash btn btn-danger"></i></a>
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
