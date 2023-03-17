@extends('vendor.vendor_dashboard')

@section('vendor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Signalement</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active " aria-current="page">Message</i>
                        </li>
                    </ol>
                </nav>
            </div>
            <hr />
        </div>

        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4> Détails du commentaire </h4>
                                    </div>
                                    <div class="panel-body mt-4">
                                        <div class="ticket-info">
                                            <p>
                                                <strong>Produit commenté:</strong>
                                                <div class="d-flex align-items-center">
                                                    <div class="recent-product-img">
                                                        <img src="{{ asset($review->product->product_thumbnail) }}" alt="">
                                                    </div>
                                                    <div class="ms-2">
                                                        <h6 class="mb-1 font-14">{{ $review['product']['product_name'] }}</h6>
                                                    </div>
                                                </div>
                                            </p>

                                            <!-- created at -->
                                            <p>
                                                <strong>Commenté le :</strong>
                                                {{ $review->created_at->translatedFormat('d F Y à H\hi') }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="comments">
                                    <div class="chat-content-leftside">
                                        <div class="d-flex">
                                            <div class="flex-grow-1 ms-2">
                                                <p class="chat-left-msg">{{ $review->comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn btn-secondary" href="{{ route('vendor.all.review') }}" role="button" >Retour</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
