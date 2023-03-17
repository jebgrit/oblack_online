<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">

    {{-- <meta http-equiv="refresh" content="3;url=/" /> --}}

    <script>
        var seconds = 5;
        function displaySeconds()
        {
            seconds -= 1;
            document.getElementById("countdown").innerText="Vous allez être redirigé dans " +seconds+ " secondes ...";
        }
        setInterval(displaySeconds, 1000);

        function redirectPage()
        {
            window.location="/";
        }
        setTimeout('redirectPage()', 5000);
    </script>
</head>


<body>

    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp


    <style>
        body {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }
    
        h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }
    
        p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size: 20px;
            margin: 0;
        }
    
        i {
            color: #9ABC66;
            font-size: 100px;
            line-height: 200px;
            margin-left: -15px;
        }
    
        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
    </style>

    <div class="card">
        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <i class="checkmark">✓</i>
        </div>
        <h1>Merci pour votre commande chez {{ $setting->company_name }}</h1>
        <p>Nous espérons qu'elle vous plaira!<br /> Nous vous contacterons par e-mail dès qu'elle est expédiée.</p>

        <p id="countdown" class="text-info" style="font-size: 10px;"></p>
    </div>
</body>

</html>
