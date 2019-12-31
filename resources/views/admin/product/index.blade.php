@extends('admin.layout')

@section('content')
	<div class="container my-4">
		<div class="row">
			<div class="col-sm-3"><h3>Продукты</h3></div>
			<div class="col-sm-3">
        		<a href="{{ route('admin.product.create') }}" class="btn btn-primary">Добавить</a>
			</div>
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
			      <th scope="col">Картинка</th>
			      <th scope="col">Действие</th>
			    </tr>
			  </thead>
		    <tbody>
		        @foreach($products as $product)
		        <tr>
		            <th scope="row">{{ $product->id }}</th>
		            <td>{{ $product->name }}</td>
		            <td>
		            	<img height="100px" src="{{ '/' . $PATH_TO_PRODUCT_IMG . $product->image }}" alt="...">
		            </td>
		            <td>
		            	<a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-primary">Редактировать</a>
		            	<form style="display: inline-block;" action="{{ route('admin.product.destroy', $product->id) }}" method="post">
	                  {{ csrf_field() }}
	                  <input type="hidden" name="_method" value="delete" />
	                  <button class="btn btn-danger" type="submit">Удалить</button>
	                </form>
		            </td>
		        </tr>
		        @endforeach
		    </tbody>
		  </table>
		</div>
	</div>
@endsection