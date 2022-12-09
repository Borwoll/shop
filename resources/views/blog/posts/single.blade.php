@extends('layouts.app')
@section('content')
    <section class="htc__product__area ptb--130 bg__white">
        <div class="container">
            <div class="htc__product__container">
                <div class="row">
                    <div class="product__list another-product-style">
                        <div class="col-lg-12">
                            <div class="feature-img">
                                <img class="img-fluid" src="{{ $post->getImageUrl() }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3  col-md-3">
                            <div class="blog_info text-right">
                                <div class="post_tag">
                                    @foreach ($post->tags as $tag)
                                        <a href="{{ route('blog.posts.tag', $tag->name) }}">
                                            {{ $tag->name }}@if (!$loop->last), @endif
                                        </a>
                                    @endforeach
                                </div>
                                <ul class="blog_meta list">
                                    <li><a href="javascript:void(0);">{{ $post->author ? $post->author->name : 'None' }}<i class="lnr lnr-user"></i></a></li>
                                    <li><a href="javascript:void(0);">{{ $post->created_at }}<i class="lnr lnr-calendar-full"></i></a></li>
                                    <li><a href="javascript:void(0);">{{ $post->views }} Views<i class="lnr lnr-eye"></i></a></li>
                                    <li><a href="#comments">{{ $post->comments }} Comments<i class="lnr lnr-bubble"></i></a></li>
                                    <li><a href="{{ route('blog.posts.category', ['slug' => $post->category->slug]) }}">{{ $post->category->name }} <i class="lnr lnr-cloud"></i></a></li>
                                    <li class="like" data-id="{{ $post->id }}"><a href="javascript:void(0);"><span id="likesCount_{{$post->id}}">{{ $post->likes }}</span> Likes<i class="lnr lnr-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h2>{{ $post->title }}</h2>
                            <p class="excert">
                                {{ Str::limit($post->description, 50) }}
                            </p>
                        </div>
                        <div class="col-lg-12">
                            {!! $post->content !!}
                        </div>

                        @include ('blog.posts._comments', $post)

                        @include ('blog.posts._sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section ('scripts')
    <script>
        $(document).on("click", "#comments .reply-btn", function () {
            let link = $(this);
            let form = $("#reply-block");
            let comment = link.closest(".comment-list");
            $("#parent").val(comment.data("id"));
            form.detach().appendTo(comment.find(".reply-block:first"));
            return false;
        });
    </script>
@endsection