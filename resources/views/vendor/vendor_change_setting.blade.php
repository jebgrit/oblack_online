@extends('vendor.vendor_dashboard')

@section('vendor')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Paramètres</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Modifier le mot de passe</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <form id="myForm" action="#" method="POST">
                                    @csrf

                                    <div id="show_alert"></div>
                                    
                                    <div class="row mb-3">
                                        
                                        <div class="form-group mb-4 mt-4">
                                            <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Mot de passe actuel"/>
                                            
                                        </div>

                                        
                                        <div class="form-group mb-4">
                                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="8 caractères minimum"/>
                                    
                                            <div class="invalid-feedback"></div>

                                        </div>


                                        <div class="form-group mb-4">
                                            <input type="submit" value="Enregistrer" class="btn text-white" id="save_btn" style="background-color: #112c3f">
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
        $(function(){
            $("#myForm").submit(function(e){
                e.preventDefault();
                $("#save_btn").val('Vérification...');
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    data: $(this).serialize(),
                    url: "/vendorPasswordStore",
                    success: function(res){
                        // console.log(res);
                        if(res.status == 400){
                            showError('new_password', res.messages.new_password);
                            $("#save_btn").val('Enregistrer');
                        } else if(res.status == 200) {
                            $("#show_alert").html(showMessage('success', res.messages));
                            $("#myForm")[0].reset();
                            removeValidationClasses("#myForm");
                            $("#save_btn").val('Enregistrer');
                        } else if(res.status == 401) {
                            $("#show_alert").html(showMessage('danger', res.messages));
                            $("#save_btn").val('Enregistrer');
                        }
                    }
                })
            });
        });
    </script>


@endsection
