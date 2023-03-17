@extends('admin.admin_dashboard')

@section('admin')
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Faq</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
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

                                <form id="myForm" action="{{ route('faq.store') }}" method="POST">
                                    @csrf

                                    

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Question <span class="text-danger">*</span></h6>
                                        </div>

                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" class="form-control @error('question') is-invalid @enderror" name="question" placeholder="100 caractères maximums">

                                            @error('question')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Réponse <span class="text-danger">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <textarea rows="10" class="form-control @error('answer') is-invalid @enderror" name="answer" placeholder="1000 caractères maximums"></textarea>

                                            @error('answer')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <button type="submit" class="btn btn-info">
                                                 Envoyer
                                            </button>

                                            <a class="btn btn-secondary" href="{{ route('faq.all') }}" role="button">Annuler</a>
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

    
@endsection
