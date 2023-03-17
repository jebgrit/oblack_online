<!doctype html>
<html lang="fr">

<head>
    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $setting->company_name }}.fr: Télécharger la facture</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 15px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: #112c3f;
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: #112c3f;
            ;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>

<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            
            <td align="right">
                <pre class="font">
                    <strong>{{ $setting->company_name }} S.A </strong>
                    <strong>{{ $setting->company_address }}</strong>
                    <strong></strong> {{ $setting->company_email }} 
                </pre>
            </td>
        </tr>

    </table>


    <table width="100%" style="background:white; padding:2px;"></table>

    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>Nom:</strong> {{ $order->name }} <br>
                    <strong>Adresse:</strong> {{ $order->address }}, {{ $order->zip_code }}, {{ $order->city }}
                </p>
            </td>
            <td>
                <p class="font">
                <strong>No. Facture: </strong>{{ $order->invoice_no }}<br> 
                <strong>Date de commande: </strong> {{ $order->order_date }}
                </p>
            </td>
        </tr>
    </table>
    <br />
    <h3>Produits</h3>


    <table width="100%">
        <thead style="background-color: #112c3f; color:#FFFFFF;">
            <tr class="font">
                <th>Aperçu</th>
                <th>Produit</th>
                <th>Couleur</th>
                <th>Taille</th>
                <th>SKU</th>
                <th>Quantité</th>
                <th>Total </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($order_item as $item)
                <tr class="font">
                    <td align="center">
                        <img src="{{ public_path($item->product->product_thumbnail) }}" height="50px;" width="50px;" alt="">
                    </td>
                    <td align="center">{{ $item->product->product_name }}</td>
                    <!--color -->
                    @if ($item->color == null)
                        <td align="center">
                            <label>.... </label>
                        </td>
                    @else
                        <td align="center">
                            <label>{{ $item->color }} </label>
                        </td>
                    @endif
                    <!--size -->
                    @if ($item->size == null)
                        <td align="center">
                            <label>.... </label>
                        </td>
                    @else
                        <td align="center">
                            <label>{{ $item->size }} </label>
                        </td>
                    @endif
                    <!--product code -->
                    <td align="center">{{ $item->product->product_code }}</td>
                    <!--quantity -->
                    <td align="center">{{ $item->qty }}</td>
                    <!--price -->
                    <td align="center">{{ $item->price }}€</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: #112c3f;">Prix d'origine:</span> {{ $order->amount }}€</h2>
                <h2><span style="color: #112c3f;">Total:</span> {{ $order->amount }}€</h2>
                {{-- <h2><span style="color: #112c3f;">Full Payment PAID</h2> --}}
            </td>
        </tr>
    </table>
    <div class="thanks mt-3">
        <p>Merci d'avoir acheté des produits.</p>
    </div>
    <div class="authority float-right mt-5">
        <p>-----------------------------------</p>
        <h5>Signature de l'autorité:</h5>
    </div>
</body>

</html>
