@extends('admin.admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Publications</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Ajouter une publications</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <hr />

                <form id="myForm" action="{{ route('store.blog.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">

        
                                    <!-- Titre  -->
                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Titre</label>
                                        <input type="text" name="post_title"
                                            class="form-control @error('post_title') is-invalid @enderror"
                                            value="{{ old('post_title') }}" required>

                                        <span class="text-danger">
                                            @error('post_title')
                                                Veuillez saisir au maximum 170 caractères.
                                            @enderror
                                        </span>
                                    </div>
                                    <br>

                                    <!-- Contenu -->
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">
                                            Description
                                        </label>
                                        <textarea class="form-control @error('post_long_description') is-invalid @enderror" id="mytextarea" name="post_long_description">
                                            {{ old('post_long_description') }}
                                        </textarea>
                                        <span class="text-danger">
                                            @error('post_long_description')
                                                Veuillez saisir au minimum 170 caractères.
                                            @enderror
                                        </span>
                                    </div>
                                    <br>


                                    <!-- Image de couveture -->
                                    <div class="form-group mb-3">
                                        <label for="inputProductDescription" class="form-label">Image de couverture</label>
                                        <input class="form-control @error('post_image') is-invalid @enderror"
                                            name="post_image" type="file" id="image" accept='.jpg,.jpeg,.png,.webp'
                                            required>

                                        <span id="error1" style="display:none;" class="text-danger">
                                            Veuillez télécharger le fichier dans ces formats uniquement (jpg, jpeg, png,
                                            webp).
                                        </span>

                                        <span id="error2" style="display:none;" class="text-danger">
                                            La limite maximale de taille de fichier est de 1 Mo.
                                        </span>

                                        <span class="text-danger">
                                            @error('post_image')
                                                Seule les images au format jpeg, png, jpg et webp sont acceptés.
                                            @enderror
                                        </span>


                                        <img src="{{ url('upload/blog_images/no_image.jpg') }}" id="showImage"
                                            alt="" class="mt-4" style="width: 100px; height: 100px">
                                    </div>
                                </div>
                            </div>
                            <!-- Submit -->
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">
                                        Ajouter
                                    </button>
                                </div>
                            </div>

                        </div>
                        <!--end row-->
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
            })
        })
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
