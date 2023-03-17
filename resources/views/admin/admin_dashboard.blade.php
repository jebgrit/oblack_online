<!doctype html>
<html lang="fr">

<head>
    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp



    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!--favicon-->
    <link rel="icon" href="{{ asset($setting->favicon) }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('adminBackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminBackend/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminBackend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminBackend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminBackend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('adminBackend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('adminBackend/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

    <!-- Filepond -->
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />



    <!-- loader-->
    <link href="{{ asset('adminBackend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('adminBackend/assets/js/pace.min.js') }}"></script>
    

    <script src="{{ asset('fronted/assets/js/function.js') }}"></script>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('adminBackend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminBackend/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('adminBackend/assets/css/icons.css') }}" rel="stylesheet">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('adminBackend/assets/css/header-colors.css') }}" />

    <!--Datatable -->
    <link href="{{ asset('adminBackend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" />

    <!-- Toaster -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous" />

    

    <title>{{ $setting->company_name }} - Staff</title>
</head>

<body>
    <style>
        .underline-on-hover:hover {
            text-decoration: underline;
        }
    </style>

    
    <!--wrapper-->
    <div class="wrapper">

        <!--sidebar wrapper -->
        @include('admin.body.sidebar')

        <!--start header -->
        @include('admin.body.header')

        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('admin')
        </div>

        <!--start overlay-->
        <div class="overlay toggle-icon"></div>

        <!--Start Back To Top Button--> 
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

        @include('admin.body.footer')
    </div>


    <!-- Bootstrap JS -->
    <script src="{{ asset('adminBackend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('adminBackend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('adminBackend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('adminBackend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('adminBackend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('adminBackend/assets/plugins/jquery-knob/excanvas.js') }}"></script>
    <script src="{{ asset('adminBackend/assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
    <script src="{{ asset('adminBackend/assets/js/validate.min.js') }}"></script>

    <script src="{{ asset('adminBackend/assets/plugins/select2/js/select2.min.js') }}"></script>
	<script>
		$('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
		$('.multiple-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
	</script>







    <!--Datatable -->
    <script src="{{ asset('adminBackend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminBackend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        $(function() {
            $(".knob").knob();
        });
    </script>
    <script src="{{ asset('adminBackend/assets/js/index.js') }}"></script>



    




    <!--app JS-->
    <script src="{{ asset('adminBackend/assets/js/app.js') }}"></script>

    <!--Toaster-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>



    <!--Datatable -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                language: {
                    processing: "Traitement en cours...",
                    search: "Rechercher&nbsp;:",
                    lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
                    info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                    infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    infoPostFix: "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    emptyTable: "Aucune donnée disponible dans le tableau",
                    paginate: {
                        first: "Premier",
                        previous: "Pr&eacute;c&eacute;dent",
                        next: "Suivant",
                        last: "Dernier"
                    },
                    aria: {
                        sortAscending: ": activer pour trier la colonne par ordre croissant",
                        sortDescending: ": activer pour trier la colonne par ordre décroissant"
                    },
                    
                },
                ordering: true,
                lengthMenu: [
                    [50, 150, 250, -1],
                    [50, 150, 250, 'Tout'],
                ],
            });
        });
    </script>



    <!--Sweat alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('adminBackend/assets/js/code.js') }}"></script>

    <!-- TyniMI -->
    <script src="https://cdn.tiny.cloud/1/dzdxndrk4p55bemlpo5avcso097lyw7vemhwsxuuant06ctd/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
        });
    </script>


    <script>
        tinymce.init({
            selector: '#cgv',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
        });
    </script>

    <script>
        tinymce.init({
            selector: '#legal',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
        });
    </script>

    <script>
        tinymce.init({
            selector: '#term',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
        });
    </script>

</body>

</html>
