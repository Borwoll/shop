<div class="col-xl-9 col-lg-8 col-md-7">
    <section class="lattest-product-area pb-40 category-list">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                    <div class="product">
                        <div class="product__inner">
                            <div class="pro__thumb">
                                <a href="#">
                                    <img src="{{ $product->photos()->exists() ? $product->photos()->first()->getUrl() : '' }}" alt="product images">
                                </a>
                            </div>
                            <div class="product__hover__info">
                                <ul class="product__action">
                                    <li><a title="Подробнее" href="{{ route('shop.products.single', ['id' => $product->id, 'slug' => $product->slug]) }}"><span class="lnr lnr-move"></span></a></li>
                                    <li><a title="В сравнение" href="#" class="add-to-comparison" data-id="{{ $product->id }}"><span class="lnr lnr-sync"></span></a></li>
                                    <li><a title="В избранное" href="#" class="add-to-wishlist" data-id="{{ $product->id }}"><span class="lnr lnr-heart"></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product__details">
                            <h2><a href="product-details.html">{{ $product->title }}</a></h2>
                            <ul class="product__price">
                                <li class="new__price">{{ $product->price }} ₽</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </section>
</div>

@section ('scripts')
    <script>
        $(document).on("click", ".add-to-cart", function () {
            let productId = $(this).data("product-id");
            let quantity = 1;

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
                    cartItemsCount.text(+ count + quantity);
                }
            });
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