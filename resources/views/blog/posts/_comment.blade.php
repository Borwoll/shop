<div class="single-blog-comment comment-list" data-id="{{ $comment->id }}" id="comment_{{ $comment->id }}">
    <div class="blog-comment-thumb">
        <img src="{{ asset('images/comment/1.jpg') }}" alt="comment images">
    </div>
    <div class="blog-comment-details">
        <div class="comment-title-date">
            <h2><a href="#">{{ $comment->author ? $comment->author->name : 'аккаунт удален' }}</a></h2>
            <div class="reply-btn">
                <p>{{ $comment->created_at }} / <a href="#" class="btn-reply comment-reply text-uppercase">Ответить</a></p>
            </div>
        </div>
        <p>{{ $comment->text }}</p>
    </div>
    <div class="reply-block"></div>
</div>

@if ($comment->children()->exists())
    @foreach ($comment->children as $child)
        <div style="margin-left:30px;">
            @include ('blog.posts._comment', ['comment' => $child])
        </div>
    @endforeach
@endif