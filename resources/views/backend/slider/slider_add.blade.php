@extends('admin.admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Sliders</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Ajouter un slider</li>
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

                                <form id="myForm" action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Titre principale </h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" class="form-control @error('slider_title') is-invalid @enderror" name="slider_title" />

                                            <span class="text-danger">
                                                @error('slider_title')
                                                    Veuillez saisir au maximum 100 caractères.
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Titre secondaire</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" class="form-control @error('short_title') is-invalid @enderror" name="short_title" />

                                            <span class="text-danger">
                                                @error('short_title')
                                                    Veuillez saisir au maximum 100 caractères.
                                                @enderror
                                            </span>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Image</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" class="form-control @error('slider_image') is-invalid @enderror" name="slider_image" id="image" accept='.jpg,.jpeg,.png,.webp' required/>
                                            <p id="error1" style="display:none; color:#FF0000;">
                                                Veuillez télécharger le fichier dans ces formats uniquement (jpg, jpeg, png, webp).
                                            </p>
                                            <p id="error2" style="display:none; color:#FF0000;">
                                                La limite maximale de taille de fichier est de 1 Mo.
                                            </p>
                                            <span class="text-danger">
                                                @error('slider_image')
                                                    Veuillez télécharger le fichier dans ces formats uniquement (jpg, jpeg, png, webp).
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">

                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{ url('upload/no_image.jpg') }}"
                                                style="width: 100px; height: 100px">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Enregister" />
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
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    slider_title: {
                        required: true,
                    },
                    short_title: {
                        required: true,
                    },
                    
                },
                messages: {
                    slider_title: {
                        required: 'Saisissez le titre du slider',
                    },
                    short_title: {
                        required: 'Saisissez le titre secondaire',
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

    <!-- Image validation -->
    <script type="text/javascript">
        var a = 0;

        //binds to onchange event of your input field
        $('#image').bind('change', function() {

            var ext = $('#image').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['webp', 'png', 'jpg', 'jpeg']) == -1) {
                $('#error1').slideDown("slow");
                $('#error2').slideUp("slow");
                a = 0;
            } else {
                var picsize = (this.files[0].size);
                if (picsize > 1000000) {
                    $('#error2').slideDown("slow");
                    a = 0;
                } else {
                    a = 1;
                    $('#error2').slideUp("slow");
                }
                $('#error1').slideUp("slow");

            }
        });
    </script>
@endsection
