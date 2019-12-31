@extends('admin.layout')

@section('content')
<div class="container py-4">
	<div class="row mb-4">
		<div class="col-lg-8 offset-lg-2">
			<h3 class="mb-3 font-weight-light text-center">Заказ: <span class="font-weight-bold">#{{ $order->id }}</span></h3>
			<h4 class="my-3 font-weight-light">Заказчик</h4>
			<div class="row border-top mx-0 py-2">
				<div class="col-6">Фамилия и имя</div>
				<div class="col-auto"><h6>{{ $order->name }}</h6></div>
			</div>
			<div class="row border-top mx-0 py-2">
				<div class="col-6">Телефон</div>
				<div class="col-auto"><h6>{{ $order->phone }}</h6></div>
			</div>
			<div class="row border-top mx-0 py-2">
				<div class="col-6">Адрес</div>
				<div class="col-auto"><h6>{{ $order->address }}</h6></div>
			</div>
			<div class="row border-top mx-0 py-2">
				<div class="col-6">E-Mail</div>
				<div class="col-auto"><h6>{{ $order->email }}</h6></div>
			</div>
			<div class="row border-top mx-0 py-2">
				<div class="col-6">Комментарии к заказу</div>
				<div class="col-auto"><h6>{{ $order->comment }}</h6></div>
			</div>
			<div class="row border-top mx-0 py-2">
				<div class="col"><h5>Дата:</h5></div>
				<div class="col-auto"><h6>{{ $order->data }}</h6></div>
			</div>
			<h4 class="my-3 font-weight-light">Заказ</h4>
			@foreach($order->products as $product)
				<div class="row border-top mx-0 py-2">
					<div class="col"><a class="text-dark" href={{ route('shop.show', $product->id) }}>{{ $product->name }}</a></div>
					<div class="col-auto">{{ $product->pivot->quantity }} шт.</div>
					<div class="col-auto"><h6>{{ $product->price }} сом.</h6></div>
				</div>
			@endforeach
			<div class="row border-top mx-0 py-2">
				<div class="col"><h5>Итог:</h5></div>
				<div class="col-auto"><h5>{{ $order->total }} сом.</h5></div>
			</div>
			<div class="row border-top mx-0 py-2">
				<div class="col"><h5>Статус:</h5></div>
				<div class="col-auto">
					<select id="order_status" class="form-control form-control-sm" data-id={{ $order->id }}>
						@foreach($statuses as $status)
                            <option value={{ $status->id }} {{$order->status->id == $loop->iteration ? 'selected' : ''}}>{{ $status->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	(function(){
		const order_status = document.getElementById('order_status');

		order_status.addEventListener('change', function() {
			$.ajax({
				url: '/admin/order/' + this.getAttribute('data-id'),
				method: 'post',
				data: {
					status_id: this.value,
					'_method': 'PATCH'
				},
				complete: function () {
					location.reload();
				}
			});
		});
	})();
</script>
@endsection
