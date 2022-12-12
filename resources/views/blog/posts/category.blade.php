@extends('layouts.app')
@section('content')
    <div class="wrapper fixed__footer">
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">{{ $category->name }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="blog-details-wrap bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <div class="blod-details-right-sidebar">
                            @include ('blog.posts._sidebar')
                        </div>
                    </div>
                        @foreach ($category->posts as $post)
                        <div class="col-md-4 col-lg-4 hidden-sm col-xs-12">
                            <div class="blog foo">
                                <div class="blog__inner">
                                    <div class="blog__thumb">
                                        <a href="blog-details.html">
                                            <img src="{{ asset('images/blog/blog-img/1.jpg') }}" alt="blog images">
                                        </a>
                                    </div>
                                    <div class="blog__hover__info">
                                        <div class="blog__hover__action">
                                            <p class="blog__des"><a href="{{ route('blog.posts.single', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ Str::limit($post->description, 50) }}</a></p>
                                            <ul class="bl__meta">
                                                <li>Автор: <a href="#">{{ $post->author ? $post->author->name : 'None' }}</a></li>
                                                <li>{{ $post->title }}</li>
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

                        @if (!$category->posts)
                            <h2>Посты не найдены</h2>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
