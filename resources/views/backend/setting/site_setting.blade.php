@extends('admin.admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Réglage du site</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Réglage</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <hr />

                <form id="myForm" action="{{ route('store.setting') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $site->id }}">

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">

                                    
                                    <div class="row g-3 mb-4">
                                        <div class="form-group col-md-4">
                                            <label>Nom de l'entreprise</label>
                                            <input type="text" name="company_name" class="form-control" value="{{ $site->company_name }}">
                                        </div>
    
                                        <div class="form-group col-md-4">
                                            <label>Slogan de l'entreprise</label>
                                            <input type="text" name="slogan" class="form-control" value="{{ $site->slogan }}">
                                        </div>
    
                                        <div class="form-group col-md-4">
                                            <label>Contact de l'entreprise</label>
                                            <input type="text" name="company_phone" class="form-control" value="{{ $site->company_phone }}">
                                        </div>
                                    </div>
                                    <br>

                                    

                                    <div class="row g-3 mb-4">
                                        <div class="form-group col-md-4">
                                            <label >Copyright</label>
                                            <input type="text" name="copyright" class="form-control" value="{{ $site->copyright }}">
                                        </div>
    
                                        <div class="form-group col-md-4">
                                            <label>Siège de l'entreprise</label>
                                            <input type="text" name="company_address" class="form-control" value="{{ $site->company_address }}">
                                        </div>
    
                                        <div class="form-group col-md-4">
                                            <label>Email de l'entreprise</label>
                                            <input type="text" name="company_email" class="form-control" value="{{ $site->company_email }}">
                                        </div>
    
                                    </div>
                                    <br>

                                    <div class="row g-3 mb-4">
                                        <div class="form-group col-md-4">
                                            <label >Compte Facebook</label>
                                            <input type="text" name="facebook" class="form-control"  value="{{ $site->facebook }}">
                                        </div>
    
                                        <div class="form-group col-md-4">
                                            <label >Compte Twitter</label>
                                            <input type="text" name="twitter" class="form-control" value="{{ $site->twitter }}">
                                        </div>
    
                                        <div class="form-group col-md-4">
                                            <label >Compte YouTube</label>
                                            <input type="text" name="youtube" class="form-control" value="{{ $site->youtube }}">
                                        </div>
    
                                    </div>
                                    <br>

                                    


    

                                    <!-- Legal notice -->
                                    <div class="mb-3">
                                        <label>Mentions légales</label>
                                        <textarea id="legal" name="legal_notice">{{ $site->legal_notice }}</textarea>
                                    </div>
                                    <br>

                                    <!-- Term -->
                                    <div class="mb-3">
                                        <label>Conditions d'utilisations</label>
                                        <textarea id="term" name="term">{{ $site->term }}</textarea>
                                    </div>
                                    <br>


                                    <!-- cgv -->
                                    <div class="mb-3">
                                        <label>Conditions générales de ventes</label>
                                        <textarea id="cgv" name="cgv">{{ $site->cgv }}</textarea>
                                    </div>
                                    <br>


                                    <!-- favicon -->
                                    <div class="form-group mb-3">
                                        <label>Favicon</label>
                                        <input class="form-control" name="favicon" type="file" id="image2" accept='.png'>

                                        <img src="{{ asset($site->favicon) }}" id="showImage2" class="mt-4">
                                    </div>
                                    <br>



                                    <!-- logo -->
                                    <div class="form-group mb-3">
                                        <label>Logo</label>
                                        <input class="form-control" name="company_logo" type="file" id="image" accept='.jpg,.jpeg,.png,.webp'>


                                        <img src="{{ asset($site->company_logo) }}" id="showImage" class="mt-4">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success"> Mettre à jour </button>
                                </div>
                            </div>
                
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>




    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image2').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage2').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
