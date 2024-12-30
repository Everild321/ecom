@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Tableau de bord</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Historique des commandes</h5>
                        <a href="{{ route('orders.history') }}" class="btn btn-primary">Voir</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Panier</h5>
                        <a href="{{ route('cart.view') }}" class="btn btn-primary">Voir</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-2">
            <h1 class="my-4">Articles</h1>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p>
                                    Prix:{{ $product->price }}
                                </p>
                                <p>
                                    Quantité:{{ $product->stock }}
                                </p>

                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editProductModal{{ $product->id }}" data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                    data-stock="{{ $product->stock }}">Ajouter au panier</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="editProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProductModalLabel">Ajouter au panier</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-body">
                                        <input type="hidden" name="product_id" value={{ $product->id }}>
                                        <div class="mb-3">
                                            <label for="edit-stock" class="form-label">Quantité</label>
                                            <input type="number" class="form-control" id="edit-stock" name="quantity"
                                                required min="1">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-warning">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
