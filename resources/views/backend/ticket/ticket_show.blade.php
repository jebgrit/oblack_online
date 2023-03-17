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
                        <li class="breadcrumb-item active " aria-current="page">Message <i class="fa fa-ticket"></i>
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
                                        <h4> #{{ $ticket->ticket_id }} - {{ ucfirst($ticket->objet) }} </h4>
                                    </div>
                                    <div class="panel-body mt-4">
                                        <div class="ticket-info">
                                            <!-- Staus -->
                                            <p>
                                                @if ($ticket->status === 'Ouvert')
                                                    <strong>Statut:</strong> <span
                                                        class="badge bg-success w-1">{{ $ticket->status }}</span>
                                                @else
                                                    <strong>Statut:</strong> <span
                                                        class="badge bg-danger w-1">{{ $ticket->status }}</span>
                                                @endif
                                            </p>
                                            <!-- Priority -->
                                            <p>
                                                @if ($ticket->priority === 'bas')
                                                    <strong>Priorité:</strong>
                                                    <span class="badge bg-info w-1">{{ $ticket->priority }}</span>
                                                @elseif ($ticket->priority === 'moyen')
                                                    <strong>Priorité:</strong>
                                                    <span class="badge bg-warning w-1">{{ $ticket->priority }}</span>
                                                @else
                                                    <strong>Priorité:</strong>
                                                    <span class="badge bg-danger w-1">{{ $ticket->priority }}</span>
                                                @endif
                                            </p>
                                            <!-- created at -->
                                            <p>
                                                <strong>Crée le :</strong> {{ $ticket->created_at->translatedFormat('d F Y à H\hi') }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <hr>



                                {{-- @include('tickets.comments') --}}

                                <div class="comments">
                                    
                                    <div class="chat-content-leftside">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 ms-2">
                                                <p class="mb-0 chat-time">
                                                    <strong> 
                                                        {{ ucfirst($ticket->user->name) }},
                                                        ({{ $ticket->created_at->diffForHumans() }})
                                                    </strong>
                                                </p>
                                                <p class="chat-left-msg" style="word-break: break-all;">{{ $ticket->message }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($ticket->conversations as $conv)
                                        <div class="chat-content-leftside">
                                            <div class="d-flex">
                                                <div class="flex-grow-1 ms-2">
                                                    <p class="mb-0 chat-time">
                                                        <strong> 
                                                            {{ ucfirst($conv->user->name) }},
                                                            ({{ $conv->created_at->diffForHumans() }})
                                                        </strong>
                                                    </p>
                                                    <p class="chat-left-msg" style="word-break: break-all;">{{ $conv->conversation }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                                <hr class="mb-4">
                                {{-- @include('tickets.reply') --}}

                                @if ($ticket->status == 'Fermé')
                                    <input class="form-control mb-3" type="text" placeholder="Vous avez cloturé ce ticket."
                                        aria-label="Disabled input example" disabled="">
                                @else
                                    <div class="panel panel-default">
                                        <div class="panel-heading mb-2">
                                            <h5>Répondre </h5>
                                        </div>

                                        <div class="panel-body">
                                            <div class="comment-form">

                                                <form action="#" method="POST" class="form" id="myForm">
                                                    @csrf

                                                    <div id="show_alert"></div>

                                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                                                    <div class="d-flex align-items-center">

                                                        <div class="input-group">
                                                            <textarea type="text" id="conversation" class="form-control" name="conversation"></textarea>
                                                            <div class="invalid-feedback"></div>

                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class="row mt-4">
                                                        <div class="form-group">
                                                            <input type="submit" value="Envoyer" class="btn btn-warning text-white" id="save_btn">
                
                                                            <a class="btn btn-secondary" href="{{ route('all.ticket') }}" role="button">Annuler</a>
                                                        </div>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>



            <script type="text/javascript">
                $(function(){
                    $("#myForm").submit(function(e){
                        e.preventDefault();
                        $("#save_btn").val('En cours...');
                        $.ajax({
                            type: "POST",
                            dataType: 'json',
                            data: $(this).serialize(),
                            url: "/conversation",
                            cache: false,
                            success: function(res){
                                                        
                                // console.log(res);
                                if(res.status == 400){
                                    showError('conversation', res.messages.conversation);
                                    $("#save_btn").val('Envoyer');
                                } else if(res.status == 200) {
                                    $("#show_alert").html(showMessage('success', res.messages));
                                    $("#myForm")[0].reset();
                                    removeValidationClasses("#myForm");
                                    $("#save_btn").val('Envoyer');
                                }
                            }
                        })
                    });
                });
        
                
            </script>
        @endsection
