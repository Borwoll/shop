@extends ('layouts.app')

@section ('content')

<div class="wrapper fixed__footer">
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Магазин</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="htc__shop__sidebar bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div class="htc__shop__left__sidebar">
                        @include ('shop.products._sidebar')
                    </div>
                </div>
                <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12 smt-30">
                    <div class="row">
                        <div class="shop__grid__view__wrap another-product-style">
                            <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                @foreach ($category->products as $product)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-product">
                                            <img class="img-fluid" src="{{ $product->photos()->first()->getUrl() }}" alt="">
                                            <div class="product-details">
                                                <h6>{{ $product->title }}</h6>
                                                <div class="price">
                                                    <h6>${{ $product->price }}</h6>
                                                </div>
                                                <div class="prd-bottom">
                                                    <a href="" class="social-info">
                                                        <span class="ti-bag"></span>
                                                        <p class="hover-text">add to bag</p>
                                                    </a>
                                                    <a href="" class="social-info">
                                                        <span class="lnr lnr-heart"></span>
                                                        <p class="hover-text">Wishlist</p>
                                                    </a>
                                                    <a href="" class="social-info">
                                                        <span class="lnr lnr-sync"></span>
                                                        <p class="hover-text">compare</p>
                                                    </a>
                                                    <a href="{{ route('shop.products.single', ['id' => $product->id, 'slug' => $product->slug]) }}" class="social-info">
                                                        <span class="lnr lnr-move"></span>
                                                        <p class="hover-text">view more</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection