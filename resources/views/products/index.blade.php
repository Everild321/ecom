@extends('layouts.appV')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Gestion des Produits</h2>
        <!-- Bouton pour ajouter un produit -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Ajouter un
            Produit</button>
        <!-- Tableau des produits -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }} €</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editProductModal{{ $product->id }}" data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                data-stock="{{ $product->stock }}">Modifier</button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteProductModal{{ $product->id }}"
                                data-id="{{ $product->id }}">Supprimer</button>
                        </td>
                    </tr>
                    <!-- Modal de modification de produit -->
                    <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="editProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProductModalLabel">Modifier le Produit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('vendor.products.update', ['product' => $product]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="edit-name" class="form-label">Nom du Produit</label>
                                            <input type="text" class="form-control" id="edit-name" name="name"
                                                value="{{ $product->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit-price" class="form-label">Prix</label>
                                            <input type="number" class="form-control" id="edit-price" name="price"
                                                value="{{ $product->price }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit-stock" class="form-label">Stock</label>
                                            <input type="number" class="form-control" id="edit-stock" name="stock"
                                                value="{{ $product->stock }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-warning">Modifier</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de suppression de produit -->
                    <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteProductModalLabel">Supprimer le Produit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('vendor.products.destroy', ['product' => $product]) }}"
                                    method="POST" id="deleteProductForm">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        <p>Êtes-vous sûr de vouloir supprimer ce produit ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>



        <!-- Modal d'ajout de produit -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Ajouter un Produit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('vendor.products.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom du Produit</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Prix</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" required>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="" cols="30" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
