@extends('admin.layout')

@section('content')
<div class="container py-4">
	<h3 class="mb-3">Добавить продукт</h3>
	<div class="row">
		<div class="col-lg-6">
			<form class="formsValidate" action="{{ route('admin.product.store') }}" method="post"  enctype="multipart/form-data" novalidate>
				{{ csrf_field() }}
				<div class="form-group">
					<label for="inputCategory">Категория:</label>
					<select name="category" class="custom-select" id="inputCategory" required>
						<option value="">Не выбрано</option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
						@endforeach
					</select>
					@if ($errors->has('category'))
						<span class="font-weight-bold small">{{ $errors->first('category') }}</span>
					@endif
				</div>
				<div class="form-group">
					<label for="inputName">Имя:</label>
					<input name="name" value="{{ old('name') }}" type="text" class="form-control form-control-sm" id="inputName" required>
					@if ($errors->has('name'))
						<span class="font-weight-bold small">{{ $errors->first('name') }}</span>
					@endif
				</div>
				<div class="form-group">
					<label for="inputPrice">Цена: <strong>в сомони</strong></label>
					<input name="price" value="{{ old('price') }}" type="text" class="form-control form-control-sm" id="inputPrice" required>
					@if ($errors->has('price'))
						<span class="font-weight-bold small">{{ $errors->first('price') }}</span>
					@endif
				</div>
				<div class="form-group">
					<label for="inputDescription">Описание:</label>
					<textarea name="description" class="form-control form-control-sm" id="inputDescription" required>{{ old('description') }}</textarea>
					@if ($errors->has('description'))
						<span class="font-weight-bold small">{{ $errors->first('description') }}</span>
					@endif
				</div>
				<div class="form-group">
					<label for="inputImage">Картинка:</label>
					<input name="image" class="w-100 form-control h-100" id="inputImage" type="file" required>
					<small class="form-text text-muted">Пожалуйста, загрузите действительный файл изображения. Размер изображения не должен превышать 10 МБ.</small>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Добавить</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
