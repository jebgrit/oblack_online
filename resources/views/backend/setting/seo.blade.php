@extends('admin.admin_dashboard')

@section('admin')

    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Réglage du site</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">SEO</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <hr />

                <form id="myForm" action="{{ route('store.seo') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{ $seo->id }}">

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">

                                    <!-- Meta title -->
                                    <div class="form-group mb-3">
                                        <label>Méta titre</label>
                                        <input type="text" name="meta_title" class="form-control" value="{{ $seo->meta_title }}">
                                    </div>

                                    <!-- Meta author -->
                                    <div class="form-group mb-3">
                                        <label>Méta auteur</label>
                                        <input type="text" name="meta_author" class="form-control" value="{{ $seo->meta_author }}">
                                    </div>

                                    <!-- Meta keyword -->
                                    <div class="form-group mb-3">
                                        <label>Méta mots clés</label>
                                        <input type="text" name="meta_keyword" class="form-control" placeholder="Mots clés" value="{{ $seo->meta_keyword }}">
                                    </div>

                                    <!-- Meta description -->
                                    <div class="mb-3">
                                        <label>Méta description</label>
                                        <textarea class="form-control" name="meta_description"  rows="3">{{ $seo->meta_description }}</textarea>
                                        
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
                                    Mettre à jour
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
