@extends('dashboard')

@section('user')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection



<div class="page-content pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">

                    <!-- Menu -->
                    @include('fronted.body.dashboard_sidebar_menu')
                    <!-- End menu -->

                    <div class="col-md-6">
                        <div class="tab-content account dashboard-content pl-50">

                            <!-- photo profil -->
                            <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                aria-labelledby="dashboard-tab">

                                <div class="card">
                                    <div class="card-header">
                                        <h5>Modifier le mot de passe</h5>
                                    </div>
                                    <div class="card-body">

                                        <div id="show_alert"></div>

                                        <form action="#" method="POST" id="passwordForm">
                                            @csrf

                                            <div class="row">

                                                <!-- old password -->
                                                <div class="form-group col-md-12">
                                                    <label>Mot de passe actuel </label>
                                                    <input class="form-control" name="old_password" type="password" id="old_password" placeholder="Ancien mot de passe" />

                                                </div>

                                                <!-- New password -->
                                                <div class="form-group col-md-12">
                                                    <label>Nouveau mot de passe </label>
                                                    <input class="form-contro" name="new_password" type="password" id="new_password" placeholder="6 caractères minimum" />

                                                    <div class="invalid-feedback"></div>
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

<script type="text/javascript">
    $(function(){
        $("#passwordForm").submit(function(e){
            e.preventDefault();
            $("#save_btn").val('Vérification...');
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: $(this).serialize(),
                url: "/newPassword",
                success: function(res){
                    // console.log(res);
                    if(res.status == 400){
                        showError('new_password', res.messages.new_password);
                        $("#save_btn").val('Enregistrer');
                    } else if(res.status == 200) {
                        $("#show_alert").html(showMessage('success', res.messages));
                        $("#passwordForm")[0].reset();
                        removeValidationClasses("#passwordForm");
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
