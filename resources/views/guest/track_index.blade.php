@extends('layout')
@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-lg-6 offset-lg-3">
                <h2 class="text-center mb-5">Отслеживание заказа</h2>
                <form class="text-center" action="{{ route('track.search') }}" method="post">
                    {{ csrf_field() }}

                    <input name="track" class="form-control mb-4" type="text" placeholder="Введите трек-номер" autofocus>
                    <button type="submit" class="btn btn-primary">Отследить</button>
                </form>
            </div>
        </div>
    </div>
@endsection