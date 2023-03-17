@extends('auth.layout')

@section('main')
    

<div class="page-content pt-150 pb-150">

    <div class="d-flex justify-content-center align-items-center mt-5">

        <div class="card"> 

            <div class="heading_s1">
                <h4 class="mb-10 text-center">S'inscrire</h4>
            </div>


            <div class="tab-content" >

                    <div class="form px-4 mb-60">

                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}" id="loginForm">
                            @csrf

                            <!-- Name -->
                            <div class="form-group">
                                <input type="text" id="name" name="name" placeholder="Nom et prénom" class="form-control rounded-0 @error('name') is-invalid @enderror" value="{{ old('name') }}"/>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Email Address -->
                            <div class="form-group">
                                <input type="email" id="email" name="email" placeholder="Email" class="form-control rounded-0 @error('email') is-invalid @enderror" value="{{ old('email') }}"/>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Password -->
                            <div class="form-group">
                                <input type="password" id="password" name="password" placeholder="Mot de passe (minimum 6 caractères)" class="form-control rounded-0 @error('password') is-invalid @enderror"/>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="login_footer form-group mb-55">
                                <span>Déjà inscrit ? <a href="{{ route('login') }}" class="underline-on-hover">Se connecter</a></span>
                            </div>

                            <div class="form-group mb-30">
                                <input type="submit" value="S'inscrire" class="rounded-0 text-white" id="register_btn" style="background-color: #112c3f">
                            </div>

                        </form>


                    </div>

                    

            </div>

            




        </div>


    </div>


    



</div>

@endsection