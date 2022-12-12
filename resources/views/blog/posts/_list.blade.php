@foreach ($posts as $post)
<div class="col-md-4 col-lg-4 hidden-sm col-xs-12">
    <div class="blog foo">
        <div class="blog__inner">
            <div class="blog__thumb">
                <a href="{{ route('blog.posts.single', ['id' => $post->id, 'slug' => $post->slug]) }}">
                    <img src="{{ asset('images/blog/blog-img/1.jpg') }}" alt="blog images">
                </a>
            </div>
            <div class="blog__hover__info">
                <div class="blog__hover__action">
                    <p class="blog__des"><a href="{{ route('blog.posts.single', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->title }}</a></p>
                    <ul class="bl__meta">
                        <li>Автор: <a href="#">{{ $post->author ? $post->author->name : 'None' }}</a></li>
                        <li>{{ Str::limit($post->description, 50) }}</li>
                    </ul>
                    <div class="blog__btn">
                        <a class="read__more__btn" href="{{ route('blog.posts.single', ['id' => $post->id, 'slug' => $post->slug]) }}">подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@if (!$posts)
    <h2>Посты не найдены</h2>
@endif