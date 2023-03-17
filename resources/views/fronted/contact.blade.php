@extends('fronted.master')

@section('main')

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

@section('title')
    {{ $setting->company_name }} - {{ $setting->slogan }}
@endsection

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>



<div class="page-content pt-30 pb-30">
    <div class="container">
        <div class="breadcrumb mb-80">
            <a href="{{ route('home') }}">Accueil</a>
            <span></span> Contact
        </div>

        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <section class="mb-50">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="contact-from-area padding-20-row-col">
                                <h4 class="mb-10">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Faites-nous savoir comment nous pouvons
                                            vous
                                            aider</font>
                                    </font>
                                </h4>
                                
                                @auth
                                    <form class="contact-form-style mt-30" id="contactForm" action="#" method="POST">
                                        @csrf

                                        <div id="show_success_alert"></div>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="name" id="name" placeholder="Nom et prénom *" type="text" value="{{ Auth::user()->name }}">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="email" id="email" placeholder="Email *" type="email" value="{{ Auth::user()->email }}">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="phone" id="phone" placeholder="Téléphone *" type="tel" value="{{ Auth::user()->phone }}">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="subject" placeholder="Objet *" type="text" id="subject">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="textarea-style mb-30">
                                                    <textarea name="message" id="message" placeholder="Message *"></textarea>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                
                                            </div>

                                            <input type="submit" value="Envoyer" class="rounded-0 text-white" id="send_btn" style="background-color: #112c3f">

                                        </div>
                                    </form>
                                @else
                                    <form class="contact-form-style mt-30" id="contactForm" action="#" method="POST">
                                        @csrf

                                        <div id="show_success_alert"></div>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="name" placeholder="Nom et prénom *" type="text" id="name">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="email" placeholder="Email *" type="email" id="email">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="phone" placeholder="Téléphone *" type="tel" id="phone">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="subject" placeholder="Objet *" type="text" id="subject">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="textarea-style mb-30">
                                                    <textarea name="message" placeholder="Message *" id="message"></textarea>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                                
                                            </div>
                                            <input type="submit" value="Envoyer" class="rounded-0 text-white" id="send_btn" style="background-color: #112c3f">
                                        </div>
                                    </form>
                                @endauth


                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function(){
        $("#contactForm").submit(function(e){
            e.preventDefault();
            $("#send_btn").val('En cours...');
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: $(this).serialize(),
                url: "/contactStore",
                success: function(res){
                    // console.log(res);
                    if(res.status == 400){
                        showError('name', res.messages.name);
                        showError('email', res.messages.email);
                        showError('phone', res.messages.phone);
                        showError('subject', res.messages.subject);
                        showError('message', res.messages.message);
                        $("#send_btn").val('Envoyer');
                    } else if(res.status == 200) {
                        $("#show_success_alert").html(showMessage('success', res.messages));
                        $("#contactForm")[0].reset();
                        removeValidationClasses("#contactForm");
                        $("#send_btn").val('Envoyer');
                    }
                }
            })
        });
    });
</script>


@endsection
