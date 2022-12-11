@extends('layouts.app')
@section('content')
    <section class="htc__product__area ptb--130 bg__white">
        <div class="container">
            <div class="htc__product__container">
                <div class="row">
                    <div class="product__list another-product-style">
                        <div class="col-lg-8">
                            <div class="blog_left_sidebar">

                                @include ('blog.posts._list')

                            </div>
                        </div>

                        @include ('blog.posts._sidebar')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection