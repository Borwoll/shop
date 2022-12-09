<div role="tabpanel" id="reviews" class="product__tab__content fade">
    <div class="review__address__inner">
        @if ($product->reviews()->exists())
            @foreach ($product->reviews()->get() as $review)
                <div class="pro__review">
                    <div class="review__details">
                        <div class="review__info">
                            <h4><a href="#">{{ $review->author ? $review->author->name : 'Пользователь удален' }}</a></h4>
                            <ul class="rating">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <li><i class="zmdi zmdi-star"></i></li>
                                @endfor
                            </ul>
                        </div>
                        <div class="review__date">
                            <span>{{ $review->created_at }}</span>
                        </div>
                        <p>{{ $review->text }}</p>
                    </div>
                </div>
                <br>
            @endforeach
        @else
            <h2>Нет оценок</h2>
            <br>
        @endif
    </div>
    <div class="rating__wrap">
        <h2 class="rating-title">Напишите отзыв</h2>
        <h4 class="rating-title-2">Ваша оценка</h4>
        <div class="rating__list">
            <ul class="rating">
                <li>
                    <a href="javascript:void(0);" class="star" data-rating="1">
                        <i class="zmdi zmdi-star-half" id="star_1"></i>
                    </a>
                </li>
            </ul>
            <ul class="rating">
                <li>
                    <a href="javascript:void(0);" class="star" data-rating="2">
                        <i class="zmdi zmdi-star-half" id="star_2"></i>
                        <i class="zmdi zmdi-star-half"></i>
                    </a>
                </li>
            </ul>
            <ul class="rating">
                <li>
                    <a href="javascript:void(0);" class="star" data-rating="3">
                        <i class="zmdi zmdi-star-half" id="star_3"></i>
                        <i class="zmdi zmdi-star-half"></i>
                        <i class="zmdi zmdi-star-half"></i>
                    </a>
                </li>
            </ul>
            <ul class="rating">
                <li>
                    <a href="javascript:void(0);" class="star" data-rating="4">
                        <i class="zmdi zmdi-star-half" id="star_4"></i>
                        <i class="zmdi zmdi-star-half"></i>
                        <i class="zmdi zmdi-star-half"></i>
                        <i class="zmdi zmdi-star-half"></i>
                    </a>
                </li>
            </ul>
            <ul class="rating">
                <li>
                    <a href="javascript:void(0);" class="star" data-rating="5">
                        <i class="zmdi zmdi-star-half" id="star_5"></i>
                        <i class="zmdi zmdi-star-half"></i>
                        <i class="zmdi zmdi-star-half"></i>
                        <i class="zmdi zmdi-star-half"></i>
                        <i class="zmdi zmdi-star-half"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="review__box">
        <form action="{{ route('shop.products.review', compact('product')) }}" method="post" id="contactForm" novalidate="novalidate">
            @csrf
            <div class="single-review-form">
                <div class="review-box name">
                    <input type="hidden" name="rating" id="rating" value="5">
                </div>
            </div>
            <div class="single-review-form">
                <div class="review-box message">
                    <textarea class="form-control" name="text" id="text" rows="1" placeholder="Отзыв" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Отзыв'"></textarea>
                </div>
            </div>
            <div class="review-btn">
                <a class="fv-btn" href="#" onclick="document.getElementById('contactForm').submit()">Отправить</a>
            </div>
        </form>                                
    </div>
</div>