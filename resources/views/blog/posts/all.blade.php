@extends('layouts.app')
@section('content')
    <div class="wrapper fixed__footer">
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Блог</h2>
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
                        @include ('blog.posts._list')
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection