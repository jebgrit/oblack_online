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
                        <li class="breadcrumb-item active " aria-current="page">Message</i>
                        </li>
                    </ol>
                </nav>
            </div>
            <hr />
        </div>

        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4> Signalé par: {{ $report['user']['name'] }} </h4>
                                    </div>
                                    <div class="panel-body mt-4">
                                        <div class="ticket-info">
                                            
                                            <p>
                                                <strong>Commentaire signalé:</strong>
                                                {{ $report['review']['comment'] }}
                                            </p>
                                            <!-- created at -->
                                            <p>
                                                <strong>Signalé le :</strong>
                                                {{ $report->created_at->translatedFormat('d F Y à H\hi') }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="comments">
                                    <div class="chat-content-leftside">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 ms-2">
                                                <p class="chat-left-msg">{{ $report->report }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
