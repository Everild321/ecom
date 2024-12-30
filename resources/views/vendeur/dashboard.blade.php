@extends('layouts.appV')

@section('content')
    <div class="container">
        <h1 class="my-4">Tableau de bord</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des articles</h5>
                        <a href="{{ route('vendor.products.index') }}" class="btn btn-primary">Voir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Commandes</h5>
                        <a href="{{ route('orders.history') }}" class="btn btn-primary">Voir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
