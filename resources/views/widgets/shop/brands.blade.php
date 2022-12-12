<div class="htc__shop__cat">
    <h4 class="section-title-4">Бренды</h4>
    <ul class="sidebar__list">
        @if ($brands)
            @foreach ($brands as $brand)
                <li class="main-nav-list">
                    <a href="{{ route('shop.products.brand', ['slug' => $brand->slug]) }}" aria-expanded="false">
                        {{ $brand->name }}
                        <span class="number">
                            ({{ $brand->products()->count() }})
                        </span>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</div>