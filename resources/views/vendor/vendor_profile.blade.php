@extends('vendor.vendor_dashboard')

@section('vendor')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Informations</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <style>
            .box {
                inline-size: 350px;
                overflow-wrap: break-word;
            }
        </style>

        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ !empty($vendorData->photo) ? url('upload/vendor_images/' . $vendorData->photo) : url('upload/vendor_images/no_image.jpg') }}"
                                        alt="Admin" class="rounded-circle" width="110">
                                    <div class="mt-3">
                                        <h4>{{ ucfirst($vendorData->name) }}</h4>
                                        <p class="text-secondary mb-1">{{ ucfirst($vendorData->username) }}</p>
                                        <br>
                                        <p class="text-muted font-size-sm box">
                                            {{ Auth::user()->vendor_short_info }}
                                        </p>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Téléphone:</h6>
                                        <span class="text-secondary">{{ Auth::user()->phone }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Adresse:</h6>
                                        <span class="text-secondary">{{ Auth::user()->address }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0">Partenaire depuis:</h6>
                                        <span
                                            class="text-secondary">{{ Carbon\Carbon::parse(Auth::user()->vendor_join)->translatedFormat('d F Y') }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">

                                

                                <form action="#" method="POST" enctype="multipart/form-data" id="myForm">
                                    @csrf
                                    
                                    <div class="row">

                                        <div id="show_success_alert"></div>

                                        <div class="form-group mb-4 mt-4">
                                            <label>Nom de l'enseigne (C'est celui-ci qui apparaitra sur vos produits) </label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $vendorData->name }}" />

                                            <div class="invalid-feedback"></div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label>Nom et prénom </label>
                                            <input type="text" id="username" name="username" class="form-control" value="{{ $vendorData->username }}" />

                                            <div class="invalid-feedback"></div>
                                        </div>

                                        

                                        <div class="form-group mb-4">
                                            <label>Adresse email </label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $vendorData->email }}" />
                                        </div>


                                        
                                        <div class="form-group mb-4">
                                            <label>Téléphone </label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $vendorData->phone }}" />

                                            <div class="invalid-feedback"></div>
                                        </div>
 

                                      
                                        <div class="form-group mb-4">
                                            <label>Adresse </label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ $vendorData->address }}" />

                                             <div class="invalid-feedback"></div>
                                        </div>



                                        <div class="form-group mb-4">
                                            <label>Bio </label>
                                            <textarea class="form-control" id="info" name="info" rows="5">{{ $vendorData->vendor_short_info }}</textarea>

                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <br>


                                    
                                        <div class="form-group mb-4">
                                            <label>Photo </label>
                                            <input type="file" class="form-control" name="image" id="image" accept='.jpg,.jpeg,.png' />

                                            <div class="invalid-feedback"></div>
                                        </div>


                                    
                                        
                                        <div class="form-group mb-4">
                                            <img id="showImage" src="{{ !empty($vendorData->photo) ? url('upload/vendor_images/' . $vendorData->photo) : url('upload/vendor_images/no_image.jpg') }}" style="width: 100px; height: 100px">
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
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>


    <script type="text/javascript">
        $(function(){
            $("#myForm").submit(function(e){
                e.preventDefault();

                let formData = new FormData($('#myForm')[0]);
                $("#save_btn").val('Vérification...');
                $.ajax({
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    url: "/vendorProfileStore",
                    success: function(res){
                        // console.log(res);
                        if(res.status == 400){
                            showError('username', res.messages.username);
                            showError('name', res.messages.name);
                            showError('email', res.messages.email);
                            showError('phone', res.messages.phone);
                            showError('address', res.messages.address);
                            showError('info', res.messages.info);
                            showError('image', res.messages.image);
                            $("#save_btn").val('Enregistrer');
                        } else if(res.status == 200) {
                            $("#show_success_alert").html(showMessage('success', res.messages));
                            $("#myForm")[0].reset();
                            removeValidationClasses("#myForm");
                            $("#save_btn").val('Enregistrer');
                        }
                    }
                })
            });
        });

        $();
    </script>
@endsection
