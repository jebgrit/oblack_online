@extends('dashboard')

@section('user')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection

    

    
    <div class="page-content pt-30 pb-50">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 m-auto">

                    <div class="row">
                        
                        <!-- Menu -->
                        @include('fronted.body.dashboard_sidebar_menu')
                        <!-- End menu -->

                        <div class="col-md-6">
                            <div class="tab-content account dashboard-content pl-50">


                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">

                                    <!-- Details compte -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Mon addresse</h5>
                                        </div>
                                        <div class="card-body">

                                            <div id="show_success_alert"></div>

                                            <form method="POST" action="#" enctype="multipart/form-data" id="saveForm">
                                                @csrf

                                                <div class="row">
                                                    <!-- Name -->
                                                    <div class="form-group col-md-12">
                                                        <label>Nom et prénom </label>
                                                        <input class="form-control" id="name" name="name" type="text" value="{{ $userData->name }}" />

                                                        <div class="invalid-feedback"></div>
                                                    </div>


                                                    <div class="form-group col-md-12">
                                                        <label>Email </label>
                                                        <input class="form-control" id="email" name="email" type="email" value="{{ $userData->email }}" />

                                                        <div class="invalid-feedback"></div>
                                                    </div>


                                                    <div class="form-group col-md-12">
                                                        <label>Téléphone </label>
                                                        <input class="form-control" id="phone" name="phone" type="text" value="{{ $userData->phone }}" />

                                                        <div class="invalid-feedback"></div>
                                                    </div>


                                                    <div class="form-group col-md-12">
                                                        <label>Adresse (Numéro et voie / société) </label>
                                                        <input class="form-control" id="address" name="address" type="text" value="{{ $userData->address }}" />

                                                        <div class="invalid-feedback"></div>
                                                    </div>

                                                    
                                                    <div class="form-group col-md-12">
                                                        <label>Ville </label>
                                                        <input class="form-control" id="city" name="city" type="text" value="{{ $userData->city }}" />

                                                        <div class="invalid-feedback"></div>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label>Code postal </label>
                                                        <input class="form-control" id="zip_code" name="zip_code" type="text" value="{{ $userData->zip_code }}" />

                                                        <div class="invalid-feedback"></div>
                                                    </div>


                                                    <div class="col-sm-12 text-secondary">
                                                        <label>Choisir une photo de profil </label>
                                                        <input class="form-control" name="image" id="image" type="file" accept='image/*' />

                                                        <div class="invalid-feedback"></div>
                                                    </div>


                                                    <div class="row mb-3 mt-2">
                                                        <div class="col-sm-9 text-secondary">
                                                            <img id="showImage"
                                                                src="{{ !empty($userData->photo) ? url('upload/user_images/' . $userData->photo) : url('upload/user_images/no_image.jpg') }}"
                                                                alt="User" style="width: 100px; height: 100px">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12">
                                                        <input type="submit" value="Enregistrer" class="rounded-0 text-white" id="save_btn" style="background-color: #112c3f">
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
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

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
            $("#saveForm").submit(function(e){
                e.preventDefault();

                let formData = new FormData($('#saveForm')[0]);
                $("#save_btn").val('Vérification...');
                $.ajax({
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    url: "/updateProfile",
                    success: function(res){
                        // console.log(res);
                        if(res.status == 400){
                            showError('name', res.messages.name);
                            showError('email', res.messages.email);
                            showError('phone', res.messages.phone);
                            showError('address', res.messages.address);
                            showError('city', res.messages.city);
                            showError('zip_code', res.messages.zip_code);
                            showError('image', res.messages.image);
                            $("#save_btn").val('Enregistrer');
                        } else if(res.status == 200) {
                            $("#show_success_alert").html(showMessage('success', res.messages));
                            $("#saveForm")[0].reset();
                            removeValidationClasses("#saveForm");
                            $("#save_btn").val('Enregistrer');
                        }
                    }
                })
            });
        });

        $();
    </script>

@endsection
