@extends('layouts.app')

@section('content')

    <div class="container">
        <h2 class="my-4">Votre panier</h2>
        @if ($cartItems->isEmpty())
            <div class="alert alert-warning animate__animated animate__fadeIn" role="alert">
                Votre panier est vide.
            </div>
        @else
            <table class="table table-bordered animate__animated animate__fadeIn">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr class="animate__animated animate__fadeInUp">
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->product->price }} €</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->product->price * $item->quantity }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <form action="{{ route('order.place') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary animate__animated animate__pulse animate__infinite">
                        Passer la commande
                    </button>
                </form>
            </div>
        @endif
    </div>
@endsection
