@extends('vendor.vendor_dashboard')

@section('vendor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Support</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i
                                    class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active " aria-current="page">Toutes les tickets <i
                                class="fa fa-ticket"></i></li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    @if ($tickets->isEmpty())
                        <!-- -->
                    @else
                        <a href="{{ route('vendor.export.ticket') }}" type="button" class="btn btn-primary"><i
                                class="fa-solid fa-file-export"></i>Exporter</a>
                        <span class="px-2"></span>
                        <a href="{{ route('vendor.new.ticket') }}" type="button" class="btn btn-success"><i
                            class="fa fa-btn fa-ticket"></i>Ouvrir un ticket</a>
                    @endif
                    
                </div>
            </div>
        </div>
        <hr />

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    @if ($tickets->isEmpty())
                        <div class="col">
                            <div class="card-body">
                                <p class="card-text text-danger">Vous n'avez ouvert aucun ticket. </p>
                                <p class="card-text">Les tickets vous permettent de faire des
                                    demandes aux administrateurs, de signaler des problèmes ou même encore de proposer des
                                    suggestions.</p>
                                <p class="card-text">Le temps de traitement d'un ticket est de 10 minutes maximum.</p>
                                <a href="{{ route('vendor.new.ticket') }}" class="btn btn-success"><i
                                    class="fa fa-btn fa-ticket"></i>Ouvrir un ticket</a>
                            </div>
                        </div>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Objet</th>
                                    <th>Statut</th>
                                    <th>Ouvert le</th>
                                    <th>Cloturé le</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->ticket_id }}</td>
                                        <td>{{ $ticket->objet }}</td>
                                        <td>
                                            @if ($ticket->status == 'Ouvert')
                                                <span class="badge bg-success w-1">{{ $ticket->status }}</span>
                                            @else
                                                <span class="badge bg-danger w-1">{{ $ticket->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $ticket->created_at->translatedFormat('d F Y à H\hi') }}</td>
                                        <td>{{ $ticket->updated_at->translatedFormat('d F Y à H\hi') }}</td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                @if ($ticket->status == 'Ouvert')
                                                    <a href="{{ route('vendor.show.ticket', $ticket->ticket_id) }}"
                                                        class="">
                                                        <i class="bx bx-reply btn btn-info"></i>
                                                    </a>
                                                    <span class="px-2"></span>
                                                @else
                                                    <a href="{{ route('vendor.show.ticket', $ticket->ticket_id) }}"
                                                        class="">
                                                        <i class="bx bx-history btn btn-warning"></i>
                                                    </a>
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
