@extends('auth.layout')


@section('main')

    

<div class="page-content pt-150 pb-150">

    <div class="d-flex justify-content-center align-items-center mt-5">

        <div class="card">
            <div class="row mb-30">
                <div class="logo logo-width-1" style="text-align:center">
                    <img class="border-radius-15" src="{{ asset('fronted/assets/imgs/page/reset_password.svg') }}"
                        alt=""/>
                </div>
            </div>


            <div class="d-flex justify-content-center align-items-center mt-5">

                <div class="card">

                    <div class="heading_s1">
                        <p class="mb-10 text-center">Indiquez-nous simplement
                            votre adresse e-mail et nous vous enverrons par e-mail un lien de réinitialisation
                            de mot de passe.</p>
                    </div>

                    <div class="form px-4 pt-5">

                        <form method="POST" action="{{ route('password.email') }}" id="loginForm">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">
                                <input type="email" id="email" name="email" placeholder="Email" class="form-control rounded-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-30">
                                <input type="submit" value="Envoyer le lien" class="bg-info rounded-0 text-white"
                                    id="login_btn">
                            </div>

                        </form>

                    </div>

                </div>


            </div>

            <div class="row mt-10">
                <p class="font-xs text-muted text-center">
                    Besoin d'aide? <a href="{{ route('cgv') }}" class="underline-on-hover">Contactez-nous</a>
                </p>
                
            </div>
        </div>




    </div>


</div>



@endsection