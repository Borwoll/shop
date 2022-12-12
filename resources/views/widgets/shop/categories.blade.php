<div class="htc__shop__cat">
    <h4 class="section-title-4">Категории</h4>
    <ul class="sidebar__list">
        @if ($categories)
            @foreach ($categories as $category)
                <li class="main-nav-list"><a href="{{ route('shop.products.category', ['slug' => $category->slug]) }}" aria-expanded="false" aria-controls="{{ $category->slug }}">{{ $category->name }}<span class="number">({{ $category->products()->count() }})</span></a>
                    @if ($category->children()->exists())
                        <ul class="collapse" id="{{ $category->slug }}" aria-controls="{{ $category->slug }}">
                            @foreach ($category->children as $child)
                                <li class="main-nav-list child"><a href="{{ route('shop.products.category', ['slug' => $category->slug]) }}">{{ $child->name }}<span class="number">({{ $child->posts()->count() }})</span></a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>
</div>