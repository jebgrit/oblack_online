@extends('auth.layout')

@section('main')
    
<div class="container mb-80 mt-50">

    <div class="breadcrumb mb-80">
        <a href="{{ route('home') }}">Accueil </a>
    </div>
    
    <form method="POST" action="{{ route('checkout') }}"> 
        @csrf

        <div class="row">

        
            <div class="col-lg-6">
                <div class="border p-40 cart-totals ml-30 mb-50" style="background-color: #fff">
                    <div class="row">
                        <h4 class="mb-30">Adresse de livraison</h4>
                        
                        <div class="form-group mb-30">
                            <label>Nom et prénom</label>
                            <input required="" type="text" name="shipping_name" value="{{ ucfirst(Auth::user()->name) }}" placeholder="Nom et prénom">
                        </div>


                        <div class="form-group mb-30">
                            <label>Numéro de téléphone</label>
                            <input required="" type="text" name="shipping_phone" value="{{ Auth::user()->phone }}" placeholder="Numéro de téléphone">
                        </div>


                        <div class="form-group mb-30">
                            <label>Adresse (Numéro et voie)</label>
                            <input required="" type="text" name="shipping_address" value="{{ Auth::user()->address }}" placeholder="Adresse">
                        </div>


                        <div class="form-group mb-30">
                            <label>Ville</label>
                            <input required="" type="text" name="shipping_city" value="{{ Auth::user()->city }}" placeholder="Ville">
                        </div>


                        <div class="form-group mb-30">
                            <label>Code postal</label>
                            <input required="" type="text" name="shipping_zipcode" value="{{ Auth::user()->zip_code }}" placeholder="Code postal">
                        </div>


                    </div>
                </div>
            </div>



            <div class="col-lg-6">
                <div class="border p-40 cart-totals ml-30 mb-50" style="background-color: #fff">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Récapitulatif de votre commande</h4>
                    </div>
                    
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            <tbody>

                                @foreach ($carts as $item)
                                    <tr>
                                        <td class="image product-thumbnail">
                                            <img src="{{ asset($item->options->image) }}" alt="produit" style="width: 50px; height:50px;"></td>
                                        <td>
                                            <p class="w-160 mb-5">
                                                <a href="{{ url('product/details/' . $item->id . '/' . $item->name) }}" class="text-heading">{{ Str::limit($item->name, 25) }}</a>
                                            </p>
                                            <div class="product-rate-cover">

                                                <!-- color -->
                                                @if ($item->options->color == null)
                                                    <!-- -->
                                                @else
                                                    <p>Couleur : {{ $item->options->color }}</p>
                                                @endif

                                                <!-- size -->
                                                @if ($item->options->size == null)
                                                    <!-- -->
                                                @else
                                                    <p>Taille : {{ $item->options->size }}</p>
                                                @endif


                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-muted pl-20 pr-20">x {{ $item->qty }}</p>
                                        </td>
                                        <td>
                                            <p class="text-brand">{{ $item->price }}€</p>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>




                        <table class="table no-border">
                            <tbody>

                                <tr>
                                    <td class="cart_total_label">
                                        <p class="text-muted">Total à payer</p>
                                    </td>
                                    <td class="cart_total_amount">
                                        <p class="text-brand text-end">{{ $cart_total }}€</p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <button type="submit" class="btn btn-fill-out ">Continuer<i class="fi-rs-sign-out ml-15"></i></button>
                </div>
                
            </div>
        </div>

    </form>
</div>




@endsection
