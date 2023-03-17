@extends('admin.admin_dashboard')

@section('admin')
    
    <link rel="stylesheet" type="text/css" href="{{ asset('adminBackend/assets/app.css') }}">

    {{-- <style>
        .file-upload {
          display: flex;
          flex-direction: column;
          align-items: center;
        }
        .file-upload input[type="file"] {
          display: none;
        }
        .file-upload label {
          background-color: blue;
          color: white;
          padding: 10px;
          border-radius: 4px;
          cursor: pointer;
        }
        .file-list {
          display: flex;
          flex-wrap: wrap;
        }
        .file-list .file-item {
          width: 150px;
          height: 150px;
          margin: 10px;
          position: relative;
        }
        .file-list .file-item img {
          width: 100%;
          height: 100%;
          object-fit: cover;
        }
        .file-list .file-item .remove-file {
          position: absolute;
          top: 5px;
          right: 5px;
          background-color: red;
          color: white;
          padding: 5px;
          border-radius: 50%;
          cursor: pointer;
        }
    </style> --}}

    <style>
        form {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
}

input[type="file"] {
  margin-bottom: 10px;
  padding: 10px;
}

input[type="submit"] {
  padding: 10px 20px;
  background-color: blue;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

    </style>


    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Produits</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Ajouter un produit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Nouveau produit</h5>
                <hr />

                <form id="myForm" action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">

                                <!-- Product name -->
                                <div class="row g-3 mb-4">
                                    <div class="form-group col-md-6">
                                        <label>Nom du produit</label>
                                        <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" id="product_name" value="{{ old('product_name') }}" >

                                        @error('product_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Category ID -->
                                    <div class="form-group col-md-6">
                                        <label>Catégorie</label>

                                        @if ($categories->isEmpty())
                                            <p class="text-danger">! Vous devez d'abord créer des catégories</p>
                                        @else
                                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id" >
                                                <option value="" hidden=""><< choisissez >></option>

                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                        @endif
                                    </div>
                                </div>


                                <br>
                                <div class="row g-3 mb-4">

                                    <!-- Pays-->
                                    <div class="form-group col-md-6">
                                        <label>Pays d'origine</label>

                                        <select class="single-select select2-hidden-accessible" name="product_country">
                                            <option value="Afghanistan">Afghanistan </option>
                                            <option value="Afrique du Sud">Afrique du Sud </option>
                                            <option value="Albanie">Albanie </option>
                                            <option value="Algerie">Algerie </option>
                                            <option value="Allemagne">Allemagne </option>
                                            <option value="Andorre">Andorre </option>
                                            <option value="Angola">Angola </option>
                                            <option value="Anguilla">Anguilla </option>
                                            <option value="Arabie Saoudite">Arabie Saoudite </option>
                                            <option value="Argentine">Argentine </option>
                                            <option value="Armenie">Armenie </option>
                                            <option value="Australie">Australie </option>
                                            <option value="Autriche">Autriche </option>
                                            <option value="Azerbaidjan">Azerbaidjan </option>

                                            <option value="Bahamas">Bahamas </option>
                                            <option value="Bangladesh">Bangladesh </option>
                                            <option value="Barbade">Barbade </option>
                                            <option value="Bahrein">Bahrein </option>
                                            <option value="Belgique">Belgique </option>
                                            <option value="Belize">Belize </option>
                                            <option value="Benin">Bénin </option>
                                            <option value="Bermudes">Bermudes </option>
                                            <option value="Bielorussie">Bielorussie </option>
                                            <option value="Bolivie">Bolivie </option>
                                            <option value="Botswana">Botswana </option>
                                            <option value="Bhoutan">Bhoutan </option>
                                            <option value="Boznie Herzegovine">Boznie Herzegovine </option>
                                            <option value="Bresil">Brésil </option>
                                            <option value="Brunei">Brunei </option>
                                            <option value="Bulgarie">Bulgarie </option>
                                            <option value="Burkina Faso">Burkina Faso </option>
                                            <option value="Burundi">Burundi </option>

                                            <option value="Cambodge">Cambodge </option>
                                            <option value="Cameroun">Cameroun </option>
                                            <option value="Canada">Canada </option>
                                            <option value="Canaries">Canaries </option>
                                            <option value="Cap Vert">Cap Vert </option>
                                            <option value="Chili">Chili </option>
                                            <option value="Chine">Chine </option>
                                            <option value="Chypre">Chypre </option>
                                            <option value="Colombie">Colombie </option>
                                            <option value="Comores">Comores </option>
                                            <option value="Congo">Congo </option>
                                            <option value="Corée du Nord">Corée du Nord </option>
                                            <option value="Corée du Sud">Corée du Sud </option>
                                            <option value="Costa Rica">Costa Rica </option>
                                            <option value="Côte d'ivoire">Côte d'ivoire </option>
                                            <option value="Croatie">Croatie </option>
                                            <option value="Cuba">Cuba </option>

                                            <option value="Danemark">Danemark </option>
                                            <option value="Djibouti">Djibouti </option>
                                            <option value="Dominique">Dominique </option>

                                            <option value="Égypte">Égypte </option>
                                            <option value="Emirats Arabes Unis">Emirats Arabes Unis </option>
                                            <option value="Équateur">Équateur </option>
                                            <option value="Érythrée">Érythrée </option>
                                            <option value="Espagne">Espagne </option>
                                            <option value="Estonie">Estonie </option>
                                            <option value="Etats Unis">Etats Unis </option>
                                            <option value="Éthiopie">Éthiopie </option>

                                            <option value="Fidji">Fidji </option>
                                            <option value="Finlande">Finlande </option>
                                            <option value="France">France </option>

                                            <option value="Gabon">Gabon </option>
                                            <option value="Gambie">Gambie </option>
                                            <option value="Géorgie">Géorgie </option>
                                            <option value="Ghana">Ghana </option>
                                            <option value="Gibraltar">Gibraltar </option>
                                            <option value="Grèce">Grèce </option>
                                            <option value="Grenade">Grenade </option>
                                            <option value="Groenland">Groenland </option>
                                            <option value="Guadeloupe">Guadeloupe </option>
                                            <option value="Guam">Guam </option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernesey">Guernesey </option>
                                            <option value="Guinee">Guinee </option>
                                            <option value="Guinee Bissau">Guinee Bissau </option>
                                            <option value="Guinée équatoriale">Guinée équatoriale </option>
                                            <option value="Guyane">Guyane </option>

                                            <option value="Haiti">Haiti </option>
                                            <option value="Hawaii">Hawaii </option>
                                            <option value="Honduras">Honduras </option>
                                            <option value="Hong Kong">Hong Kong </option>
                                            <option value="Hongrie">Hongrie </option>

                                            <option value="Inde">Inde </option>
                                            <option value="Indonésie">Indonésie </option>
                                            <option value="Iran">Iran </option>
                                            <option value="Iraq">Iraq </option>
                                            <option value="Irlande">Irlande </option>
                                            <option value="Islande">Islande </option>
                                            <option value="Israel">Israel </option>
                                            <option value="Italie">italie </option>

                                            <option value="Jamaique">Jamaique </option>
                                            <option value="Japon">Japon </option>
                                            <option value="Jordanie">Jordanie </option>

                                            <option value="Kazakhstan">Kazakhstan </option>
                                            <option value="Kenya">Kenya </option>
                                            <option value="Koweit">Koweit </option>

                                            <option value="Laos">Laos </option>
                                            <option value="Lésotho">Lésotho </option>
                                            <option value="Léttonie">Léttonie </option>
                                            <option value="Liban">Liban </option>
                                            <option value="Libéria">Libéria </option>
                                            <option value="Liechtenstein">Liechtenstein </option>
                                            <option value="Lituanie">Lituanie </option>
                                            <option value="Luxembourg">Luxembourg </option>
                                            <option value="Lybie">Lybie </option>

                                            <option value="Macao">Macao </option>
                                            <option value="Macédoine">Macédoine </option>
                                            <option value="Madagascar">Madagascar </option>
                                            <option value="Madère">Madère </option>
                                            <option value="Malaisie">Malaisie </option>
                                            <option value="Malawi">Malawi </option>
                                            <option value="Maldives">Maldives </option>
                                            <option value="Mali">Mali </option>
                                            <option value="Malte">Malte </option>
                                            <option value="Man">Man </option>
                                            <option value="Mariannes du Nord">Mariannes du Nord </option>
                                            <option value="Maroc">Maroc </option>
                                            <option value="Marshall">Marshall </option>
                                            <option value="Martinique">Martinique </option>
                                            <option value="Maurice">Maurice </option>
                                            <option value="Mauritanie">Mauritanie </option>
                                            <option value="Mayotte">Mayotte </option>
                                            <option value="Mexique">Mexique </option>
                                            <option value="Micronesie">Micronesie </option>
                                            <option value="Midway">Midway </option>
                                            <option value="Moldavie">Moldavie </option>
                                            <option value="Monaco">Monaco </option>
                                            <option value="Mongolie">Mongolie </option>
                                            <option value="Montserrat">Montserrat </option>
                                            <option value="Mozambique">Mozambique </option>

                                            <option value="Namibie">Namibie </option>
                                            <option value="Nauru">Nauru </option>
                                            <option value="Nepal">Nepal </option>
                                            <option value="Nicaragua">Nicaragua </option>
                                            <option value="Niger">Niger </option>
                                            <option value="Nigéria">Nigéria </option>
                                            <option value="Niue">Niue </option>
                                            <option value="Norfolk">Norfolk </option>
                                            <option value="Norvege">Norvege </option>
                                            <option value="Nouvelle Calédonie">Nouvelle Calédonie </option>
                                            <option value="Nouvelle Zélande">Nouvelle Zélande </option>

                                            <option value="Oman">Oman </option>
                                            <option value="Ouganda">Ouganda </option>
                                            <option value="Ouzbekistan">Ouzbekistan </option>

                                            <option value="Pakistan">Pakistan </option>
                                            <option value="Palau">Palau </option>
                                            <option value="Palestine">Palestine </option>
                                            <option value="Panama">Panama </option>
                                            <option value="Papouasie Nouvelle Guinée">Papouasie Nouvelle Guinée </option>
                                            <option value="Paraguay">Paraguay </option>
                                            <option value="Pays Bas">Pays Bas </option>
                                            <option value="Pérou">Pérou </option>
                                            <option value="Philippines">Philippines </option>
                                            <option value="Pologne">Pologne </option>
                                            <option value="Polynesie">Polynesie </option>
                                            <option value="Porto Rico">Porto Rico </option>
                                            <option value="Portugal">Portugal </option>

                                            <option value="Qatar">Qatar </option>

                                            <option value="République Démocratique du Congo">République Démocratique du Congo </option>
                                            <option value="République Dominicaine">République Dominicaine </option>
                                            <option value="République Tchèque">République Tchèque </option>
                                            <option value="Réunion">Réunion </option>
                                            <option value="Roumanie">Roumanie </option>
                                            <option value="Royaume Uni">Royaume Uni </option>
                                            <option value="Russie">Russie </option>
                                            <option value="Rwanda">Rwanda </option>

                                            <option value="Sahara Occidental">Sahara Occidental </option>
                                            <option value="Sainte Lucie">Sainte Lucie </option>
                                            <option value="Saint Marin">Saint Marin </option>
                                            <option value="Salomon">Salomon </option>
                                            <option value="Salvador">Salvador </option>
                                            <option value="Samoa Occidentales">Samoa Occidentales</option>
                                            <option value="Samoa Americaine">Samoa Americaine </option>
                                            <option value="Sao Tomé et Principe">Sao Tomé et Principe </option>
                                            <option value="Sénégal">Sénégal </option>
                                            <option value="Seychelles">Seychelles </option>
                                            <option value="Sierra Leone">Sierra Leone </option>
                                            <option value="Singapour">Singapour </option>
                                            <option value="Slovaquie">Slovaquie </option>
                                            <option value="Slovenie">Slovenie</option>
                                            <option value="Somalie">Somalie </option>
                                            <option value="Soudan">Soudan </option>
                                            <option value="Sri Lanka">Sri Lanka </option>
                                            <option value="Suède">Suède </option>
                                            <option value="Suisse">Suisse </option>
                                            <option value="Surinam">Surinam </option>
                                            <option value="Swaziland">Swaziland </option>
                                            <option value="Syrie">Syrie </option>

                                            <option value="Tadjikistan">Tadjikistan </option>
                                            <option value="Taiwan">Taiwan </option>
                                            <option value="Tonga">Tonga </option>
                                            <option value="Tanzanie">Tanzanie </option>
                                            <option value="Tchad">Tchad </option>
                                            <option value="Thailande">Thailande </option>
                                            <option value="Tibet">Tibet </option>
                                            <option value="Timor Oriental">Timor Oriental </option>
                                            <option value="Togo">Togo </option>
                                            <option value="Trinite et Tobago">Trinite et Tobago </option>
                                            <option value="Tristan da cunha">Tristan de cuncha </option>
                                            <option value="Tunisie">Tunisie </option>
                                            <option value="Turkmenistan">Turmenistan </option>
                                            <option value="Turquie">Turquie </option>

                                            <option value="Ukraine">Ukraine </option>
                                            <option value="Uruguay">Uruguay </option>

                                            <option value="Vanuatu">Vanuatu </option>
                                            <option value="Vatican">Vatican </option>
                                            <option value="Venezuela">Venezuela </option>
                                            <option value="Vierges Americaines">Vierges Americaines </option>
                                            <option value="Vierges Britanniques">Vierges Britanniques </option>
                                            <option value="Vietnam">Vietnam </option>

                                            <option value="Wake">Wake </option>
                                            <option value="Wallis et Futuma">Wallis et Futuma </option>

                                            <option value="Yemen">Yemen </option>
                                            <option value="Yougoslavie">Yougoslavie </option>

                                            <option value="Zambie">Zambie </option>
                                            <option value="Zimbabwe">Zimbabwe </option>
                                        </select>
                                    </div>

                                    <!-- Tailles -->
                                    <div class="form-group col-md-6">
                                        <label>Taille </label>

                                        <select class="form-select" name="product_size" >
                                            <option value="" hidden=""><< choisissez >></option>
                                            <optgroup label="Pointures">
                                                <option value="16">16 </option>
                                                <option value="16,5">16,5 </option>
                                                <option value="17">17 </option>
                                                <option value="17,5">17,5 </option>
                                                <option value="18">18 </option>
                                                <option value="18,5">18,5 </option>
                                                <option value="19">19 </option>
                                                <option value="19,5">19,5 </option>
                                                <option value="20">20 </option>
                                                <option value="20,5">20,5 </option>
                                                <option value="21">21 </option>
                                                <option value="21,5">21,5 </option>
                                                <option value="22">22 </option>
                                                <option value="22,5">22,5 </option>
                                                <option value="23">23 </option>
                                                <option value="23,5">23,5 </option>
                                                <option value="24">24 </option>
                                                <option value="24,5">24,5 </option>
                                                <option value="25">25 </option>
                                                <option value="25,5">25,5 </option>
                                                <option value="26">26 </option>
                                                <option value="26,5">26,5 </option>
                                                <option value="27">27 </option>
                                                <option value="27,5">27,5 </option>
                                                <option value="28">28 </option>
                                                <option value="28,5">28,5 </option>
                                                <option value="29">29 </option>
                                                <option value="29,5">29,5 </option>
                                                <option value="30">30 </option>
                                                <option value="30,5">30,5 </option>
                                                <option value="31">31 </option>
                                                <option value="31,5">31,5 </option>
                                                <option value="32">32 </option>
                                                <option value="32,5">32,5 </option>
                                                <option value="33">33 </option>
                                                <option value="33,5">33,5 </option>
                                                <option value="34">34 </option>
                                                <option value="34,5">34,5 </option>
                                                <option value="35">35 </option>
                                                <option value="35,5">35,5 </option>
                                                <option value="36">36 </option>
                                                <option value="36,5">36,5 </option>
                                                <option value="37">37 </option>
                                                <option value="37,5">37,5 </option>
                                                <option value="38">38 </option>
                                                <option value="38,5">38,5 </option>
                                                <option value="39">39 </option>
                                                <option value="39,5">39,5 </option>
                                                <option value="40">40 </option>
                                                <option value="40,5">40,5 </option>
                                                <option value="41">41 </option>
                                                <option value="41,5">41,5 </option>
                                                <option value="42">42 </option>
                                                <option value="42,5">42,5 </option>
                                                <option value="43">43 </option>
                                                <option value="43,5">43,5 </option>
                                                <option value="44">44 </option>
                                                <option value="44,5">44,5 </option>
                                                <option value="45">45 </option>
                                                <option value="45,5">45,5 </option>
                                                <option value="46">46 </option>
                                                <option value="46,5">46,5 </option>
                                                <option value="47">47 </option>
                                                <option value="47,5">47,5 </option>
                                                <option value="48">48 </option>
                                                <option value="48,5">48,5 </option>
                                                <option value="49">49 </option>
                                                <option value="49,5">49,5 </option>
                                                <option value="50 et plus">50 et plus </option>
                                            </optgroup>
                                            <optgroup label="Taille de vêtements">
                                                <optgroup label="Femme">
                                                    <option value="32 - XXS">32 - XXS </option>
                                                    <option value="34 - XS">34 - XS </option>
                                                    <option value="36 - S">36 - S </option>
                                                    <option value="38 - M">38 - M </option>
                                                    <option value="40 - L">40 - L </option>
                                                    <option value="42 - XL">42 - XL </option>
                                                    <option value="44 - XXL">44 - XXL </option>
                                                    <option value="46 - XXXL">46 - XXXL </option>
                                                    <option value="48 - 4XL">48 - 4XL </option>
                                                    <option value="50 et plus - 5XL">50 et plus - 5XL</option>
                                                <optgroup label="Homme">
                                                    <option value="XS">XS </option>
                                                    <option value="S">S </option>
                                                    <option value="M">M </option>
                                                    <option value="L">L </option>
                                                    <option value="XL">XL </option>
                                                    <option value="XXL">XXL </option>
                                                    <option value="XXL et plus">XXXL et plus </option>
                                                <optgroup label="Enfant">
                                                    <option value="3 ans">3 ans </option>
                                                    <option value="4 ans">4 ans </option>
                                                    <option value="5 ans">5 ans </option>
                                                    <option value="6 ans">6 ans </option>
                                                    <option value="8 ans">8 ans </option>
                                                    <option value="10 ans">10 ans </option>
                                                    <option value="12 ans">12 ans </option>
                                                    <option value="14 ans">14 ans </option>
                                                    <option value="16 ans">16 ans </option>
                                                    <option value="18 ans">18 ans </option>
                                                </optgroup>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <br>
                                <div class="row g-3 mb-4">

                                    <!-- Type vetement -->
                                    <div class="form-group col-md-6">
                                        <label>Type</label>

                                        <select name="product_type" class="form-select">
                                            <option value="" hidden=""><< choisissez >></option>
                                            <optgroup label="Type de vêtements">
                                                <option value="Robes / jupes">Robes / jupes </option>
                                                <option value="Manteaux & vestes">Manteaux & vestes </option>
                                                <option value="Hauts / T-shirts / Polos">Hauts / T-shirts / Polos </option>
                                                <option value="Pantalons">Pantalons </option>
                                                <option value="Pulls / Gilets / Mailles">Pulls / Gilets / Mailles </option>
                                                <option value="Jeans">Jeans </option>
                                                <option value="Chemises / Chemisiers">Chemises / Chemisiers </option>
                                                <option value="Costumes / Tailleurs">Costumes / Tailleurs </option>
                                                <option value="Shorts / Pantacourts / Bermudas">Shorts / Pantacourts / Bermudas </option>
                                                <option value="Maillots de bain & vêtements de plage">Maillots de bain & vêtements de plage </option>
                                                <option value="Lingerie">Lingerie </option>
                                                <option value="Sous-vêtements & vêtements de nuit">Sous-vêtements & vêtements de nuit </option>
                                                <option value="Déguisements">Déguisements </option>
                                                <option value="Mariage">Mariage </option>
                                            <optgroup label="Type de chaussures">
                                                <option value="Baskets & Sneakers">Baskets & Sneakers </option>
                                                <option value="Chaussures à lacets">Chaussures à lacets</option>
                                                <option value="Chaussures à scratch">Chaussures à scratch </option>
                                                <option value="Mocassins">Mocassins </option>
                                                <option value="Bottines & lowboots">Bottines & lowboots </option>
                                                <option value="Bottes">Bottes </option>
                                                <option value="Sandales & Nu-pieds">Sandales & Nu-pieds </option>
                                                <option value="Chaussons & Pantoufles">Chaussons & Pantoufles </option>
                                                <option value="Ballerines">Ballerines </option>
                                            <option value="Autres">Autres </option>
                                        </select>

                                    </div>

                                    <!-- Couleur -->
                                    <div class="form-group col-md-6">
                                        <label>Couleur </label>
                                        <select class="form-select" name="product_color" >
                                            <option value="" hidden=""><< choisissez >></option>
											<option value="Argenté / Acier">Argenté / Acier</option>
											<option value="Beige / Camel">Beige / Camel</option>
											<option value="Blanc">Blanc</option>
											<option value="Bleu / Ciel">Bleu / Ciel</option>
											<option value="Crème / Blanc cassé / Écru">Crème / Blanc cassé / Écru</option>
                                            <option value="Doré / Bronze / Cuivre">Doré / Bronze / Cuivre</option>
                                            <option value="Gris / Anthracite">Gris / Anthracite</option>
                                            <option value="Imprimés multicolore">Imprimés multicolore</option>
											<option value="Jaune / Moutarde">Jaune / Moutarde</option>
											<option value="Kaki">Kaki</option>
											<option value="Lavande / Lilas">Lavande / Lilas</option>
											<option value="Marine / Turquoise">Marine / Turquoise</option>
											<option value="Marron">Marron</option>
											<option value="Multicolore">Multicolore</option>
											<option value="Noir">Noir</option>
											<option value="Orange / Corail">Orange / Corail</option>
											<option value="Rose / Fuchsia">Rose / Fuchsia</option>
											<option value="Rouge / Bordeaux">Rouge / Bordeaux</option>
											<option value="Vert">Vert</option>
											<option value="Violet / Mauve">Violet / Mauve</option>
											<option value="Autre">Autre</option>

										</select>
                                    </div>
                                </div>





                                <br>
                                <div class="row g-3 mb-4">
                                    <!-- Product price -->
                                    <div class="form-group col-md-4">
                                        <label>Prix</label>
                                        <input type="text" name="product_price" class="form-control @error('product_price') is-invalid @enderror" id="product_price"value="{{ old('product_price') }}">

                                        @error('product_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Discount price -->
                                    <div class="form-group col-md-4">
                                        <label>Prix de la remise</label>
                                        <input type="text" name="discount_price" class="form-control @error('discount_price') is-invalid @enderror" id="discount_price" value="{{ old('discount_price') }}">

                                        @error('discount_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Product quantity -->
                                    <div class="form-group col-md-4">
                                        <label>Quantité mis en vente</label>
                                        <input type="text" name="product_quantity" class="form-control @error('product_quantity') is-invalid @enderror" id="product_quantity" value="{{ old('product_quantity') }}" >

                                        @error('product_quantity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <br>
                                <div class="row g-4 mb-4">
                                    <!-- Brand ID -->
                                    <div class="form-group col-md-6">
                                        <label>Marque</label>

                                        @if ($brands->isEmpty())
                                            <p class="text-danger">! Vous devez d'abord créer des marques</p>
                                        @else
                                            <select class="form-select @error('brand_id') is-invalid @enderror" name="brand_id" id="brand_id" >
                                                <option value="" hidden=""><< choisissez >></option>

                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>

                                            @error('brand_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>


                                    <!-- Vendor ID -->
                                    <div class="form-group col-md-6">
                                        <label>Vendeur</label>

                                        @if ($activeVendor->isEmpty())
                                            <p class="text-danger">! Vous devez d'abord inscrire un vendeur</p>
                                        @else
                                            <select class="form-select @error('vendor_id') is-invalid @enderror" name="vendor_id" id="vendor_id" >
                                                <option value="" hidden=""><< choisissez >></option>

                                                @foreach ($activeVendor as $vendor)
                                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('vendor_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>

                                </div>



                                <br>
                                <!-- Long description -->
                                <div class="form-group mb-4">
                                    <label> Information supplémentaire </label>
                                    <textarea class="form-control @error('long_description') is-invalid @enderror" id="mytextarea" name="long_description">{{ old('long_description') }}</textarea>

                                    @error('long_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <br>


                                <!-- Thumbnail -->
                                <div class="form-group mb-4">
                                    <label>Image de couverture</label>
                                    
                                    <div class="mt-4">

                                        <input class="form-group @error('product_thumbnail') is-invalid @enderror" name="product_thumbnail" type="file" accept='.jpg,.jpeg,.png,.webp' id="formFile" onchange="mainThumbUrl(this)" >

                                        @error('product_thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <img src="" id="mainThmb" alt="" class="mt-4 text-center" style="border-radius: 3%">
                                    
                                </div>



                                
                                <br>
                                <!-- Multiple image -->
                                <div class="form-group mb-3">
                                    <label>Images</label>


                                    {{-- <div class="drag-area">
                                        <span class="visible select">
                                            Faites glisser et déposez l'image ici ou parcourez
                                        </span>
                                        <input name="multi_img[]" type="file" class="file @error('multi_img') is-invalid @enderror" multiple accept=".jpg,.jpeg,.png,.webp"/>

                                        @error('multi_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

                                    {{-- <div class="file-upload">
                                        <input type="file" id="file-input" name="multi_img[]" multiple />
                                        <label for="file-input">Upload des fichiers</label>
                                    </div>

                                    <div class="container">
                                        <div class="file-list"></div>
                                    </div> --}}


                                    <form>
                                        <input type="file" multiple id="fileInput">
                                        <input type="submit" value="Upload">
                                      </form>
                                      <div id="previewContainer"></div>
                                      

                                                                
                                    <!-- IMAGE PREVIEW CONTAINER -->
                                    {{-- <div class="container"></div> --}}

                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- <hr> --}}
                    <!-- Submit -->
                    <div class="col-12">
                        <div align="center">
                            <button type="submit" class="btn btn-success">Ajouter produit <i class="bx bx-save"></i></button>
                        </div>
                    </div>
                </form>

            </div>

        </div>



    </div>

    <script src="{{ asset('adminBackend/assets/app.js') }}"></script>

    <!-- Thumbnail script -->
    <script type="text/javascript">
        function mainThumbUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(175).height(175);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    {{-- <script>
        const fileInput = document.getElementById("file-input");
        const fileList = document.querySelector(".file-list");
        fileInput.addEventListener("change", function() {
        for (const file of fileInput.files) {
            const fileItem = document.createElement("div");
            fileItem.classList.add("file-item");
            const fileImage = new Image();
            fileImage.src = URL.createObjectURL(file);
            fileImage.alt = file.name;
            fileItem.appendChild(fileImage);
            const removeFileButton = document.createElement("div");
            removeFileButton.classList.add("remove-file");
            removeFileButton.textContent = "X";
            removeFileButton.addEventListener("click", function() {
            fileItem.remove();
            });
            fileItem.appendChild(removeFileButton);
            fileList.appendChild(fileItem);
        }
        });
  </script> --}}

  <script>
    const fileInput = document.querySelector('#fileInput');
const previewContainer = document.querySelector('#previewContainer');

let selectedFiles = [];

fileInput.addEventListener('change', (e) => {
  selectedFiles = [...selectedFiles, ...e.target.files];

  // Clear previous previews
  previewContainer.innerHTML = '';

  for (let i = 0; i < selectedFiles.length; i++) {
    const file = selectedFiles[i];
    const reader = new FileReader();

    reader.addEventListener('load', (e) => {
      const image = new Image();
      image.src = e.target.result;
      image.style.width = '100px';
      image.style.height = '100px';

      // Add delete button to each preview
      const deleteButton = document.createElement('button');
      deleteButton.innerHTML = 'Delete';
      deleteButton.addEventListener('click', () => {
        selectedFiles = selectedFiles.filter((selectedFile) => selectedFile !== file);
        image.remove();
        deleteButton.remove();
      });

      previewContainer.appendChild(image);
      previewContainer.appendChild(deleteButton);
    });

    reader.readAsDataURL(file);
  }
});

});

  </script>

@endsection
