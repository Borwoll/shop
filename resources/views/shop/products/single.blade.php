@extends ('layouts.app')

@section ('content')
<div class="wrapper fixed__footer">
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Подробная информация о продукте</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="htc__product__details pt--100 pb--100 bg__white">
        <div class="container">
            <div class="scroll-active">
                <div class="row">
                    <div class="col-md-7 col-lg-7 col-sm-5 col-xs-12">
                        <div class="product__details__container product-details-5">
                            @foreach ($product->photos as $photo)
                                <div class="scroll-single-product mb--30">
                                    <img src="{{ asset('images/product/big-img/1.jpg') }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="sidebar-active col-md-5 col-lg-5 col-sm-7 col-xs-12 xmt-30">
                        <div class="htc__product__details__inner ">
                            <div class="pro__detl__title">
                                <h2>{{ $product->title }}</h2>
                            </div>
                            <div class="pro__dtl__rating">
                                <ul class="pro__rating">
                                    @for ($i = $product->rating; $i > 0; $i--)
                                        <li><span class="ti-star"></span></li>
                                    @endfor
                                </ul>
                                <span class="rat__qun">(Основано на {{$product->reviews()->count()}} оценках)</span>
                            </div>
                            <div class="pro__details">
                                {{ $product->description }}
                            </div>
                            <ul class="pro__dtl__prize">
                                <li>{{ $product->price }} ₽</li>
                            </ul>
                            <div class="pro__dtl__color">
                                <h2 class="title__5" href="javascript:void(0)">
                                    <span>Доступность</span>:
                                    @if ($product->isAvailable())
                                        В наличии
                                    @endif

                                    @if ($product->isUnavailable())
                                        Нет в наличии
                                    @endif
                                </h2>
                            </div>
                            <div class="pro__dtl__size">
                                <h2 class="title__5"><span>Вес</span>: {{ $product->weight }}</h2>
                            </div>
                            <div class="pro__dtl__size"><a class="active title__5" href="{{ $product->category ? route('shop.products.category', ['slug' => $product->category->slug]) : "javascript:void(0)" }}"><span>Категория</span> : {{ $product->category ? $product->category->name : 'Нет' }}</a></div>       
                            <div class="product-action-wrap">
                                @if ($product->isAvailable())
                                    <div class="product_count">
                                        <label for="qty">Количество:</label>
                                        <input type="text" name="qty" id="qty" maxlength="12" value="1" title="Quantity:" class="cart-plus-minus-box qty">
                                        <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                        <button onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty > 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                                    </div>
                                @else
                                    <p>Этот продукт в настоящее время отсутствует на складе и недоступен.</p>
                                @endif
                            </div>
                            <ul class="pro__dtl__btn">
                                @if ($product->isAvailable())
                                    <li class="buy__now__btn"><a class="add-to-cart" href="javascript:void(0)" data-product-id="{{ $product->id }}">Добавить в корзину</a></li>
                                @endif
                                <li><a href="#" class="add-to-wishlist" data-id="{{ $product->id }}"><span class="lnr lnr lnr-heart"></span></a></li>
                                <li><a href="#" class="add-to-comparison" data-id="{{ $product->id }}"><span class="lnr lnr-sync"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="htc__product__details__tab bg__white pb--120">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <ul class="product__deatils__tab mb--60" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#description" role="tab" data-toggle="tab">Описание</a>
                        </li>
                        <li role="presentation">
                            <a href="#specification" role="tab" data-toggle="tab">Спецификация</a>
                        </li>
                        <li role="presentation">
                            <a href="#comments_tab" role="tab" data-toggle="tab">Комментарии</a>
                        </li>
                        <li role="presentation">
                            <a href="#reviews" role="tab" data-toggle="tab">Обзоры</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product__details__tab__content">
                        <div role="tabpanel" id="description" class="product__tab__content fade in active">
                            <div class="product__description__wrap">
                                <div class="product__desc">
                                    {!! $product->content !!}
                                </div>
                            </div>
                        </div>
                        @include ('shop.products.single._characteristics', compact('product'))
                        @include ('shop.products.single._comments', compact('product'))
                        @include ('shop.products.single._reviews', compact('product'))
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section ('scripts')
    <script>
        $(document).on("click", "#comments .reply_btn", function () {
            let link = $(this);
            let comment = link.closest(".review_item");
            console.log(comment.data("id"));
            $("#parent").val(comment.data("id"));
            $("#parent_comment").html(comment.data("title"));
            return false;
        });

        $(document).on("click", ".star", function () {
            let rating = $(this).data('rating');
            let input = $("#rating");

            for (let i = 5; i > rating; i--) {
                let currentStar = $("#star_" + i);
                currentStar.removeClass("fa-star");
                currentStar.addClass("fa-star-o");
            }

            for (let j = 1; j <= rating; j++) {
                let currentStar = $("#star_" + j);
                currentStar.removeClass("fa-star-o");
                currentStar.addClass("fa-star");
            }

            input.val(rating);

            return false;
        });

        $(document).on("click", ".add-to-cart", function () {
            let productId = $(this).data("product-id");
            let quantity = $("#qty").val();

            $.ajax({
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "url": "/shop/cart/add",
                "method": "POST",
                "data": {
                    productId: productId,
                    quantity: quantity
                },
                "success": function () {
                    let cartItemsCount = $("#cart-items-count");
                    let count = cartItemsCount.text();
                    cartItemsCount.text(parseInt(count) + parseInt(quantity));
                }
            });

            window.location.href = "/shop/cart";
        });
    </script>

    <script>
        $(document).on("click", ".add-to-wishlist", function () {
            let productId = $(this).data("id");

            $.ajax({
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "url": "/my/wishlist/item/create",
                "method": "POST",
                'data': {
                    productId: productId
                },
                "success": function (data) {
                    alert("Товар успешно добавлен в список желаний");
                },
                "error": function (e) {
                    console.log(e);
                }
            });

            return false;
        });
    </script>

    <script>
        $(document).on("click", ".add-to-comparison", function () {
            let productId = $(this).data("id");

            $.ajax({
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "url": "/my/comparison/item/add",
                "method": "POST",
                'data': {
                    productId: productId
                },
                "success": function (data) {
                    alert("Товар успешно добавлен в сравнение");
                }
            });

            return false;
        });
    </script>
@endsection