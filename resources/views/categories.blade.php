<h3 class="mb-3">Каталог</h3>
<ul class="main-catalog">
    @foreach($categories as $category)
        <li class="item"><a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="link">{{ $category->name }}</a></li>
    @endforeach
</ul>