@extends('auth.layout')


@section('main')



    <div class="page-content pt-150 pb-150">

        <div class="d-flex justify-content-center align-items-center mt-5">

            <div class="card"> 

                <div class="heading_s1">
                    <h4 class="mb-10 text-center">Devenir vendeur</h4>
                </div>


                <div class="tab-content" >

                        <div class="form px-4 mb-60">

                            

                            <form method="POST" action="{{ route('vendor.register') }}" id="loginForm">
                                @csrf

                                <!-- Name -->
                                <div class="form-group">
                                    <input type="text" id="name" name="name" placeholder="Nom de l'enseigne" class="form-control rounded-0 @error('name') is-invalid @enderror" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Username -->
                                <div class="form-group">
                                    <input type="text" id="username" name="username" placeholder="Nom et prénom" class="form-control rounded-0 @error('username') is-invalid @enderror"/>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Email Address -->
                                <div class="form-group">
                                    <input type="email" id="email" name="email" placeholder="Email" class="form-control rounded-0 @error('email') is-invalid @enderror"/>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone number -->
                                <div class="form-group">
                                    <input type="text" id="phone" name="phone" placeholder="Téléphone" class="form-control rounded-0 @error('phone') is-invalid @enderror"/>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <!-- Password -->
                                <div class="form-group">
                                    <input type="password" id="password" name="password" placeholder="Minimum 6 caractères" class="form-control rounded-0 @error('password') is-invalid @enderror"/>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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