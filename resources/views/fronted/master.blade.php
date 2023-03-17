<!DOCTYPE html>
<html class="no-js" lang="fr">

@php
    $seo = App\Models\Seo::find(1);
    $setting = App\Models\SiteSetting::find(1);
@endphp

<head>
    <meta charset="utf-8" />

    <title>@yield('title')</title>

    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    <meta name="title" content="{{ $seo->meta_title }}" />
    <meta name="author" content="{{ $seo->meta_author }}" />
    <meta name="keyword" content="{{ $seo->meta_keyword }}" />
    <meta name="description" content="{{ $seo->meta_description }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset($setting->favicon) }}" />

    <!-- Plugins -->
    <script src="https://js.stripe.com/v3/"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">


    <!-- My CSS -->
    <link rel="stylesheet" href="{{ asset('fronted/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('fronted/assets/css/main.css?v=5.3') }}" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">


</head>

<!-- keep footer bottom -->
<style>
    body {
        position: relative;
        min-height: 100vh;
    }

    main {
        padding-bottom: 2.5rem;
    }

    footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 2.5rem;        
    }
</style>

<body style="background-color: #FAFAFA">

    <style>
        .underline-on-hover:hover {
            text-decoration: underline;
        }
    </style>


    
    <!-- Header  -->
    @include('fronted.body.header')

    @include('fronted.body.responsive_mobile')


    <main class="main" style="background-color: #FAFAFA">

        @yield('main')

    </main>


    <!-- Footer  -->
    @include('fronted.body.footer')





    <script src="{{ asset('fronted/assets/js/function.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <!-- Vendor JS-->
    <script src="{{ asset('fronted/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('fronted/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('fronted/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('fronted/assets/js/shop.js?v=5.3') }}"></script>
    <script src="{{ asset('fronted/assets/js/search.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>


    <!-- Sweat alert add to cart -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>








    


    <!-- Add to cart -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        // Add to cart product in details page
        function addToCartDetails() {

            var product_name = $('#dpname').text();
            var id = $('#dproduct_id').val();
            var vendor = $('#vproduct_id').val();
            var color = $('#dcolor').text();
            var size = $('#dsize').text();
            var quantity = $('#dquantity').val();

            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    color: color,
                    size: size,
                    quantity: quantity,
                    product_name: product_name,
                    vendor: vendor
                },
                url: "/dcart/data/store/" + id,
                success: function(data) {
                    miniCart();


                    // show message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        })
                    } else {

                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        })
                    }

                }
            })
        }
    </script>





    <!-- Mini cart -->
    <script type="text/javascript">
        // Mini cart show product
        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success: function(response) {
                    // console.log(response)

                    $('#cartQty').text(response.cart_qty);
                    $('span[id="cartSubTotal"]').text(response.cart_total);

                    // for mobile view
                    $('#cartQty2').text(response.cart_qty);
                    $('span[id="cartSubTotal2"]').text(response.cart_total);

                    var miniCart = ""

                    // for mobile view
                    var miniCart2 = ""

                    $.each(response.carts, function(key, value) {

                        // if (value.qty == 0) {
                        //     miniCart += ``
                        // } else {

                        // }

                        miniCart += `<ul class="pt-4">
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="/product/details/${value.id}/${value.name}">
                                                    <img alt="Nest" src="/${value.options.image}" style="width:30px; height:30px" />
                                                </a>
                                            </div>
                                            <div class="shopping-cart-title" style="margin: -73px 74px 14px; width:146px;">
                                                <p>
                                                    <a href="/product/details/${value.id}/${value.name}">${value.name.substring(0, 10)}</a>
                                                </p>
                                                <p>
                                                    <span>${value.qty} x </span>
                                                    ${value.price}€
                                                </p>
                                            </div>
                                            <div class="shopping-cart-delete" style="margin: -55px 1px 0px;">
                                                <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)" >
                                                    <i class="fi-rs-cross-small"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul><hr><br>`
                    });

                    // for mobile view
                    $.each(response.carts, function(key, value) {
                        miniCart2 += `<ul class="pt-4">
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="/product/details/${value.id}/${value.name}">
                                                    <img alt="Nest" src="/${value.options.image}" style="width:30px; height:30px" />
                                                </a>
                                            </div>
                                            <div class="shopping-cart-title" style="margin: -73px 74px 14px; width:146px;">
                                                <p>
                                                    <a href="/product/details/${value.id}/${value.name}">${value.name}</a>
                                                </p>
                                                <p>
                                                    <span>${value.qty} x </span>
                                                    ${value.price}€
                                                </p>
                                            </div>
                                            <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
                                                <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)" >
                                                    <i class="fi-rs-cross-small"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul><hr><br>`
                    });


                    $('#miniCart').html(miniCart);
                    $('#miniCart2').html(miniCart2);
                }
            })
        }
        miniCart();


        // Mini cart remove product
        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product/remove/' + rowId,
                dataType: 'json',
                success: function(data) {
                    miniCart();

                }
            })
        }
    </script>


    <!-- Add to Wishlist -->
    <script type="text/javascript">
        function addToWishList(product_id) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/add-to-wishlist/' + product_id,
                success: function(data) {
                    wishlist();

                    // Start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }
                }
            })
        }
    </script>

    <!-- Load Wishlist data -->
    <script type="text/javascript">
        function wishlist() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/get-wishlist-product',
                success: function(response) {
                    $('#wishQty').text(response.wishQty);
                    var rows = ""

                    // for mobile
                    $('#wishQty2').text(response.wishQty);

                    $.each(response.wishlist, function(key, value) {

                        rows += `
                            <tr class="pt-30">
                                    <td class="custome-checkbox pl-30">

                                    </td>
                                    <td class="image product-thumbnail pt-40">
                                        <img src="/${value.product.product_thumbnail}" alt="produit" style="width: 50px; height:50px;">
                                    </td>
                                    <td class="product-des product-name">
                                        <p>
                                            <a class="product-name mb-10" href="/product/details/${value.product.id}/${value.product.product_name}">
                                                ${value.product.product_name}
                                            </a>
                                        </p>
                                    </td>
                                    <td class="price" data-title="Price">
                                        ${value.product.discount_price == null
                                            ? `<p class="text-brand">${value.product.product_price}€</p>`
                                            : `<p class="text-brand">${value.product.discount_price}€</p>`
                                        }
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        ${value.product.product_quantity > 0
                                            ? `<span class="stock-status in-stock mb-0"> En stock </span>`
                                            : `<span class="stock-status out-stock mb-0"> Rupture de stock </span>`
                                        }
                                    </td>
                                    <td class="action text-center" data-title="Remove">
                                        <a type="submit" class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)">
                                            <i class="fi-rs-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                        `
                    });


                    $('#wishlist').html(rows);
                }
            })
        }

        wishlist();


        // wishlist remove
        function wishlistRemove(id) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/wishlist-remove/' + id,
                success: function(data) {
                    wishlist();

                }
            })
        }
    </script>


    <!-- Load My cart -->
    <script type="text/javascript">
        function cart() {
            $.ajax({
                type: 'GET',
                url: '/get-cart-product',
                dataType: 'json',
                success: function(response) {
                    // console.log(response.carts)

                    
                    var rows = ""


                    $.each(response.carts, function(key, value) {

                        // console.log(value.qty);

                        rows += `<tr class="pt-30" style="background-color: #fff">
                                    
                                    <td class="image product-thumbnail pt-40 text-center"><img src="/${value.options.image}" alt="produit" style="width: 50px; height:50px;"></td>
                                    <td class="product-des product-name">
                                        <p class="mb-5"><a class="product-name mb-10 text-heading" href="/product/details/${value.id}/${value.name}">${value.name}</a></p>
                                        
                                        <div class="detail-extralink mr-15 mt-2">
                                            ${value.options.color == null ? `` : `<p class="text-body"><span class="text-dark">Couleur:</span> ${value.options.color} </p>`}
                                        </div>
                                        <div class="detail-extralink mr-15">
                                            ${value.options.size == null ? `` : `<p class="text-body"><span class="text-dark">Taille:</span> ${value.options.size} </p>` }
                                        </div>

                                        <br>
                                        <div class="detail-qty border radius">
                                            <a type="submit" class="qty-down" id="${value.rowId}" onclick="cartDecrement(this.id)">
                                                <i class="fi-rs-angle-small-down"></i>
                                            </a>
                                            <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">
                                            <a type="submit" class="qty-up" id="${value.rowId}" onclick="cartIncrement(this.id)">
                                                <i class="fi-rs-angle-small-up"></i>
                                            </a>
                                        </div>
                                        
                                    </td>
                                    
                                    
                                    <td class="price text-center" data-title="Price">
                                        <p class="text-brand">${value.price}€</p>
                                    </td>
                                    <td class="action text-center" data-title="Remove">
                                        <a type="submit" class="text-body" id="${value.rowId}" onclick="cartRemove(this.id)">
                                            <i class="fi-rs-trash"></i>
                                        </a>
                                    </td>
                                    
                                </tr>`
                    });

                    $('#cartPage').html(rows);
                }
            })
        }
        cart();


        //  remove products from cart 
        function cartRemove(id) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/cart-remove/' + id,

                success: function(data) {
                    cart();
                    miniCart();
                    couponCalculation();
                }
            })
        }

        // cart decrement
        function cartDecrement(rowId) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/cart-decrement/' + rowId,

                success: function(data) {
                    couponCalculation();
                    cart();
                    miniCart();
                }
            })
        }

        // cart increment
        function cartIncrement(rowId) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/cart-increment/' + rowId,
                success: function(data) {
                    couponCalculation();
                    cart();
                    miniCart();
                }
            })
        }
    </script>


    <!-- Apply coupon -->
    <script type="text/javascript">
        function applyCoupon() {

            var coupon_name = $('#coupon_name').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    coupon_name: coupon_name
                },
                url: '/coupon-apply/',
                success: function(data) {

                    couponCalculation()

                    if (data.validity == true) {
                        $('#couponField').hide();
                    }

                    // Start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }
                }
            })
        }

        // coupon calculation
        function couponCalculation() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/coupon-calculation/',
                success: function(data) {
                    //

                    if (data.total) {
                        $('#couponCalField').html(
                            `<tr>
                                <td class="cart_total_label">
                                    <p class="text-muted">Total</p>
                                </td>
                                <td class="cart_total_amount">
                                    <p class="text-brand text-end">${data.total}€</p>
                                </td>
                            </tr>
                                        
                            <tr>
                                <td class="cart_total_label">
                                    <p class="text-muted">Total à payer</p>
                                </td>
                                <td class="cart_total_amount">
                                    <p class="text-brand text-end">${data.total}€</p>
                                </td>
                            </tr>`
                        )
                    } else {
                        $('#couponCalField').html(
                            `<tr>
                                <td class="cart_total_label">
                                    <p class="text-muted">Total</p>
                                </td>
                                <td class="cart_total_amount">
                                    <p class="text-brand text-end">${data.subtotal}€</p>
                                </td>
                            </tr>
                                        
                            <tr>
                                <td class="cart_total_label">
                                    <p class="text-muted">Coupon</p>
                                </td>
                                <td class="cart_total_amount">
                                    <p class="text-brand text-end">${data.coupon_name} <a type="submit" onclick="couponRemove()"><i class="fi-rs-trash"></i></a></p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="cart_total_label">
                                    <p class="text-muted">Montant de la remise</p>
                                </td>
                                <td class="cart_total_amount">
                                    <p class="text-brand text-end">${data.discount_amount}€</p>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="cart_total_label">
                                    <p class="text-muted">Total à payer</p>
                                </td>
                                <td class="cart_total_amount">
                                    <p class="text-brand text-end">${data.total_amount}€</p>
                                </td>
                            </tr>`
                        )
                    }
                }
            })
        }

        couponCalculation()
    </script>

    <script type="text/javascript">
        //  coupon remove
        function couponRemove() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/coupon-remove/',
                success: function(data) {
                    couponCalculation();

                    $('#couponField').show();
                }
            })
        }
    </script>
</body>

</html>
