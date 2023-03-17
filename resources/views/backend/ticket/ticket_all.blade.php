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
                        <li class="breadcrumb-item active " aria-current="page">Toutes les tickets   <i class="fa fa-ticket"></i>
                            @if ($tickets->isEmpty())
                                <span class="badge rounded-pill bg-danger">0</span>
                            @else
                                <span class="badge rounded-pill bg-danger"> {{ count($tickets) }}</span>
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    @if ($tickets->isEmpty())
                        <!-- -->
                    @else
                        <a href="{{ route('export.ticket') }}" type="button" class="btn btn-secondary"><i class="fa-solid fa-file-export"></i>Exporter</a>
                        <span class="px-2"></span>
                    @endif
                    
                </div>
            </div>
        </div>
        <hr />

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    @if ($tickets->isEmpty())
                        <p>Il n'y a actuellement aucun ticket.</p>
                    @else
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID ticket</th>
                                    <th>Expéditeur</th>
                                    <th>Objet</th>
                                    <th>Priorité</th>
                                    <th>Statut</th>
                                    <th>Ouvert le</th>
                                    <th>Cloturé le</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td><a href="{{ route('show.ticket', $ticket->ticket_id) }}" class="underline-on-hover">{{ $ticket->ticket_id }}</a></td>
                                        <td>{{ ucfirst($ticket['user']['name']) }}</td>
                                        <td>{{ $ticket->objet }}</td>
                                        <td>
                                            @if ($ticket->priority === 'bas')
                                                <span class="badge bg-info w-1">{{ ucfirst($ticket->priority) }}</span>
                                            @elseif ($ticket->priority === 'moyen')
                                                <span class="badge bg-warning w-1">{{ ucfirst($ticket->priority) }}</span>
                                            @else
                                                <span class="badge bg-danger w-1">{{ ucfirst($ticket->priority) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($ticket->status === 'Ouvert')
                                                <span class="badge bg-success w-1">{{ $ticket->status }}</span>
                                            @else
                                                <span class="badge bg-danger w-1">{{ $ticket->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $ticket->created_at->translatedFormat('d F Y à H\hi') }}</td>
                                        <td>{{ $ticket->updated_at->translatedFormat('d F Y à H\hi') }}</td>
                                        <td>
                                            @if ($ticket->status === 'Ouvert')
                                                <div class="d-flex order-actions">
                                                    <a href="{{ route('show.ticket', $ticket->ticket_id) }}"
                                                        class=""><i class="bx bx-reply btn btn-info"></i></a>
                                                    <span class="px-2"></span>
                                                    <a href="{{ route('close.ticket', $ticket->ticket_id) }}"
                                                        class="" id="close"><i
                                                            class="lni lni-lock btn btn-danger"></i></a>
                                                </div>
                                            @else
                                                <a href="{{ route('show.ticket', $ticket->ticket_id) }}" class="">
                                                    <i class="bx bx-history btn btn-warning"></i>
                                                </a>
                                            @endif
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
