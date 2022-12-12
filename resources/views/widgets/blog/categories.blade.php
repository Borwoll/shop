<div class="our-category-area mt--60">
    <h2 class="section-title-2">КАТЕГОРИИ</h2>
    <ul class="categore-menu">
        @foreach ($categories as $category)
            <li>
                <a href="{{ route('blog.posts.category', ['slug' => $category->slug]) }}">
                    <i class="zmdi zmdi-caret-right"></i>@for ($i = 0; $i < $category->depth; $i++) -- @endfor{{ $category->name }} <span>{{ $category->posts()->count() }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>