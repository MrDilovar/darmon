@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4 col-lg-3">
                @include('categories')
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="mb-3">
                    <h3>{{ $categoryName }}</h3>
                    <b>Цены:</b>
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'low_high']) }}" class="text-dark">по возрастанию</a> |
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'high_low']) }}" class="text-dark">по убыванию</a>
                </div>
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-6 col-sm-4 col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 text-center">
                                <div class="p-3">
                                    <a href="{{ route('shop.show', $product->id) }}"><img style="max-height: 200px; max-width: 100%;" src="/img/products/{{ $product->image }}" alt=""></a>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title"><a class="text-dark" href="{{ route('shop.show', $product->id) }}">{{ $product->name }}</a></h6>
                                    <h6 class="font-weight-light">{{ $product->price }} сом.</h6>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col">Сожалеем, но ничего не найдено.</div>
                    @endforelse
                </div>
                {{ $products->appends(request()->input())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection