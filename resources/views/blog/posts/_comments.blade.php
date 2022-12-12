<div class="our-blog-comment mt--20">
    <div class="blog-comment-inner" id="comments">
        <h2 class="section-title-2">Комментарии ({{ $post->comments }})</h2>
        @foreach ($post->commentsList as $comment)
            @include ('blog.posts._comment', $comment)
        @endforeach
    </div>
</div>

@guest
    <p>Вы должны авторизоваться, чтобы оставить комменатрийt</p>
@else
    <div class="our-reply-form-area mt--20">
        <h2 class="section-title-2">Оставить комментарий</h2>
        <div class="reply-form-inner mt--40">
            <form method="POST" action="{{ route('blog.posts.comment', $post) }}" id="send_comment_form">
                @csrf

                <div class="reply-form-box">
                    <input type="hidden" id="parent" name="parent">
                    <textarea name="text" id="text" placeholder="Напишите ваше сообщение.."></textarea>
                </div>

                <div class="blog__details__btn">
                    <a class="htc__btn btn--gray" href="#" onclick="document.getElementById('send_comment_form').submit()">Отправить</a>
                </div>
            </form>
        </div>
    </div>
    <br>
@endguest

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