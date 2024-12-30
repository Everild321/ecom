@extends('layouts.appV')

@section('content')

    <div class="container">
        <h2 class="my-4">Commandes</h2>
        @if ($orders->isEmpty())
            <div class="alert alert-info animate__animated animate__fadeIn" role="alert">
                Aucune commande n'a encore été passé.
            </div>
        @else
            @foreach ($orders as $order)
                <div class="card mb-3 animate__animated animate__zoomIn">
                    <div class="card-header">
                        Commande #{{ $order->id }} - Total : {{ $order->total }} € - Passée le
                        {{ $order->created_at->format('d/m/Y') }}
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($order->orderItems as $item)
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center animate__animated animate__fadeInUp">
                                    {{ $item->product->name }}
                                    <span>
                                        {{ $item->quantity }} x {{ $item->price }} € = {{ $item->quantity * $item->price }}
                                        €
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
