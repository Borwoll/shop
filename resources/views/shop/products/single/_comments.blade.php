<div role="tabpanel" id="comments_tab" class="product__tab__content fade">
    <div class="review__address__inner" id="comments">
        @if ($product->comments()->exists())
            @foreach ($product->comments()->get() as $comment)

                @include ('shop.products.single._comment', compact('comment'))

            @endforeach
        @else
            <h2>Нет комментариев</h2>
        @endif
    </div>
    <div class="rating__wrap">
        <h2 class="rating-title">Напишите комментарий</h2>
    </div>
    <div class="review__box">
        @guest
            <p>Вы должны войти в систему, чтобы оставить комментарий</p>
        @else
            <form class="contact_form" action="{{ route('shop.products.comment', compact('product')) }}" method="POST" novalidate="novalidate" id="commForm">
                @csrf

                <div class="single-review-form">
                    <div class="review-box name">
                        <label for="parent">Вы пишите ответ на сообщение:</label> <span id="parent_comment"> нет</span>
                        <input type="hidden" id="parent" name="parent">
                    </div>
                </div>

                <div class="single-review-form">
                    <div class="review-box message">
                        <textarea class="form-control" name="text" id="text" rows="1" placeholder="Сообщение"></textarea>    
                    </div>
                </div>

                <div class="review-btn">
                    <a class="fv-btn" href="#" onclick="document.getElementById('commForm').submit()">Отправить</a>
                </div>
            </form>
        @endguest                           
    </div>
</div>