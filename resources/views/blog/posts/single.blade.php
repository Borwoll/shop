@extends('layouts.app')
@section('content')
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Подробная информация о посте</h2>
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
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                    <div class="blog-details-left-sidebar mrg-blog">
                        <div class="blog-details-top">
                            <!--Start Blog Thumb -->
                            <div class="blog-details-thumb-wrap">
                                <div class="blog-details-thumb">
                                    <img src="{{ asset('images/blog/big-images/1.jpg') }}" alt="blog images">
                                </div>
                            </div>
                            <h2>{{ $post->title }}</h2>
                            <div class="blog-admin-and-comment">
                                <p>Автор: <a href="#">{{ $post->author ? $post->author->name : 'отсутствует' }}</a></p>
                                <p class="separator">|</p>
                                <p>Комменатрий: {{ $post->comments }}</p>
                                <p class="separator">|</p>
                                <p>Лайков: {{ $post->likes }}</p>
                                <p class="separator">|</p>
                                <p>Просмотров: {{ $post->views }}</p>
                                <p class="separator">|</p>
                                <p>Дата выхода статьи: {{ $post->created_at }}</p>
                            </div>
                            <div class="blog-details-pra">
                                <p>{{ $post->content }}</p>
                            </div>

                            @include ('blog.posts._comments', $post)
                        </div>
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