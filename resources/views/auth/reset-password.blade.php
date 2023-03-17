@extends('auth.layout')

@section('main')
   

<div class="page-content pt-150 pb-150">

    <div class="d-flex justify-content-center align-items-center mt-5">

        <div class="card">

            <div class="heading_s1">
                <h4 class="mb-10 text-center">Réinitialiser le mot de passe</h4>
            </div>




            <div class="form px-4 pt-5">

                <form method="POST" action="{{ route('password.update') }}" >
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Address -->
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Adresse email" class="form-control rounded-0 @error('email') is-invalid @enderror" value="{{ old('email', $email) }}" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Password -->
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Nouveau mot de passe" class="form-control rounded-0 @error('password') is-invalid @enderror" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-30">
                        <input type="submit" value="Valider" class="rounded-0 text-white" id="login_btn" style="background-color: #112c3f">
                    </div>

                </form>

            </div>




        </div>




    </div>


</div>

@endsection