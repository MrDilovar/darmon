@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-lg-8 offset-lg-2">
                @if($order)
                    <h4 class="mb-4 font-weight-light text-center">Заказ: <span class="font-weight-bold">#{{ $order->id }}</span></h4>
                    @foreach($order->products as $product)
                        <div class="row border-top mx-0 py-2">
                            <div class="col"><a class="text-dark" href={{ route('shop.show', $product->id) }}>{{ $product->name }}</a></div>
                            <div class="col-auto">{{ $product->pivot->quantity }} шт.</div>
                            <div class="col-auto"><span class="font-weight-bold">{{ $product->price }} сом.</span></div>
                        </div>
                    @endforeach
                    <div class="row border-top mx-0 py-2">
                        <div class="col"><h5>Итог:</h5></div>
                        <div class="col-auto"><h5>{{ $order->total }} сом.</h5></div>
                    </div>
                    <div class="row border-top mx-0 py-2">
                    <div class="col"><h5>Статус:</h5></div>
                    <div class="col-auto"><h5>{{ $order->status->name }}</h5></div>
                </div>
                @else
                    <div class="my-4 text-center">
                        <h3 class="mb-4">Неправильный трек номер!</h3>
                    </div>
                @endif
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('shop.index') }}" class="btn btn-outline-dark">Главная страница</a>
        </div>
    </div>
@endsection