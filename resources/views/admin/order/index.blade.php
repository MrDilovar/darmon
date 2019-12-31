@extends('admin.layout')

@section('content')
	<div class="container my-4">
		<div class="row">
			<div class="col-sm-3"><h3>Заказы</h3></div>
		</div>
		<div class="mt-4">
		  @if(session()->get('success'))
		    <div class="alert alert-success">
		      {{ session()->get('success') }}  
		    </div>
		  @endif
		  <table class="table">
		  	<thead class="thead-light">
			    <tr>
			      	<th scope="col">ID</th>
					<th scope="col">Имя</th>
					<th scope="col">Телефон</th>
					<th scope="col">Адрес</th>
					<th scope="col">Статус</th>
					<th scope="col">Дата</th>
			    </tr>
			  </thead>
		    <tbody>
		        @foreach($orders as $order)
		        <tr>
		            <th scope="row">{{ $order->id }}</th>
		            <td><a href={{ route('admin.order.show', $order->id) }}>{{ $order->name }}</a></td>
					<td>{{ $order->phone }}</td>
					<td>{{ $order->address }}</td>
					<td>{{ $order->status->name }}</td>
					<td>{{ $order->data }}</td>
				</tr>
		        @endforeach
		    </tbody>
		  </table>
		</div>
	</div>
@endsection