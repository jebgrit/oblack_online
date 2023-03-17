@extends('vendor.vendor_dashboard')

@section('vendor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Support</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active " aria-current="page">Nouveau ticket <i class="fa fa-ticket"></i></li>
                    </ol>
                </nav>
            </div>
        </div>
        <hr />

        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <form id="myForm" action="{{ route('vendor.store.ticket') }}" method="POST">
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Demandeur</h6>
                                        </div>

                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" class="form-control" name="name" aria-label="Disabled input example" disabled value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Objet <span class="text-danger">*</span></h6>
                                        </div>

                                        <div class="form-group col-sm-9 text-secondary">
                                            <input id="objet" type="text" class="form-control" name="objet" placeholder="50 caractères maximums">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Priorité <span class="text-danger">*</span></h6>
                                        </div>

                                        <div class="form-group col-sm-9 text-secondary">
                                            <select id="priority" type="" class="form-control" name="priority">
                                                <option value="">---choisir la priorité</option>
                                                <option value="bas">Bas</option>
                                                <option value="moyen">Moyen</option>
                                                <option value="élevé">Élevé</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Description <span class="text-danger">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <textarea rows="10" id="message" class="form-control" name="message" placeholder="2000 caractères maximums"></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <button type="submit" class="btn btn-info">
                                                 Envoyer
                                            </button>

                                            <a class="btn btn-secondary" href="{{ route('vendor.all.ticket') }}" role="button">Annuler</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    objet: {
                        required: true,
                    },
                    priority: {
                        required: true,
                    },
                    message: {
                        required: true,
                    },
                },
                messages: {
                    objet: {
                        required: 'Ce champ est requis',
                    },
                    priority: {
                        required: 'Ce champ est requis',
                    },
                    message: {
                        required: 'Ce champ est requis',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
