<div class="pro__review review_item" data-id="{{ $comment->id }}" data-title="{{ Str::limit($comment->text, 10) }}">
    <div class="review__details">
        <div class="review__info">
            <h4><a href="#">{{ $comment->author ? $comment->author->name : 'Пользователь удален' }}</a></h4>
        </div>
        <div class="review__date">
            <span>{{ $comment->created_at }}</span>
            <a class="reply_btn" href="javascript:void(0)">Ответить</a>
        </div>
        <p>{{ $comment->text }}</p>
    </div>
</div>
@if ($comment->children()->exists())
    @foreach ($comment->children as $child)
        <div class="pro__review ans">
            @include ('shop.products.single._comment', ['comment' => $child])
        </div>
    @endforeach
@endif